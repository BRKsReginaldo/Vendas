import Vue from 'vue'
import Router from 'vue-router'
import routes from "./routes"
import store from '../store'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (window.matchMedia(`(max-width: 991px)`).matches && store.getters['ui/sidebarOpen']) {
    store.dispatch('ui/setSidebarOpen', false)
  }

  if (to.matched.some(route => route.meta.auth)) {
    if (localStorage.getItem('auth_credentials') === null) {
      next({
        path: '/login',
        params: {
          nextUrl: to.fullPath
        }
      })
    }
  } else if (to.matched.some(route => route.meta.guest)) {
    if (localStorage.getItem('auth_credentials') !== null) {
      next({
        path: '/'
      })
    }
  }

  if (to.matched.some(route => route.meta.can)) {
    if (!to.matched.filter(route => typeof route.meta.can === 'function').every(route => route.meta.can())) {
      unauthorizedError()
      next({
        path: '/'
      })
    }
  }

  next()
})

export default router
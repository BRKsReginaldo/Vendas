import Vue from 'vue'
import Router from 'vue-router'
import routes from "./routes"

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
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

  next()
})

export default router
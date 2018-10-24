import Vue from 'vue'
import './bootstrap'
import '@fortawesome/fontawesome-free/css/all.css'
import './assets/sass/main.scss'
import {i18n, mutations} from './plugins'
import App from './App.vue'
import store from './store'
import router from './router'
import Page from './components/Page'
import baseMutations from './mutations'

Vue.config.productionTip = false

Vue.component('page', Page)

Vue.use(mutations, {
  mutations: baseMutations
})

new Vue({
  router,
  store,
  i18n,
  mounted() {
    store.dispatch('auth/setupAuth')
  },
  render: h => h(App)
}).$mount('#app')

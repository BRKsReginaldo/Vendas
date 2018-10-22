import Vue from 'vue'
import './bootstrap'
import '@fortawesome/fontawesome-free/css/all.css'
import './assets/sass/main.scss'
import {i18n} from './plugins'
import App from './App.vue'
import store from './store'
import router from './router'
import Page from './components/Page'

Vue.config.productionTip = false

Vue.component('page', Page)

new Vue({
  router,
  store,
  i18n,
  mounted() {
    store.dispatch('auth/setupAuth')
  },
  render: h => h(App)
}).$mount('#app')

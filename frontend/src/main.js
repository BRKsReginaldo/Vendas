import Vue from 'vue'
import {i18n} from './plugins'
import App from './App.vue'
import store from './store'
import router from './router'
import '@fortawesome/fontawesome-free/css/all.css'
import './bootstrap'
import './assets/sass/main.scss'
import Page from './components/Page'
import swal from "sweetalert"

Vue.config.productionTip = false

Vue.component('page', Page)

window.unknownError = () => swal($t('notifications.title.error'), $t('notifications.message.error'))

const app = new Vue({
  router,
  store,
  i18n,
  mounted() {
    store.dispatch('auth/setupAuth')
  },
  render: h => h(App)
}).$mount('#app')

window.$t = (...args) => app.$t(...args)

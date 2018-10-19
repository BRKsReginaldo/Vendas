import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@fortawesome/fontawesome-free/css/all.css'
import './bootstrap'
import './assets/sass/main.scss'
import moment from "moment/moment"

Vue.config.productionTip = false

new Vue({
  router,
  store,
  mounted() {
    this.$store.dispatch('auth/setupAuth')
    this.$store.dispatch('auth/checkRefresh')
  },
  render: h => h(App)
}).$mount('#app')

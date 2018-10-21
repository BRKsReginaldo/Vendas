import Vue from 'vue'
import swal from 'sweetalert'
import VueNotifications from 'vue-notifications'

const toast = ({title, message, type, timeout, cb = () => null}) => {
  if (type === VueNotifications.types.warn) type = 'warning'
  if (type === 'test') type = 'error'
  return swal(title, message, type).then(cb)
}

const options = {
  success: toast,
  error: toast,
  info: toast,
  warn: toast,
  test: toast
}

Vue.use(VueNotifications, options)
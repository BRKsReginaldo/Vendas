import Vue from 'vue'
import VueI18n from 'vue-i18n'
import messages from "@/config/i18n"

Vue.use(VueI18n)

export default new VueI18n({
  locale: 'pt_BR',
  fallbackLocale: 'pt_BR',
  messages
})
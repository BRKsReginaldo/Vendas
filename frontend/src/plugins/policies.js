import Vue from 'vue'
import store from '../store'
import policies from '@/config/policies'

class Authorization {
  install = (_Vue) => {
    this._Vue = _Vue
    this.policies = {}

    this.loadPolicies()
    this._Vue.prototype.$can = this.$can
    window.$can = this.$can
  }

  getUser = () => {
    if (!store.getters['auth/user'] && !!localStorage.getItem('auth_user')) return JSON.parse(localStorage.getItem('auth_user'))
    return store.getters['auth/user']
  }

  beforeify = (before, method, fn) => {

    return ((user, ...args) => {
      const authUser = this.getUser()
      if (!authUser) return false
      let beforeResult = before(authUser, method)
      if (beforeResult === true || beforeResult === false) return beforeResult

      return fn(user, ...args)
    })
  }

  loadPolicies = () => {
    const policyGroups = Object.keys(policies)
    this.policies = policyGroups.reduce((carry, group) => {
      const methods = Object.keys(policies[group])
      const hasBefore = methods.indexOf('before') >= 0
      const filteredMethods = methods.filter(method => method !== 'before')
      const reducedMethods = filteredMethods.reduce((carry, method) => {
        carry[`${method}${group}`] = hasBefore ? this.beforeify(policies[group]['before'], method, policies[group][method]) : policies[group][method]
        return carry
      }, {})
      return {
        ...carry,
        ...reducedMethods
      }
    }, {})
  }

  $can = (ability, ...params) => {
    if (!this.policies.hasOwnProperty(ability)) throw new Error(`Unknown policy [${ability}]`)
    return this.policies[ability](this.getUser(), ...params)
  }
}

const Auth = new Authorization()


Vue.use(Auth)
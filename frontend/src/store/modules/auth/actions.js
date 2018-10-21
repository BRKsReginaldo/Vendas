import {simpleAction} from "../../helpers"
import {requiredParam} from "../../../helpers"
import moment from 'moment'
import UserService from "../../../services/UserService"
import swal from 'sweetalert'
import router from '@/router'

const AUTH_KEY = 'auth_credentials'

export const setupAuth = ({dispatch}) => {
  const credentials = localStorage.getItem(AUTH_KEY)

  if (credentials) {
    const jsonCredentials = JSON.parse(credentials)
    const expires = moment(jsonCredentials.expires_in)

    if (expires.isBefore(moment())) return dispatch('logout')
    if (expires.diff(moment(), 'days') <= 30) return dispatch('refreshToken')

    dispatch('setCredentials', jsonCredentials)
  } else {
    dispatch('logout')
  }
}

export const refreshToken = async ({dispatch}) => {
  const credentials = localStorage.getItem(AUTH_KEY)

  if (credentials) {
    const jsonCredentials = JSON.parse(credentials)

    try {
      const response = await UserService.refreshToken(jsonCredentials.refresh_token)

      dispatch('setCredentials', response.data)
    } catch (e) {
      if (e.response.status === 401) return dispatch('logout')
      unknownError()
    }
  } else {
    dispatch('logout')
  }
}

export const login = async ({commit, dispatch}, {email = requiredParam(), password = requiredParam()}) => {
  try {
    const response = await UserService.login(email, password)

    const data = response.data

    data.expires_in = moment().add(data.expires_in, 'seconds').toISOString()

    dispatch('setCredentials', data)
  } catch (e) {
    if (e.response.status === 422) {
      return Promise.reject({
        errors: e.response.data.errors
      })
    } else if (e.response.status === 401) {
      return Promise.reject({
        errors: {
          general: ['email ou senha incorretos']
        }
      })
    }

    unknownError()
  }
}

export const setCredentials = ({commit, dispatch}, payload) => {
  commit('SET_CREDENTIALS', payload)
  localStorage.setItem(AUTH_KEY, JSON.stringify(payload))
  dispatch('fetchUser')
}

export const fetchUser = async ({commit, dispatch}) => {
  try {
    const response = await UserService.fetchUser()

    commit('SET_USER', response.data.data)
  } catch (e) {
    if (e.response.status === 401) {
      dispatch('logout')
      router.push({
        name: 'login'
      })
    }
  }
}

export const logout = ({commit}) => {
  localStorage.removeItem(AUTH_KEY)
  commit('LOGOUT')
}

export const verifyPassword = async () => {
  return swal({
    title: $t('notifications.title.user.verifyPassword'),
    content: {
      element: 'input',
      attributes: {
        type: 'password',
        placeholder: $t('placeholders.password')
      }
    }
  })
    .then(async password => {
      if (!password) return Promise.reject({manual: true})
      return await UserService.verifyPassword(password)
    })
    .then(res => {
      return res.data.matches
    })
    .catch(e => {
      try {
        if (e && e.response && e.response.status === 422) {
          const errors = e.response.data.errors.password_check
          swal($t('notifications.title.error'), errors.join('\n'))
        } else if (e.manual) {

        }
          else {
          unknownError()
        }
      } catch (e) {
        if (process.env.NODE_ENV !== 'production') {
          console.log(e)
        }
      }
      finally {
        return false
      }
    })
}

export const updateUser = async ({getters, dispatch}, payload) => {
  try {
    const response = await UserService.update(getters.user.id, payload)

    dispatch('fetchUser')
      .then(() => swal($t('notifications.title.success'), $t('notifications.message.user.update.success'), 'success'))

    return {}
  } catch(e) {
    if (e && e.response && e.response.status === 422) {
      return {
        errors: e.response.data.errors
      }
    } else {
      unknownError()
    }

    return {}
  }
}
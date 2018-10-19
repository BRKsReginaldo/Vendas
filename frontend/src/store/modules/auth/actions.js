import {simpleAction} from "../../helpers"
import {requiredParam} from "../../../helpers"
import * as UserService from "../../../services/UserService"
import moment from 'moment'

export const setUser = simpleAction('SET_USER')

export const setCredentials = simpleAction('SET_CREDENTIALS')

export const setupAuth = ({commit}) => commit('SETUP_AUTH')

export const fetchUser = async ({dispatch}) => {
  try {
    const {data: {data}} = await UserService.fetchUser()

    dispatch('setUser', data)
  } catch (e) {
    if (process.env.NODE_ENV !== 'production') {
      console.log(e)
    }

    if (e.response.status === 401) {
      if (location.pathname !== '/login') {
        dispatch('logout')
        location.reload()
      }
    }
  }
}

export const logout = simpleAction('LOGOUT')

export const checkRefresh = async ({dispatch, state}) => {
  if (!state.credentials) return

  const credentials = state.credentials
  const now = moment()
  const expires = moment(credentials.expires_in)

  if (expires.isBefore(now)) {
    dispatch('logout')
    // Refresh the page
    location.reload()
  }

  if (expires.diff(now, 'days') < 30) {
    const {data} = await UserService.refreshToken(credentials.refresh_token)

    await dispatch('setCredentials', {
      ...data,
      expires_in: moment().add(data.expires_in, 'seconds').toDate().toISOString()
    })

    dispatch('setupAuth')
  }
}

export const login = async ({dispatch}, {email = requiredParam(), password = requiredParam()}) => {
  try {
    const {data} = await UserService.login(email, password)

    await dispatch('setCredentials', {
      ...data,
      expires_in: moment().add(data.expires_in, 'seconds').toDate().toISOString()
    })

    dispatch('setupAuth')
  } catch (e) {
    if (process.env.NODE_ENV !== 'production') {
      console.log(e)
    }
    if (e.response.status === 422) {
      return e.response.data
    } else if (e.response.status === 401) {

      return {
        errors: {
          general: ['o email ou senha estão incorretos!']
        }
      }
    }
  }

  return {}
}
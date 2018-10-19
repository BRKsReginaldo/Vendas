import {simpleMutation} from "../../helpers"

export const SET_USER = simpleMutation('user')
export const SET_CREDENTIALS = simpleMutation('credentials')
export const SETUP_AUTH = () => null
export const LOGOUT = (state) => {
  state.user = null
  state.credentials = null
}
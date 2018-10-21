import {composedMutations, simpleMutation} from "../../helpers"

export const SET_USER = simpleMutation('user')
export const SET_CREDENTIALS = simpleMutation('credentials')
export const LOGOUT = (state) => composedMutations(
  simpleMutation('user'),
  simpleMutation('credentials')
)(state, null)
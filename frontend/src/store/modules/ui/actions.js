import {simpleAction} from "../../helpers"

export const setSidebarOpen = simpleAction('SET_SIDEBAR_OPEN')

export const toggleSidebarOpen = ({dispatch, state}) => {
  dispatch('setSidebarOpen', !state.sidebarOpen)
}
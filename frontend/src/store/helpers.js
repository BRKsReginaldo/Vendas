import {flow} from 'lodash'

export const simpleAction = mutationName => ({commit}, payload) => commit(mutationName, payload)
export const simpleMutation = stateKey => (state, payload) => state[stateKey] = payload
export const simpleGetter = stateKey => state => state[stateKey]
export const composedMutations = (...mutations) => (state, payload) => {
  mutations.forEach(m => m(state, payload))
}
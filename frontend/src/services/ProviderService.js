import client from "../helpers/client"

export default {
  create(data) {
    if (!$can('createProvider')) return unauthorizedError().then(() => Promise.reject(false))
    return client.post('/api/providers', data)
  },
  delete(provider) {
    if (!$can('deleteProvider', provider)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelDelete(`/api/providers/${provider.id}`)
  },
  restore(provider) {
    if (!$can('restoreProvider', provider)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/providers/restore/${provider.id}`)
  },
  show(providerId) {
    if (!$can('viewProvider')) return unauthorizedError().then(() => Promise.reject(false))
    return client.get(`/api/providers/${providerId}`)
  },
  update(provider, data) {
    if (!$can('updateProvider', provider)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/providers/${provider.id}`, data)
  }
}
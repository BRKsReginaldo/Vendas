import client from "../helpers/client"

export default {
  create(userId) {
    if (!$can('createClient', userId)) return unauthorizedError().then(() => Promise.reject(false))
    return client.post('/api/clients', {user_id: userId})
  },
  disable(clientId) {
    if (!$can('disableClient', clientId)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelDelete(`/api/clients/disable/${clientId}`)
  },
  enable(clientId) {
    if (!$can('enableClient', clientId)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/clients/enable/${clientId}`)
  }
}
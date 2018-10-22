import client from '../helpers/client'

export default {
  login(email, password) {
    return client.post('/api/login', {email, password})
  },

  fetchUser() {
    return client.get('/api/user')
  },

  refreshToken(refreshToken) {
    return client.post('/api/refresh', {refreshToken})
  },

  verifyPassword(password_check) {
    return client.post('/api/verify', {password_check})
  },

  update(userId, data) {
    if (!$can('updateUser', {id: userId})) return unauthorizedError().then(() => false)
    return client.laravelPut(`/api/users/${userId}`, data)
  },

  create(data) {
    if (!$can('createUser')) return unauthorizedError().then(() => false)
    return client.post('/api/users', data)
  },

  delete(userId) {
    if (!$can('deleteUser', {id: userId})) return unauthorizedError().then(() => false)
    return client.laravelDelete(`/api/users/${userId}`)
  },

  restore(userId) {
    if (!$can('restoreUser', {id: userId})) return unauthorizedError().then(() => false)
    return client.laravelPatch(`/api/users/restore/${userId}`)
  },

  fetchAll() {
    return client.get('/api/users')
  }
}
import client from '../helpers/client'

export default {
  login(email, password) {
    return client.post('/login', {email, password})
  },

  fetchUser() {
    return client.get('/api/user')
  },

  refreshToken(refreshToken) {
    return client.post('/refresh', {refreshToken})
  },

  verifyPassword(password_check) {
    return client.post('/verify', {password_check})
  },

  update(userId, data) {
    return client.laravelPut(`/api/users/${userId}`, data)
  }
}
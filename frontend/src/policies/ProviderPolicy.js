export default {
  view(user) {
    return !!user.client_id
  },
  create(user) {
    return !!user.client_id
  },
  delete(user, provider) {
    return user.client_id && user.client_id === provider.client_id
  },
  restore(user, provider) {
    return user.client_id && user.client_id === provider.client_id
  },
  update(user, provider) {
    return user.client_id && user.client_id === provider.client_id
  }
}
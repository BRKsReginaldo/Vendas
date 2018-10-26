export default {
  view(user) {
    return !!user.client_id
  },
  create(user) {
    return !!user.client_id
  },
  delete(user, product) {
    return user.client_id && user.client_id === product.client_id
  },
  restore(user, product) {
    return user.client_id && user.client_id === product.client_id
  },
  update(user, product) {
    return user.client_id && user.client_id === product.client_id
  }
}
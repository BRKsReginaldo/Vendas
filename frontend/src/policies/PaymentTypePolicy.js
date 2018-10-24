export default {
  view(user) {
    return !!user.client_id
  },
  create(user) {
    return !!user.client_id
  },
  delete(user, paymentType) {
    return user.client_id && user.client_id === paymentType.client_id
  },
  restore(user, paymentType) {
    return user.client_id && user.client_id === paymentType.client_id
  },
  update(user, paymentType) {
    return user.client_id && user.client_id === paymentType.client_id
  }
}
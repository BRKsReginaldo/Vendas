export default {
  view(user) {
    return !!user.client_id
  },
  create(user) {
    return !!user.client_id
  },
  update(user, payment) {
    return user.client_id && user.client_id === payment.client_id
  }
}
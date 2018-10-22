export default {
  view(user) {
    return !!user.client_id
  },
  create(user) {
    return !!user.client_id
  },
  delete(user, customer) {
    return user.client_id && user.client_id === customer.client_id
  },
  restore(user, customer) {
    return user.client_id && user.client_id === customer.client_id
  },
}
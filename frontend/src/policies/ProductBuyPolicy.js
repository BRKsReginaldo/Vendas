export default {
  buy(user, product) {
    return !product || (user.client_id && user.client_id === product.client_id)
  }
}
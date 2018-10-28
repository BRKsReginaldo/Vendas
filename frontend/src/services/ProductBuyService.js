import client from "../helpers/client"

export default {
  buy(data, product) {
    if (!$can('buyProductBuy', product)) return unauthorizedError().then(() => false)
    return client.post('/api/product-buys', data)
  }
}
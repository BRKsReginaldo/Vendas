import client from "../helpers/client"

export default {
  create(data) {
    if (!$can('createProduct')) return unauthorizedError().then(() => Promise.reject(false))
    return client.post('/api/products', data)
  },
  delete(product) {
    if (!$can('deleteProduct', product)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelDelete(`/api/products/${product.id}`)
  },
  restore(product) {
    if (!$can('restoreProduct', product)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/products/restore/${product.id}`)
  },
  show(productId) {
    if (!$can('viewProduct')) return unauthorizedError().then(() => Promise.reject(false))
    return client.get(`/api/products/${productId}`)
  },
  update(product, data) {
    if (!$can('updateProduct', product)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/products/${product.id}`, data)
  }
}
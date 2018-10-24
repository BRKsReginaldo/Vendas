import client from "../helpers/client"

export default {
  create(data) {
    if (!$can('createPaymentType')) return unauthorizedError().then(() => Promise.reject(false))
    return client.post('/api/payment-types', data)
  },
  delete(paymentType) {
    if (!$can('deletePaymentType', paymentType)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelDelete(`/api/payment-types/${paymentType.id}`)
  },
  restore(paymentType) {
    if (!$can('restorePaymentType', paymentType)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/payment-types/restore/${paymentType.id}`)
  },
  show(paymentTypeId) {
    if (!$can('viewPaymentType')) return unauthorizedError().then(() => Promise.reject(false))
    return client.get(`/api/payment-types/${paymentTypeId}`)
  },
  update(paymentType, data) {
    if (!$can('updatePaymentType', paymentType)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/payment-types/${paymentType.id}`, data)
  }
}
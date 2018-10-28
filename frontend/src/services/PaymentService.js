import client from '../helpers/client'

export default {
  create(data) {
    if (!$can('createPayment')) return unauthorizedError().then(() => false)
    return client.post('/api/payments', data)
  }
}
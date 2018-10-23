import client from "../helpers/client"

export default {
  create(data) {
    if (!$can('createCustomer')) return unauthorizedError().then(() => Promise.reject(false))
    return client.post('/api/customers', data)
  },
  delete(customer) {
    if (!$can('deleteCustomer', customer)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelDelete(`/api/customers/${customer.id}`)
  },
  restore(customer) {
    if (!$can('restoreCustomer', customer)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/customers/restore/${customer.id}`)
  },
  show(customerId) {
    if (!$can('viewCustomer')) return unauthorizedError().then(() => Promise.reject(false))
    return client.get(`/api/customers/${customerId}`)
  },
  update(customer, data) {
    if (!$can('updateCustomer', customer)) return unauthorizedError().then(() => Promise.reject(false))
    return client.laravelPut(`/api/customers/${customer.id}`, data)
  }
}
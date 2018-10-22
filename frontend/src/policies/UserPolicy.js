export default {
  before(user, ability) {
    if (user.roles.some(role => role.name === 'admin')) return true
  },
  create(user) {
    return false
  },
  update(user, model) {
    return user.id === model.id
  },
  restore(user, model) {
    return false
  },
  delete(user, model) {
    return user.id === model.id
  }
}
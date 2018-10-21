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
  delete(user, model) {
    return user.id === model.id
  }
}
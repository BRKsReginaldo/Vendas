export default {
  before(user, ability) {
    if (user.roles.some(role => role.name === 'admin')) return true
  },
  create(user, userId) {
    return user.id === userId
  },
  view(user) {
    return false;
  },
  disable(user, clientId) {
    return false;
  },
  enable(user, clientId) {
    return false;
  }
}
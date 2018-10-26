export default {
  view(user) {
    return user.roles.some(role => role.name === 'seller') && !user.roles.some(role => role.name === 'admin')
  }
}
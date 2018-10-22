export default {
  computed: {
    user() {
      return this.$store.getters['auth/user']
    },
    credentials() {
      return this.$store.getters['auth/credentials']
    },
    requestAuth() {
      return {
        headers: {
          Authorization: `Bearer ${this.credentials.access_token}`
        }
      }
    }
  }
}
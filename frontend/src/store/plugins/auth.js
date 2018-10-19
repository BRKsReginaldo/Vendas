
export default store => {
  const handleSetupCredentials = credentials => {
    localStorage.setItem('auth_credentials', JSON.stringify(credentials))
  }

  const setupAuth = credentials => {
    if (!credentials) {
      return localStorage.removeItem('auth_credentials')
    }

    axios.defaults.headers.common.Authorization = `Bearer ${credentials.access_token}`

    store.dispatch('auth/fetchUser')
    store.commit('auth/SET_CREDENTIALS', credentials)
  }

  const logout = () => {
    localStorage.removeItem('auth_credentials')

    delete axios.defaults.headers.common.Authorization
  }

  store.subscribe((mutation) => {
    switch (mutation.type) {
      case 'auth/SET_CREDENTIALS':
        handleSetupCredentials(mutation.payload)
        break
      case 'auth/SETUP_AUTH':
        setupAuth(JSON.parse(localStorage.getItem('auth_credentials')))
        break
      case 'auth/LOGOUT':
        logout()
        break
    }
  })
}
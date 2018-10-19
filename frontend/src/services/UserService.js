export const login = (email, password) => axios.post('/login', {email, password})
export const fetchUser = () => axios.get('/api/user')
export const refreshToken = (token) => axios.post('/refresh', {refreshToken: token})
export default {
  authFailed (state) {
    state.currentUser = null
    state.isLoggedIn = false
    state.isActive = false
    state.authError = true
    state.isAdmin = false
    state.isEditor = false
    state.permissions = []
    localStorage.removeItem('token')
  },
  authSuccess (state, { user }) {
    state.authError = false
    state.isLoggedIn = true
    state.isActive = true

    if (user.level_access >= 1) {
      state.isEditor = true
    }

    if (user.level_access >= 2) {
      state.isAdmin = true
    }
  },
  setToken (state, payload) {
    try {
      const token = payload.access_token
      state.token = token
      localStorage.setItem('token', token)
    } catch (e) {
      console.error(e)
    }
  },
  setUser (state, payload) {
    state.currentUser = payload.user
  },
}

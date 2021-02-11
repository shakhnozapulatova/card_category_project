export default function auth ({ next, store }) {
  if (!store.state.auth.isLoggedIn) {
    return next({
      name: 'login',
    })
  }

  return next()
}

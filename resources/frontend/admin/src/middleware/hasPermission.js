export default function auth ({ next, store }) {
  if (!store.getters.auth.id || localStorage.getItem('token')) {
    return next({
      name: 'login',
    })
  }

  return next()
}

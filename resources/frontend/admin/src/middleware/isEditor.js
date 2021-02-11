export default function isAdmin ({ next, store }) {
  if (!store.state.auth.isEditor) {
    return next({
      name: 'login',
    })
  }
  return next()
}

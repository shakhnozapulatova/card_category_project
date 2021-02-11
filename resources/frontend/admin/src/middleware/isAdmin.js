export default function isAdmin ({ next, store }) {
  if (!store.state.auth.isAdmin) {
    return next({
      name: 'home',
    })
  }
  return next()
}

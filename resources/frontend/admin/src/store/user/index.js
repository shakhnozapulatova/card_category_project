import HttpService from '@/services/HttpService'

export default {
  namespaced: true,
  state: {
    users: [],
  },
  mutations: {
    setUsers (state, users) {
      state.users = users
    },
  },
  getters: {
    users: (state) => {
      return state.users
    },
  },
  actions: {
    fetchUsersList ({ commit }, params) {
      return HttpService.get('users', params)
        .then(({ data }) => {
          const users = data.data.map((user) => {
            return {
              id: user.id,
              name: user.name,
              email: user.email,
            }
          })
          commit('setUsers', users)
        })
    },
  },
}

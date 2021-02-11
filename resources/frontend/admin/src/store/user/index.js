import UserResourceService from '@/services/UserService'

export default {
  namespaced: true,
  actions: {
    getUserList ({ commit }, params = {}) {
      return UserResourceService.getResourceList(params)
    },
    getUserById ({ commit }, id) {
      return UserResourceService.getResourceList(id)
    },
    createUser ({ commit }, data) {
      return UserResourceService.createResource(data)
    },
    updateUser ({ commit }, id, data) {
      return UserResourceService.updateResource(id, data)
    },
    deleteUser ({ commit }, id) {
      return UserResourceService.deleteResourceById(id)
    },
    getUpdateForm ({ commit }, id) {
      return UserResourceService.getUpdateForm(id)
    },
    getCreateForm ({ commit }) {
      return UserResourceService.getCreateForm()
    },
  },
}

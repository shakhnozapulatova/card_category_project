import { CategoryService } from '@/services/CategoryService'

export default {
  namespaced: true,
  actions: {
    getCategoryList ({ commit }, params = {}) {
      return CategoryService.getResourceList(params)
    },
    getCategoryById ({ commit }, id) {
      return CategoryService.getResourceList(id)
    },
    createCategory ({ commit }, data) {
      return CategoryService.createResource(data)
    },
    updateCategory ({ commit }, { id, params }) {
      return CategoryService.updateResource(id, params)
    },
    deleteCategory ({ commit }, id) {
      return CategoryService.deleteResourceById(id)
    },
    getUpdateForm ({ commit }, id) {
      return CategoryService.getUpdateForm(id)
    },
    getCreateForm ({ commit }) {
      return CategoryService.getCreateForm()
    },
  },
}
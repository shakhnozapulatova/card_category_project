import { ProductService } from '@/services/ProductService'

export default {
  namespaced: true,
  actions: {
    getProductList ({ commit }, params) {
      return ProductService.getResourceList(params)
    },
    getProductById ({ commit }, id) {
      return ProductService.getResourceList(id)
    },
    createProduct ({ commit }, data) {
      return ProductService.createResource(data)
    },
    updateProduct ({ commit }, { id, data }) {
      return ProductService.updateResource(id, data)
    },
    deleteProduct ({ commit }, id) {
      return ProductService.deleteResourceById(id)
    },
    getProductUpdateForm ({ commit }, id) {
      return ProductService.getUpdateForm(id)
    },
    getProductCreateForm ({ commit }) {
      return ProductService.getCreateForm()
    },
  },
}

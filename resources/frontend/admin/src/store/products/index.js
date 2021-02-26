import HttpService from '@/services/HttpService'
import store from '@/store'
export default {
  namespaced: true,
  actions: {
    getProductList ({ state }, params) {
      // import auth state from store
      const url = store.state.auth.isAdmin ? 'admin/products' : 'products'
      return HttpService.get(url, params)
    },
    getProductById ({ commit }, { id, params }) {
      const url = `products/${id}`
      return HttpService.get(url, params)
    },
    updateProduct ({ commit }, { id, data }) {
      const url = `products/${id}`
      return HttpService.put(url, data)
    },
    updateProductData ({ commit }, { id, data }) {
      const url = `product-data/${id}`
      return HttpService.put(url, data)
    },
    deleteProduct ({ commit }, id) {
      const url = `admin/products/${id}`
      return HttpService.delete(url)
    },
  },
}

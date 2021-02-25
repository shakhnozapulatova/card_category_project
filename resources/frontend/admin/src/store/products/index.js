import HttpService from '@/services/HttpService'

export default {
  namespaced: true,
  actions: {
    getProductList ({ commit }, params) {
      return HttpService.get('products', params)
    },
    getProductById ({ commit }, { id, params }) {
      const url = `products/${id}`
      return HttpService.get(url, params)
    },
    updateProduct ({ commit }, { id, data }) {
      const url = `products/${id}`
      return HttpService.post(url, data)
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

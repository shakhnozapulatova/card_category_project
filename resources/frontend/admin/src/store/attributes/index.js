import HttpService from '@/services/HttpService'

export default {
  namespaced: true,
  state: {
    attributes: {},
  },
  mutations: {
    setAttribute (state, payload) {
      const { key } = payload
      state.attributes[key] = payload.data
    },
  },
  getters: {
    getAttributeByKey: state => key => {
      return state.attributes[key]
    },
  },
  actions: {
    getOptions ({ commit }, attributeName) {
      return HttpService.get('product-attributes-option', {
        attribute: attributeName,
      })
    },
  },
}

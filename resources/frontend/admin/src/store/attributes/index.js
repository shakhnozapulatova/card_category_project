import HttpService from '@/services/HttpService'

export default {
  namespaced: true,
  state: {
    attributes: {},
    atx: [],
  },
  mutations: {
    setAttribute (state, { key, data }) {
      state[key] = data
      state.attributes[key] = data
    },
  },
  getters: {
    getAttributeByKey: state => key => {
      return state[key]
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

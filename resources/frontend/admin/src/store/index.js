import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import user from './user'
import ui from './ui'
import alert from './alert'
import category from './category'
import product from './products'
import productData from './product-data'

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  modules: {
    ui, alert, auth, category, user, product, productData,
  },
})

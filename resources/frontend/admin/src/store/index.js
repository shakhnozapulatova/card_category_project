import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import user from './user'
import ui from './ui'
import alert from './alert'
import product from './products'
import attributes from './attributes'

Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  modules: {
    ui, alert, auth, user, product, attributes,
  },
})

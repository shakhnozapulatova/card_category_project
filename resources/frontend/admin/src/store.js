import Vue from 'vue'
import Vuex from 'vuex'
import user from './store/user'
import users from './store/users'
import ui from './store/ui'
// eslint-disable-next-line camelcase
import alert_message from './store/alert_message'
Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    ui, alert_message, user, users,
  },
})

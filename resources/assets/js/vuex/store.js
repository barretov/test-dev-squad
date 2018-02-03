import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
  count: 0,
  lists: [],
}

const mutations = {
  increment: state => state.count++,
  addList: state => state.lists.push({id: state.lists.length, name: state.lists.length}),
}

export default new Vuex.Store({
  state,
  mutations
})

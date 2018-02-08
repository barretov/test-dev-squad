import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
	idx: 1,
	store: [],
}

const mutations = {
	ADDLIST (state) {
		state.store.push({
			id: state.idx,
			name: state.idx,
			cards: []
		})
		state.idx++
	},

	SAVELIST (state, data) {
		let index = arrayIndex(state.store, data.id)
		state.store[index].name = data.name
	},

	DELLIST (state, id) {
		let index = arrayIndex(state.store, id)
		state.store.splice(index, 1)
	},

	ADDCARD (state, id) {
		let index = arrayIndex(state.store, id)

		state.store[index].cards.push({
			idLst: id,
			id: state.idx,
			data: ''
		})
		state.idx++
	},

	SAVECARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		let cardIdx = arrayIndex(state.store[index].cards, data.id)
		state.store[index].cards[cardIdx].data = data.data,
		state.store[index].cards[cardIdx].id = data.id,
		state.store[index].cards[cardIdx].idLst = data.idLst,
		state.store[index].cards[cardIdx].owner = data.owner
	},

	DRAGCARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		// change idLst of moved cards
		for (var i = data.value.length - 1; i >= 0; i--) {
			data.value[i].idLst = data.idLst
		};
		state.store[index].cards = data.value
	},

	DELCARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		let cardIdx = arrayIndex(state.store[index].cards, data.id)
		state.store[index].cards.splice(cardIdx, 1)
	},
}

export default new Vuex.Store({
	state,
	mutations
})

/**
 * Function to identify the object id in the index List
 * @param  {data} data Data data
 * @param  {int} id Id of object
 * @return {int} Index for operations
 */
 function arrayIndex(data, id) {
 	for (var i = data.length -1; i >= 0; i--) {
 		if (data[i].id === id) {
 			return i
 		}
 	};
 }

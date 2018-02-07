import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
	idx: 1,
	idxCard: 1,
	lists: [],
	cards: [],
}

const mutations = {
	// ADDLIST (state) {
	// 	state.lists.push({
	// 		id: state.idxList,
	// 		name: state.idxList
	// 	})
	// 	state.idxList++
	// },
	ADDLIST (state) {
		state.lists.push({
			id: state.idx,
			name: state.idx,
			cards: []
		})
		state.idx++
	},

	SAVELIST (state, data) {
		let index = arrayIndex(state.lists, data.id)
		state.lists[index].name = data.name
	},

	DELLIST (state, id) {
		let index = arrayIndex(state.lists, id)
		state.lists.splice(index, 1)
	},

	// ADDCARD (state, id) {
	// 	state.cards.push({
	// 		idLst: id,
	// 		id: state.idxCard,
	// 		data: state.idxCard
	// 	})
	// 	state.idxCard++
	// },
	ADDCARD (state, id) {
		let index = arrayIndex(state.lists, id)

		state.lists[index].cards.push({
			idLst: id,
			id: state.idx,
			data: state.idx
		})
		state.idx++
	},

	// SAVECARD (state, data) {
	// 	let index = arrayIndex(state.cards, data.id)
	// 	state.cards[index].data = data.data
	// 	state.cards[index].id = data.id
	// 	state.cards[index].idLst = data.idLst
	// 	state.cards[index].owner = data.owner
	// },

	SAVECARD (state, data) {
		console.log("savecard")
		console.log(data)
		let index = arrayIndex(state.lists, data.idLst)
		let indexId = arrayIndex(state.lists[index].cards, data.id)
		console.log("index: " + index)
		console.log("indexId: " + indexId)

			state.lists[index].cards[indexId].data = data.data,
			state.lists[index].cards[indexId].id = data.id,
			state.lists[index].cards[indexId].idLst = data.idLst,
			state.lists[index].cards[indexId].owner = data.owner
	},

	DRAGCARD (state, data) {
		let index = arrayIndex(state.lists, data[0].id)
		// change idLst of moved cards
		for (var i = data.length - 1; i >= 0; i--) {
			data[i].idLst = data[0].id
		};
		data.splice(0, 1)
		console.log("DRAGCARD")
		console.log(data)
		state.lists[index].cards = data
	},

	DELCARD (state, id) {
		let index = arrayIndex(state.cards, id)
		state.cards.splice(index, 1)
	},
}

export default new Vuex.Store({
	state,
	mutations
})

/**
 * Function to identify the object id in the index List
 * @param  {array} array Data array
 * @param  {int} id Id of object
 * @return {int} Index for operations
 */
 function arrayIndex(array, id) {
 	for (var i = array.length -1; i >= 0; i--) {
 		if (array[i].id === id) {
 			return i
 		}
 	};
 }

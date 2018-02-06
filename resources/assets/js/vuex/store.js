import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
	idxList: 1,
	idxCard: 1,
	lists: [],
	cards: [],
}

const mutations = {
	ADDLIST (state) {
		state.lists.push({
			id: state.idxList,
			name: state.idxList
		})
		state.idxList++
	},

	SAVELIST (state, data) {
		let index = arrayIndex(state.lists, data.id)
		state.lists[index].name = data.name
	},

	DELLIST (state, id) {
		let index = arrayIndex(state.lists, id)
		state.lists.splice(index, 1)
	},

	ADDCARD (state, id) {
		state.cards.push({
			idLst: id,
			id: state.idxCard,
			data: state.idxCard
		})
		state.idxCard++
	},

	SAVECARD (state, data) {

		if (1 == data.length) {
			// ### @TODO: Remove this debug #### //
			let index = arrayIndex(state.cards, data.id)
			console.log("zero ou negativo"  +  index);
		}

		// state.cards[index].data = data.data
		// state.cards[index].id = data.id
		// state.cards[index].idLst = data.idLst
		// state.cards[index].owner = data.owner
	},

	DRAGCARD (state, data) {
		// ### @TODO: Remove this debug #### //
		console.log("### Drag ### "  +  data);
		let index = arrayIndex(state.cards, data.id)
		state.cards[index].data = data.data
		// state.cards[index].id = data.id
		// state.cards[index].idLst = data.idlst
		// state.cards[index].owner = data.owner
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

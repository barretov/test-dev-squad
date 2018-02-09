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
			name: '',
			cards: []
		})

		axios.post('/lists', {id: state.idx}).then((response) => {
		}).catch((err) => {
			console.log(err);
		});

		state.idx++
	},

	SAVELIST (state, data) {
		let index = arrayIndex(state.store, data.id)
		state.store[index].name = data.name

		axios.put('/lists/'+ data.id, {name: data.name}).then((response) => {
		}).catch((err) => {
			console.log(err);
		});
	},

	DELLIST (state, id) {
		let index = arrayIndex(state.store, id)
		state.store.splice(index, 1)

		axios.delete('/lists/'+ id).then((response) => {
		}).catch((err) => {
			console.log(err);
		});
	},

	ADDCARD (state, id) {
		let index = arrayIndex(state.store, id)

		state.store[index].cards.push({
			idLst: id,
			id: state.idx,
			data: ''
		})

		axios.post('/cards', {id: state.idx, idLst: id}).then((response) => {
		}).catch((err) => {
			console.log(err);
		});

		state.idx++
	},

	SAVECARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		let cardIdx = arrayIndex(state.store[index].cards, data.id)
		state.store[index].cards[cardIdx].data = data.data,
		state.store[index].cards[cardIdx].id = data.id,
		state.store[index].cards[cardIdx].idLst = data.idLst,
		state.store[index].cards[cardIdx].owner = data.owner

		axios.put('/cards/'+ data.id, {
			data: data.data,
			idLst: data.idLst,
			owner: data.owner
		}).then((response) => {
		}).catch((err) => {
			console.log(err);
		});
	},

	DELCARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		let cardIdx = arrayIndex(state.store[index].cards, data.id)
		state.store[index].cards.splice(cardIdx, 1)

		axios.delete('/cards/'+ data.id).then((response) => {
		}).catch((err) => {
			console.log(err);
		});
	},

	DRAGCARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		// change idLst of moved cards
		for (var i = data.value.length - 1; i >= 0; i--) {
			data.value[i].idLst = data.idLst
		};
		state.store[index].cards = data.value
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

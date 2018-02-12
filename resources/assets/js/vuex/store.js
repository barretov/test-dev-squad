import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
	store: [],
	users: '',
}

const mutations = {
	ADDLIST (state) {
		axios.post('/lists').then((response) => {
			state.store.push({
				id: response.data.id,
				name: 'New List',
				cards: []
			})
			refreshEvent()
		}).catch((err) => {
			console.log(err)
		})
	},

	SAVELIST (state, data) {
		let index = arrayIndex(state.store, data.id)

		if (state.store[index].name != data.name) {
			state.store[index].name = data.name
			axios.put('/lists/'+ data.id, {name: data.name}).then((response) => {
				refreshEvent()
			}).catch((err) => {
				console.log(err)
			})
		}
	},

	DELLIST (state, id) {
		let index = arrayIndex(state.store, id)
		state.store.splice(index, 1)

		axios.delete('/lists/'+ id).then((response) => {
			refreshEvent()
		}).catch((err) => {
			console.log(err)
		})
	},

	ADDCARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)

		axios.post('/cards', {idLst: data.idLst}).then((response) => {
			state.store[index].cards.push({
				idLst: data.idLst,
				id: response.data.id,
				owner: data.usrId,
				name: data.usrName,
				crd_order: response.data.id,
				data: '',
			})
			refreshEvent()
		}).catch((err) => {
			console.log(err)
		})
	},

	SAVECARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		let cardIdx = arrayIndex(state.store[index].cards, data.id)
		let card = state.store[index].cards[cardIdx]

		if (card.data != data.data ||
			card.owner != data.owner ||
			card.crdInvite != data.crdInvite) {

			card.data = data.data,
			card.owner = data.owner
			card.crdInvite = data.crdInvite

			axios.put('/cards/'+ data.id, {
				data: data.data,
				owner: data.owner,
				idLst: data.idLst,
				crdInvite: data.crdInvite
			}).then((response) => {
				refreshEvent()
			}).catch((err) => {
				console.log(err)
			})
		}
	},

	DELCARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)
		let cardIdx = arrayIndex(state.store[index].cards, data.id)
		state.store[index].cards.splice(cardIdx, 1)

		axios.delete('/cards/'+ data.id).then((response) => {
			refreshEvent()
		}).catch((err) => {
			console.log(err)
		})
	},

	DRAGCARD (state, data) {
		let index = arrayIndex(state.store, data.idLst)

		for (let i = data.value.length - 1; i >= 0; i--) {

			if (data.value[i].idLst != data.idLst) {
				data.value[i].idLst = data.idLst
			}
			data.value[i].idLst = data.idLst
		}

		axios.put('/cards-order/', {data: data}).then((response) => {
			refreshEvent()
		}).catch((err) => {
			console.log(err)
		})

		state.store[index].cards = data.value
	},

	UPSTORE (state, data) {
		state.store = ''
		state.store = data
	},
}

export default new Vuex.Store({
	state,
	mutations
})

/**
 * Function to identify the object id in the index List
 *
 * @param  {data} data Data data
 * @param  {int} id Id of object
 * @return {int} Index for operations
 */
 function arrayIndex(data, id) {
 	for (let i = data.length -1; i >= 0; i--) {
 		if (data[i].id == id) {
 			return i
 		}
 	}
 }

 /**
  * Function for call a event to refresh all clients
  *
  * @return void
  */
 function refreshEvent() {
 	axios.get('/fire-refresh-event').then((response) => {
 	}).catch((err) => {
 		console.log(err)
 	})
 }

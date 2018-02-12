<template>
	<div>
		<div v-for="list in getLists" :key="list.id">
			<List :id="list.id" :name="list.name" :usrId="uid" :usrName="uname" :usrEmail="uemail"/>
		</div>

		<div class="col-xs-3">
			<button @click="addList" class="btn btn-primary">
				Add List <i class="glyphicon glyphicon-list"></i>
			</button>
		</div>

		<v-dialog/>
	</div>
</template>

<script>
import List from './List'
import store from '../vuex/store'

export default {
	props: ['uid', 'uname', 'uemail'],

	data: function() {
		return {
			lists: ''
		}
	},

	created() {
		this.syncronize()
		Echo.channel('refreshEventChannel').listen('RefreshEvent', (e) =>{
			this.syncronize()
		})
	},

	computed: {
		getLists() {
			return this.$store.state.store
		}
	},

	methods: {
		addList() {
			this.$store.commit('ADDLIST')
		},
		syncronize() {
			let lists

			axios.get('/lists').then((response) => {
				lists = response.data

				axios.get('/cards').then((response) => {
					let cards = response.data
					// binds the cards in the lists
					for (let i = cards.length -1; i >= 0; i--) {
						// bind cards to invited user
						if (cards[i].crd_invite === this.uemail) {
							cards[i].owner = this.uid
							cards[i].name = this.uname
							cards[i].crd_invite = ''
						}

						for (let idx = lists.length -1; idx >= 0; idx--) {

							if (!lists[idx].cards) {
								lists[idx].cards = []
							}

							if (cards[i].idLst == lists[idx].id) {
								lists[idx].cards.push(cards[i])
							}
						};
					}
					this.$store.commit('UPSTORE', lists)
				}).catch((err) => {
					console.log(err)
				})
			}).catch((err) => {
				console.log(err)
			})

			axios.get('/users').then((response) => {
				this.$store.state.users = response.data
			}).catch((err) => {
				console.log(err);
			});
		}
	},

	components: {
		List
	},
	store
}
</script>

<template>
	<div>
		<div v-for="list in getLists" :key="list.id" :id="list.id" :lis="list">
			<List/>
		</div>

		<button @click="addList" class="btn btn-primary">Add List...</button>
	</div>
</template>

<script>
import List from './List'
import store from '../vuex/store'

export default {
	name: 'app',
	components: {
		List
	},

	methods: {
		addList() {
			console.log("addlist");
			this.$store.commit('addList')
		},
	},

	computed: {
		getLists() {
			let a = this.$store.state.lists
			console.log(a)
			return a
		}
	},
	store
}
</script>

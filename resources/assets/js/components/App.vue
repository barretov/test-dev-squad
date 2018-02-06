<template>
	<div>
		<div v-for="list in getLists" :key="list.id">
			<List :id="list.id" :user="user"></List>
		</div>

		<div class="col-xs-3">
			<button @click="addList" class="btn btn-primary">
				Add List <i class="glyphicon glyphicon-list"></i>
			</button>
		</div>
	</div>
</template>

<script>
import List from './List'
import store from '../vuex/store'

export default {
	props: ['user'],

	methods: {
		addList() {
			this.$store.commit('ADDLIST')
		},
	},

	computed: {
		getLists() {
			return this.$store.state.lists
		}
	},

	components: {
		List
	},
	store
}
</script>

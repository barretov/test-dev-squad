<template lang="html">
	<div class="col-xs-12 col-sm-3 col-md-3">

		<div class="well well-sm">
			<div class="form-group" align="center">
				<input v-model="titleList" class="form-control" @blur="saveList"
				 @focus="options = true" placeholder="New List...">

				<button @click="delList" class="btn-link pull-right bottom"
				v-if="options" @focus="options = true">
					Delete List <i class="glyphicon glyphicon-trash"></i>
				</button>
			</div>

			<div class="col-xs-12" v-for="card in getCards" :key="card.id">
				<card v-if="card.idLst === id" :id="card.id" :idLst="card.idLst"/>
			</div>

			<div class="form-group">
				<button @click="addCard" class="btn-link">
					Add Card <i class="glyphicon glyphicon-file"></i>
				</button>
			</div>
		</div>

	</div>
</template>

<script>
import Card from './Card'

export default {
	props: {
		'id': {type: Number, required: true},
	},

	data: function () {
		return {
			titleList: '',
			options: false
		}
	},

	methods: {
		saveList() {
			this.$store.commit('SAVELIST', {
				id: this.id,
				name: this.titleList
			})
			this.options = false
		},
		delList() {
			this.$store.commit('DELLIST', this.id)
		},
		addCard() {
			this.$store.commit('ADDCARD', this.id)
		}
	},

	computed: {
		getCards() {
			return this.$store.state.cards
		}
	},

	components: {
		Card,
	}
}
</script>

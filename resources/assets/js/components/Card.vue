<template>
	<div class="row">
		<div class="form-group">
			<textarea v-model="dataCard" class="form-control" @blur="saveCard"
			placeholder="Write something..." @focus="options = true"/>

			<button @click="delCard" class="btn-link pull-right" v-if="options"
			@focus="options = true">
				Delete this card <i class="glyphicon glyphicon-trash"></i>
			</button>
		</div>
	</div>
</template>

<script>

export default {
	props: {
		'id': {type: Number, required: true},
		'idLst': {type: Number, required: true},
	},
	data: function () {
		return {
			dataCard: '',
			options: false
		}
	},

	methods: {
		saveCard() {
			this.$store.commit('SAVECARD', {
				id: this.id,
				idLst: this.idLst,
				data: this.dataCard
			})
			this.options = false
		},
		delCard() {
			this.$store.commit('DELCARD', this.id)
		},
	}
}
</script>

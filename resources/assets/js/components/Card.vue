<template>
	<div class="row">
		<div class="form-group">
			<textarea v-model="dataCard" class="form-control" @blur="saveCard" placeholder="Write something..." @focus="options = true"/>

			<button @click="dialog" class="btn-link pull-right" v-if="options" @focus="options = true">
				Delete this card <i class="glyphicon glyphicon-trash"></i>
			</button>
		</div>

		<v-dialog/>
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
			options: false,
		}
	},

	methods: {
		saveCard() {
			this.$store.commit('SAVECARD', {
				id: this.id,
				idLst: this.idLst,
				data: this.dataCard
			})
			this.options = true
		},
		delCard() {
			this.$store.commit('DELCARD', this.id)
		},
		dialog() {
		  this.$modal.show('dialog', {
		    title: 'Delete card',
		    text: 'Are you sure?',
		    buttons: [
		      {
		        title: '<span class="text-primary">No <i class="glyphicon glyphicon-remove"></i></span>',
		        default: true
		      },
		      {
		        title: '<span class="text-danger">Yes <i class="glyphicon glyphicon-ok"></i></span>',
		        handler: () => {this.$modal.hide('dialog'), this.delCard()}
		      }
		   ]
		  })
		},
	}
}
</script>

<template>
	<div class="row">
		<div class="form-group">

			<textarea v-model="dataCard" class="form-control" @blur="saveCard" placeholder="Write something..." @focus="options = true"/>
			{{getUsers}}

			<div v-if="options">
				<button @click="listOwner" class="btn-link" @focus="options = true">
					<i class="glyphicon glyphicon-user"></i> {{user.substr(0,15) + '...'}}
				</button>

				<button @click="dialogDelCard" class="btn-link pull-right" @focus="options = true">
					Delete this card <i class="glyphicon glyphicon-trash"></i>
				</button>
			</div>

		</div>
		<!-- <modal name="teste" class="modal-content" :width="380" :height="180">

				<div class="row">
			        <h4 class="modal-title">Modal title</h5>
				</div>
			      <div class="modal-body">
			        <select v-model="selected" class="form-control">
			 			<option disabled value="">Please select one</option>
			 			<option>A</option>
			 			<option>B</option>
			 			<option>C</option>
			 		</select>
			      </div>
			      <div class="modal-footer bottom">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <button @click="changeOwner" type="button" class="btn btn-primary">Save changes</button>
			  	</div>
			 </div> -->
		<!-- </modal> -->
	</div>
</template>

<script>

export default {
	props: {
		'id': {type: Number, required: true},
		'idLst': {type: Number, required: true},
		'user': {type: String, required: true},
	},
	data: function () {
		return {
			users: '',
			combo: '',
			dataCard: '',
			cardOwner: '',
			options: false,
		}
	},

	computed: {
		getUsers() {
			axios.get('/users').then((response) => {
				for (var i = response.data.length - 1; i >= 0; i--) {
					this.combo += '<option>'
					this.combo += response.data[i].name
					this.combo += '</option>'
				}
			}).catch((err) => {
				console.log(err);
			});
		}
	},

	methods: {
		saveCard() {
			this.$store.commit('SAVECARD', {
				id: this.id,
				idLst: this.idLst,
				data: this.dataCard,
				owner: this.user
			})
			this.options = false
		},
		delCard() {
			this.$store.commit('DELCARD', this.id)
		},
		dialogDelCard() {
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
					handler: () => {this.$modal.hide('dialog'), this.delCard(this.cardOwner)}
				}]
			})
		},

		listOwner() {
			this.$modal.show('dialog', {
				title: 'Card owner',
				text: '<select v-model="cardOwner" class="form-control" @focus="options = true">'
					+ '<option selected>Select a user...</option>'
					+ '<option "invite">Invite a person</option>'
					+ this.combo
					+ '</select>',
				buttons: [
					{
						title: '<span class="text-default">Cancel <i class="glyphicon glyphicon-remove"></i></span>',
						default: true
					},
					{
						title: '<span class="text-primary">Save <i class="glyphicon glyphicon-ok"></i></span>',
						handler: () => {this.$modal.hide('dialog'), this.changeOwner()}
					},
				]
			})
			this.options = false
		},

		changeOwner() {
					console.log(this.cardOwner);

			switch (this.cardOwner) {
				case 'invite':
					// ### @TODO: Remove this debug #### //
					console.log("invite");
					break

				case '0':
					console.log("0");
					break

				default:
					console.log("default");
					console.log(this.cardOwner);
					break
			}
		},
	},

}
</script>

<template>
	<div class="row">
		<div class="form-group">

			<textarea v-model="dataCard" class="form-control" @blur="saveCard" placeholder="Write something..." @focus="flOwner = true"/>

			<div v-show="flOwner">
				<button @click="flInpOwner = true" class="btn-link" @focus="flOwner = true">
					<i class="glyphicon glyphicon-user"></i> {{owner != 0? owner.substr(0,13) : user.substr(0,13)}} ...
				</button>

				<button @click="dialogDelCard" class="btn-link pull-right" @focus="flOwner = true">
					Delete card <i class="glyphicon glyphicon-trash"></i>
				</button>
			</div>

			<div v-show="flInpOwner" @change="changeOwner">
				{{getUsers}}
				<select v-model="owner" class="form-control">
					<option disabled value="">Select a worner</option>
					<option value="0">Invite a person</option>
					<option v-for="user in users">{{user.name}}</option>
				</select>
			</div>
		</div>

		<div v-show="flInvite">
			<div class="form-group">
				<div class="input-group">
				    <input v-model="emailInvite" type="email" class="form-control" placeholder="E-mail to invite">
				    <span class="input-group-btn">
				      <button @click="invite" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i></button>
				    </span>
				  </div>
			</div>
		</div>

	</div>
</template>

<script>
	export default {
		props: {
			'id': {type: Number, required: true},
			'idLst': {type: Number, required: true},
			'user': {type: String, required: true},
			'data': {type: String, required: true},
		},
		data: function () {
			return {
				users: '',
				dataCard: this.data,
				owner: '',
				emailInvite: '',
				flOwner: false,
				flInvite: false,
				flInpOwner: false,
			}
		},

		computed: {
			getUsers() {
				axios.get('/users').then((response) => {
					this.users =  response.data
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
				this.flOwner = false
				this.flInvite = false
			},
			delCard() {
				this.$store.commit('DELCARD', {idLst: this.idLst, id: this.id})
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
						handler: () => {this.$modal.hide('dialog'), this.delCard()}
					}]
				})
			},
			changeOwner() {
				if (0 == this.owner) {
					this.flInvite = true
				} else {
					this.flInpOwner = false
					this.flOwner = false
				}
				// @TODO:, salvar mudança no banco
			},
			invite() {
				this.owner = this.emailInvite
				this.flOwner = false
				this.flInvite = false
				this.flInpOwner = false

				axios.post('/emailInvite', {email: this.emailInvite}).then((response) => {
				}).catch((err) => {
					console.log(err);
				});
			}
		},
	}
</script>

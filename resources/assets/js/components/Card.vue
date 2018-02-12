<template>
	<div class="row">

		<div class="form-group">
			<textarea v-model="dataCard" class="form-control text-justify" @blur="saveCard" placeholder="Write something..." @focus="flOwner = true"/>

			<div v-show="flOwner">
				<button @click="flInpOwner = true" class="btn-link" @focus="flOwner = true">
					<i class="glyphicon glyphicon-user"></i>
					{{ crdInvite? crdInvite.substr(0, 18) : ownerName.substr(0, 18) }}
				</button>

				<button @click="dialogDelCard" class="btn-link pull-right" @focus="flOwner = true">
					Delete card <i class="glyphicon glyphicon-trash"></i>
				</button>
			</div>

			<div v-show="flInpOwner" @change="changeOwner">
				<select v-model="ownerId" class="form-control">
					<option disabled selected value="">Select a owner</option>
					<option value="0">Invite a person</option>
					<option v-for="user in getData" :value="user.id">{{user.name}}</option>
				</select>
			</div>
		</div>

		<div v-show="flInvite">
			<div class="form-group">
				<div class="input-group">
				    <input v-model="crdInvite" type="email" class="form-control" placeholder="E-mail to invite">
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
		props: ['id', 'idLst', 'user', 'userId', 'data', 'crd_invite'],

		data: function () {
			return {
				ownerId: '',
				flTxt: false,
				flOwner: false,
				flInvite: false,
				flInpOwner: false,
				dataCard: this.data,
				ownerName: this.user,
				crdInvite: this.crd_invite,
			}
		},

		computed: {
			getData() {
				let state = this.$store.state
				this.dataCard = this.data
				this.ownerName = this.user
				this.crdInvite = this.crd_invite
				return state.users
			},
		},

		methods: {
			saveCard() {
				this.$store.commit('SAVECARD', {
					id: this.id,
					idLst: this.idLst,
					data: this.dataCard,
					owner: this.ownerId? this.ownerId : this.userId,
					crdInvite: this.crdInvite
				})

				this.ownerId = ''
				this.flOwner = false
				this.flInvite = false
			},

			delCard() {
				this.$store.commit('DELCARD', {idLst: this.idLst, id: this.id})
			},

			changeOwner() {
				if (0 == this.ownerId) {
					this.flInvite = true
				} else {
					this.flInpOwner = false
					this.flOwner = false

					let users = this.$store.state.users
					// update name for a new owner
					for (let i = 0; users.length >= 0; i++) {
						if (users[i].id === this.ownerId) {
							this.ownerName = users[i].name
							break
						}
					}
					this.crdInvite = ''
					this.saveCard()
				}
			},

			invite() {
				this.flOwner = false
				this.flInvite = false
				this.flInpOwner = false
				this.ownerId = ''
				this.saveCard()

				axios.post('/email-invite', {email: this.crdInvite}).then((response) => {
				}).catch((err) => {
					console.log(err)
				})
			},

			dialogDelCard() {
				this.$modal.show('dialog', {
				title: 'Delete card',
				text: 'Are you sure?',
				buttons: [
					{
						title: 'No <i class="glyphicon glyphicon-remove text-danger"/>',
						handler:() => {this.$modal.hide('dialog'), this.flOwner = false},
						default: true
					},
					{
						title: 'Yes <i class="glyphicon glyphicon-ok text-info"/>',
						handler: () => {this.$modal.hide('dialog'), this.delCard()}
					}]
				})
			}
		}
	}
</script>

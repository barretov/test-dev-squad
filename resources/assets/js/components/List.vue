<template lang="html">
	<div class="col-xs-12 col-sm-3 col-md-3">

		<div class="well well-sm">
			<div class="form-group" align="center">
				<input v-model="titleList" class="form-control" @blur="saveList" @focus="options = true" placeholder="New List..." v-show="flTitle" @keyup.13="flTitle = false">

				<span @click="flTitle = true" v-show="!flTitle" class="text-info">
					<legend>{{titleList}}</legend>
				</span>

				<button @click="dialog" v-show="flTitle" class="btn-link pull-right" @focus="flTitle = true">
					Delete List <i class="glyphicon glyphicon-trash"></i>
				</button>
			</div>

			<draggable v-model="dragCard" :options="{group:'cards'}" class="col-xs-12">
				<div v-for="card in getCards" :key="card.id">
					<card :id="card.id" :idLst="card.idLst" :user="card.name" :userId="card.owner" :data="card.data" :crd_invite="card.crd_invite"/>
				</div>
			</draggable>

			<button @click="addCard" class="btn-link">
				Add Card ...
			</button>
		</div>

	</div>
</template>

<script>
import Card from './Card'
import draggable from 'vuedraggable'

export default {
	props: ['id', 'name', 'usrId', 'usrName', 'usrEmail'],

	data: function () {
		return {
			titleList: this.name,
			options: false,
			flTitle: false,
		}
	},

	methods: {
		saveList() {
			this.$store.commit('SAVELIST', {
				id: this.id,
				name: this.titleList
			})

			this.options = false
			this.flTitle = false
		},

		delList() {
			this.$store.commit('DELLIST', this.id)
		},

		addCard() {
			this.$store.commit('ADDCARD', {
				idLst: this.id,
				usrId: this.usrId,
				usrName: this.usrName
			})
		},

		dialog() {
		  this.$modal.show('dialog', {
		    title: 'Delete list',
		    text: 'Are you sure? It will remove all cards of this list!',
		    buttons: [
		      {
		        title: 'No <i class="glyphicon glyphicon-remove text-danger"/>',
		        	handler: () => {this.$modal.hide('dialog'), this.flTitle = false},
		        default: true
		      },
		      {
		        title: 'Yes <i class="glyphicon glyphicon-ok"/>',
		        handler: () => {this.$modal.hide('dialog'), this.delList()}
		      }
		   ]
		  })
		}
	},

	computed: {
		getCards() {
			// refresh title after pusher event
			this.titleList = this.name
			let data = this.$store.state.store

			for (var i = data.length -1; i >= 0; i--) {
				if (data[i].id == this.id) {
					return data[i].cards
				}
			}
		},

		dragCard: {
		    get() {
		    	return this.getCards
		    },
		    set(value) {
		        this.$store.commit('DRAGCARD', {idLst: this.id, value: value})
		    }
		}
	},

	components: {
		Card,
		draggable
	}
}
</script>

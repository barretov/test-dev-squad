<template lang="html">
	<div class="col-xs-12 col-sm-3 col-md-3">

		<div class="well well-sm">
			<div class="form-group" align="center">
				<input v-model="titleList" class="form-control" @blur="saveList"
				 @focus="options = true" placeholder="New List...">

				<button @click="dialog" v-if="options" class="btn-link pull-right bottom" @focus="options = true">
					Delete List <i class="glyphicon glyphicon-trash"></i>
				</button>
			</div>

			<div class="col-xs-12" v-for="card in getCards" :key="card.id">
			<draggable v-model="dragCard" :options="{group:'cards'}">
					<card v-if="card.idLst === id" :id="card.id" :idLst="card.idLst" :user="user"/>
			</draggable>
			</div>

			<div class="form-group">
				<button @click="addCard" class="btn-link">
					Add Card <i class="glyphicon glyphicon-file"></i>
				</button>
			</div>
		</div>

		<v-dialog/>
	</div>
</template>

<script>
import Card from './Card'
import draggable from 'vuedraggable'

export default {
	props:
	 {
		'id': {type: Number, required: true},
		'user': {type: String, required: true},
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
		},
		dialog() {
		  this.$modal.show('dialog', {
		    title: 'Delete list',
		    text: 'Are you sure? It will remove all cards of this list!',
		    buttons: [
		      {
		        title: '<span class="text-primary">'
		        	+'No <i class="glyphicon glyphicon-remove"></i></span>',
		        default: true
		      },
		      {
		        title: '<span class="text-danger">'
		        	+'Yes <i class="glyphicon glyphicon-ok"></i></span>',
		        handler: () => {this.$modal.hide('dialog'), this.delList()}
		      }
		   ]
		  })
		},
	},

	computed: {
		getCards() {
			return this.$store.state.cards
		},
		dragCard: {
		    get(value) {
		    	// ### @TODO: Remove this debug #### //
		    	console.log("drag get " + value );
		        return this.$store.state.cards
		    	console.log(this.$store.state.cards)
		    },
		    set(value) {
		    	// ### @TODO: Remove this debug #### //
		    	console.log("drag set", value);
		        this.$store.commit('SAVECARD', value)
		    }
		}
	},

	components: {
		Card,
		draggable
	}
}
</script>
<style>
.drag-area {
	 min-height: 20px;
}
</styel>

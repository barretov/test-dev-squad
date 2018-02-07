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

				<draggable v-model="dragCard" :options="{group:'cards'}">
					<transition-group>
			<div class="col-xs-12" v-for="card in getCards" :key="card.id">
						<card v-if="card.idLst === id" :id="card.id" :idLst="card.idLst" :user="user"/>
			</div>
					</transition-group>
				</draggable>

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
			options: false,
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
		    	// console.log("lista")
		    	// ### @TODO: Remove this debug #### //
		    	// console.log(this.lista);
		        return this.$store.state.cards
		    },
		    set(value) {

		    	console.log("value")
		    	console.log(value);
		    	// console.log("lista")
		    	// ### @TODO: Remove this debug #### //
		    	// console.log(this.lista);
		        this.$store.commit('DRAGCARD', value)
		    	// ### @TODO: Remove this debug #### //
		    	// console.log("passou-----------------------")
		    	// for (var i = value.length - 1; i >= 0; i--) {
		    		// console.log('id: '+ value[0].idLst)
		    		// value[i].idLst = this.idTarget
			        // this.$store.commit('SAVECARD', value[i])
		    	// }
		    },
		    handleChange() {
		         console.log('changed');
		       },
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

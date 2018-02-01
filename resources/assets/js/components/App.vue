<template>
	<div class="board">
		<div class="cards">
			<div class="empty-state" v-show="!boards.length">Sem Listas ainda :P</div>
			<board v-for="board in boards" :name="board.name"></board>
		</div>
		<div class="col-sm-3 col-md-2">
			<button @click="addBoard()" class="btn btn-default">Add a list...</button>
			<!-- <board ref="board" /> -->
		</div>
	</div>

</template>

<script>
import Board from './Board'

export default {
	name: 'app',
	components: {
		Board,
	},

	data: function () {
		return {
			boards: []
		}
	},

	methods: {
		addBoard() {
			console.log("adding board");

			var board = {
				id: 1,
				name: 'board1'
			}

			this.boards.push(board)
		},
	}
}
</script>

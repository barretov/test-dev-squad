<template>
	<div class="col-sm-3 col-md-2">
		<button @click="$refs.board.addBoard()" class="btn btn-default">Add a list...</button>
		<board ref="board" :board="addList2" />
	</div>
</template>

<script>
import Board from './Board'

export default {
	name: 'app',
	components: {
		Board,
	},

	methods: {
		addList2() {
			console.log("variable");
		},
	}
}
</script>

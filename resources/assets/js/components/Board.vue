<template lang="html">
	<div class="col-xs-12 col-sm-3 col-md-2">
		<div class="form-group">
			<input class="form-control">
		</div>
		<div class="form-group">
			<button class="btn btn-info">Add</button>
			<button class="btn btn-default">X</button>
		</div>
	</div>
</template>

<script>
export default {
	name: 'custom-board',

	props: {
		name: {type: String, required: true},
	},

	// data: function() {
	// 	console.log("estou no componente board...");
	// 	return {
	// 		object
	// 	}
	// 	},

		components: {
		}
	}
	</script>

	<style lang="scss" scoped>
	.board {
		background-color: green;
	}
	</style>

<template>
	<div class="col-xs-12 col-md-3" style="border: 1px red solid ;margin: 3px 3px 3px 3px">
		<h1>TESTE</h1>
	</div>
</template>

<script>
export default {
	mounted() {
		console.log('Component mounted.')
	},
	methods: {
		addCard: function () {
			console.log("adding a card");
		}
	}
}
</script>

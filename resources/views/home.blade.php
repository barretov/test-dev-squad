@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div id="app" class="panel-body">
					<!-- {{ $users }} -->
					<div id="lists"></div>

					<button class="btn btn-primary" @click="addList">Add a list...</button>
					<!-- <new-list></new-list> -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

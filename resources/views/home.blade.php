@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<app id="app" user="{{Auth::user()->name}}"/>
		</div>
	</div>
</div>
@endsection

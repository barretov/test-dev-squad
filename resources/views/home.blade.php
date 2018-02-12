@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<app id="app" uid="{{Auth::user()->id}}" uname="{{Auth::user()->name}}" uemail="{{Auth::user()->email}}"/>
		</div>
	</div>
</div>
@endsection

@extends('layouts.email')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Invitation for DevSquad Trello</div>

                <div class="panel-body">
                   <div class="center-block">
                   	<p>Hello,</p>
                   	<p>The user {{Auth::user()->name}}, assigned a card for you on DevSquad Trello.</p>
                   	<p>you must have to register for see you card!</p>
                   	<a class="btn btn-primary" href="http://localhost:8000/register">Register</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

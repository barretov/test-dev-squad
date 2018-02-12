<?php

use App\Mail\Email;
use App\Events\RefreshEvent;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fire-refresh-event', function () {
    event(new RefreshEvent());
});

Route::put('/cards-order', 'CardController@cardsOrder')->middleware('auth');
Route::post('/email-invite', 'EmailController@emailInvite')->middleware('auth');
Route::resource('/home', 'HomeController')->middleware('auth');
Route::resource('/users', 'UserController')->middleware('auth');
Route::resource('lists', 'ListController')->middleware('auth');
Route::resource('cards', 'CardController')->middleware('auth');

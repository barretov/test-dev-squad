<?php

use App\Mail\Email;

Auth::routes();

// public route.
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@list');
Route::post('/emailInvite', 'EmailController@emailInvite');

Route::resource('list', 'ListController')->middleware('auth');
Route::resource('card', 'CardController')->middleware('auth');

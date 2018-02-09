<?php

use App\Mail\Email;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@list');
Route::post('/emailInvite', 'EmailController@emailInvite');

Route::resource('lists', 'ListController')->middleware('auth');
Route::resource('cards', 'CardController')->middleware('auth');

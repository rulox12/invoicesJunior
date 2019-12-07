<?php

//Users

Route::get('/users')->name('users.index')->uses('UserController@index');
Route::get('users/create')->name('users.create')->uses('UserController@create');;
Route::post('users/store')->name('users.store')->uses('UserController@store');
Route::get('users/{user}')->name('users.show')->uses('UserController@show');
Route::get('users/{user}/edit')->name('users.edit')->uses('UserController@edit');
Route::get('users/{user}/delete')->name('users.delete')->uses('UserController@delete');
Route::patch('users/{user}')->name('users.update')->uses('UserController@update');

Route::get('/', function () {
    return view("home");
})->name("home.index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


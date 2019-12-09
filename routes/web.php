<?php

//Users

Route::get('/users')->name('users.index')->uses('UserController@index');
Route::get('users/create')->name('users.create')->uses('UserController@create');;
Route::post('users/store')->name('users.store')->uses('UserController@store');
Route::get('users/{user}')->name('users.show')->uses('UserController@show');
Route::get('users/{user}/edit')->name('users.edit')->uses('UserController@edit');
Route::get('users/{user}/delete')->name('users.delete')->uses('UserController@delete');
Route::patch('users/{user}')->name('users.update')->uses('UserController@update');

//Customer

Route::get('/customers')->name('customers.index')->uses('CustomerController@index');
Route::get('customers/create')->name('customers.create')->uses('CustomerController@create');;
Route::post('customers/store')->name('customers.store')->uses('CustomerController@store');
Route::get('customers/{customer}')->name('customers.show')->uses('CustomerController@show');
Route::get('customers/{customer}/edit')->name('customers.edit')->uses('CustomerController@edit');
Route::get('customers/{customer}/toggle')->name('customers.toggle')->uses('CustomerController@toggle');
Route::patch('customers/{customer}')->name('customers.update')->uses('CustomerController@update');

//Invoice

Route::get('/invoices')->name('invoices.index')->uses('InvoiceController@index');
Route::get('invoices/create')->name('invoices.create')->uses('InvoiceController@create');;
Route::post('invoices/store')->name('invoices.store')->uses('InvoiceController@store');
Route::get('invoices/{invoice}')->name('invoices.show')->uses('InvoiceController@show');
Route::get('invoices/{invoice}/edit')->name('invoices.edit')->uses('InvoiceController@edit');
Route::patch('invoices/{invoice}')->name('invoices.update')->uses('InvoiceController@update');
Route::get('invoices/{invoice}/status')->name('invoices.edit.status')->uses('InvoiceController@editStatus');
Route::patch('invoices/status/{invoice}')->name('invoices.update.status')->uses('InvoiceController@updateStatus');


Route::get('/', function () {
    return view("home");
})->name("home.index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


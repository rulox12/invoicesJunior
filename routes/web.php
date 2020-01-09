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

//Seller

Route::get('/sellers')->name('sellers.index')->uses('sellerController@index');
Route::get('sellers/create')->name('sellers.create')->uses('sellerController@create');;
Route::post('sellers/store')->name('sellers.store')->uses('sellerController@store');
Route::get('sellers/{seller}')->name('sellers.show')->uses('sellerController@show');
Route::get('sellers/{seller}/edit')->name('sellers.edit')->uses('sellerController@edit');
Route::get('sellers/{seller}/toggle')->name('sellers.toggle')->uses('sellerController@toggle');
Route::patch('sellers/{seller}')->name('sellers.update')->uses('sellerController@update');

//Invoice

Route::get('/invoices')->name('invoices.index')->uses('InvoiceController@index');
Route::get('/invoices/import')->name('invoices.import')->uses('InvoiceController@importExcelShow');
Route::patch('/invoices/importSave')->name('invoices.importSave')->uses('InvoiceController@importExcelSave');
Route::get('invoices/create')->name('invoices.create')->uses('InvoiceController@create');;
Route::post('invoices/store')->name('invoices.store')->uses('InvoiceController@store');
Route::get('invoices/{invoice}')->name('invoices.show')->uses('InvoiceController@show');
Route::get('invoices/{invoice}/edit')->name('invoices.edit')->uses('InvoiceController@edit');
Route::patch('invoices/{invoice}')->name('invoices.update')->uses('InvoiceController@update');
Route::get('invoices/{invoice}/status')->name('invoices.edit.status')->uses('InvoiceController@editStatus');
Route::patch('invoices/status/{invoice}')->name('invoices.update.status')->uses('InvoiceController@updateStatus');
Route::get('invoices/filter/date')->name('invoices.filter.date')->uses('InvoiceController@filterDate');


Route::get('/', function () {
    return view("home");
})->name("home.index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


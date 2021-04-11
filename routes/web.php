<?php

//Users

Route::get('/users')->name('users.index')->uses('UserController@index')->middleware('auth');
Route::get('users/create')->name('users.create')->uses('UserController@create')->middleware('auth');
Route::post('users/store')->name('users.store')->uses('UserController@store')->middleware('auth');
Route::get('users/{user}')->name('users.show')->uses('UserController@show')->middleware('auth');
Route::get('users/{user}/edit')->name('users.edit')->uses('UserController@edit')->middleware('auth');
Route::get('users/{user}/delete')->name('users.delete')->uses('UserController@delete')->middleware('auth');
Route::patch('users/{user}')->name('users.update')->uses('UserController@update')->middleware('auth');

//Customer

Route::get('/customers')->name('customers.index')->uses('CustomerController@index')->middleware('auth');
Route::get('customers/create')->name('customers.create')->uses('CustomerController@create')->middleware('auth');
Route::post('customers/store')->name('customers.store')->uses('CustomerController@store')->middleware('auth');
Route::get('customers/{customer}')->name('customers.show')->uses('CustomerController@show')->middleware('auth');
Route::get('customers/{customer}/edit')->name('customers.edit')->uses('CustomerController@edit')->middleware('auth');
Route::get('customers/{customer}/toggle')->name('customers.toggle')->uses('CustomerController@toggle')->middleware('auth');
Route::patch('customers/{customer}')->name('customers.update')->uses('CustomerController@update')->middleware('auth');

//Seller

Route::get('/sellers')->name('sellers.index')->uses('sellerController@index')->middleware('auth');
Route::get('sellers/create')->name('sellers.create')->uses('sellerController@create')->middleware('auth');
Route::post('sellers/store')->name('sellers.store')->uses('sellerController@store')->middleware('auth');
Route::get('sellers/{seller}')->name('sellers.show')->uses('sellerController@show')->middleware('auth');
Route::get('sellers/{seller}/edit')->name('sellers.edit')->uses('sellerController@edit')->middleware('auth');
Route::get('sellers/{seller}/toggle')->name('sellers.toggle')->uses('sellerController@toggle')->middleware('auth');
Route::patch('sellers/{seller}')->name('sellers.update')->uses('sellerController@update')->middleware('auth');

//Invoice

Route::get('/invoices')->name('invoices.index')->uses('InvoiceController@index')->middleware('auth');
Route::get('invoices/create')->name('invoices.create')->uses('InvoiceController@create')->middleware('auth');
Route::post('invoices/store')->name('invoices.store')->uses('InvoiceController@store')->middleware('auth');
Route::get('invoices/{invoice}')->name('invoices.show')->uses('InvoiceController@show')->middleware('auth');
Route::get('invoices/{invoice}/edit')->name('invoices.edit')->uses('InvoiceController@edit')->middleware('auth');
Route::patch('invoices/{invoice}')->name('invoices.update')->uses('InvoiceController@update')->middleware('auth');
Route::get('invoices/{invoice}/status')->name('invoices.edit.status')->uses('InvoiceController@editStatus')->middleware('auth');
Route::patch('invoices/status/{invoice}')->name('invoices.update.status')->uses('InvoiceController@updateStatus')->middleware('auth');
Route::get('invoices/filter/date')->name('invoices.filter.date')->uses('InvoiceController@filterDate')->middleware('auth');


//Rol

Route::get('/roles')->name('roles.index')->uses('RoleController@index')->middleware('auth');
Route::get('roles/create')->name('roles.create')->uses('RoleController@create')->middleware('auth');
Route::post('roles/store')->name('roles.store')->uses('RoleController@store')->middleware('auth');
Route::get('roles/{role}')->name('roles.show')->uses('RoleController@show')->middleware('auth');
Route::get('roles/{role}/edit')->name('roles.edit')->uses('RoleController@edit')->middleware('auth');
Route::get('roles/{role}/toggle')->name('roles.toggle')->uses('RoleController@toggle')->middleware('auth');
Route::patch('roles/{role}')->name('roles.update')->uses('RoleController@update')->middleware('auth');

//Import

Route::get('/imports')->name('imports.index')->uses('ImportController@index')->middleware('auth');
Route::post('imports/store')->name('imports.store')->uses('ImportController@store')->middleware('auth');


//Export

Route::get('/exports')->name('exports.index')->uses('ExportController@index')->middleware('auth');
Route::get('exports/generateExportInvoice/{type}')->name('exports.generateExportInvoice')->uses('ExportController@generateExportInvoice')->middleware('auth');

//Payment

Route::get('payments/store/{invoice}')->name('payments.store')->uses('PaymentController@store')->middleware('auth');
Route::get('payments/returnURL/{reference}')->name('payments.return')->uses('PaymentController@returnWebCheckout')->middleware('auth');
Route::get('/payments')->name('payments.index')->uses('PaymentController@index')->middleware('auth');
Route::get('payments/{payment}')->name('payments.show')->uses('PaymentController@show')->middleware('auth');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');

<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'API\RegisterController@login');
Route::middleware('auth:api')->group(function () {
    Route::resource('invoices-api', 'API\InvoiceController');
    Route::resource('customer-api', 'API\CustomerController');
    Route::resource('seller-api', 'API\SellerController');
});

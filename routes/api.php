<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// User routes
Route::get('/user', 'UserController@auth');
Route::get('users/trashed', 'UserController@trashed')->name('users.restore');
Route::match(['put', 'patch'], 'users/restore/{id}', 'UserController@restore')->name('users.restore');
Route::apiResource('users', 'UserController');

// Client routes
Route::get('clients/disabled', 'ClientController@disabled')->name('clientes.disabled');
Route::delete('clients/disable/{client}', 'ClientController@disable')->name('clients.disable');
Route::match(['put', 'patch'], 'clients/enable/{id}', 'ClientController@enable')->name('clients.enable');
Route::apiResource('clients', 'ClientController');

// Customer routes
Route::match(['put', 'patch'], 'customers/restore/{id}', 'CustomerController@restore')->name('customers.restore');
Route::get('customers/trashed', 'CustomerController@trashed')->name('customers.trashed');
Route::apiResource('customers', 'CustomerController');

// Provider routes
Route::match(['put', 'patch'], 'providers/restore/{id}', 'ProviderController@restore')->name('providers.restore');
Route::get('providers/trashed', 'ProviderController@trashed')->name('providers.trashed');
Route::apiResource('providers', 'ProviderController');

// Payment Type routes
Route::match(['put', 'patch'], 'payment-types/restore/{id}', 'PaymentTypeController@restore')->name('payment-types.restore');
Route::get('payment-types/trashed', 'PaymentTypeController@trashed')->name('payment-types.trashed');
Route::apiResource('payment-types', 'PaymentTypeController');

// Product Routes
Route::match(['put', 'patch'], 'products/restore/{id}', 'ProductController@restore')->name('products.restore');
Route::get('products/trashed', 'ProductController@trashed')->name('products.trashed');
Route::apiResource('products', 'ProductController');

// Product Buy Routes
Route::apiResource('product-buys', 'ProductBuyController', [
    'only' => ['index', 'store']
]);

Route::apiResource('payments', 'PaymentController', [
   'only' => ['show', 'store', 'update']
]);

Route::apiResource('plots', 'PlotController', [
   'only' => 'index'
]);


Route::group(['namespace' => 'Auth'], function () {
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/refresh', 'RefreshController@refresh')->name('refresh');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::post('/verify', 'VerifyPasswordController@verify')->name('password.verify')->middleware('auth');
});
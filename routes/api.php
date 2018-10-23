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

Route::group(['namespace' => 'Auth'], function () {
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/refresh', 'RefreshController@refresh')->name('refresh');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::post('/verify', 'VerifyPasswordController@verify')->name('password.verify')->middleware('auth');
});
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

Route::group(['namespace' => 'Auth'], function () {
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/refresh', 'RefreshController@refresh')->name('refresh');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::post('/verify', 'VerifyPasswordController@verify')->name('password.verify')->middleware('auth');
});
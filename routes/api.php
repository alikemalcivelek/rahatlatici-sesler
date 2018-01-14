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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::post('/auth/signUp', 'AuthController@signUp');
Route::post('/auth/signIn', 'AuthController@signIn');

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/auth/signOut', 'AuthController@signOut');
});

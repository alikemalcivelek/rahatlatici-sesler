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

Route::get('/auth/status', 'AuthController@status');
Route::post('/auth/signUp', 'AuthController@signUp');
Route::post('/auth/signIn', 'AuthController@signIn');

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/auth/signOut', 'AuthController@signOut');

	/*
	|--------------------------------------------------------------------------
	| Category Routes
	|--------------------------------------------------------------------------
	*/

	Route::get('/categories', 'CategoryController@categories');

	/*
	|--------------------------------------------------------------------------
	| Sound Routes
	|--------------------------------------------------------------------------
	*/

	Route::get('/sounds/{categoryId}', 'SoundController@sounds');

	/*
	|--------------------------------------------------------------------------
	| Favorite Routes
	|--------------------------------------------------------------------------
	*/

	Route::get('/favorites', 'FavoriteController@favorites');
	Route::post('/favorites/{soundId}', 'FavoriteController@add');
	Route::delete('/favorites/{soundId}', 'FavoriteController@remove');
});

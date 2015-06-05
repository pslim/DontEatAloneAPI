<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(['prefix' => 'api/v1'], function() {
	Route::resource('users', 'UsersController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('matches', 'MatchesController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

	Route::get('/{profile}', 'ProfilesController@show');
	Route::get('users/{id}/matches', 'MatchesController@index');

	# Authentication
	Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@store']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
	Route::resource('sessions', 'SessionsController', ['only' => ['store', 'destroy']]);
});

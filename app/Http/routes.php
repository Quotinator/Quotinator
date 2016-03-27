<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'QuoteController@index']);
Route::get('{quote}', ['as' => 'quote', 'uses' => 'QuoteController@show'])->where('quote', '[0-9]+');

Route::get('{quote}/edit', ['as' => 'quote.edit', 'uses' => 'QuoteController@edit'])->where('quote', '[0-9]+');
Route::post('{quote}/edit', ['as' => 'quote.edit', 'uses' => 'QuoteController@update'])->where('quote', '[0-9]+');

Route::get('create', ['as' => 'quote.create', 'uses' => 'QuoteController@create']);
Route::post('create', ['as' => 'quote.create', 'uses' => 'QuoteController@store']);

Route::get('~{user}', ['as' => 'user.profile', 'uses' => 'ProfileController@getIndex']);
Route::get('~{user}/favorites', ['as' => 'user.favorites', 'uses' => 'ProfileController@getFavorites']);
Route::get('~{user}/quotes', ['as' => 'user.quotes', 'uses' => 'ProfileController@getQuotes']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

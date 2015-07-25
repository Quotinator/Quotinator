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
Route::get('top', ['as' => 'top', 'uses' => 'QuoteController@index']);
Route::get('random', ['as' => 'random', 'uses' => 'QuoteController@index']);
Route::get('{quote}', ['as' => 'quote', 'uses' => 'QuoteController@show'])->where('quote', '[0-9]+');
Route::get('{quote}/edit', ['as' => 'quote.edit', 'uses' => 'QuoteController@edit'])->where('quote', '[0-9]+');
Route::get('create', ['as' => 'quote.create', 'uses' => 'QuoteController@create']);

Route::get('~{username}', ['as' => 'user.profile', 'uses' => 'QuoteController@index']);
Route::get('~{username}/favorites', ['as' => 'user.favorites', 'uses' => 'QuoteController@index']);
Route::get('~{username}/quotes', ['as' => 'user.quotes', 'uses' => 'QuoteController@index']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

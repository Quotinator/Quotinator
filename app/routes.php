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

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));
Route::get('/random', array('as' => 'random', 'uses' => 'HomeController@getRandom'));
Route::get('/top', array('as' => 'top', 'uses' => 'HomeController@getTop'));

Route::get('/{quote}', 'HomeController@getQuote')->where('quote', '[0-9]+');

Route::get('/user/{username}', array('as' => 'user', 'uses' => 'HomeController@getUserQuotes'))->where('username', '[A-Za-z0-9]+');

Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
Route::post('/login', array('as' => 'login', 'uses' => 'AuthController@postLogin', 'before' => 'csrf'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

Route::get('/register', array('as' => 'register', 'uses' => 'RegistrationController@getRegister'));
Route::post('/register', array('as' => 'register', 'uses' => 'RegistrationController@postRegister'));

Route::get('/about', array('as' => 'about', 'uses' => 'HomeController@getAbout'));

Route::get('/submit', array('as' => 'submit', 'before' => 'auth', 'uses' => 'SubmitController@getIndex'));
Route::post('/submit', array('as' => 'submit', 'before' => 'auth', 'uses' => 'SubmitController@postIndex'));

Route::get('/preferences', array('as' => 'userpreferences', 'before' => 'auth', 'uses' => 'PreferencesController@getUser'));
Route::post('/preferences', array('as' => 'userpreferences', 'before' => 'auth|csrf', 'uses' => 'PreferencesController@postUser'));


Route::controller('password', 'RemindersController');

Route::get('/help', array('as' => 'help', 'uses' => function()
{
	return '';
}));

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
Route::bind('username', function($value, $route)
{
	$user = User::where('username', $value)->first();
    if ($user) return $user;
    App::abort(404, 'User not found!');
});

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));
Route::get('/random', array('as' => 'random', 'uses' => 'HomeController@getRandom'));
Route::get('/top', array('as' => 'top', 'uses' => 'HomeController@getTop'));


Route::get('/{quote}', array('as' => 'quote', 'uses' => 'HomeController@getQuote'))->where('quote', '[0-9]+');

Route::group(array('prefix' => 'user'), function ()
{
	Route::get('/{username}', array('as' => 'user.profile', 'uses' => 'UserController@getProfile'))->where('username', '[A-Za-z0-9]+');
	Route::get('/{username}/quotes', array('as' => 'user.quotes', 'uses' => 'UserController@getQuotes'))->where('username', '[A-Za-z0-9]+');
	Route::get('/{username}/favorites', array('as' => 'user.favorites', 'uses' => 'UserController@getFavorites'))->where('username', '[A-Za-z0-9]+');
});



Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
Route::post('/login', array('as' => 'login', 'uses' => 'AuthController@postLogin', 'before' => 'csrf'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

Route::get('/register', array('as' => 'register', 'uses' => 'RegistrationController@getRegister'));
Route::post('/register', array('as' => 'register', 'uses' => 'RegistrationController@postRegister'));

Route::get('/about', array('as' => 'about', 'uses' => 'HomeController@getAbout'));

Route::get('/submit', array('as' => 'submit', 'before' => 'auth|can:quote.submit', 'uses' => 'SubmitController@getIndex'));
Route::post('/submit', array('as' => 'submit', 'before' => 'auth|can:quote.submit', 'uses' => 'SubmitController@postIndex'));

Route::get('/preferences', array('as' => 'userpreferences', 'before' => 'auth', 'uses' => 'PreferencesController@getUser'));
Route::post('/preferences', array('as' => 'userpreferences', 'before' => 'auth|csrf', 'uses' => 'PreferencesController@postUser'));


Route::controller('password', 'RemindersController');

Route::get('/help', array('as' => 'help', 'uses' => function()
{
	return '';
}));

Route::get('/test', function() {
	Quote::find(1)->votes->first()->pivot->vote = 2;
	$votes = Quote::find(1)->votes->updateExistingPivot(1, array('vote' => -1));
	return '<pre>' . print_r($votes, true) . '</pre>';
});

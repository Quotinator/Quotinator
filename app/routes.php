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

//Patterns
Route::pattern('quote', '[0-9]+');
Route::pattern('user', '[A-Za-z0-9_]+');

//Bindings
Route::bind('user', function($value, $route)
{
	$user = User::where('username', $value)->first();
    if ($user) return $user;
    App::abort(404, 'User not found!');
});

Route::model('quote', 'Quote', function()
{
    App::abort(404, 'Quote not found!');
});


//Quote listings
Route::group(array('before' => 'votes'), function () {
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex', 'before' => 'moderate'));
	Route::get('/random', array('as' => 'random', 'uses' => 'HomeController@getRandom'));
	Route::get('/top', array('as' => 'top', 'uses' => 'HomeController@getTop'));
	Route::get('/{quote}', array('as' => 'quote', 'uses' => 'HomeController@getQuote', 'before' => 'moderate'));
	Route::get('/search', array('as' => 'search', 'uses' => 'HomeController@getSearch'));
	Route::post('/search', array('as' => 'search.post', 'uses' => 'HomeController@postSearch', 'before' => 'csrf'));
});

//User Profiles
Route::group(array('prefix' => 'user', 'before' => 'votes|favorite'), function ()
{
	Route::get('/{user}', array('as' => 'user.profile', 'uses' => 'UserController@getProfile'));
	Route::get('/{user}/quotes', array('as' => 'user.quotes', 'uses' => 'UserController@getQuotes'));
	Route::get('/{user}/favorites', array('as' => 'user.favorites', 'uses' => 'UserController@getFavorites'));
});

//Guest Pages
Route::group(array('before' => 'guest'), function () 
{
	Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'));
	Route::post('/login', array('as' => 'login', 'uses' => 'AuthController@postLogin', 'before' => 'csrf'));

	Route::get('/register', array('as' => 'register', 'uses' => 'RegistrationController@getRegister'));
	Route::post('/register', array('as' => 'register', 'uses' => 'RegistrationController@postRegister', 'before' => 'csrf'));

	Route::controller('password', 'RemindersController');
});

//Auth Pages
Route::group(array('before' => 'auth'), function ()
{
	Route::get('/{quote}/favorite', array('as' => 'favorite', 'uses' => 'QuoteController@getFavorite'));
	Route::get('/{quote}/unfavorite', array('as' => 'unfavorite', 'uses' => 'QuoteController@getUnfavorite'));

	Route::get('/{quote}/upvote', array('as' => 'upvote', 'uses' => 'QuoteController@getUpvote'));
	Route::get('/{quote}/downvote', array('as' => 'downvote', 'uses' => 'QuoteController@getDownvote'));
	Route::get('/{quote}/unvote', array('as' => 'unvote', 'uses' => 'QuoteController@getUnvote'));

	Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));
	Route::get('/submit', array('as' => 'submit', 'before' => 'auth|can:quote.submit', 'uses' => 'SubmitController@getIndex'));
	Route::post('/submit', array('as' => 'submit', 'before' => 'auth|can:quote.submit', 'uses' => 'SubmitController@postIndex'));
});

Route::group(array('prefix' => 'dashboard', 'before' => 'auth'), function()
	{
		Route::get('/', array('as' => 'user.dashboard', 'before' => 'auth', 'uses' => 'UserDashboardController@getMain'));
		Route::get('account', array('as' => 'user.dashboard.account', 'before' => 'auth', 'uses' => 'UserDashboardController@getEditAccount'));
		Route::post('account', array('as' => 'user.dashboard.account', 'before' => 'auth|csrf', 'uses' => 'UserDashboardController@postEditAccount'));

		Route::get('profile', array('as' => 'user.dashboard.profile', 'before' => 'auth', 'uses' => 'UserDashboardController@getEditProfile'));
		Route::post('profile', array('as' => 'user.dashboard.profile', 'before' => 'auth|csrf', 'uses' => 'UserDashboardController@postEditProfile'));
	});

//Info Pages
Route::get('/about', array('as' => 'about', 'uses' => 'HomeController@getAbout'));
Route::get('/help', array('as' => 'help', 'uses' =>  'HomeController@getHelp'));
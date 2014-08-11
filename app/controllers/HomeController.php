<?php

class HomeController extends BaseController
{
	public function getIndex()
	{
		return View::make('home')->with('quotes', Quote::orderBy('id', 'desc')->paginate(Config::get('per_page')));
	}

	public function getRandom()
	{
		return View::make('random')->with('quotes', Quote::orderByRaw('RAND()')->paginate(Config::get('per_page')));	
	}

	public function getTop()
	{
		return View::make('home')->with('quotes', Quote::paginate(Config::get('per_page')));
	}	

	public function getAbout()
	{
		return View::make('about')->with('pagetitle', 'About');
	}

	public function getQuote($id)
	{
		return View::make('quote')->with('quote', Quote::find($id));
	}

	public function getUserQuotes($username) {
		$user = User::whereUsername($username)->first();
		$quotes = $user->quotes()->paginate(Config::get('per_page'));
		$quoteCount = $quotes->count();
		if (count($user) > 0) {
			return View::make('user')->with('user', $user)->with('quotes', $quotes)->with('count', $quoteCount);
		}
		return Redirect::to('/');
	}
}
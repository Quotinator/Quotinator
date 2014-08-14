<?php

class UserController extends BaseController
{
	public function getProfile(User $user) {
		return View::make('user.profile')->with('user', $user);
	}
	
	public function getQuotes(User $user) {
		$quotes = $user->quotes()->orderBy('id', 'desc')->whereStatus(1)->paginate(Config::get('per_page'));
		$quoteCount = $quotes->count();
		return View::make('user.quotes')->with('user', $user)->with('quotes', $quotes)->with('count', $quoteCount);
	}

	public function getFavorites(User $user) {
		$quotes = $user->favorites()->orderBy('id', 'desc')->whereStatus(1)->paginate(Config::get('per_page'));
		$quotesCount = $quotes->count();
		return View::make('user.favorites')->with('user', $user)->with('quotes', $quotes)->with('count', $quotesCount);
	}
}
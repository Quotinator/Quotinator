<?php

class UserController extends BaseController
{
	public function getProfile(User $username) {
		return View::make('user.profile')->with('user', $username);
	}
	public function getQuotes(User $username) {
		$quotes = $username->quotes()->orderBy('id', 'desc')->paginate(Config::get('per_page'));
		$quoteCount = $quotes->count();
		return View::make('user.quotes')->with('user', $username)->with('quotes', $quotes)->with('count', $quoteCount);
	}

	public function getFavorites(User $username) {
		$quotes = $username->favorites()->orderBy('id', 'desc')->paginate(Config::get('per_page'));
		$quotesCount = $quotes->count();
		return View::make('user.favorites')->with('user', $username)->with('quotes', $quotes)->with('count', $quotesCount);
	}
}
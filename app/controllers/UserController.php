<?php

class UserController extends PageController
{
	public function getProfile(User $user) {
		$this->layout->title = $user->username . "'s profile";
		$quotes = $user->quotes()->orderBy('id', 'desc')->whereStatus(1)->take(3);
		$this->layout->nest('content', 'user.profile', ['user' => $user, 'quotes' => $quotes]);
	}
	
	public function getQuotes(User $user) {
		$this->layout->title = $user->username . "'s submitted quotes";
		$quotes = $user->quotes()->orderBy('id', 'desc')->whereStatus(1)->paginate(Config::get('per_page'));
		$quoteCount = $quotes->count();
		$this->layout->nest('content', 'user.quotes', ['user' => $user, 'quotes' => $quotes, 'count' => $quoteCount]);
	}

	public function getFavorites(User $user) {
		$this->layout->title = $user->username . "'s favorites";
		$quotes = $user->favorites()->orderBy('id', 'desc')->whereStatus(1)->paginate(Config::get('per_page'));
		$quoteCount = $quotes->count();
		$this->layout->nest('content', 'user.favorites', ['user' => $user, 'quotes' => $quotes, 'count' => $quoteCount]);	
	}
}
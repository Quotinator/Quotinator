<?php

class HomeController extends PageController
{
	public function getIndex()
	{
		$this->layout->title = 'Home';
		if (Auth::check() && Auth::user()->can(['quote.approve', 'quote.deny'])) {
			$quotes = Quote::orderBy('id', 'desc')->where('status', '!=', -1)->paginate(Config::get('settings.per_page'));
		} else {
			$quotes = Quote::orderBy('id', 'desc')->whereStatus(1)->paginate(Config::get('settings.per_page'));
		}
		$this->layout->nest('content', 'home', ['quotes' => $quotes]);
	}

	public function getRandom()
	{
		$this->layout->title = 'Random';
		$quotes = Quote::orderByRaw('RAND()')->whereStatus(1)->paginate(Config::get('settings.per_page'));

		$this->layout->nest('content', 'random', ['quotes' => $quotes]);
	}

	public function getTop()
	{
		$this->layout->title = 'Top';
		$quotes = Quote::orderBy('confidence', 'desc')->whereStatus(1)->paginate(Config::get('settings.per_page'));
		$this->layout->nest('content', 'home', ['quotes' => $quotes]);
	}	

	public function getQuote(Quote $quote)
	{
		if ($quote->status == 1 || $quote->user->username == Auth::user()->username || Auth::user()->can(['quote.approve', 'quote.deny'])) {
			$this->layout->title = $quote->title;
			$this->layout->nest('content', 'quote', ['quote' => $quote]);
		} else {
			App::abort(404, 'Quote not found!');
		}
	}

	public function getUsers() {
		$this->layout->title = 'Users';
		$users = User::orderBy('id', 'asc');
		$userCount = $users->count();
		$paginate = $users->paginate(100);

		$this->layout->nest('content', 'users', ['users' => $paginate, 'count' => $userCount]);
	}

	public function getAbout()
	{
		$this->layout->title = 'About';
		$this->layout->content = View::make('about');
	}

	public function getHelp()
	{
		$this->layout->title = 'Help';
		$this->layout->content = View::make('help');
	}

	public function getSearch() {
		if (Session::has('search')) {
			$words = explode(' ', Session::get('search'));
			$quotes = Quote::orderBy('id', 'desc')->orWhere(function($query) use ($words){
				foreach ($words as $word) {
					$query->where('quote', 'LIKE', '%' . $word . '%');
				}
				$query->whereStatus(1);
			})->orWhere(function($query) use ($words){
				foreach ($words as $word) {
					$query->where('title', 'LIKE', '%' . $word . '%');
				}
				$query->whereStatus(1);
			})->paginate(Config::get('settings.per_page'));
			$quotesCount = $quotes->count();

			//$this->layout->title = 'Search';
			$this->layout->nest('content', 'search', ['quotes' => $quotes, 'count' => $quotesCount, 'terms' => Session::get('search')]);
		} else {
			return Redirect::to('/')->withErrors(array('usesearch' => 'Use the search box, silly :)'));
		}
	}

	public function postSearch() {
		if (Input::has('search')) {
			$data = array('search' => Input::get('search'));
			
			$rules = array('search' => 'min:4|max:50');

			$validator = Validator::make($data, $rules);
			
			if ($validator->passes()) {
				//We found a search, save in session and redirect to search results
				Session::put('search', Input::get('search'));
				return Redirect::route('search');
			} else {
				//Invalid search
				return Redirect::to('/')->withErrors($validator);
			}
		}
		return Redirect::to('/');
	}
}

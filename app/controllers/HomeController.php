<?php

class HomeController extends BaseController
{
	private function input() {
		if (!Auth::check()) {
			return;
		}
		$rules = array(
			'upvote' => 'integer|numeric',
			'downvote' => 'integer|numeric',
			'favorite' => 'integer|numeric'
			);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			if (Input::has('favorite')) {
				$id = Input::get('favorite');
				$quote = Quote::find($id);
				if ($quote) {
					if (!Auth::user()->favorites->contains($id)) {
						Auth::user()->favorites()->attach($quote);
					}
				}
			}
			if (Input::has('upvote') || Input::has('downvote'))  {
				if (Input::has('upvote')) {
					$value = 1;
					$id = Input::get('upvote');
				} elseif (Input::has('downvote')) {
					$value = 0;
					$id = Input::get('downvote');
				} else { 
					//Not sure how you would get here
					return;
				}

				$user = Auth::user();
				$quote = Quote::find($id);
				$vote = $quote->votes()->whereUserId($user->id);
				
				$vote->vote = 0;
				$vote->save();
				die();
				if (!$vote) {        	
					$vote = new Vote;
					
	        		$vote->user()->associate($user);
	        		$vote->quote()->associate($quote);
					$vote->save();
				} else {
					$vote->vote = $value;
					$vote->save();
				}

			}
		}
	}
	public function getIndex()
	{
		$this->input();
		return View::make('home')->with('quotes', Quote::orderBy('id', 'desc')->paginate(Config::get('per_page')));
	}

	public function getRandom()
	{
		$this->input();
		return View::make('random')->with('quotes', Quote::orderByRaw('RAND()')->paginate(Config::get('per_page')));	
	}

	public function getTop()
	{
		$this->input();
		return View::make('home')->with('quotes', Quote::paginate(Config::get('per_page')));
	}	

	public function getAbout()
	{
		return View::make('about')->with('pagetitle', 'About');
	}

	public function getQuote($id)
	{
		$this->input();
		return View::make('quote')->with('quote', Quote::find($id));
	}

	public function getUserQuotes(User $username) {
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
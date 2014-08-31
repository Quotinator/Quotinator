<?php

class HomeController extends BaseController
{

	public function getIndex()
	{
		if (Auth::check() && Auth::user()->can(['quote.approve', 'quote.deny'])) {
			return View::make('home')->with('pagetitle', 'Home')->with('quotes', Quote::orderBy('id', 'desc')->where('status', '!=', -1)->paginate(Config::get('settings.per_page')));
		} else {
			return View::make('home')->with('pagetitle', 'Home')->with('quotes', Quote::orderBy('id', 'desc')->whereStatus(1)->paginate(Config::get('settings.per_page')));
		}
	}

	public function getRandom()
	{
		return View::make('random')->with('pagetitle', 'Home')->with('quotes', Quote::orderByRaw('RAND()')->whereStatus(1)->paginate(Config::get('settings.per_page')));	
	}

	public function getTop()
	{
		return View::make('home')->with('quotes', Quote::orderBy('confidence', 'desc')->whereStatus(1)->paginate(Config::get('settings.per_page')));
	}	

	public function getQuote(Quote $quote)
	{
		if ($quote->status == 1 || $quote->user->username == Auth::user()->username || Auth::user()->can(['quote.approve', 'quote.deny'])) {
			return View::make('quote')->with('quote', $quote);
		} else {
			App::abort(404, 'Quote not found!');
		}
	}

	public function getAbout()
	{
		return View::make('about')->with('pagetitle', 'About');
	}

	public function getHelp()
	{
		return View::make('help')->with('pagetitle', 'Help');
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

			return View::make('search')->with('quotes', $quotes)->with('count', $quotesCount)->with('terms', Session::get('search'));
		}
		return Redirect::to('/')->withErrors(array('usesearch' => 'Use the search box, silly :)'));
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
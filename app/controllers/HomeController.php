<?php

class HomeController extends BaseController
{

	public function getIndex()
	{
		if (Auth::check() && Auth::user()->can(['quote.approve', 'quote.deny'])) {
			return View::make('home')->with('quotes', Quote::orderBy('id', 'desc')->where('status', '!=', -1)->paginate(Config::get('per_page')));
		} else {
			return View::make('home')->with('quotes', Quote::orderBy('id', 'desc')->whereStatus(1)->paginate(Config::get('per_page')));
		}
	}

	public function getRandom()
	{
		return View::make('random')->with('quotes', Quote::orderByRaw('RAND()')->whereStatus(1)->paginate(Config::get('per_page')));	
	}

	public function getTop()
	{
		return View::make('home')->with('quotes', Quote::orderBy('confidence')->whereStatus(1)->paginate(Config::get('per_page')));
	}	

	public function getQuote(Quote $quote)
	{
		return View::make('quote')->with('quote', $quote);
	}

	public function getAbout()
	{
		return View::make('about')->with('pagetitle', 'About');
	}

}
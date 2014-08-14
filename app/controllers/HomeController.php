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
			'unvote' => 'integer|numeric',
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
			if (Input::has('upvote') || Input::has('downvote') || Input::has('unvote') )  {
				$value = NULL;
				$id = NULL;
				if (Input::has('upvote')) {
					$value = 1;
					$id = Input::get('upvote');
				} elseif (Input::has('downvote')) {
					$value = 0;
					$id = Input::get('downvote');
				} elseif (Input::has('unvote')) {
					$id = Input::get('unvote');
				}

				$quote = Quote::find($id);
				if ($quote) {
					$vuser = $quote->voted()->whereUserId(Auth::user()->id)->first();
					if (!$vuser) {
						$quote->voted()->attach(Auth::user(), array('vote' => $value));
						$quote->updateVoteConfidence();
						return;
					} elseif (Input::has('unvote')) {
						if ($vuser) {
							$quote->voted()->detach(Auth::user());
							$quote->updateVoteConfidence();
						}
						return;
					}
					$vuser->pivot->vote = $value;
					$vuser->pivot->save();
					$quote->updateVoteConfidence();
					return;
				}
				return;
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
		return View::make('home')->with('quotes', Quote::orderBy('confidence')->paginate(Config::get('per_page')));
	}	

	public function getAbout()
	{
		return View::make('about')->with('pagetitle', 'About');
	}

	public function getQuote(Quote $quote)
	{
		$this->input();
		return View::make('quote')->with('quote', $quote);
	}


}
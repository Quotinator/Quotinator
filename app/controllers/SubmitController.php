<?php
class SubmitController extends BaseController {
	public function getIndex()
	{
		return View::make('submit');
	}

	public function postIndex()
	{
			$rules = array (
				'title' => 'required|alphaNum|min:5',
				'quote' => 'required|min:15'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('submit')->withErrors($validator)->withInput(Input::all());
		} else {
			$quote = new Quote;
			$quote->title = Input::get('title');
			$quote->quote = Input::get('quote');

			Auth::User()->quotes()->save($quote);
			return Redirect::to('/');
		}
	}
}
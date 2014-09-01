<?php
class SubmitController extends PageController {
	public function getIndex()
	{
		$this->layout->title = 'Submit';
		$this->layout->content = View::make('submit');
	}

	public function postIndex()
	{
			$rules = array (
				'title' => 'required|min:3|max:32',
				'quote' => 'required|min:5|max:10240'
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
<?php
class EditorController extends PageController {

	public function getIndex($quote = null)
	{
		$this->layout->title = 'Quote Editor';
		if (is_null($quote))
		{
			$this->layout->content = View::make('editor');
		}
		else
		{
			$this->layout->nest('content', 'editor', ['quote' => $quote]);
		}
	}

	public function postIndex($quote = null)
	{
			$rules = array (
				'title' => 'required|min:3|max:32',
				'quote' => 'required|min:5|max:10240'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) 
		{
			return Redirect::to('editor')->withErrors($validator)->withInput(Input::all());
		}
		else
		{
			if (is_null($quote))
			{
				$quote = new Quote;
			}

			$quote->title = Input::get('title');
			$quote->quote = Input::get('quote');

			if (!isset($quote->id))
			{
				Auth::User()->quotes()->save($quote);
			}
			else
			{
				$quote->save();
			}
			return Redirect::to('/');
		}
	}
}
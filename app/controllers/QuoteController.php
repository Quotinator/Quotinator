<?php
class QuoteController extends PageController
{
	public function getFavorite(Quote $quote)
	{
		if (!Auth::user()->favorites->contains($quote->id))
		{
			Auth::user()->favorites()->attach($quote);
		}
		return Redirect::route('quote', array($quote->id))->withErrors('Thanks for favoriting!');
		//return Redirect::back();
	}

	public function getUnfavorite(Quote $quote)
	{
		if (Auth::user()->favorites->contains($quote->id))
		{
			Auth::user()->favorites()->detach($quote);
		}
		return Redirect::route('quote', array($quote->id))->withErrors('You have unfavorited this quote.');;
		//return Redirect::back();
	}


	public function getUpvote(Quote $quote)
	{
		$vuser = $quote->voted()->whereUserId(Auth::user()->id)->first();
		if (!$vuser)
		{
			$quote->voted()->attach(Auth::user(), array('vote' => 1));
		}
		else
		{
			$vuser->pivot->vote = 1;
			$vuser->pivot->save();
		}

		$quote->updateVoteConfidence();
		return Redirect::route('quote', array($quote->id))->withErrors('You have upvoted!');
	}

	public function getDownvote(Quote $quote)
	{
		$vuser = $quote->voted()->whereUserId(Auth::user()->id)->first();
		if (!$vuser)
		{
			$quote->voted()->attach(Auth::user(), array('vote' => 0));
		}
		else 
		{
			$vuser->pivot->vote = 0;
			$vuser->pivot->save();
		}
		$quote->updateVoteConfidence();
		return Redirect::route('quote', array($quote->id))->withErrors('You have downvoted!');
	}
	
	public function getUnvote(Quote $quote)
	{
		$vuser = $quote->voted()->whereUserId(Auth::user()->id)->first();
		if ($vuser)
		{
			$quote->voted()->detach(Auth::user());
			$quote->updateVoteConfidence();
			return Redirect::route('quote', array($quote->id))->withErrors('You have removed your vote!');
		}
	}


}
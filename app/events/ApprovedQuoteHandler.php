<?php

class ApprovedQuoteHandler
{
	public function handle($quote)
	{
		$id = $quote->id;
		$username = $quote->user->username;
		$title = $quote->title;
		$url = URL::route('quote', [$quote->id]);

		$message = "#$id ($username): $title $url";
		Twitter::postTweet(array('status' => $message, 'format' => 'json'));
		Irc::broadcast($message);
	}
}

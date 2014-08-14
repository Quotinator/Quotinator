<?php

class Quote extends Eloquent {

	public function user() {
		return $this->belongsTo('User');
	}

	public function upVotes() {
		return $this->hasMany('Vote')->whereVote(1)->count();
	}

	public function downVotes() {
		return $this->hasMany('Vote')->whereVote(0)->count();
	}

	public function didAuthVote() {
		if (!Auth::check()) return false;
		if ($this->hasMany('Vote')->whereUserId(Auth::User()->id)->count() > 0) {
			return true;
		}
	}

	public function totalVotes() {
		return $this->hasMany('Vote')->count();	
	}

	public function voteConfidence() {
		$ups = $this->upVotes();
		$downs = $this->downVotes();
		$n = $ups + $downs;
		if ($n == 0) return 0;
		$z = 1.0; #1.0 = 85%, 1.6 = 95%
		$phat = floatval($ups) / $n;
		return sqrt($phat+$z*$z/(2*$n)-$z*(($phat*(1-$phat)+$z*$z/(4*$n))/$n))/(1+$z*$z/$n);
	}

	public function updateVoteConfidence() {
		$this->confidence = $this->voteConfidence();
		$this->save();
	}


	public function favorited() {
		return $this->belongsToMany('User', 'favorites', 'quote_id', 'user_id')->withTimestamps();
	}

	public function voted() {
		return $this->belongsToMany('User', 'votes', 'quote_id', 'user_id')->withTimestamps();
	}
}
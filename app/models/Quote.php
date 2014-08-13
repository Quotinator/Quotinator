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

	public function votes() {
		return $this->hasMany('Vote');
	}

	public function favorited() {
		return $this->belongsToMany('User', 'favorites', 'quote_id', 'user_id');
	}

	public function users() {
		return $this->belongsToMany('User', 'votes', 'quote_id', 'user_id');
	}
}
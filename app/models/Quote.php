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

	public function votes() {
		return $this->hasMany('Vote');
	}
}
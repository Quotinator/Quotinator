<?php

class Vote extends Eloquent {

	public function user() {
		return $this->belongsTo('User');
	}

	public function quote() {
		return $this->belongsTo('Quote');
	}
}
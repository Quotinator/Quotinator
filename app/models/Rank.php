<?php

class Rank extends Eloquent {
	public $timestamps = false;

	public function users() {
		return $this->belongsToMany('User');
	}

	public function permissions() {
		return $this->belongsToMany('Permission');
	}
}
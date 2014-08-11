<?php

class Permission extends Eloquent {
	public $timestamps = false;

	public function ranks() {
		return $this->belongsToMany('Rank');
	}
}
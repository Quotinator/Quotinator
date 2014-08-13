<?php

class Permission extends Eloquent {
	public $timestamps = false;

	public function roles() {
		return $this->belongsToMany('Role');
	}

}
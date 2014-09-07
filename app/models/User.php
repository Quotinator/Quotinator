<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function roles() {
		return $this->belongsToMany('Role');
	}

	public function favorites() {
		return $this->belongsToMany('Quote', 'favorites', 'user_id', 'quote_id')->withTimestamps();
	}

	public function quotes() {
		return $this->hasMany('Quote');
	}

	public function votes() {
		return $this->belongsToMany('Quote', 'votes', 'user_id', 'quote_id')->withTimestamps();
	}

	public function can($permissions) {
		if (!is_array($permissions)) {
			$permissions = array($permissions);
		}

		$roles = $this->roles()->with('permissions')->get();
		if ($roles) {
			foreach ($roles as $role) {
				foreach ($permissions as $permission) {
					//Check each role of the user for the permission.
					$count = $role->permissions()->where('node', $permission)->count();
					if ($count > 0) return true;
				}
			}
		}

		return false;
	}


	public function getAvatarAttribute()
	{

		$gravatar = function ( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
			$url = 'https://www.gravatar.com/avatar/';
			$url .= md5( strtolower( trim( $email ) ) );
			$url .= "?s=$s&d=$d&r=$r";
			if ( $img ) {
				$url = '<img src="' . $url . '"';
				foreach ( $atts as $key => $val )
					$url .= ' ' . $key . '="' . $val . '"';
				$url .= ' />';
			}
			return $url;
		};

    	return htmlentities($gravatar($this->attributes['email'], 100, 'retro', 'r'));
	}

}

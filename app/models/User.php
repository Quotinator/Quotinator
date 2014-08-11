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

	public function ranks() {
		return $this->belongsToMany('Rank');
	}

	public function quotes() {
		return $this->hasMany('Quote');
	}

	public function votes() {
		return $this->hasMany('Vote');
	}

	public function getCanAttribute($value)
	{
		return true;
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

    	return $gravatar($this->attributes['email'], 80, 'retro', 'r');
	}

}

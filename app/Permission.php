<?php

namespace Quotinator;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  public $timestamps = false;

	public function roles()
  {
		return $this->belongsToMany('Quotinator\Role');
	}
}

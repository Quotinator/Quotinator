<?php

namespace Quotinator;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  public $timestamps = false;

	public function users()
  {
		return $this->belongsToMany('Quotinator\User');
	}

	public function permissions()
  {
		return $this->belongsToMany('Quotinator\Permission');
	}
}

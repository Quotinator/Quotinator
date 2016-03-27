<?php

namespace Quotinator;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes that are sortable.
     *
     * @var array
     */
    protected $sortable = ['created_at', 'username', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
      return $this->belongsToMany('Quotinator\Role');
    }

    public function favorites()
    {
      return $this->belongsToMany('Quotinator\Quote', 'favorites', 'user_id', 'quote_id')->withTimestamps();
    }

    public function quotes()
    {
      return $this->hasMany('Quotinator\Quote', 'user_id', 'id');
    }

    public function votes()
    {
      return $this->belongsToMany('Quotinator\Quote', 'votes', 'user_id', 'quote_id')->withTimestamps();
    }

    public function avatar()
    {
      return \Gravatar::get($this->email);
    }
}

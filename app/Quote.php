<?php

namespace Quotinator;

use Log;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Quote extends Model
{
  use Sortable;

  const APPROVED = 1;
  const PENDING = 0;
  const DENIED = -1;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['title', 'quote', 'status'];

  /**
   * The attributes that are sortable.
   *
   * @var array
   */
  protected $sortable = ['id', 'quote', 'title', 'status', 'confidence'];

  public function user()
  {
    return $this->belongsTo('Quotinator\User');
  }

  public function upVotes()
  {
    return $this->hasMany('Quotinator\Vote')->whereVote(1)->count();
  }
  public function downVotes()
  {
    return $this->hasMany('Quotinator\Vote')->whereVote(0)->count();
  }

  public function totalVotes()
  {
    return $this->hasMany('Quotinator\Vote')->count();
  }

  public function isFavored()
  {
		if (!\Auth::check()) return false;
		if ($this->belongsToMany('Quotinator\User', 'favorites', 'quote_id', 'user_id')->whereUserId(\Auth::User()->id)->count() > 0) {
			return true;
		}
    return false;
	}

  public function scopeStatus($query, $type)
  {
    if (strtolower($type) == 'approved')
    {
      return $query->whereStatus(self::APPROVED);
    }
    elseif (strtolower($type) == 'pending')
    {
      return $query->whereStatus(self::PENDING);
    }
    elseif (strtolower($type) == 'denied')
    {
      return $query->whereStatus(self::DENIED);
    }
    else
    {
      Log::warning('An invalid quote status was used. Defaulting to Approved only.');
      return $query->whereStatus(self::APPROVED);
    }
  }

  public function voteConfidence()
  {
    $ups = $this->upVotes();
    $downs = $this->downVotes();
    $n = $ups + $downs;
    if ($n == 0) return 0;
    $z = 1.0; #1.0 = 85%, 1.6 = 95%
    $phat = floatval($ups) / $n;
    return sqrt($phat+$z*$z/(2*$n)-$z*(($phat*(1-$phat)+$z*$z/(4*$n))/$n))/(1+$z*$z/$n);
  }

  public function updateVoteConfidence()
  {
    $this->confidence = $this->voteConfidence();
    $this->save();
  }

  public function favorited()
  {
    return $this->belongsToMany('Quotinator\User', 'favorites', 'quote_id', 'user_id')->withTimestamps();
  }

  public function voted()
  {
    return $this->belongsToMany('Quotinator\User', 'votes', 'quote_id', 'user_id')->withTimestamps();
  }
}

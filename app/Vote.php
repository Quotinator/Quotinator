<?php

namespace Quotinator;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function user()
    {
        return $this->belongsTo('Quotinator\User');
    }

    public function quote()
    {
        return $this->belongsTo('Quotinator\Quote');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scout extends Model
{
    protected $dates = ['birth_date'];

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function nextRank()
    {
        return $this->rank->nextRank();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{

    public function nextRank()
    {
        return $this->belongsTo(Rank::class, 'next_rank_id');
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }
}

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
        if(!empty($this->rank_id)) {
            return $this->rank->nextRank;
        }

        return Rank::where('name', 'Bobcat')->first();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adventure extends Model
{

    public function requirements()
    {
        return $this->morphMany(Requirement::class, 'requireable');
    }
}

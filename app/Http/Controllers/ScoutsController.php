<?php

namespace App\Http\Controllers;

use App\Scout;
use Illuminate\Http\Request;

class ScoutsController extends Controller
{

    public function show(Scout $scout)
    {
        return view('scouts.view', ['scout'=>$scout]);
    }
}

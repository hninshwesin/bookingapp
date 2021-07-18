<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TownshipResourceCollection;
use App\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    public function townships()
    {
        $townships = Township::with('region')->get();

        return new TownshipResourceCollection($townships);
    }
}

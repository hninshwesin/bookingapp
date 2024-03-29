<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResourceCollection;
use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function regions()
    {
        $regions = Region::orderBy('sort_order', 'ASC')->get();

        return new RegionResourceCollection($regions);
    }
}

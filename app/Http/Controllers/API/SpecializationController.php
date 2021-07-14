<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecializationResourceCollection;
use App\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function specializations()
    {
        $specializations = Specialization::all();

        // $specializations = Specialization::whereHas('doctor', function ($query) {
        //     $query->where('approve_status', 1);
        // })->get();
        //        dd($specializations);

        return new SpecializationResourceCollection($specializations);
    }
}

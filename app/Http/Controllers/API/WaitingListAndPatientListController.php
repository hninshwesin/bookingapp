<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WaitingResourceCollection;
use App\WaitingList;
use Illuminate\Support\Facades\Auth;

class WaitingListAndPatientListController extends Controller
{
    public function patient()
    {
        $doctor = Auth::guard('doctor-api')->user();

        $patients = WaitingList::where('doctor_id', [$doctor->id])->where('status', '1')->get();

        return new WaitingResourceCollection($patients);

    }

    public function waiting()
    {
        $doctor = Auth::guard('doctor-api')->user();

        $waiting = WaitingList::where('doctor_id', [$doctor->id])->where('status', '0')->get();

        return new WaitingResourceCollection($waiting);

//        return response()->json(['patient' => $waiting]);
//        return WaitingResource::collection($waiting);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientResourceCollection;
use App\Http\Resources\WaitingResource;
use App\Http\Resources\WaitingResourceCollection;
use App\Patient;
use App\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Collection;

class PatientListController extends Controller
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
//        dd($waiting);
//        dd($waiting[0]->patient_id);

//        return response()->json(['patient' => $waiting]);

        return new WaitingResourceCollection($waiting);

//        return WaitingResource::collection($waiting);
    }
}

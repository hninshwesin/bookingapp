<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function patient($patient_id)
    {
//        dd($patient_id);
        $patient = Patient::where('id', $patient_id)->first();

        return new PatientResource($patient);
    }
}

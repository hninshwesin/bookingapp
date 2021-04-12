<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Http\Resources\SearchPatientResource;
use App\Http\Resources\SearchPatientResourceCollection;
use App\Http\Resources\WaitingResource;
use App\Patient;
use App\WaitingList;
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

    public function searchpatient(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();

        $app_user = AppUser::where('id', [$user->id])->first();
        $doctor = Doctor::where('app_user_id', '=', $app_user->id)->first();

//        $patient = WaitingList::with('patient')->where('doctor_id', $doctor->id)->get();

//        $patient = WaitingList::with('patient')
//            ->where('doctor_id', $doctor->id)
//            ->whereHas('patient', function ($query) use ($data){
//            $query->where('Name', 'like', '%' . $data . '%')->get();
//        });


        $patient = WaitingList::with(['patient' => function ($query) use ($data) {$query->where('Name', 'like', '%' . $data . '%');}])
            ->where('doctor_id', $doctor->id)
            ->get();

        return new SearchPatientResourceCollection($patient);



    }
}


//'like', '%' . $data . '%'

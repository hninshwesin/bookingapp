<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PatientResourceCollection;
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

    public function all_patients()
    {
        $patients = Patient::get();

        return new PatientResourceCollection($patients);
    }

    public function store(Request $request)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $doctor_status = $app_user->doctor_status;

        if($doctor_status == 0) {
            $request->validate([

                'name' => 'required',
    
                'age' => 'required',
    
                'gender' => 'required',
    
                'address' => 'required',
    
                'contact_number' => 'required',
    
            ]);
    
            $name = $request->input('name');
            $age = $request->input('age');
            $gender = $request->input('gender');
            $address = $request->input('address');
            $contact_number = $request->input('contact_number');
    
            $patient = Patient::create([
                'Name' => $name,
                'Age' => $age,
                'Gender' => $gender,
                'Address' => $address,
                'Contact_Number' => $contact_number,
                'app_user_id' => $app_user->id,
            ]);
    
            $app_user->doctor_status = 2;
            $app_user->save();
    
            return response()->json(['error_code' => '0','patient' => $patient, 'message' => 'Patient Profile created successfully.'], 200);
        } elseif($doctor_status == 2) {
            return response()->json(['error_code' => '1', 'message' => 'Patient already exist'], 422);
        } elseif($doctor_status == 3) {
            return response()->json(['error_code' => '1', 'message' => "Doctor already created, Please wait for admin approval"], 422);
        } else {
            return response()->json(['error_code' => '1', 'message' => "You can't create patient, Doctor already exist"], 422);
        }
    }

    public function patient_create_api(Request $request)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $app_user_id = $app_user->id;

        if($app_user->doctor_status == 1) {
            $doctor = Doctor::where('app_user_id', $app_user_id)->first();

            $request->validate([

                'name' => 'required',

                'age' => 'required',

                'gender' => 'required',

                'address' => 'required',

                'contact_number' => 'required',

            ]);

            $name = $request->input('name');
            $age = $request->input('age');
            $gender = $request->input('gender');
            $address = $request->input('address');
            $contact_number = $request->input('contact_number');

            $patient = Patient::create([
                'Name' => $name,
                'Age' => $age,
                'Gender' => $gender,
                'Address' => $address,
                'Contact_Number' => $contact_number,
                'app_user_id' => 0,
            ]);
            
            $doctor->patients()->attach($patient->id);

            WaitingList::create([
                'doctor_id' => $doctor->id,
                'patient_id' => $patient->id,
                'status' => 0,
            ]);

            return response()->json(['error_code' => '0','patient' => $patient, 'message' => 'Patient created and assigned successfully.'], 200);
        } else {
            return response()->json(['error_code' => '1', 'message' => "Please wait for admin approval for Doctor"], 422);
        }
    }
}


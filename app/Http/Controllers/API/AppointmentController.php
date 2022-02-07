<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResourceCollection;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function make_appointment(Request $request)
    {
        $app_user_doctor_id = $request->input('app_user_doctor_id');
        $appintment_datetime = $request->input('datetime');

        $user = Auth::guard('user-api')->user();
        $app_user_id = AppUser::find($user->id);

        if ($app_user_id->doctor_status == 2) {
            $patient = Patient::where('app_user_id', $app_user_id->id)->first();
            if ($patient) {
                $doctor = Doctor::where('app_user_id', $app_user_doctor_id)->first();
                $appointment = Appointment::create([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctor->id,
                    'appintment_datetime' => $appintment_datetime,
                    'app_user_patient_id' => $app_user_id->id,
                    'app_user_doctor_id' => $app_user_doctor_id,
                    'status' => 0
                ]);

                return response()->json(['error_code' => '0', 'appointment' => $appointment, 'message' => 'Making appointment Successfully, Please wait for doctor\'s confirmation'], 200);
            } else {
                return response()->json(['error_code' => '1', 'message' => 'Something went wrong, Please Sign In again'], 422);
            }
        } else {
            return response()->json(['error_code' => '1', 'message' => 'Something went wrong, Please Sign In again'], 422);
        }
    }

    public function appointment_list()
    {
        $user = Auth::guard('user-api')->user();
        $app_user_id = AppUser::find($user->id);

        $doctor = Doctor::where('app_user_id', $app_user_id->id)->first();
        if ($doctor) {
            $appointments = Appointment::where('doctor_id', $doctor->id)->get();

            return new AppointmentResourceCollection($appointments);
        } else {
            return response()->json(['error_code' => '1', 'message' => 'Something went wrong, Please Sign In again'], 422);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Ambulance;
use App\AppUser;
use App\Clinic;
use Illuminate\Http\Request;
use App\Lab;
use App\Pharmacy;

class ApproveController extends Controller
{
    public function doctor_approve(Request $request)
    {
        $app_user_id = $request->input('app_user_id');
        $doctor_id = $request->input('doctor_id');
        $app_user = AppUser::where('id','=', $app_user_id)->first();
        $app_user->doctor_status = 1;
        $app_user->save();

        return redirect()->route('home')->with('success','Doctor has been approved');
    }

    public function ambulance_approve(Request $request)
    {
        $ambulance_id = $request->input('ambulance_id');
        $ambulance = Ambulance::where('id','=', $ambulance_id)->first();
        $ambulance->pending_status = 1;
        $ambulance->save();

        return redirect()->route('home')->with('success','Ambulance has been approved');
    }

    public function clinic_approve(Request $request)
    {
        $clinic_id = $request->input('clinic_id');
        $clinic = Clinic::where('id','=', $clinic_id)->first();
        $clinic->pending_status = 1;
        $clinic->save();

        return redirect()->route('home')->with('success','Clinic has been approved');
    }

    public function lab_approve(Request $request)
    {
        $lab_id = $request->input('lab_id');
        $lab = Lab::where('id','=', $lab_id)->first();
        $lab->pending_status = 1;
        $lab->save();

        return redirect()->route('home')->with('success','Lab has been approved');
    }

    public function pharmacy_approve(Request $request)
    {
        $pharmacy_id = $request->input('pharmacy_id');
        $pharmacy = Pharmacy::where('id','=', $pharmacy_id)->first();
        $pharmacy->pending_status = 1;
        $pharmacy->save();

        return redirect()->route('home')->with('success','Pharmacy has been approved');
    }
}

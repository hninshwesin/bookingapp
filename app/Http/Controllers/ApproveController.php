<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Ambulance;
use App\AppUser;
use App\Clinic;
use Illuminate\Http\Request;
use App\Lab;
use App\Pharmacy;

class ApproveController extends Controller
{
    public function doctor()
    {
        $doctors = Doctor::where('approve_status', '0')->where('app_user_id', '!=', '0')->get();
        return view('doctor_approve.index')->with(['doctors' => $doctors]);
    }

    public function doctor_approve(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $doctor = Doctor::find($doctor_id);
        $doctor->approve_status = 1;
        $doctor->save();
        $app_user = AppUser::where('id', '=', $doctor->app_user_id)->first();
        $app_user->doctor_status = 1;
        $app_user->save();

        return redirect()->back()->with('success', 'Doctor has been approved');
    }

    public function ambulance()
    {
        $ambulances = Ambulance::where('pending_status', '0')->get();
        return view('charity_approve.ambulance')->with(['ambulances' => $ambulances]);
    }

    public function ambulance_approve(Request $request)
    {
        $ambulance_id = $request->input('ambulance_id');
        $ambulance = Ambulance::find($ambulance_id);
        $ambulance->pending_status = 1;
        $ambulance->save();

        return redirect()->back()->with('success', 'Ambulance has been approved');
    }

    public function clinic()
    {
        $clinics = Clinic::where('pending_status', '0')->get();
        return view('charity_approve.clinic')->with(['clinics' => $clinics]);
    }

    public function clinic_approve(Request $request)
    {
        $clinic_id = $request->input('clinic_id');
        $clinic = Clinic::find($clinic_id);
        $clinic->pending_status = 1;
        $clinic->save();

        return redirect()->back()->with('success', 'Clinic has been approved');
    }

    public function lab()
    {
        $labs = Lab::where('pending_status', '0')->get();
        return view('charity_approve.lab')->with(['labs' => $labs]);
    }

    public function lab_approve(Request $request)
    {
        $lab_id = $request->input('lab_id');
        $lab = Lab::find($lab_id);
        $lab->pending_status = 1;
        $lab->save();

        return redirect()->back()->with('success', 'Oxygen has been approved');
    }

    public function pharmacy()
    {
        $pharmacies = Pharmacy::where('pending_status', '0')->get();
        return view('charity_approve.pharmacy')->with(['pharmacies' => $pharmacies]);
    }

    public function pharmacy_approve(Request $request)
    {
        $pharmacy_id = $request->input('pharmacy_id');
        $pharmacy = Pharmacy::find($pharmacy_id);
        $pharmacy->pending_status = 1;
        $pharmacy->save();

        return redirect()->back()->with('success', 'Pharmacy has been approved');
    }
}

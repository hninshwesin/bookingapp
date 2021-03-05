<?php

namespace App\Http\Controllers\API;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\DoctorResourceCollection;
use App\Referral;
use App\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd('hello');
        $from_doctor = Auth::guard('doctor-api')->user();
//        dd($from_doctor->id);

        $to_doctor_id = $request->input('to_doctor_id');
        $patient_id = $request->input('patient_id');
//        dd($to_doctor_id, $patient_id);

//        $to_doctor = Doctor::where('id', $to_doctor_id)->first();
        $waiting = WaitingList::where('doctor_id', $to_doctor_id)->where('patient_id', $patient_id)->first();
//        dd($waiting);

        if (!$waiting){

            Referral::create([
                'from_doctor_id' => $from_doctor->id,
                'to_doctor_id' => $to_doctor_id,
                'patient_id' => $patient_id,
            ]);

            WaitingList::create([
                'doctor_id' => $to_doctor_id,
                'patient_id' => $patient_id,
                'status' => 0,
            ]);

            return response()->json(['error_code' => '0', 'message' => 'Referral Doctor successfully'], 200);

        }
        else{
            return response()->json(['error_code' => '1', 'message' => 'This doctor and patient Already exit'], 422);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function doctors()
    {
        $doctor = Auth::guard('doctor-api')->user();
        $doctors = Doctor::where('id', '!=', $doctor->id)->get();
        dd($doctors);

        return new DoctorResourceCollection($doctors);
    }
}

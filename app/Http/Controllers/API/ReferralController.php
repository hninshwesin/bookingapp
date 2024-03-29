<?php

namespace App\Http\Controllers\API;

use App\AppUser;
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
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $from_doctor = Doctor::where('app_user_id', '=', $app_user->id)->first();

        $to_doctor_id = $request->input('to_doctor_id');
        $patient_id = $request->input('patient_id');
        //        dd($to_doctor_id, $patient_id);

        //        $to_doctor = Doctor::where('id', $to_doctor_id)->first();
        $waiting = WaitingList::where('doctor_id', $to_doctor_id)->where('patient_id', $patient_id)->first();
        //        dd($waiting);

        if (!$waiting) {

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
        } else {
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

    public function doctors(Request $request)
    {
        $specialization = $request->input('specialization');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $app_user_id = $app_user->id;

        if ($specialization) {
            $doctors = Doctor::with(['app_users' => function ($query) use ($app_user_id) {
                $query->where('app_user_id', '=', $app_user_id)->get();
            }])->where('app_user_id', '!=', $user->id)
                ->where('specialization', $specialization)
                ->where('approve_status', 1)->get();

            return new DoctorResourceCollection($doctors);
        } else {
            $doctors = Doctor::with(['app_users' => function ($query) use ($app_user_id) {
                $query->where('app_user_id', '=', $app_user_id)->get();
            }])->where('app_user_id', '!=', $user->id)->where('approve_status', 1)->get();

            return new DoctorResourceCollection($doctors);
        }
    }

    public function doctors_filter_with_language(Request $request)
    {
        $language_id = $request->input('language_id');
        $user = Auth::guard('user-api')->user();

        if ($language_id) {
            $doctors = Doctor::where('app_user_id', '!=', $user->id)
                ->whereHas('languages', function ($query) {
                    $query->where('language_id', request()->input('language_id'));
                })->where('approve_status', 1)->get();

            return new DoctorResourceCollection($doctors);
        } else {
            $doctors = Doctor::where('app_user_id', '!=', $user->id)->where('approve_status', 1)->get();

            return new DoctorResourceCollection($doctors);
        }
    }
}

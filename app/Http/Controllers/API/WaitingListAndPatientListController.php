<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\WaitingResourceCollection;
use App\WaitingList;
use Illuminate\Support\Facades\Auth;

class WaitingListAndPatientListController extends Controller
{
    public function patient()
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $doctor = Doctor::where('app_user_id', '=', $app_user->id)->first();

        $patients = WaitingList::where('doctor_id', [$doctor->id])->where('status', '1')->get();

        return new WaitingResourceCollection($patients);

    }

    public function waiting()
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $doctor = Doctor::where('app_user_id', '=', $app_user->id)->first();

        $waiting = WaitingList::where('doctor_id', [$doctor->id])->where('status', '0')->get();

        return new WaitingResourceCollection($waiting);

//        return response()->json(['patient' => $waiting]);
//        return WaitingResource::collection($waiting);
    }
}

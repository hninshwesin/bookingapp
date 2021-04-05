<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorProfile;
use App\Http\Resources\DoctorProfileCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('user-api')->user();
        $doctors = Doctor::where('app_user_id', '=', $user->id)->get();

        if ($user->doctor_status === 1){
            return new DoctorProfileCollection($doctors);
        } else{
            return response()->json(['error_code' => '0','status' => '0', 'message' => 'Does not have doctor']);
        }

//        return response(['doctor' => $user]);
    }
}

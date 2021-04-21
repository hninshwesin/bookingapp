<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppUserResource;
use App\Http\Resources\DoctorProfile;
use App\Http\Resources\DoctorProfileCollection;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\PendingDoctorProfileResource;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', '=', $user->id)->first();
        $doctors = Doctor::where('app_user_id', '=', $user->id)->first();
        $user_profile = UserProfile::where('app_user_id', '=', $user->id)->first();
        // dd($app_user);

        if ($user->doctor_status === 1) {
            // return (new DoctorProfileCollection($doctors))->response()->setStatusCode(200);
            return (new DoctorProfile($doctors));
        } elseif ($user->doctor_status === 2) {
            return (new UserProfileResource($user_profile));
        }elseif ($user->doctor_status === 3) {
            return (new PendingDoctorProfileResource($doctors));
        }else{
            return (new AppUserResource($app_user));
//            return response()->json(['error_code' => '0','status' => '0', 'message' => 'Does not have any profile yet'], 200);
        }

//        return response(['doctor' => $user]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppUserResource;
use App\Http\Resources\DoctorProfile;
use App\Http\Resources\DoctorProfileCollection;
use App\Http\Resources\UserProfileResourceCollection;
use App\Http\Resources\PendingDoctorProfileResourceCollection;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', '=', $user->id)->first();
        $doctors = Doctor::where('app_user_id', '=', $user->id)->get();
        $user_profile = UserProfile::where('app_user_id', '=', $user->id)->get();
        // dd($app_user);

        if ($user->doctor_status === 1) {
            return (new DoctorProfileCollection($doctors))->response()->setStatusCode(200);
        } elseif ($user->doctor_status === 2) {
            return (new UserProfileResourceCollection($user_profile))->response()->setStatusCode(200);
        }elseif ($user->doctor_status === 3) {
            return (new PendingDoctorProfileResourceCollection($doctors))->response()->setStatusCode(200);
        }else{
            return (new AppUserResource($app_user));
//            return response()->json(['error_code' => '0','status' => '0', 'message' => 'Does not have any profile yet'], 200);
        }

//        return response(['doctor' => $user]);
    }
}

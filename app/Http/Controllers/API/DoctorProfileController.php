<?php

namespace App\Http\Controllers\API;

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
        $user = Auth::guard('doctor-api')->user();

        return new DoctorProfile($user);

//        return response(['doctor' => $user]);
    }
}

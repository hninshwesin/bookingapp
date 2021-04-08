<?php

namespace App\Http\Controllers\API;

use App\Ambulance;
use App\AppUser;
use App\Clinic;
use App\Http\Controllers\Controller;
use App\Http\Resources\AmbulanceResourceCollection;
use App\Http\Resources\ClinicResourceCollection;
use App\Http\Resources\LabResourceCollection;
use App\Http\Resources\PharmacyResourceCollection;
use App\Lab;
use App\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharityFilterController extends Controller
{
    public function filter_ambulance(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $ambulance = Ambulance::where('name', 'like', '%' . $data . '%')->where('app_user_id', '=', $app_user->id)->get();

        return new AmbulanceResourceCollection($ambulance);
    }

    public function filter_clinic(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $ambulance = Clinic::where('name', 'like', '%' . $data . '%')->where('app_user_id', '=', $app_user->id)->get();

        return new ClinicResourceCollection($ambulance);
    }

    public function filter_lab(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $ambulance = Lab::where('name', 'like', '%' . $data . '%')->where('app_user_id', '=', $app_user->id)->get();

        return new LabResourceCollection($ambulance);
    }

    public function filter_pharmacy(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $ambulance = Pharmacy::where('name', 'like', '%' . $data . '%')->where('app_user_id', '=', $app_user->id)->get();

        return new PharmacyResourceCollection($ambulance);
    }
}

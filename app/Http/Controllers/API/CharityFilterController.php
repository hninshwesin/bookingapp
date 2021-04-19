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
        $ambulance = Ambulance::where('name', 'like', '%' . $data . '%')->get();

        return new AmbulanceResourceCollection($ambulance);
    }

    public function filter_clinic(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $clinic = Clinic::where('name', 'like', '%' . $data . '%')->get();

        return new ClinicResourceCollection($clinic);
    }

    public function filter_lab(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $lab = Lab::where('name', 'like', '%' . $data . '%')->get();

        return new LabResourceCollection($lab);
    }

    public function filter_pharmacy(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $pharmacy = Pharmacy::where('name', 'like', '%' . $data . '%')->get();

        return new PharmacyResourceCollection($pharmacy);
    }

    public function favorite_ambulance($ambulance_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $app_user->ambulances()->attach($ambulance_id);

        $ambulance = Ambulance::where('id', '=' , $ambulance_id)->where('app_user_id', '=', $app_user->id)->first();
        $ambulance->favorite_status = 1;
        $ambulance->save();

        return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
    }

    public function favorite_clinic($clinic_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $app_user->clinics()->attach($clinic_id);

        $clinic = Clinic::where('id', '=' , $clinic_id)->where('app_user_id', '=', $app_user->id)->first();
        $clinic->favorite_status = 1;
        $clinic->save();

        return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
    }

    public function favorite_lab($lab_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $app_user->labs()->attach($lab_id);

        $lab = Lab::where('id', '=' , $lab_id)->where('app_user_id', '=', $app_user->id)->first();
        $lab->favorite_status = 1;
        $lab->save();

        return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
    }

    public function favorite_pharmacy($pharmacy_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $app_user->pharmacies()->attach($pharmacy_id);

        $pharmacy = Pharmacy::where('id', '=' , $pharmacy_id)->where('app_user_id', '=', $app_user->id)->first();
        $pharmacy->favorite_status = 1;
        $pharmacy->save();

        return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
    }

    public function get_favorite_ambulance(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        $ambulance = Ambulance::where('favorite_status' , '=', '1')
        ->where('name', 'like', '%' . $data . '%')
        ->where('app_user_id', '=', $app_user->id)->get();

        return new AmbulanceResourceCollection($ambulance);
    }

    public function get_favorite_clinic(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        $clinic = Clinic::where('favorite_status' , '=', '1')
        ->where('name', 'like', '%' . $data . '%')
        ->where('app_user_id', '=', $app_user->id)->get();

        return new ClinicResourceCollection($clinic);
    }

    public function get_favorite_lab(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        $lab = Lab::where('favorite_status' , '=', '1')
        ->where('name', 'like', '%' . $data . '%')
        ->where('app_user_id', '=', $app_user->id)->get();

        return new LabResourceCollection($lab);
    }

    public function get_favorite_pharmacy(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        $pharmacy = Pharmacy::where('favorite_status' , '=', '1')
        ->where('name', 'like', '%' . $data . '%')
        ->where('app_user_id', '=', $app_user->id)->get();

        return new PharmacyResourceCollection($pharmacy);
    }
}

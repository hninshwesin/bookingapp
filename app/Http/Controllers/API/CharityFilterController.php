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
        $ambulance = Ambulance::where('name', 'like', '%' . $data . '%')
        ->where('pending_status', '=', '1')->get();

        return new AmbulanceResourceCollection($ambulance);
    }

    public function filter_clinic(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $clinic = Clinic::where('name', 'like', '%' . $data . '%')
        ->where('pending_status', '=', '1')->get();

        return new ClinicResourceCollection($clinic);
    }

    public function filter_lab(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $lab = Lab::where('name', 'like', '%' . $data . '%')
        ->where('pending_status', '=', '1')->get();

        return new LabResourceCollection($lab);
    }

    public function filter_pharmacy(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $pharmacy = Pharmacy::where('name', 'like', '%' . $data . '%')
        ->where('pending_status', '=', '1')->get();

        return new PharmacyResourceCollection($pharmacy);
    }

    public function favorite_ambulance($ambulance_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $pivot = $app_user->ambulances()->where('ambulance_id', '=', $ambulance_id)->first();

        if($pivot == null) {
            $app_user->ambulances()->attach($ambulance_id);
            
            return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
        }else {
            $app_user->ambulances()->detach($ambulance_id);
            
            return response()->json(['error_code' => '0','message' => 'Removed from the favorite'],  200);
        }
    }

    public function favorite_clinic($clinic_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $pivot = $app_user->clinics()->where('clinic_id', '=', $clinic_id)->first();

        if($pivot == null) {
            $app_user->clinics()->attach($clinic_id);
            
            return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
        }else {
            $app_user->clinics()->detach($clinic_id);
            
            return response()->json(['error_code' => '0','message' => 'Removed from the favorite'],  200);
        }

        // $clinic = Clinic::where('id', '=' , $clinic_id)->where('app_user_id', '=', $app_user->id)->first();
        // $clinic->favorite_status = 1;
        // $clinic->save();
    }

    public function favorite_lab($lab_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $pivot = $app_user->labs()->where('lab_id', '=', $lab_id)->first();

        if($pivot == null) {
            $app_user->labs()->attach($lab_id);
            
            return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
        }else {
            $app_user->labs()->detach($lab_id);
            
            return response()->json(['error_code' => '0','message' => 'Removed from the favorite'],  200);
        }

    }

    public function favorite_pharmacy($pharmacy_id)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $pivot = $app_user->pharmacies()->where('pharmacy_id', '=', $pharmacy_id)->first();

        if($pivot == null) {
            $app_user->pharmacies()->attach($pharmacy_id);
            
            return response()->json(['error_code' => '0','message' => 'Added to the favorite'],  200);
        }else {
            $app_user->pharmacies()->detach($pharmacy_id);
            
            return response()->json(['error_code' => '0','message' => 'Removed from the favorite'],  200);
        }
        
    }

    public function get_favorite_ambulance(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        if($data) {
            $ambulance = $app_user->ambulances()->where('name', 'like', '%' . $data . '%')->get();
    
            return new AmbulanceResourceCollection($ambulance);
        } else {
            $ambulance = $app_user->ambulances;
    
            return new AmbulanceResourceCollection($ambulance);
        }
    }

    public function get_favorite_clinic(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        if($data) {
            $clinic = $app_user->clinics()->where('name', 'like', '%' . $data . '%')->get();
    
            return new ClinicResourceCollection($clinic);
        } else {
            $clinic = $app_user->clinics;
    
            return new ClinicResourceCollection($clinic);
        }
    }

    public function get_favorite_lab(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        if($data) {
            $lab = $app_user->labs()->where('name', 'like', '%' . $data . '%')->get();
    
            return new LabResourceCollection($lab);
        } else {
            $lab = $app_user->labs;
    
            return new LabResourceCollection($lab);
        }
    }

    public function get_favorite_pharmacy(Request $request)
    {
        $data = $request->get('name');
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        if($data) {
            $pharmacy = $app_user->pharmacies()->where('name', 'like', '%' . $data . '%')->get();
    
            return new PharmacyResourceCollection($pharmacy);
        } else {
            $pharmacy = $app_user->pharmacies;
    
            return new PharmacyResourceCollection($pharmacy);
        }
    }
}

<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Http\Controllers\Controller;
use App\Patient;
use App\TopupPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopupPatientController extends Controller
{
    public function topup(Request $request)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);

        $request->validate([

            'amount' => 'required|integer'

        ]);

        $amount = $request->input('amount');

        $patient = Patient::where('app_user_id', $app_user->id)->first();

        if ($patient) {
            TopupPatient::create([
                'user_id' => 0,
                'patient_id' => $patient->id,
                'amount' => $amount
            ]);

            return response()->json(['error_code' => '0', 'message' => 'Topup Requested successfully, Admin will contact soon']);
        } else {
            return response()->json(['error_code' => '1', 'message' => 'You are not patient']);
        }
    }
}

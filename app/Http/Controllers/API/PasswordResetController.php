<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\PasswordResetCode;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function requestPasswordCode(Request $request)
    {
        try {
            $app_user = AppUser::where('name', '=', $request->name)->first();
            if (!$app_user) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'User does not exist'
                ], 422);
            } else {
                $status = $app_user->doctor_status;
                if ($status == 0) {
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'You can\'t reset password'
                    ], 422);
                } else {
                    $reset_code = PasswordResetCode::create([
                        'app_user_id' => $app_user->id,
                        'reset_code' => random_int(1000, 9999)
                    ]);

                    if ($status == 1 || $status == 3) {
                        $user = Doctor::where('app_user_id', $app_user->id)->first();
                        $phone_number = $user->Contact_Number;
                    } elseif ($status == 2) {
                        $user = Patient::where('app_user_id', $app_user->id)->first();
                        $phone_number = $user->Contact_Number;
                    }
                }
            }

            $sms_api = 'http://www.etracker.cc/bulksms/mesapi.aspx?user=EZCare&pass=EZ2care@123&type=0&to=95' . $phone_number . '&from=' . urlencode('EZ Care MM') . '&text=' . urlencode($reset_code->reset_code . ' is your OTP Code') . '&servID=MES01';

            $ch = curl_init($sms_api);

            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);

            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            return response()->json([
                'status' => 'success',
                'error_code' => 0,
                'message' => 'A reset SMS Code has been sent to your phone number.'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'error_code' => 1,
                'case' => 'Something went wrong in this API' . $exception->getMessage()
            ], 422);
        }
    }

    public function postPasswordCode(Request $request)
    {
        $get_code = $request->input('code');

        $password_reset_code = PasswordResetCode::where('reset_code', $get_code)->first();
        if (!$password_reset_code) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Code does not exist',
                'error_code' => 1
            ], 422);
        } else {
            $code_status = $password_reset_code->status;
            if ($code_status == 1) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Code already used',
                    'error_code' => 1
                ], 422);
            } else {
                $password_reset_code->status = 1;
                $password_reset_code->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Now You can reset new password',
                    'app_user_id' => $password_reset_code->app_user_id,
                    'error_code' => 0
                ]);
            }
        }
    }

    public function resetPassword(Request $request)
    {
        $app_user_id = $request->input('app_user_id');
        $password = $request->input('new_password');

        $app_user = AppUser::find($app_user_id);

        if (!$app_user) {
            return response()->json([
                'status' => 'fail',
                'message' => 'User does not exist',
                'error_code' => 1
            ], 422);
        } else {
            if ($password) {
                $app_user->update([
                    'password' => Hash::make($password)
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Now You can sign in with new password',
                    'error_code' => 0
                ]);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Field is required',
                    'error_code' => 1
                ], 422);
            }
        }
    }
}

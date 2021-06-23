<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\DoctorCertificateFile;
use App\DoctorProfilePicture;
use App\DoctorSamaFileOrNrcFile;
use App\Http\Controllers\Controller;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorProfileController extends Controller
{
    //    public function __construct()
    //    {
    //        $this->middleware('guest')->except('logout');
    //        $this->middleware('guest:doctor-api')->except('logout');
    //        $this->middleware('guest:doctor')->except('logout');
    //    }

    public function register(Request $request)
    {
        //        dd($request->all());
        //        if (!$validatedData){
        //            return response()->json($validatedData->messages(), 422);
        //        }
        //            $validatedData['password'] = bcrypt($request->password);

        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);
        $doctor_status = $app_user->doctor_status;

        if ($doctor_status == 0) {
            $doctor_profile = Doctor::where('app_user_id', '=', $app_user->id)->first();

            if (!$doctor_profile) {
                $request->validate([

                    'Name' => 'required',

                    'sama_number' => 'required',

                    'Qualifications' => 'required',

                    'specialization_id' => 'required',

                    'Contact_Number' => 'required',

                    'available_time' => 'required',

                    'Email' => 'required|email',

                    'certificate_file' => 'required',

                    'SaMa_or_NRC' => 'required',

                ]);

                $name = $request->input('Name');
                $sama_number = $request->input('sama_number');
                $qualification = $request->input('Qualifications');
                $specialization_id = $request->input('specialization_id');
                $phone = $request->input('Contact_Number');
                $available_time = $request->input('available_time');
                $email = $request->input('Email');
                $other_option = $request->input('other_option');
                $hide_my_info = $request->has('hide_my_info');

                $specialization = Specialization::where('id', $specialization_id)->first();

                $doctor = Doctor::create([
                    'Name' => $name,
                    'sama_number' => $sama_number,
                    'Qualifications' => $qualification,
                    'specialization' => $specialization->name,
                    'Contact_Number' => $phone,
                    'available_time' => $available_time,
                    'Email' => $email,
                    'other_option' => $other_option,
                    'app_user_id' => $app_user->id,
                    'hide_my_info' => $hide_my_info
                ]);

                $app_user->doctor_status = 3;
                $app_user->save();

                if ($request->hasFile('certificate_file')) {
                    $certificate_files = $request->file('certificate_file');
                    foreach ($certificate_files as $certificate_file) {
                        $file_name = $certificate_file->getClientOriginalName();
                        $file = $certificate_file->store('public/doctor_certificate');

                        DoctorCertificateFile::create([
                            'doctor_id' => $doctor->id,
                            'name' => $file_name,
                            'certificate_file' => $file
                        ]);
                    }
                }

                if ($request->hasFile('profile_image')) {
                    $profile_picture = $request->file('profile_image');
                    $file = $profile_picture->store('public/doctor_profile_picture');

                    DoctorProfilePicture::create([
                        'doctor_id' => $doctor->id,
                        'profile_picture' => $file
                    ]);
                }

                if ($request->hasFile('SaMa_or_NRC')) {
                    $SaMa_or_NRC_files = $request->file('SaMa_or_NRC');
                    foreach ($SaMa_or_NRC_files as $SaMa_or_NRC_file) {
                        $file = $SaMa_or_NRC_file->store('public/SaMa_or_NRC');

                        DoctorSamaFileOrNrcFile::create([
                            'doctor_id' => $doctor->id,
                            'SaMa_or_NRC' => $file
                        ]);
                    }
                }

                //        $accessToken = $doctor->createToken('authToken')->accessToken;

                return response()->json(['error_code' => '0', 'doctor' => $doctor, 'message' => 'Successfully registered']);
            } else {
                return response()->json(['error_code' => '1', 'message' => 'Doctor already exist'], 422);
            }
        } elseif ($doctor_status == 1) {
            return response()->json(['error_code' => '1', 'message' => 'Doctor already exist'], 422);
        } elseif ($doctor_status == 2) {
            return response()->json(['error_code' => '1', 'message' => "You can't create doctor, Patient already exist"], 422);
        } else {
            return response()->json(['error_code' => '1', 'message' => "Doctor already created, Please wait for admin approval"], 422);
        }
    }

    //    public function login(Request $request)
    //    {
    //        $loginData = $request->validate([
    //            'Email' => 'email|required',
    //            'password' => 'required'
    //        ]);
    //
    //
    //        if (Auth::guard('doctor')->attempt($loginData)) {
    //            $accessToken = Auth::guard('doctor')->user()->createToken('authToken')->accessToken;
    //
    //            return response()->json(['error_code' => '0', 'doctor' => Auth::guard('doctor')->user(), 'access_token' => $accessToken, 'message' => 'Login successfully']);
    //        }
    //        else{
    //            return response()->json(['error_code' => '1','message' => 'Invalid Credentials'],  403);
    //        }
    //
    //
    //    }
}

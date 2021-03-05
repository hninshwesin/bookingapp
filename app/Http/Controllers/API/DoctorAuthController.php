<?php

namespace App\Http\Controllers\API;

use App\Doctor;
use App\DoctorCertificateFile;
use App\DoctorProfilePicture;
use App\DoctorSamaFileOrNrcFile;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:doctor-api')->except('logout');
        $this->middleware('guest:doctor')->except('logout');
    }

    public function register(Request $request)
    {
//        dd($request->all());
        $validatedData = $request->validate([
            'Name' => 'required|max:55',
            'sama_number' => 'required',
            'Qualifications' => 'required',
            'Contact_Number' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'Email' => 'email|required|unique:doctors',
            'password' => 'required|confirmed',
            'other_option' => 'required',
            'certificate_file' => 'required',
            'profile_image' => 'required',
            'SaMa_or_NRC' => 'required',
        ]);

//        if (!$validatedData){
//            return response()->json($validatedData->messages(), 422);
//        }

            $validatedData['password'] = bcrypt($request->password);

//            $validatedData['start_time'] = Carbon::parse($request->start_time)->format('g:i A');
//            $validatedData['end_time'] = Carbon::parse($request->end_time)->format('g:i A');

            $doctor = Doctor::create($validatedData);

        if ($request->hasFile('certificate_file')){
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

        if ($request->hasFile('profile_image')){
            $profile_pictures = $request->file('profile_image');
            foreach ($profile_pictures as $profile_picture) {
                $file = $profile_picture->store('public/doctor_profile_picture');

                DoctorProfilePicture::create([
                    'doctor_id' => $doctor->id,
                    'profile_picture' => $file
                ]);
            }
        }

        if ($request->hasFile('SaMa_or_NRC')){
            $SaMa_or_NRC_files = $request->file('SaMa_or_NRC');
            foreach ($SaMa_or_NRC_files as $SaMa_or_NRC_file) {
                $file = $SaMa_or_NRC_file->store('public/SaMa_or_NRC');

                DoctorSamaFileOrNrcFile::create([
                    'doctor_id' => $doctor->id,
                    'SaMa_or_NRC' => $file
                ]);
            }
        }

        $accessToken = $doctor->createToken('authToken')->accessToken;

        return response()->json(['error_code' => '0', 'doctor' => $doctor, 'access_token' => $accessToken, 'message' => 'Register successfully']);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'Email' => 'email|required',
            'password' => 'required'
        ]);


        if (Auth::guard('doctor')->attempt($loginData)) {
            $accessToken = Auth::guard('doctor')->user()->createToken('authToken')->accessToken;

            return response()->json(['error_code' => '0', 'doctor' => Auth::guard('doctor')->user(), 'access_token' => $accessToken, 'message' => 'Login successfully']);
        }
        else{
            return response()->json(['error_code' => '1','message' => 'Invalid Credentials'],  403);
        }


    }
}

<?php

namespace App\Http\Controllers\API;

use App\Doctor;
use App\DoctorCertificateFile;
use App\DoctorProfilePicture;
use App\DoctorSamaFileOrNrcFile;
use App\Http\Controllers\Controller;
use App\Specialization;
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
//        if (!$validatedData){
//            return response()->json($validatedData->messages(), 422);
//        }
//            $validatedData['password'] = bcrypt($request->password);

        $request->validate([

            'Name' => 'required',

            'sama_number' => 'required',

            'Qualifications' => 'required',

            'specialization_id' => 'required',

            'Contact_Number' => 'required',

            'start_date' => 'required',

            'end_date' => 'required',

            'start_time' => 'required',

            'end_time' => 'required',

            'Email' => 'required|email',

            'password' => 'required',

            'certificate_file' => 'required',

            'profile_image' => 'required',

            'SaMa_or_NRC' => 'required',

        ]);

        $name = $request->input('Name');
        $sama_number = $request->input('sama_number');
        $qualification = $request->input('Qualifications');
        $specialization_id = $request->input('specialization_id');
        $phone = $request->input('Contact_Number');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $email = $request->input('Email');
        $password = bcrypt($request->input('password'));
        $other_option = $request->input('other_option');

        $specialization = Specialization::where('id', $specialization_id)->first();

        $doctor = Doctor::create([
            'Name' => $name,
            'sama_number' => $sama_number,
            'Qualifications' => $qualification,
            'specialization' => $specialization->name,
            'Contact_Number' => $phone,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'Email' => $email,
            'password' => $password,
            'other_option' => $other_option,
        ]);

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

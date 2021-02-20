<?php

namespace App\Http\Controllers\API;

use App\Doctor;
use App\DoctorCertificateFile;
use App\Http\Controllers\Controller;
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
            'Qualifications' => 'required',
            'Contact_Number' => 'required',
            'Email' => 'email|required|unique:doctors',
            'password' => 'required|confirmed',
            'certificate_file' => 'required',
        ]);

//        if (!$validatedData){
//            return response()->json($validatedData->messages(), 422);
//        }

            $validatedData['password'] = bcrypt($request->password);

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
            return response()->json(['error_code' => '1','message' => 'Invalid Credentials', 'status' => '422']);
        }


    }
}

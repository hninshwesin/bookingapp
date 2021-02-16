<?php

namespace App\Http\Controllers\API;

use App\Doctor;
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
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $doctor = Doctor::create($validatedData);

        $accessToken = $doctor->createToken('authToken')->accessToken;

        return response([ 'doctor' => $doctor, 'access_token' => $accessToken, 'message' => 'Register successfully']);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'Email' => 'email|required',
            'password' => 'required'
        ]);

        if (Auth::guard('doctor')->attempt($loginData)) {
            $accessToken = Auth::guard('doctor')->user()->createToken('authToken')->accessToken;

            return response(['doctor' => Auth::guard('doctor')->user(), 'access_token' => $accessToken, 'message' => 'Login successfully']);
        }
        else{
            return response(['message' => 'Invalid Credentials']);
        }


    }
}

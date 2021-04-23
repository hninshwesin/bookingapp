<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppUserController extends Controller
{
    public function register(Request $request)
    {
//        dd($request->all());
//        if (!$validatedData){
//            return response()->json($validatedData->messages(), 422);
//        }
//            $validatedData['password'] = bcrypt($request->password);

        $request->validate([

            'name' => 'required',

            'password' => 'required',

        ]);

        $name = $request->input('name');
        $password = bcrypt($request->input('password'));

        $user = AppUser::create([
            'name' => $name,
            'password' => $password,
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['error_code' => '0', 'user' => $user, 'access_token' => $accessToken, 'message' => 'Register successfully']);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);


        if (Auth::guard('user')->attempt($loginData)) {
            $accessToken = Auth::guard('user')->user()->createToken('authToken')->accessToken;

            return response()->json(['error_code' => '0', 'app_user' => Auth::guard('user')->user(), 'access_token' => $accessToken, 'message' => 'Login successfully']);
        }
        else{
            return response()->json(['error_code' => '1','message' => 'Invalid Credentials'],  403);
        }


    }
}

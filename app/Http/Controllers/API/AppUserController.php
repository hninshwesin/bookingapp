<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Http\Resources\AppUserResourceCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppUserController extends Controller
{
    public function register(Request $request)
    {
        //        dd($request->all());
        //        if (!$validatedData){
        //            return response()->json($validatedData->messages(), 422);
        //        }
        //            $validatedData['password'] = bcrypt($request->password);

        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:app_users',

            'password' => 'required',
        ]);

        $name = $request->input('name');
        $password = bcrypt($request->input('password'));

        if ($validator->fails()) {
            return response()->json(['error_code' => '1', 'message' => 'The name has already been taken'],  422);
        } else {
            $user = AppUser::create([
                'name' => $name,
                'password' => $password,
            ]);

            $accessToken = $user->createToken('authToken')->accessToken;

            return response()->json(['error_code' => '0', 'user' => $user, 'access_token' => $accessToken, 'message' => 'Register successfully'], 200);
        }
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
        } else {
            return response()->json(['error_code' => '1', 'message' => 'Invalid Credentials'],  403);
        }
    }

    public function all_users()
    {
        $app_users = AppUser::where('doctor_status', 2)->get();
        return new AppUserResourceCollection($app_users);
    }
}

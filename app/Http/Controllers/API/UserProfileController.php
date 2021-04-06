<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Http\Controllers\Controller;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function register(Request $request)
    {
//        dd($request->all());

        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        $request->validate([

            'full_name' => 'required',

            'date_of_birth' => 'required',

            'sex' => 'required',

            'address' => 'required',

            'phone_number' => 'required',

            'email' => 'required|email',

        ]);

        $name = $request->input('full_name');
        $date_of_birth = $request->input('date_of_birth');
        $sex = $request->input('sex');
        $address = $request->input('address');
        $phone = $request->input('phone_number');
        $email = $request->input('email');
        $image = $request->hasFile('profile_image');

        if ($image) {
            $profile_picture = $request->file('profile_image');
            $file = $profile_picture->store('public/user_profile_picture');

            $user_profile = UserProfile::create([
                'app_user_id' => $app_user->id,
                'name' => $name,
                'date_of_birth' => $date_of_birth,
                'sex' => $sex,
                'address' => $address,
                'phone_number' => $phone,
                'email' => $email,
                'profile_image' => $file
            ]);

            $app_user->doctor_status = 0;
            $app_user->save();

            return response()->json(['error_code' => '0', 'user_profile' => $user_profile, 'message' => 'Successfully registered']);
        } else {
            $user_profile = UserProfile::create([
                'app_user_id' => $app_user->id,
                'name' => $name,
                'date_of_birth' => $date_of_birth,
                'sex' => $sex,
                'address' => $address,
                'phone_number' => $phone,
                'email' => $email,
                'profile_image' => 'null'
            ]);

            $app_user->doctor_status = 0;
            $app_user->save();

            return response()->json(['error_code' => '0', 'user_profile' => $user_profile, 'message' => 'Successfully registered']);
        }
    }
}

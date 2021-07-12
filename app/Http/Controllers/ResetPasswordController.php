<?php

namespace App\Http\Controllers;

use App\AppUser;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function resetform(Request $request)
    {
        $app_user_id = $request->input('app_user_id');

        $app_user = AppUser::find($app_user_id);

        return view('doctors.resetpassword', compact('app_user'));
    }

    public function resetpassword(Request $request)
    {
        $app_user_id = $request->input('app_user_id');
        $app_user_pw = bcrypt($request->input('password'));

        $app_user = AppUser::find($app_user_id);
        $app_user->password = $app_user_pw;
        $app_user->save();

        return redirect()->route('doctor.index')->with('success', 'Password Reset successfully');
    }
}

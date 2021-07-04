<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Http\Controllers\Controller;
use App\MessageNotificationDeviceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageNotificationDeviceTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::guard('user-api')->user();
        // $app_user = AppUser::find($user->id);

        $device_token = $request->input('device_token');
        $token = MessageNotificationDeviceToken::where('device_token', $device_token)->first();
        dd($token);
        if (!$token) {
            MessageNotificationDeviceToken::create([
                'app_user_id' => $user->id,
                'device_token' => $device_token
            ]);
        } else {
            if ($token->app_user_id != $user->id) {
                $token->delete();

                MessageNotificationDeviceToken::create([
                    'app_user_id' => $user->id,
                    'device_token' => $device_token
                ]);
            } else {
                return response()->json(['error_code' => '0', 'message' => 'token already have'], 200);
            }
        }

        return response()->json(['error_code' => '0', 'message' => 'token sent successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\MessageNotificationDeviceToken;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Request;

class AppUserController extends Controller
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
        //
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

    public function app_user_list()
    {
        $app_users = AppUser::get();

        return view('app_users.noti')->with(['app_users' => $app_users]);
    }

    public function app_user_noti(Request $request)
    {
        $heading = $request->input('heading');
        $body = $request->input('body');

        $devicetokens = MessageNotificationDeviceToken::whereIn('app_user_id', function ($q) {
            $q->select('id')->from('app_users');
        })->pluck('device_token');

        $push = new PushNotification('fcm');
        $request = $push->setMessage([
            'notification' => [
                'title' => $heading,
                'body' => $body,
            ]
        ])
            ->setDevicesToken($devicetokens->toArray())
            ->send()
            ->getFeedback();

        return redirect()->route('app_user_list')->with('success', 'Notification sent successfully');
    }
}

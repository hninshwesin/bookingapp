<?php

namespace App\Http\Controllers\API;

use App\Ambulance;
use App\AppUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\AmbulanceResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ambulance = Ambulance::where('pending_status', '=', '1')->get();
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $app_user_id = $app_user->id;
        $ambulance = Ambulance::with(['app_users' => function ($query) use ($app_user_id) {
            $query->where('app_user_id', '=', $app_user_id)->get();
        }])->where('pending_status', '=', '1')->get();

        return new AmbulanceResourceCollection($ambulance);
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
        $app_user = AppUser::where('id', [$user->id])->first();

        $request->validate([

            'name' => 'required',

            'charity_service' => 'required',

            'address' => 'required',

            'contact_number' => 'required',

            'email' => 'required|email',

            'available_time' => 'required',

        ]);

        $name = $request->input('name');
        $charity_service = $request->input('charity_service');
        $address = $request->input('address');
        $contact = $request->input('contact_number');
        $email = $request->input('email');
        $available_time = $request->input('available_time');
        $comment = $request->input('comment');
        $image = $request->hasFile('profile_image');

        $count = strlen($contact);
        if ($count >= 10 && Str::startsWith($contact, "959")) {
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/ambulances');

                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => $file
                ]);

                return response()->json(['error_code' => '0', 'ambulance' => $ambulance, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            } else {
                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => 'null'
                ]);

                return response()->json(['error_code' => '0', 'ambulance' => $ambulance, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            }
        } elseif ($count >= 9 && Str::startsWith($contact, "09")) {
            $contact_number = Str::replaceFirst('09', '959', $contact);
            // dd(Str::after($contact, "09"));
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/ambulances');

                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => $file
                ]);

                return response()->json(['error_code' => '0', 'ambulance' => $ambulance, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            } else {
                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => 'null'
                ]);

                return response()->json(['error_code' => '0', 'ambulance' => $ambulance, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            }
        } else {
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/ambulances');

                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => $file
                ]);

                return response()->json(['error_code' => '0', 'ambulance' => $ambulance, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            } else {
                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => 'null'
                ]);

                return response()->json(['error_code' => '0', 'ambulance' => $ambulance, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            }
        }
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

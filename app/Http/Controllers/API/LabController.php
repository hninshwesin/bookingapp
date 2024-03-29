<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\LabResourceCollection;
use App\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lab = Lab::where('pending_status', '=', '1')->get();
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();
        $app_user_id = $app_user->id;
        $lab = Lab::with(['app_users' => function ($query) use ($app_user_id) {
            $query->where('app_user_id', '=', $app_user_id)->get();
        }])->where('pending_status', '=', '1')->get();

        return new LabResourceCollection($lab);
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
        $region_id = $request->input('region_id');
        $township_id = $request->input('township_id');

        if (Str::startsWith($contact, "95")) {
            $contact_number = Str::replaceFirst('95', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/labs');

                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => $file,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return response()->json(['error_code' => '0', 'Lab' => $lab, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            } else {
                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => 'null',
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return response()->json(['error_code' => '0', 'Lab' => $lab, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            }
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/labs');

                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => $file,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return response()->json(['error_code' => '0', 'Lab' => $lab, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            } else {
                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => $charity_service,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => $app_user->id,
                    'profile_image' => 'null',
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return response()->json(['error_code' => '0', 'Lab' => $lab, 'message' => 'Successfully registered, Please wait for admin approve'], 200);
            }
        } else {
            return response()->json(['error_code' => '1', 'message' => 'Please start with 95 or 0 for Phone number field'], 422);
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

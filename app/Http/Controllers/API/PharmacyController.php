<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\PharmacyResourceCollection;
use App\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacy = Pharmacy::all();

        return new PharmacyResourceCollection($pharmacy);
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

        $name = $request->input('name');
        $charity_service = $request->input('charity_service');
        $address = $request->input('address');
        $contact_number = $request->input('contact_number');
        $email = $request->input('email');
        $available_time = $request->input('available_time');
        $comment = $request->input('comment');
        $image = $request->hasFile('profile_image');

        if ($image){
            $profile_picture = $request->file('profile_image');
            $file = $profile_picture->store('public/charity_image/pharmacies');

            $pharmacy = Pharmacy::create([
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

            return response()->json(['error_code' => '0','pharmacy' => $pharmacy, 'message' => 'Successfully registered'], 200);

        }else {
            $pharmacy = Pharmacy::create([
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

            return response()->json(['error_code' => '0','pharmacy' => $pharmacy, 'message' => 'Successfully registered'], 200);
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
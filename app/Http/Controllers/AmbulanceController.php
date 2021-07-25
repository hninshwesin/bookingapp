<?php

namespace App\Http\Controllers;

use App\Ambulance;
use App\Region;
use App\Township;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambulances = Ambulance::all();

        return view('ambulances.index', compact('ambulances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::orderBy('sort_order', 'ASC')->get();
        $townships = Township::all();

        return view('ambulances.create', compact('regions', 'townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'address' => 'required',

            'contact_number' => 'required',

            'email' => 'required|email',

            'available_time' => 'required',

        ]);

        $name = $request->input('name');
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
                $file = $profile_picture->store('public/charity_image/ambulances');

                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => 'ambulance',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => $file,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info created successfully.');
            } else {
                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => 'ambulance',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => 'null',
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info created successfully.');
            }
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/ambulances');

                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => 'ambulance',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => $file,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info created successfully.');
            } else {
                $ambulance = Ambulance::create([
                    'name' => $name,
                    'charity_service' => 'ambulance',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => 'null',
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info created successfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Ambulance $ambulance
     * @return \Illuminate\Http\Response
     */
    public function show(Ambulance $ambulance)
    {
        return view('ambulances.show', compact('ambulance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ambulance $ambulance
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambulance $ambulance)
    {
        $regions = Region::orderBy('sort_order', 'ASC')->get();
        $townships = Township::all();

        return view('ambulances.edit', compact('ambulance', 'regions', 'townships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Ambulance $ambulance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambulance $ambulance)
    {
        $request->validate([

            'name' => 'required',

            'address' => 'required',

            'contact_number' => 'required',

            'email' => 'required|email',

            'available_time' => 'required',

        ]);

        $name = $request->input('name');
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
                $file = $profile_picture->store('public/charity_image/ambulances');

                if (Storage::exists($ambulance->profile_image)) {
                    Storage::delete($ambulance->profile_image);
                }

                $ambulance->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'profile_image' => $file,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info updated successfully.');
            } else {
                $ambulance->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info updated successfully.');
            }
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/ambulances');

                if (Storage::exists($ambulance->profile_image)) {
                    Storage::delete($ambulance->profile_image);
                }

                $ambulance->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'profile_image' => $file,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info updated successfully.');
            } else {
                $ambulance->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info updated successfully.');
            }
        } elseif (Str::startsWith($contact, "+95")) {
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/ambulances');

                if (Storage::exists($ambulance->profile_image)) {
                    Storage::delete($ambulance->profile_image);
                }

                $ambulance->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'profile_image' => $file,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info updated successfully.');
            } else {
                $ambulance->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('ambulance.index')->with('success', 'Ambulance Info updated successfully.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ambulance $ambulance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambulance $ambulance)
    {
        $ambulance->delete();

        return redirect()->route('ambulance.index')->with('success', 'Ambulance deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use App\Region;
use App\Township;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacies = Pharmacy::all();

        return view('pharmacies.index', compact('pharmacies'));
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

        return view('pharmacies.create', compact('regions', 'townships'));
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
                $file = $profile_picture->store('public/charity_image/pharmacies');

                $pharmacy = Pharmacy::create([
                    'name' => $name,
                    'charity_service' => 'pharmacy',
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

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info created successfully.');
            } else {
                $pharmacy = Pharmacy::create([
                    'name' => $name,
                    'charity_service' => 'pharmacy',
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

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info created successfully.');
            }
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/pharmacies');

                $pharmacy = Pharmacy::create([
                    'name' => $name,
                    'charity_service' => 'pharmacy',
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

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info created successfully.');
            } else {
                $pharmacy = Pharmacy::create([
                    'name' => $name,
                    'charity_service' => 'pharmacy',
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

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info created successfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmacy $pharmacy)
    {
        return view('pharmacies.show', compact('pharmacy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        $regions = Region::orderBy('sort_order', 'ASC')->get();
        $townships = Township::all();

        return view('pharmacies.edit', compact('pharmacy', 'regions', 'townships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pharmacy $pharmacy)
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
                $file = $profile_picture->store('public/charity_image/pharmacies');

                if (Storage::exists($pharmacy->profile_image)) {
                    Storage::delete($pharmacy->profile_image);
                }

                $pharmacy->update([
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

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
            } else {
                $pharmacy->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
            }
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/pharmacies');

                if (Storage::exists($pharmacy->profile_image)) {
                    Storage::delete($pharmacy->profile_image);
                }

                $pharmacy->update([
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

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
            } else {
                $pharmacy->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
            }
        } elseif (Str::startsWith($contact, "+95")) {
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/pharmacies');

                if (Storage::exists($pharmacy->profile_image)) {
                    Storage::delete($pharmacy->profile_image);
                }

                $pharmacy->update([
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

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
            } else {
                $pharmacy->update([
                    'name' => $name,
                    'address' => $address,
                    'contact_number' => $contact,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'region_id' => $region_id,
                    'township_id' => $township_id
                ]);

                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pharmacy $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        $pharmacy->delete();

        return redirect()->route('pharmacy.index')->with('success', 'Pharmacy deleted successfully');
    }
}

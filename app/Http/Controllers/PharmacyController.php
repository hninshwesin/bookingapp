<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('pharmacies.create');
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
                    'profile_image' => $file
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
                    'profile_image' => 'null'
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
                    'profile_image' => $file
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
                    'profile_image' => 'null'
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
        return view('pharmacies.edit', compact('pharmacy'));
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

        if (Str::startsWith($contact, "95")) {
            $contact_number = Str::replaceFirst('95', '+95', $contact);
            $pharmacy->update([
                'name' => $name,
                'address' => $address,
                'contact_number' => $contact_number,
                'email' => $email,
                'available_time' => $available_time,
                'comment' => $comment,
            ]);

            return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            $pharmacy->update([
                'name' => $name,
                'address' => $address,
                'contact_number' => $contact_number,
                'email' => $email,
                'available_time' => $available_time,
                'comment' => $comment,
            ]);

            return redirect()->route('pharmacy.index')->with('success', 'Pharmacy Info updated successfully.');
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

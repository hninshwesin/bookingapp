<?php

namespace App\Http\Controllers;

use App\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = Clinic::all();

        return view('clinics.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinics.create');
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
                $file = $profile_picture->store('public/charity_image/clinics');

                $clinic = Clinic::create([
                    'name' => $name,
                    'charity_service' => 'clinic',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => $file
                ]);

                return redirect()->route('clinic.index')->with('success', 'Clinic Info created successfully.');
            } else {
                $clinic = Clinic::create([
                    'name' => $name,
                    'charity_service' => 'clinic',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => 'null'
                ]);

                return redirect()->route('clinic.index')->with('success', 'Clinic Info created successfully.');
            }
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/clinics');

                $clinic = Clinic::create([
                    'name' => $name,
                    'charity_service' => 'clinic',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => $file
                ]);

                return redirect()->route('clinic.index')->with('success', 'Clinic Info created successfully.');
            } else {
                $clinic = Clinic::create([
                    'name' => $name,
                    'charity_service' => 'clinic',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => 'null'
                ]);

                return redirect()->route('clinic.index')->with('success', 'Clinic Info created successfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        return view('clinics.show', compact('clinic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        return view('clinics.edit', compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
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
            $clinic->update([
                'name' => $name,
                'address' => $address,
                'contact_number' => $contact_number,
                'email' => $email,
                'available_time' => $available_time,
                'comment' => $comment,
            ]);

            return redirect()->route('clinic.index')->with('success', 'Clinic Info updated successfully.');
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            $clinic->update([
                'name' => $name,
                'address' => $address,
                'contact_number' => $contact_number,
                'email' => $email,
                'available_time' => $available_time,
                'comment' => $comment,
            ]);

            return redirect()->route('clinic.index')->with('success', 'Clinic Info updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return redirect()->route('clinic.index')->with('success', 'Clinic deleted successfully');
    }
}

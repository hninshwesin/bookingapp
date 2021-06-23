<?php

namespace App\Http\Controllers;

use App\Lab;
use Illuminate\Http\Request;
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
        $labs = Lab::all();

        return view('labs.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labs.create');
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
                $file = $profile_picture->store('public/charity_image/labs');

                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => 'lab',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => $file
                ]);

                return redirect()->route('lab.index')->with('success', 'Lab Info created successfully.');
            } else {
                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => 'lab',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => 'null'
                ]);

                return redirect()->route('lab.index')->with('success', 'Lab Info created successfully.');
            }
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            if ($image) {
                $profile_picture = $request->file('profile_image');
                $file = $profile_picture->store('public/charity_image/labs');

                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => 'lab',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => $file
                ]);

                return redirect()->route('lab.index')->with('success', 'Lab Info created successfully.');
            } else {
                $lab = Lab::create([
                    'name' => $name,
                    'charity_service' => 'lab',
                    'address' => $address,
                    'contact_number' => $contact_number,
                    'email' => $email,
                    'available_time' => $available_time,
                    'comment' => $comment,
                    'app_user_id' => 0,
                    'profile_image' => 'null'
                ]);

                return redirect()->route('lab.index')->with('success', 'Lab Info created successfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        return view('labs.show', compact('lab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        return view('labs.edit', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
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
            $lab->update([
                'name' => $name,
                'address' => $address,
                'contact_number' => $contact_number,
                'email' => $email,
                'available_time' => $available_time,
                'comment' => $comment,
            ]);

            return redirect()->route('lab.index')->with('success', 'Lab Info updated successfully.');
        } elseif (Str::startsWith($contact, "0")) {
            $contact_number = Str::replaceFirst('0', '+95', $contact);
            $lab->update([
                'name' => $name,
                'address' => $address,
                'contact_number' => $contact_number,
                'email' => $email,
                'available_time' => $available_time,
                'comment' => $comment,
            ]);

            return redirect()->route('lab.index')->with('success', 'Lab Info updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lab $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        $lab->delete();

        return redirect()->route('lab.index')->with('success', 'Lab deleted successfully');
    }
}

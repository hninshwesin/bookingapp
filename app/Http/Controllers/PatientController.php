<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
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

            'Name' => 'required',

            'Age' => 'required',

            'Gender' => 'required',

            'Address' => 'required',

            'Contact_Number' => 'required',

        ]);

        $name = $request->input('Name');
        $age = $request->input('Age');
        $gender = $request->input('Gender');
        $address = $request->input('Address');
        $contact = $request->input('Contact_Number');

        Patient::create([
            'Name' => $name,
            'Age' => $age,
            'Gender' => $gender,
            'Address' => $address,
            'Contact_Number' => $contact,
            'wallet' => 0
        ]);

        return redirect()->route('patient.index')->with('success', 'Patient Profile created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validate([

            'Name' => 'required',

            'Age' => 'required',

            'Gender' => 'required',

            'Address' => 'required',

            'Contact_Number' => 'required',

        ]);

        $patient->update($validatedData);

        return redirect()->route('patient.index')->with('success', 'Patient Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patient.index')->with('success', 'Profile deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\DoctorCertificateFile;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with(['DoctorCertificateFile'])->get();

        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//                dd($request->all());

        $request->validate([

            'Name' => 'required',

            'Qualifications' => 'required',

            'Contact_Number' => 'required',

            'Email' => 'required|email',

            'password' => 'required',

            'file_name' => 'required',

            'certificate_file' => 'required',

//            'certificate_file' => 'required|mimes:jpeg,png,jpg,doc,docx,zip,pdf',

        ]);

        $name = $request->input('Name');
        $qualification = $request->input('Qualifications');
        $phone = $request->input('Contact_Number');
        $email = $request->input('Email');
        $password = bcrypt($request->input('password'));

        $doctor = Doctor::create([
            'Name' => $name,
            'Qualifications' => $qualification,
            'Contact_Number' => $phone,
            'Email' => $email,
            'password' => $password,
        ]);

        if ($request->hasFile('certificate_file')){
            $file_name = $request->input('file_name');
            $certificate_files = $request->file('certificate_file');
            foreach ($certificate_files as $certificate_file) {
                $file = $certificate_file->store('public/doctor_certificate');
//                $image_name = $image->getClientOriginalName();
//                $destinationPath = public_path('images');
//                $image_file = $image->move($destinationPath, $image_name);

                DoctorCertificateFile::create([
                    'doctor_id' => $doctor->id,
                    'name' => $file_name,
                    'certificate_file' => $file
                ]);
            }
        }

        return redirect()->route('doctor.index')->with('success','DoctorResource Profile created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validatedData = $request->validate([

            'Name' => 'required',

            'Qualifications' => 'required',

            'Contact_Number' => 'required',

            'Email' => 'required|email',

//            'file_name' => 'required',

//            'certificate_file' => 'required|mimes:jpeg,png,jpg,doc,docx,zip,pdf'

        ]);

        $doctor->update($validatedData);

        return redirect()->route('doctor.index')->with('success','DoctorResource Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctor.index')->with('success','Profile deleted successfully');
    }
}

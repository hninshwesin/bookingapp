<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\DoctorCertificateFile;
use App\DoctorProfilePicture;
use App\DoctorSamaFileOrNrcFile;
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
        $doctors = Doctor::with(['DoctorCertificateFile', 'DoctorProfilePicture', 'DoctorSamaFileOrNrcFile'])->get();

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

            'sama_number' => 'required',

            'Qualifications' => 'required',

            'Contact_Number' => 'required',

            'start_date' => 'required',

            'end_date' => 'required',

            'start_time' => 'required',

            'end_time' => 'required',

            'Email' => 'required|email',

            'password' => 'required',

            'certificate_file' => 'required',

            'profile_image' => 'required',

            'SaMa_or_NRC' => 'required',

//            'certificate_file' => 'required|mimes:jpeg,png,jpg,doc,docx,zip,pdf',

        ]);

        $name = $request->input('Name');
        $sama_number = $request->input('sama_number');
        $qualification = $request->input('Qualifications');
        $phone = $request->input('Contact_Number');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $email = $request->input('Email');
        $password = bcrypt($request->input('password'));
        $other_option = $request->input('other_option');

        $doctor = Doctor::create([
            'Name' => $name,
            'sama_number' => $sama_number,
            'Qualifications' => $qualification,
            'Contact_Number' => $phone,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'Email' => $email,
            'password' => $password,
            'other_option' => $other_option,
        ]);

        if ($request->hasFile('certificate_file')){
            $certificate_files = $request->file('certificate_file');
            foreach ($certificate_files as $certificate_file) {
                $file_name = $certificate_file->getClientOriginalName();
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

        if ($request->hasFile('profile_image')){
            $profile_pictures = $request->file('profile_image');
            foreach ($profile_pictures as $profile_picture) {
                $file = $profile_picture->store('public/doctor_profile_picture');

                DoctorProfilePicture::create([
                    'doctor_id' => $doctor->id,
                    'profile_picture' => $file
                ]);
            }
        }

        if ($request->hasFile('SaMa_or_NRC')){
            $SaMa_or_NRC_files = $request->file('SaMa_or_NRC');
            foreach ($SaMa_or_NRC_files as $SaMa_or_NRC_file) {
                $file = $SaMa_or_NRC_file->store('public/SaMa_or_NRC');

                DoctorSamaFileOrNrcFile::create([
                    'doctor_id' => $doctor->id,
                    'SaMa_or_NRC' => $file
                ]);
            }
        }

        return redirect()->route('doctor.index')->with('success','Doctor Profile created successfully.');
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

            'sama_number' => 'required',

            'Qualifications' => 'required',

            'Contact_Number' => 'required',

            'start_date' => 'required',

            'end_date' => 'required',

            'start_time' => 'required',

            'end_time' => 'required',

            'Email' => 'required|email',

//            'file_name' => 'required',

//            'certificate_file' => 'required|mimes:jpeg,png,jpg,doc,docx,zip,pdf'

        ]);

        $doctor->update($validatedData);

        return redirect()->route('doctor.index')->with('success','Doctor Profile updated successfully.');
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

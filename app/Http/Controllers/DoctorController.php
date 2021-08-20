<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\Doctor;
use App\DoctorCertificateFile;
use App\DoctorProfilePicture;
use App\DoctorSamaFileOrNrcFile;
use App\Language;
use App\MessageNotificationDeviceToken;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Edujugon\PushNotification\PushNotification;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with(['DoctorCertificateFile', 'DoctorProfilePicture', 'DoctorSamaFileOrNrcFile'])->where('approve_status', 1)->get();


        return view('doctors.index')->with(['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $specializations = Specialization::all();
        // return view('doctors.create')->with(['specializations' => $specializations]);
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

            'sama_number' => 'required',

            'Qualifications' => 'required',

            'specialization' => 'required',

            'Contact_Number' => 'required',

            'available_time' => 'required',

            'Email' => 'required|email',

            'certificate_file' => 'required',

            'SaMa_or_NRC' => 'required',

            //            'certificate_file' => 'required|mimes:jpeg,png,jpg,doc,docx,zip,pdf',

        ]);

        $name = $request->input('Name');
        $sama_number = $request->input('sama_number');
        $qualification = $request->input('Qualifications');
        $specialization = $request->input('specialization');
        $phone = $request->input('Contact_Number');
        $available_time = $request->input('available_time');
        $email = $request->input('Email');
        $other_option = $request->input('other_option');
        $hide_my_info = $request->has('hide_my_info');

        $doctor = Doctor::create([
            'Name' => $name,
            'sama_number' => $sama_number,
            'Qualifications' => $qualification,
            'specialization' => $specialization,
            'Contact_Number' => $phone,
            'available_time' => $available_time,
            'Email' => $email,
            'other_option' => $other_option,
            'app_user_id' => 0,
            'hide_my_info' => $hide_my_info
        ]);

        //        $user = new AppUser();
        //        $user->doctor_status = 0;
        //        $user->save();

        if ($request->hasFile('certificate_file')) {
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

        if ($request->hasFile('profile_image')) {
            $profile_pictures = $request->file('profile_image');
            foreach ($profile_pictures as $profile_picture) {
                $file = $profile_picture->store('public/doctor_profile_picture');

                DoctorProfilePicture::create([
                    'doctor_id' => $doctor->id,
                    'profile_picture' => $file
                ]);
            }
        }

        if ($request->hasFile('SaMa_or_NRC')) {
            $SaMa_or_NRC_files = $request->file('SaMa_or_NRC');
            foreach ($SaMa_or_NRC_files as $SaMa_or_NRC_file) {
                $file = $SaMa_or_NRC_file->store('public/SaMa_or_NRC');

                DoctorSamaFileOrNrcFile::create([
                    'doctor_id' => $doctor->id,
                    'SaMa_or_NRC' => $file
                ]);
            }
        }

        return redirect()->route('doctor.index')->with('success', 'Doctor Profile created successfully.');
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
        $specializations = Specialization::all();
        $languages = Language::all();
        return view('doctors.edit', compact('doctor', 'specializations', 'languages'));
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
        $request->validate([

            'Name' => 'required',

            'sama_number' => 'required',

            'Qualifications' => 'required',

            'specialization' => 'required',

            'Contact_Number' => 'required',

            'available_time' => 'required',

            'Email' => 'required|email',

            //            'certificate_file' => 'required',
            //
            //            'profile_image' => 'required',
            //
            //            'SaMa_or_NRC' => 'required',

            //            'certificate_file' => 'required|mimes:jpeg,png,jpg,doc,docx,zip,pdf',

        ]);

        $name = $request->input('Name');
        $sama_number = $request->input('sama_number');
        $qualification = $request->input('Qualifications');
        $specialization = $request->input('specialization');
        $phone = $request->input('Contact_Number');
        $available_time = $request->input('available_time');
        $available_language_id = $request->input('available_language_id');
        $email = $request->input('Email');
        $other_option = $request->input('other_option');

        $doctor->update([
            'Name' => $name,
            'sama_number' => $sama_number,
            'Qualifications' => $qualification,
            'specialization' => $specialization,
            'Contact_Number' => $phone,
            'available_time' => $available_time,
            'Email' => $email,
            'other_option' => $other_option
        ]);

        $doctor->languages()->sync($available_language_id);

        // if ($request->hasFile('certificate_file')) {
        //     $certificate_files = $request->file('certificate_file');
        //     foreach ($certificate_files as $certificate_file) {
        //         $file_name = $certificate_file->getClientOriginalName();
        //         $file = $certificate_file->store('public/doctor_certificate');
        //         //                $image_name = $image->getClientOriginalName();
        //         //                $destinationPath = public_path('images');
        //         //                $image_file = $image->move($destinationPath, $image_name);

        //         // if (Storage::exists($doctor->DoctorCertificateFile()->certificate_file)) {
        //         //     Storage::delete($doctor->DoctorCertificateFile()->certificate_file);
        //         //     Storage::delete($doctor->DoctorCertificateFile()->name);
        //         // }

        //         $doctor->DoctorCertificateFile()->update([
        //             'doctor_id' => $doctor->id,
        //             'name' => $file_name,
        //             'certificate_file' => $file
        //         ]);
        //     }
        // }

        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $file = $profile_picture->store('public/doctor_profile_picture');

            $profile = $doctor->DoctorProfilePicture;

            if ($profile) {
                Storage::delete($doctor->DoctorProfilePicture->profile_picture);

                $doctor->DoctorProfilePicture()->update([
                    'doctor_id' => $doctor->id,
                    'profile_picture' => $file
                ]);
            } else {
                DoctorProfilePicture::create([
                    'doctor_id' => $doctor->id,
                    'profile_picture' => $file
                ]);
            }
        }

        // if ($request->hasFile('SaMa_or_NRC')) {
        //     $SaMa_or_NRC_files = $request->file('SaMa_or_NRC');
        //     foreach ($SaMa_or_NRC_files as $SaMa_or_NRC_file) {
        //         $file = $SaMa_or_NRC_file->store('public/SaMa_or_NRC');

        //         // if (Storage::exists($doctor->DoctorSamaFileOrNrcFile->SaMa_or_NRC)) {
        //         //     Storage::delete($doctor->DoctorSamaFileOrNrcFile->SaMa_or_NRC);
        //         // }

        //         $doctor->DoctorSamaFileOrNrcFile()->update([
        //             'doctor_id' => $doctor->id,
        //             'SaMa_or_NRC' => $file
        //         ]);
        //     }
        // }

        return redirect()->route('doctor.index')->with('success', 'Doctor Profile updated successfully.');
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

        return redirect()->route('doctor.index')->with('success', 'Profile deleted successfully');
    }

    public function doctor_list()
    {
        $doctors = Doctor::where('approve_status', 1)->get();

        return view('doctors.noti')->with(['doctors' => $doctors]);
    }

    public function doctor_noti(Request $request)
    {
        // dd($request->all());
        $heading = $request->input('heading');
        $body = $request->input('body');

        $devicetokens = MessageNotificationDeviceToken::where('app_user_id', 1)->pluck('device_token');
        // dd($devicetokens);

        $push = new PushNotification('fcm');
        $request = $push->setMessage([
            'notification' => [
                'title' => 'Chat heads active',
                'body' => ' conversation',
            ]
        ])
            ->setDevicesToken($devicetokens->toArray())
            ->send()
            ->getFeedback();
        dd($request);
    }
}

<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\WaitingList;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $doctor_id = $request->input('doctor_id');
        $patient_id = $request->input('patient_id');
        // dd($doctor_id, $patient_id);

        $assign = WaitingList::where('doctor_id', $doctor_id)->where('patient_id', $patient_id)->first();

        if (!$assign) {
            $doctor = Doctor::find($doctor_id);
            //        $patient = Patient::find($patient_id);

            $doctor->patients()->attach($patient_id);

            WaitingList::create([
                'doctor_id' => $doctor_id,
                'patient_id' => $patient_id,
                'status' => 0,
            ]);

            return redirect()->route('home')->with('success', 'Assigned successfully.');
        } else {
            return redirect()->route('home')->with('failed', 'Already assigned this doctor and patient');
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

    public function delete(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $patient_id = $request->input('patient_id');
        // dd($doctor_id, $patient_id);

        $assign = WaitingList::where('doctor_id', $doctor_id)->where('patient_id', $patient_id)->first();

        if ($assign) {
            $doctor = Doctor::find($doctor_id);

            $doctor->patients()->detach($patient_id);

            $assign->delete();

            return redirect()->route('home')->with('success', 'Assigned Patient deleted successfully.');
        } else {
            return redirect()->route('home')->with('failed', 'Something went wrong');
        }
    }
}

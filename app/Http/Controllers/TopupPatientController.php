<?php

namespace App\Http\Controllers;

use App\Patient;
use App\TopupPatient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopupPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::guard()->user();
        $user = User::find($auth->id);
        $patients = Patient::all();
        $topup_patients = TopupPatient::where('approve_status', 1)->get();
        return view('topup')->with(['user' => $user, 'patients' => $patients, 'topup_patients' => $topup_patients]);
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
        $user = Auth::guard()->user();
        $admin = User::find($user->id);
        $patient_id = $request->input('patient_id');
        $amount = $request->input('amount');

        $patient = Patient::find($patient_id);

        if ($patient) {
            // $admin_amount = ($amount * 10) / 100;
            // $final_amount = $amount - $admin_amount;
            $topup = TopupPatient::create([
                'user_id' => $admin->id,
                'patient_id' => $patient->id,
                'amount' => $amount,
                'approve_status' => 1
            ]);

            $patient->wallet += $amount;
            $patient->save();

            // $admin->wallet += $admin_amount;
            // $admin->save();
        }

        return redirect()->back()->with('success', 'Topup filled successfully.');
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

    public function get_topup_unapprove()
    {
        $auth = Auth::guard()->user();
        $user = User::find($auth->id);
        $patients = Patient::all();
        $topup_patients = TopupPatient::where('approve_status', 0)->get();
        return view('approve_topup')->with(['user' => $user, 'patients' => $patients, 'topup_patients' => $topup_patients]);
    }

    public function topup_approve(Request $request)
    {
        $topup_patient_id = $request->input('topup_patient_id');
        $topup_patient = TopupPatient::find($topup_patient_id);
        $patient = Patient::find($topup_patient->patient_id);

        if ($patient) {
            $topup_patient->approve_status = 1;
            $topup_patient->save();

            $patient->wallet += $topup_patient->amount;
            $patient->save();
        }

        return redirect()->back()->with('success', 'Top up has been approved');
    }
}

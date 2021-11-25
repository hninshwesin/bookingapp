<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);

        $app_user_doctor_id = $request->input('app_user_doctor_id');
        $amount = $request->input('amount');

        if ($app_user->doctor_status == 2) {
            $patient = Patient::where('app_user_id', $app_user->id)->first();
            if ($patient->wallet >= $amount) {
                $patient->wallet -= $amount;
                $patient->save();

                $admin_amount = ($amount * 10) / 100;
                $doctor_amount = $amount - $admin_amount;

                $transaction = Transaction::create([
                    'app_user_patient_id' => $app_user->id,
                    'app_user_doctor_id' => $app_user_doctor_id,
                    'total_amount' => $amount,
                    'to_doctor_amount' => $doctor_amount,
                    'to_admin_amount' => $admin_amount
                ]);

                $doctor = Doctor::where('app_user_id', $app_user_doctor_id)->first();
                if ($doctor) {
                    $doctor->wallet += $doctor_amount;
                    $doctor->save();
                }

                $admin = User::first();
                $admin->wallet += $admin_amount;
                $admin->save();

                return response()->json(['error_code' => '0', 'transaction' => $transaction, 'message' => 'Consultation fees transfered successfully']);
            } else {
                return response()->json(['error_code' => '1', 'message' => 'You don\'t have sufficient balance']);
            }
        } else {
            return response()->json(['error_code' => '1', 'message' => 'You are not patient']);
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
}

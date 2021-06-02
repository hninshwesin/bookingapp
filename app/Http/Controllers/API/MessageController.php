<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Message;
use App\DoctorPatientLastMessage;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\LastMessageResourceCollection;
use App\Http\Resources\PatientLastMessageResourceCollection;
use App\Http\Resources\MessageResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('user-api')->user();
        $user_id = AppUser::find($user->id);
        $messages = $user_id->messages()
        ->where(function ($query) {
            $query->bySender(request()->input('sender_id'))
                ->byReceiver( $user = Auth::guard('user-api')->user()->id);
        })
        ->orWhere(function ($query) {
            $query->bySender($user = Auth::guard('user-api')->user()->id)
                ->byReceiver(request()->input('sender_id'));
        })
        ->get();
        
        return new MessageResourceCollection($messages);
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
        $app_user = AppUser::where('id', [$user->id])->first();

        $receiver_id = $request->input('receiver_id');
        $message = $request->input('message');
        $type = $request->input('type');

        $message = Message::create([
            'sender_id'   => $app_user->id,
            'receiver_id' => $receiver_id,
            'message'     => $message,
            'type'        => $type
        ]);

        broadcast(new MessageSent($message));

        if ($app_user->doctor_status == 1) {

            $last_record = $message->where('sender_id', $app_user->id)
            ->where('receiver_id', $receiver_id)
            ->orderBy('id', 'DESC')
            ->first();
            // dd($last_record->sender_id,$last_record->receiver_id, $last_record->message);

            $doctor_patient_message = DoctorPatientLastMessage::where('app_user_doctor_id', $app_user->id)
            ->where('app_user_patient_id', $receiver_id)
            ->first();

            // dd($doctor_patient_message);
            
            if(!$doctor_patient_message) {
                $last_message = DoctorPatientLastMessage::create([
                    'app_user_doctor_id' => $last_record->sender_id,
                    'app_user_patient_id' => $last_record->receiver_id,
                    'last_message' => $last_record->message,
                    'doctor_unread_status' => 0,
                    'patient_unread_status' => 1,
                ]);
            } else {
                $doctor_patient_message->last_message = $last_record->message;
                $doctor_patient_message->doctor_unread_status = 0;
                $doctor_patient_message->patient_unread_status = 1;
                $doctor_patient_message->save();
            }

        } else {
            $last_record = $message->where('sender_id', $app_user->id)
            ->where('receiver_id', $receiver_id)
            ->orderBy('id', 'DESC')
            ->first();

            $doctor_patient_message = DoctorPatientLastMessage::where('app_user_doctor_id', $receiver_id)
            ->where('app_user_patient_id', $app_user->id)
            ->first();
            
            if(!$doctor_patient_message) {
                $last_message = DoctorPatientLastMessage::create([
                    'app_user_doctor_id' => $last_record->receiver_id,
                    'app_user_patient_id' => $last_record->sender_id,
                    'last_message' => $last_record->message,
                    'doctor_unread_status' => 1,
                    'patient_unread_status' => 0,
                ]);
            } else {
                $doctor_patient_message->last_message = $last_record->message;
                $doctor_patient_message->doctor_unread_status = 1;
                $doctor_patient_message->patient_unread_status = 0;
                $doctor_patient_message->save();
            }
        }

        return $message->fresh();
        return response()->json(['error_code' => '0'], 200);
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

    public function last_message() 
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        $doctor_patient_message = DoctorPatientLastMessage::where('app_user_doctor_id', $app_user->id)->get();

        return new LastMessageResourceCollection($doctor_patient_message);
    }
    
    public function patient_last_message()
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::where('id', [$user->id])->first();

        $doctor_patient_message = DoctorPatientLastMessage::where('app_user_patient_id', $app_user->id)->get();

        return new PatientLastMessageResourceCollection($doctor_patient_message);
    }

    public function message_receive(Request $request)
    {
        $user = Auth::guard('user-api')->user();
        $app_user = AppUser::find($user->id);

        $last_message_id = $request->input('last_message_id');

        $doctor_patient_last_message = DoctorPatientLastMessage::find($last_message_id);

        $app_user_doctor_id = $doctor_patient_last_message->app_user_doctor_id;
        $app_user_patient_id = $doctor_patient_last_message->app_user_patient_id;

        if ($app_user_doctor_id == $app_user->id) {
            $doctor_patient_last_message->doctor_unread_status = 0;
            $doctor_patient_last_message->save();

            return response()->json(['error_code' => '0'], 200);
        }

        if ($app_user_patient_id == $app_user->id) {
            $doctor_patient_last_message->patient_unread_status = 0;
            $doctor_patient_last_message->save();

            return response()->json(['error_code' => '0'], 200);
        }
    }
}
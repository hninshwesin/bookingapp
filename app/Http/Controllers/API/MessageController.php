<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Message;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
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
        $user_id = $user->id;
        $messages = $user->messages()
        ->where(function ($query) use ($user_id) {
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
}

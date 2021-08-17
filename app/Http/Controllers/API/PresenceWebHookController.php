<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\PresenceLog;
use App\PresenceRawLog;
use Illuminate\Http\Request;

class PresenceWebHookController extends Controller
{
    public function store(Request $request)
    {
        $get_content = $request->getContent();
        $data = PresenceRawLog::create([
            'body' => $get_content
        ]);

        $event = json_decode($get_content)->events[0];
        $pusher_key = $request->header('X-Pusher-Key');
        $pusher_signature = $request->header('X-Pusher-Signature');

        $presence_log = PresenceLog::create([
            'user_id' => $event->user_id,
            'event_name' => $event->name,
            'channel' => $event->channel,
            'pusher_key' => $pusher_key,
            'pusher_signature' => $pusher_signature,
        ]);

        return response()->json(['error_code' => 0], 200);
    }
}

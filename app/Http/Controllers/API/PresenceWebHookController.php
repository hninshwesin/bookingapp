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

        $presence_log = PresenceLog::create([
            'user_id' => $event->user_id,
            'event_name' => $event->name,
            'channel' => $event->channel
        ]);

        return response()->json(['error_code' => 0], 200);
    }
}

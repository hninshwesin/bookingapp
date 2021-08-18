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
        $body = $request->getContent();

        $data = PresenceRawLog::create([
            'body' => $body
        ]);

        $app_key = $request->header('X-Pusher-Key');
        $webhook_signature = $request->header('X-Pusher-Signature');

        $app_secret = env('PUSHER_APP_SECRET');
        $expected_signature = hash_hmac('sha256', $body, $app_secret, false);

        if ($webhook_signature == $expected_signature) {
            $event = json_decode($body)->events[0];

            $presence_log = PresenceLog::create([
                'user_id' => $event->user_id,
                'event_name' => $event->name,
                'channel' => $event->channel,
                'pusher_key' => $app_key,
                'pusher_signature' => $webhook_signature,
            ]);

            header("Status: 200 OK");
        } else {
            header("Status: 401 Not authenticated");
        }

        // return response()->json(['error_code' => 0], 200);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\AppUser;
use App\Events\UserOffline;
use App\Events\UserOnline;
use App\Http\Controllers\Controller;
use App\PresenceLog;
use App\PresenceRawLog;
use Illuminate\Http\Request;

class PresenceWebHookController extends Controller
{
    public function store(Request $request)
    {
        $body = $request->getContent();
        // $body = file_get_contents('php://input');

        $data = PresenceRawLog::create([
            'body' => $body
        ]);

        $app_key = $request->header('X-Pusher-Key');
        $webhook_signature = $request->header('X-Pusher-Signature');

        $app_secret = \config('pusher.secret');
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

            $app_user = AppUser::find($presence_log->user_id);

            if ($presence_log->event_name == 'member_added') {
                $app_user->online_status = 1;
                $app_user->save();

                broadcast(new UserOnline($app_user));
            } elseif ($presence_log->event_name == 'member_removed') {
                $app_user->online_status = 0;
                $app_user->save();

                broadcast(new UserOffline($app_user));
            }

            return response()->json(['error_code' => 0], 200);
        } else {
            return response()->json(['error_code' => 1], 401);
        }
    }
}

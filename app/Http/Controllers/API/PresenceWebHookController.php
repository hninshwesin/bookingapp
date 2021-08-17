<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\PresenceRawLog;
use Illuminate\Http\Request;

class PresenceWebHookController extends Controller
{
    public function store(Request $request)
    {

        $data = PresenceRawLog::create([
            'body' => json_decode($request->getContent(), true)
        ]);

        return response()->json(['error_code' => 0], 200);
    }
}

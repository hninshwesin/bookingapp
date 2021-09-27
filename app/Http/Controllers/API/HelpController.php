<?php

namespace App\Http\Controllers\API;

use App\Help;
use App\Http\Controllers\Controller;
use App\Http\Resources\HelpResource;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        $help = Help::first();

        return new HelpResource($help);
    }
}

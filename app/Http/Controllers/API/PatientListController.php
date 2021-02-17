<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Patient;
use App\WaitingList;
use Illuminate\Http\Request;

class PatientListController extends Controller
{
    public function patient()
    {
        $patients = WaitingList::all();
    }

    public function waiting()
    {
        $waiting = WaitingList::all();
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Faq;
use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResourceCollection;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faq = Faq::all();
        return new FaqResourceCollection($faq);
    }
}

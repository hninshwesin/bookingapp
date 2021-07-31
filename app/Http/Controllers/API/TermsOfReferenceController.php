<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TermsOfReferenceResource;
use App\TermsOfReference;
use Illuminate\Http\Request;

class TermsOfReferenceController extends Controller
{
    public function index()
    {
        $terms = TermsOfReference::first();

        return new TermsOfReferenceResource($terms);
    }
}

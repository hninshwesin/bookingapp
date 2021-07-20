<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResourceCollection;
use App\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function languages()
    {
        $languages = Language::all();

        return new LanguageResourceCollection($languages);
    }
}

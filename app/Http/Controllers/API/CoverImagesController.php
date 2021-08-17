<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoverImageResource;
use App\Http\Resources\CoverImageResourceCollection;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoverImagesController extends Controller
{
    public function get_images()
    {
        $images = Image::get();

        return new CoverImageResourceCollection($images);
    }
}

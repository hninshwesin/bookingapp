<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');
//
//Route::middleware('auth:api')->group(function (){
//    Route::post('/visit', 'API\VisitController@store');
//    Route::post('/referral', 'API\ReferralController@store');
//});

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', 'API\DoctorAuthController@register');
    Route::post('login', 'API\DoctorAuthController@login');

    Route::group([
        'middleware' => 'auth.doctor-api'
    ], function() {
//        Route::get('user', 'AuthController@user');
//        Route::get('logout', 'AuthController@logout');
        Route::get('doctor_profile', 'API\DoctorProfileController@profile');
        Route::get('patients', 'API\PatientListController@patient');
        Route::get('waiting', 'API\PatientListController@waiting');
        Route::post('visit', 'API\VisitController@store');
        Route::post('referral', 'API\ReferralController@store');
    });
});



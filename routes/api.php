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
        Route::get('patients', 'API\WaitingListAndPatientListController@patient');
        Route::get('waiting', 'API\WaitingListAndPatientListController@waiting');
        Route::post('patient_visit/{patient_id}', 'API\VisitController@store');
        Route::get('patient_detail/{patient_id}', 'API\VisitController@detail');
        Route::get('patient/{patient_id}', 'API\PatientController@patient');
        Route::post('referral', 'API\ReferralController@store');
        Route::get('doctors', 'API\ReferralController@doctors');
    });
});



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
//    Route::post('register', 'API\DoctorProfileController@register');
//    Route::post('login', 'API\DoctorProfileController@login');

    Route::post('register', 'API\AppUserController@register');
    Route::post('login', 'API\AppUserController@login');

    Route::group([
        'middleware' => 'auth.user-api'
    ], function() {
        Route::post('doctor_register', 'API\DoctorProfileController@register');
        Route::post('user_register', 'API\UserProfileController@register');
        Route::get('profile', 'API\ProfileController@profile');
        Route::get('patients', 'API\WaitingListAndPatientListController@patient');
        Route::get('waiting', 'API\WaitingListAndPatientListController@waiting');
        Route::post('patient_visit/{patient_id}', 'API\VisitController@store');
        Route::get('patient_detail/{patient_id}', 'API\VisitController@detail');
        Route::post('referral', 'API\ReferralController@store');
        Route::get('doctors', 'API\ReferralController@doctors');
        Route::get('patient/{patient_id}', 'API\PatientController@patient');
        Route::get('search', 'API\PatientController@searchpatient');
        Route::get('specialization', 'API\SpecializationController@specializations');
        Route::post('ambulance', 'API\AmbulanceController@store');
        Route::get('get_ambulance', 'API\AmbulanceController@index');
        Route::post('clinic', 'API\ClinicController@store');
        Route::get('get_clinic', 'API\ClinicController@index');
        Route::post('lab', 'API\LabController@store');
        Route::get('get_lab', 'API\LabController@index');
        Route::post('pharmacy', 'API\PharmacyController@store');
        Route::get('get_pharmacy', 'API\PharmacyController@index');
        Route::get('filter_ambulance', 'API\CharityFilterController@filter_ambulance');
        Route::get('filter_clinic', 'API\CharityFilterController@filter_clinic');
        Route::get('filter_lab', 'API\CharityFilterController@filter_lab');
        Route::get('filter_pharmacy', 'API\CharityFilterController@filter_pharmacy');
        Route::post('favorite_ambulance/{ambulance_id}', 'API\CharityFilterController@favorite_ambulance');
        Route::post('favorite_clinic/{clinic_id}', 'API\CharityFilterController@favorite_clinic');
        Route::post('favorite_lab/{lab_id}', 'API\CharityFilterController@favorite_lab');
        Route::post('favorite_pharmacy{pharmacy_id}', 'API\CharityFilterController@favorite_pharmacy');
    });
});



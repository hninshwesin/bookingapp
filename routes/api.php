<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Edujugon\PushNotification\PushNotification;

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
    ], function () {
        Route::post('doctor_register', 'API\DoctorProfileController@register');
        Route::post('user_register', 'API\UserProfileController@register');
        Route::get('profile', 'API\ProfileController@profile');
        Route::get('patients', 'API\WaitingListAndPatientListController@patient');
        Route::get('waiting', 'API\WaitingListAndPatientListController@waiting');
        Route::post('patient_visit/{patient_id}', 'API\VisitController@store');
        Route::get('patient_detail/{patient_id}', 'API\VisitController@detail');
        Route::post('referral', 'API\ReferralController@store');
        Route::get('doctors', 'API\ReferralController@doctors');
        Route::get('all_patients', 'API\PatientController@all_patients');
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
        Route::post('favorite_pharmacy/{pharmacy_id}', 'API\CharityFilterController@favorite_pharmacy');
        Route::get('get_favorite_ambulance', 'API\CharityFilterController@get_favorite_ambulance');
        Route::get('get_favorite_clinic', 'API\CharityFilterController@get_favorite_clinic');
        Route::get('get_favorite_lab', 'API\CharityFilterController@get_favorite_lab');
        Route::get('get_favorite_pharmacy', 'API\CharityFilterController@get_favorite_pharmacy');
        Route::post('messages', 'API\MessageController@index');
        Route::post('messages/send', 'API\MessageController@store');
        Route::post('file_upload', 'API\FileUploadController@store');
        Route::get('all_users', 'API\AppUserController@all_users');
        Route::post('patient_create', 'API\PatientController@store');
        Route::get('last_message_list', 'API\MessageController@last_message');
        Route::get('patient_last_message_list', 'API\MessageController@patient_last_message');
        Route::post('patient_create_from_doctor', 'API\PatientController@patient_create_api');
        Route::post('message_receive', 'API\MessageController@message_receive');
        Route::get('message_unread_count', 'API\MessageController@message_unread_count');
        Route::post('deviceToken', 'API\MessageNotificationDeviceTokenController@store');
        Route::get('specialization_has_doctor', 'API\SpecializationController@specialization_has_doctor');
        Route::get('regions', 'API\RegionController@regions');
        Route::get('townships', 'API\TownshipController@townships');
        Route::get('languages', 'API\LanguageController@languages');
        Route::post('chat_delete_single_conversation', 'API\MessageController@chat_delete_single_conversation');
        Route::delete('chat_delete_whole_conversation', 'API\MessageController@chat_delete_whole_conversation');
        Route::get('cover_images', 'API\CoverImagesController@get_images');
        Route::post('doctor_edit/{doctor_id}', 'API\DoctorProfileController@update');
        Route::post('favorite_doctor/{doctor_id}', 'API\DoctorProfileController@favorite_doctor');
        Route::get('get_favorite_doctor', 'API\DoctorProfileController@get_favorite_doctor');
        // Route::get('filter_doctor', 'API\DoctorProfileController@filter_doctor');
        Route::get('doctors_filter_with_language', 'API\ReferralController@doctors_filter_with_language');
        Route::post('active_status', 'API\DoctorProfileController@active');
    });

    Route::post('presence', 'API\PresenceWebHookController@store');
    Route::get('terms_of_reference', 'API\TermsOfReferenceController@index');
});


// Route::get('/message', function () {

//     $push = new PushNotification('fcm');

//     $request = $push->setMessage([
//         'notification' => [
//             'title' => 'This is the title',
//             'body' => 'This is the message',
//             // 'sound' => 'default'
//         ]
//     ])
//         // ->setApiKey('AAAA32xtX0A:APA91bF8K083FO_FlmuauDW4dVAfwiT7Ti5R02HyQTl74ZD8xQQZBGzb0aSldh5EEBwsnwO2kQk3Jnq6buftjk_SaFbNVDyTO-HhXziOQK4TkIlE6VWvG3FF_bkaqE5GcHLDrU3n09aP')
//         ->setDevicesToken(['f7aeY1WDQrGIiqFAEcxZFB:APA91bHA3wlLGDck6I5kFstFTkhddXgDgQHs4jk99i8aDDYnjAWIUrfSJ7lfl3Rh3ToTFpPIswbSQwulTI8en767eQSGWF-GAsFaJIkIJnOFXvnMhXZD6IIs7zKC4iK2jKueSbpa7mpv'])
//         ->send();
//     dd($request->getFeedback());


    // PushNotification::setService('fcm')
    //     ->setMessage([
    //         'notification' => [
    //             'title' => 'This is the title',
    //             'body' => 'This is the message',
    //             'sound' => 'default'
    //         ],
    //         'data' => [
    //             'extraPayLoad1' => 'value1',
    //             'extraPayLoad2' => 'value2'
    //         ]
    //     ])
    //     ->setApiKey('AAAA32xtX0A:APA91bF8K083FO_FlmuauDW4dVAfwiT7Ti5R02HyQTl74ZD8xQQZBGzb0aSldh5EEBwsnwO2kQk3Jnq6buftjk_SaFbNVDyTO-HhXziOQK4TkIlE6VWvG3FF_bkaqE5GcHLDrU3n09aP')
    //     ->setDevicesToken([' f7aeY1WDQrGIiqFAEcxZFB: APA91bHA3wlLGDck6I5kFstFTkhddXgDgQHs4jk99i8aDDYnjAWIUrfSJ7lfl3Rh3ToTFpPIswbSQwulTI8en767eQSGWF - GAsFaJIkIJnOFXvnMhXZD6IIs7zKC4iK2jKueSbpa7mpv'])
    //     ->send()
    //     ->getFeedback();
// });

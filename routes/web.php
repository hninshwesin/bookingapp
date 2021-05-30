<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/select2-autocomplete-ajax', 'HomeController@getDataAjax')->name('getDataAjax');

//Route::get('/doctor', 'DoctorController@index')->name('doctor');

Route::resource('doctor','DoctorController');

Route::resource('patient','PatientController');

Route::resource('assign', 'AssignController');

Route::resource('specialization', 'SpecializationController');

Route::get('doctor_approve', 'ApproveController@doctor')->name('doctor_approve');

Route::post('doctor_approve', 'ApproveController@doctor_approve')->name('doctor_approve');

Route::get('ambulance_approve', 'ApproveController@ambulance')->name('ambulance');

Route::post('ambulance_approve', 'ApproveController@ambulance_approve')->name('ambulance_approve');

Route::get('clinic_approve', 'ApproveController@clinic')->name('clinic');

Route::post('clinic_approve', 'ApproveController@clinic_approve')->name('clinic_approve');

Route::get('lab_approve', 'ApproveController@lab')->name('lab');

Route::post('lab_approve', 'ApproveController@lab_approve')->name('lab_approve');

Route::get('pharmacy_approve', 'ApproveController@pharmacy')->name('pharmacy');

Route::post('pharmacy_approve', 'ApproveController@pharmacy_approve')->name('pharmacy_approve');

Route::resource('ambulance','AmbulanceController');


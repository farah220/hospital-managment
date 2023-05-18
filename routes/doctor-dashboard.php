<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'DoctorDashboard', 'as' => 'doctor-dashboard.', 'middleware' => ['web','auth:doctors']],function (){
Route::view('/','doctor-dashboard.index');
Route::post('/createPrescription','PrescriptionController@storePrescription')->name('prescription');
Route::resource('prescriptions','PrescriptionController')->only(['destroy','index','create','show','edit','update']);
Route::post('/logout','PrescriptionController@logOut')->name('logout');
    Route::get('/p','PrescriptionController@checksResult');
});

<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'DoctorDashboard', 'as' => 'dashboard.', 'middleware' => ['web','auth:doctors']],function (){
Route::view('/','doctor-dashboard.index');
Route::post('/createPrescription','PrescriptionController@storePrescription')->name('prescription');
Route::resource('prescriptions','PrescriptionController')->only(['destroy','index','create','show','edit','update']);
Route::post('/logout','PrescriptionController@logout')->name('logout');
    Route::get('/p','PrescriptionController@checksResult');
});

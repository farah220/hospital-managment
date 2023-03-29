<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'AdminDashboard', 'as' => 'dashboard.', 'middleware' => ['web','auth:admins']],function (){
Route::view('/','dashboard.index');
Route::resource('admins','AdminController');
Route::resource('patients','PatientController');
Route::post('/logout','AdminController@logout')->name('logout');

});

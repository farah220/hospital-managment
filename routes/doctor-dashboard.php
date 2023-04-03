<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'DoctorDashboard', 'as' => 'dashboard.', 'middleware' => ['web','auth:doctors']],function (){
Route::view('/','doctor-dashboard.index');
//Route::resource('admins','AdminController');
//Route::post('/logout','AdminController@logout')->name('logout');

});

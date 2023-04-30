<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'PharmacistDashboard', 'as' => 'dashboard.', 'middleware' => ['web','auth:pharmacists']],function (){
Route::view('/','pharmacist-dashboard.index');
Route::resource('medicines','MedicineController');

//Route::resource('admins','AdminController');
Route::post('/logout','MedicineController@logOut')->name('logout');


});

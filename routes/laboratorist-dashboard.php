<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'LaboratoristDashboard', 'as' => 'dashboard.', 'middleware' => ['web','auth:laboratorists']],function (){
Route::view('/','laboratorist-dashboard.index');
//Route::resource('admins','AdminController');
//Route::post('/logout','AdminController@logout')->name('logout');

});

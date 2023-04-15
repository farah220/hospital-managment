<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'LaboratoristDashboard', 'as' => 'dashboard.', 'middleware' => ['web','auth:laboratorists']],function (){
Route::view('/','laboratorist-dashboard.index');
Route::resource('checks','CheckController');
Route::post('/logout','CheckController@logOut')->name('logout');

});

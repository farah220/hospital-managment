<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'LaboratoristDashboard', 'as' => 'lab-dashboard.', 'middleware' => ['web','auth:laboratorists']],function (){
Route::view('/','laboratorist-dashboard.index');
//Route::view('/addResult','laboratorist-dashboard.checkResults.addResult');
Route::resource('checks','CheckController');
Route::resource('checkResults','CheckResultController')->only(['index','show']);
Route::get('/checksResult/{prescription}','CheckResultController@addView')->name('addView');
Route::get('/checksResult/{prescription}/show','CheckResultController@show')->name('show');
Route::post('/checksResults/{prescription}','CheckResultController@addCheckResult')->name('addResult');
Route::post('/logout','CheckController@logOut')->name('logout');


});

<?php

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
Route::view('/admins/login','auth.admin_login')->name('admins.login-form');
Route::post('/dashboard/login','App\Http\Controllers\Auth\AuthController@dashboardLogin')->name('admins.login');


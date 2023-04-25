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
    return view('auth.login');
});
Route::view('/admins/login','auth.admin_login')->name('admins.login-form');
Route::post('/dashboard/login','App\Http\Controllers\Auth\AuthController@dashboardLogin')->name('admins.login');
Route::view('/doctors/login','auth.doctor_login')->name('doctors.login-form');
Route::post('/DoctorDashboard/login','App\Http\Controllers\Auth\AuthController@DoctorDashboardLogin')->name('doctors.login');
Route::view('/pharmacists/login','auth.pharmacist_login')->name('pharmacist.login-form');
Route::post('/PharmacistDashboard/login','App\Http\Controllers\Auth\AuthController@PharmacistDashboardLogin')->name('pharmacists.login');
Route::view('/laboratorists/login','auth.laboratorist_login')->name('laboratorist.login-form');
Route::post('/LaboratoristsDashboard/login','App\Http\Controllers\Auth\AuthController@LaboratoristDashboardLogin')->name('laboratorists.login');


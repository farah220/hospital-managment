<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CheckResultController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'doctor'
], function ($router) {
    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::get('/my-doctors', [DoctorController::class, 'myDoctors']);
    Route::get('/doctors/{doctor}', [DoctorController::class, 'show']);
});
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'department'
], function ($router) {
    Route::get('/departments', [DepartmentController::class, 'index']);
});
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'checkResult'
], function ($router) {
    Route::get('/checkResults', [CheckResultController::class, 'index']);
    Route::get('/checkResults/{checkResult}', [CheckResultController::class, 'show']);
});
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'prescription'
], function ($router) {
    Route::get('/prescriptions', [PrescriptionController::class, 'index']);
    Route::get('/prescriptions/{prescription}', [PrescriptionController::class, 'show']);
});
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'user'
], function ($router) {
    Route::post('/editUser/', [UserController::class, 'update']);
});

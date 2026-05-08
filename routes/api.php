<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Patient App Endpoints
Route::prefix('v1/patient')->group(function () {
    Route::post('/login', [PatientApiController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/dashboard', [PatientApiController::class, 'dashboard']);
        Route::get('/appointments', [PatientApiController::class, 'appointments']);
        Route::get('/lab-results', [PatientApiController::class, 'labResults']);
        Route::post('/appointment-request', [PatientApiController::class, 'requestAppointment']);
    });
});

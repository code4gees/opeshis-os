<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

// Note: Auth middleware and 'registry' prefix are applied in web.php gateway

/**
 * Institutional Patient Registry & Master Index
 */
Route::middleware(['permission:module_patients'])->prefix('patients')->name('patients.')->group(function () {
    Route::get('/', [PatientController::class, 'index'])->name('index');
    Route::get('/{id}', [PatientController::class, 'show'])->name('show');
    Route::post('/register', [PatientController::class, 'register'])->name('register');
});

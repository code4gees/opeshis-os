<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::middleware(['auth'])->group(function () {
    /**
     * Institutional Patient Registry & Master Index
     */
    Route::middleware(['permission:module_patients'])->group(function () {
        Route::get('/patients', [PatientController::class, 'index'])->name('patients');
        Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patients.show');
        Route::post('/patients/register', [PatientController::class, 'register'])->name('patients.register');
    });
});

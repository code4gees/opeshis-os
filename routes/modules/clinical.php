<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClinicalController;
use App\Http\Controllers\TriageController;
use App\Http\Controllers\NursingController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\MaternalController;
use App\Http\Controllers\PaedsController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\TheatreController;
use App\Http\Controllers\OPDController;

Route::middleware(['auth'])->group(function () {
    
    // Core Clinical Engine (EMR & OPD)
    Route::middleware(['permission:module_clinical'])->group(function () {
        // Universal EMR
        Route::get('/emr/{id?}', [ClinicalController::class, 'emr'])->name('emr');
        Route::get('/clinical/dossier/{id}', [ClinicalController::class, 'dossier'])->name('clinical.dossier');
        Route::post('/clinical/signal/{id}/resolve', [ClinicalController::class, 'resolveSignal'])->name('clinical.signal.resolve');
        Route::post('/emr/save', [ClinicalController::class, 'saveConsultation'])->name('emr.save');
        Route::post('/emr/close', [ClinicalController::class, 'closeConsultation'])->name('emr.close');
        
        // Institutional OPD (Outpatient)
        Route::get('/opd', [OPDController::class, 'index'])->name('clinical.opd');
        Route::post('/opd/register', [OPDController::class, 'register'])->name('clinical.opd.register');
        Route::post('/opd/consult', [OPDController::class, 'consult'])->name('clinical.opd.consult');
        Route::post('/opd/discharge', [OPDController::class, 'discharge'])->name('clinical.opd.discharge');

        // Inpatient (Wards & Admissions)
        Route::get('/admissions', [AdmissionController::class, 'index'])->name('admissions');
        Route::post('/admissions/admit', [AdmissionController::class, 'admit'])->name('admissions.admit');
        Route::post('/admissions/discharge/{id}', [AdmissionController::class, 'discharge'])->name('admissions.discharge');
        Route::get('/admissions/beds/available', [AdmissionController::class, 'getAvailableBeds'])->name('admissions.beds.available');

        // Nursing & Rounds
        Route::get('/nursing', [NursingController::class, 'index'])->name('nursing');
        Route::post('/nursing/save', [NursingController::class, 'saveRound'])->name('nursing.save');
    });

    // Specialty Units
    Route::middleware(['permission:module_vitals'])->group(function () {
        Route::get('/triage', [TriageController::class, 'index'])->name('triage');
        Route::post('/triage/save', [TriageController::class, 'saveVitals'])->name('triage.save');
    });

    Route::middleware(['permission:module_appointments'])->group(function () {
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::post('/appointments/checkin/{id}', [AppointmentController::class, 'checkIn'])->name('appointments.checkin');
    });

    Route::middleware(['permission:module_emergency'])->get('/emergency', [EmergencyController::class, 'index'])->name('emergency');
    Route::middleware(['permission:module_maternal'])->get('/maternal', [MaternalController::class, 'index'])->name('maternal');
    Route::middleware(['permission:module_paeds'])->get('/paeds', [PaedsController::class, 'index'])->name('paeds');

    // Surgery & Community
    Route::middleware(['permission:module_clinical'])->group(function () {
        Route::get('/clinical/theatre', [TheatreController::class, 'index'])->name('clinical.theatre');
        Route::post('/clinical/theatre/preop', [TheatreController::class, 'savePreopAssessment']);
        Route::post('/clinical/theatre/intraop/start', [TheatreController::class, 'startIntraop']);
        Route::post('/clinical/theatre/intraop/complete', [TheatreController::class, 'completeIntraop']);
    });
});

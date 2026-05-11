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
use App\Http\Controllers\WardController;

// Note: Auth middleware and 'clinical' prefix are applied in web.php gateway

// Core Clinical Engine (EMR & OPD)
Route::middleware(['permission:module_clinical'])->group(function () {
    // Universal EMR Gateway
    Route::prefix('emr')->name('emr.')->group(function() {
        Route::get('/{id?}', [ClinicalController::class, 'emr'])->name('main');
        Route::post('/save', [ClinicalController::class, 'saveConsultation'])->name('save');
        Route::post('/close', [ClinicalController::class, 'closeConsultation'])->name('close');
    });

    // Patient Dossier & Signal Processing
    Route::prefix('dossier')->group(function() {
        Route::get('/{id}', [ClinicalController::class, 'dossier'])->name('clinical.dossier');
        Route::post('/{id}/resolve', [ClinicalController::class, 'resolveSignal'])->name('clinical.dossier.resolve');
    });
    
    // Institutional OPD (Outpatient)
    Route::prefix('opd')->name('clinical.opd.')->group(function() {
        Route::get('/', [OPDController::class, 'index'])->name('index');
        Route::post('/register', [OPDController::class, 'register'])->name('register');
        Route::post('/consult', [OPDController::class, 'consult'])->name('consult');
        Route::post('/discharge/{id}', [OPDController::class, 'discharge'])->name('discharge');
    });

    // Inpatient (Wards & Admissions)
    Route::get('/wards', [WardController::class, 'index'])->name('wards');
    Route::prefix('admissions')->name('admissions.')->group(function() {
        Route::get('/', [WardController::class, 'index'])->name('index');
        Route::post('/admit', [WardController::class, 'admit'])->name('admit');
        Route::post('/discharge/{id}', [WardController::class, 'discharge'])->name('discharge');
        Route::get('/beds/available', [WardController::class, 'getAvailableBeds'])->name('beds.available');
    });

    // Nursing & Rounds
    Route::prefix('nursing')->name('nursing.')->group(function() {
        Route::get('/', [NursingController::class, 'index'])->name('index');
        Route::post('/save', [NursingController::class, 'saveRound'])->name('save');
    });

    // Surgery & Theatre
    Route::prefix('theatre')->name('clinical.theatre.')->group(function() {
        Route::get('/', [TheatreController::class, 'index'])->name('index');
        Route::post('/preop', [TheatreController::class, 'savePreopAssessment'])->name('preop');
        Route::post('/intraop/start', [TheatreController::class, 'startIntraop'])->name('start');
        Route::post('/intraop/complete', [TheatreController::class, 'completeIntraop'])->name('complete');
    });
});

// Specialty Units
Route::middleware(['permission:module_vitals'])->prefix('triage')->name('triage.')->group(function () {
    Route::get('/', [TriageController::class, 'index'])->name('index');
    Route::post('/save', [TriageController::class, 'saveVitals'])->name('save');
});

Route::middleware(['permission:module_appointments'])->prefix('appointments')->name('appointments.')->group(function () {
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::post('/', [AppointmentController::class, 'store'])->name('store');
    Route::post('/checkin/{id}', [AppointmentController::class, 'checkIn'])->name('checkin');
});

    // Institutional Emergency Command
    Route::middleware(['permission:module_emergency'])->prefix('emergency')->name('clinical.emergency.')->group(function () {
        Route::get('/', [EmergencyController::class, 'index'])->name('index');
        Route::post('/intake', [EmergencyController::class, 'intake'])->name('intake');
    });

    // Institutional Paediatrics Command
    Route::middleware(['permission:module_paeds'])->prefix('paeds')->name('clinical.paeds.')->group(function () {
        Route::get('/', [PaedsController::class, 'index'])->name('index');
        Route::post('/admit', [PaedsController::class, 'admit'])->name('admit');
        Route::post('/discharge/{id}', [PaedsController::class, 'discharge'])->name('discharge');
        Route::post('/vitals', [PaedsController::class, 'logVitals'])->name('vitals');
        Route::post('/growth', [PaedsController::class, 'logGrowth'])->name('growth');
        Route::post('/drug', [PaedsController::class, 'logDrug'])->name('drug');
        Route::post('/immunisation', [PaedsController::class, 'logImmunisation'])->name('immunisation');
        Route::post('/order/create', [PaedsController::class, 'createOrder'])->name('order.create');
        Route::post('/order/acknowledge/{id}', [PaedsController::class, 'acknowledgeOrder'])->name('order.acknowledge');
        Route::post('/order/complete/{id}', [PaedsController::class, 'completeOrder'])->name('order.complete');
        Route::post('/nursing/note', [PaedsController::class, 'addNursingNote'])->name('nursing.note');
    });

    // Institutional Obstetrics & Maternal Command
    Route::middleware(['permission:module_maternal'])->prefix('obstetrics')->name('clinical.obstetrics.')->group(function () {
        Route::get('/', [MaternalController::class, 'index'])->name('index');
        Route::post('/admit', [MaternalController::class, 'admit'])->name('admit');
        Route::post('/log-observation', [MaternalController::class, 'logObservation'])->name('log-observation');
        Route::post('/record-delivery', [MaternalController::class, 'recordDelivery'])->name('record-delivery');
    });

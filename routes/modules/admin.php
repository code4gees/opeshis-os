<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\CredentialingController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ReportingController;

// Note: Auth middleware and 'admin' prefix are applied in web.php gateway

Route::middleware(['permission:module_admin'])->group(function () {
    
    // Core Admin Hub
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/forensics/export', [AdminController::class, 'exportForensics'])->name('admin.forensics.export');
    Route::post('/action', [AdminController::class, 'action'])->name('admin.action');
    
    // Intelligence & Reporting Domain
    Route::prefix('intelligence')->name('admin.intelligence.')->group(function() {
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
        Route::get('/reporting', [ReportingController::class, 'index'])->name('reporting');
        Route::post('/reporting/generate', [ReportingController::class, 'generate'])->name('reporting.generate');
        Route::post('/reporting/dhis2/export', [ReportingController::class, 'exportDHIS2'])->name('reporting.dhis2.export');
    });
    
    // Institutional Settings
    Route::prefix('settings')->name('admin.settings.')->group(function() {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/update', [SettingsController::class, 'update'])->name('update');
    });
    
    // HR & Compliance
    Route::prefix('hr')->name('admin.hr.')->group(function() {
        // Performance Management
        Route::prefix('performance')->name('performance.')->group(function() {
            Route::get('/', [PerformanceController::class, 'index'])->name('index');
            Route::post('/cycle', [PerformanceController::class, 'createCycle'])->name('cycle.store');
            Route::post('/review', [PerformanceController::class, 'completeReview'])->name('review.store');
            Route::post('/review/{id}/sign', [PerformanceController::class, 'signReview'])->name('review.sign');
            Route::post('/self-assessment', [PerformanceController::class, 'submitSelfAssessment'])->name('self_assessment.store');
        });

        // Professional Training
        Route::prefix('training')->name('training.')->group(function() {
            Route::get('/', [TrainingController::class, 'index'])->name('index');
            Route::post('/course', [TrainingController::class, 'createCourse'])->name('course.store');
            Route::post('/session', [TrainingController::class, 'createSession'])->name('session.store');
            Route::post('/attendance', [TrainingController::class, 'recordAttendance'])->name('attendance.store');
            Route::post('/certification', [TrainingController::class, 'addCertification'])->name('certification.store');
            Route::post('/need', [TrainingController::class, 'addNeed'])->name('need.store');
        });

        // Credentialing & Licensing
        Route::prefix('credentialing')->name('credentialing.')->group(function() {
            Route::get('/', [CredentialingController::class, 'index'])->name('index');
            Route::post('/store', [CredentialingController::class, 'addCredential'])->name('store');
            Route::post('/{id}/update', [CredentialingController::class, 'updateCredential'])->name('update');
            Route::post('/{id}/acknowledge', [CredentialingController::class, 'acknowledgeAlert'])->name('acknowledge');
            Route::post('/audit', [CredentialingController::class, 'runExpiryCheck'])->name('audit');
        });
    });
});

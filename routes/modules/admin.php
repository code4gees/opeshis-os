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
        Route::get('/performance', [PerformanceController::class, 'index'])->name('performance');
        Route::get('/training', [TrainingController::class, 'index'])->name('training');
        Route::get('/credentialing', [CredentialingController::class, 'index'])->name('credentialing');
    });
});

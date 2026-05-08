<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\CredentialingController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ReportingController;

Route::middleware(['auth', 'permission:module_admin'])->group(function () {
    
    // Core Admin Hub
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/forensics/export', [AdminController::class, 'exportForensics'])->name('admin.forensics.export');
    Route::post('/admin/action', [AdminController::class, 'action'])->name('admin.action');
    
    // Intelligence & Reporting
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
    Route::get('/reporting', [ReportingController::class, 'index'])->name('reporting');
    Route::post('/reporting/generate', [ReportingController::class, 'generate'])->name('reporting.generate');
    Route::post('/reporting/dhis2/export', [ReportingController::class, 'exportDHIS2'])->name('reporting.dhis2.export');
    
    // Settings & HR
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    
    Route::get('/admin/performance', [PerformanceController::class, 'index'])->name('admin.performance');
    Route::get('/admin/training', [TrainingController::class, 'index'])->name('admin.training');
    Route::get('/admin/credentialing', [CredentialingController::class, 'index'])->name('admin.credentialing');
});

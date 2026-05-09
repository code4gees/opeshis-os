<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\EClaimsController;
use App\Http\Controllers\UHCController;

// Note: Auth middleware and 'finance' prefix are applied in web.php gateway

Route::middleware(['permission:module_billing'])->group(function () {
    Route::get('/', [BillingController::class, 'index'])->name('finance.billing.index');
    Route::post('/action', [BillingController::class, 'action'])->name('finance.billing.action');
    Route::get('/invoice/{id}', [BillingController::class, 'invoice'])->name('finance.billing.invoice');
});

Route::middleware(['permission:core_admin'])->group(function () {
    Route::get('/payments', [PaymentsController::class, 'index'])->name('finance.payments.index');
    Route::get('/eclaims', [EClaimsController::class, 'index'])->name('finance.eclaims.index');
    Route::post('/eclaims', [EClaimsController::class, 'createClaim'])->name('finance.eclaims.store');
    Route::get('/reconcile', [BillingController::class, 'reconcile'])->name('finance.reconcile');

    // UHC & Social Health Interoperability
    Route::prefix('uhc')->name('uhc.')->group(function () {
        Route::get('/', [UHCController::class, 'index'])->name('index');
        Route::post('/enroll', [UHCController::class, 'enroll'])->name('enroll');
    });
});

// External Payment Callbacks (Security Exempt)
Route::post('/payments/callback', [PaymentsController::class, 'callback'])
    ->name('finance.payments.callback')
    ->withoutMiddleware([\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\InstitutionalSecurity::class]);

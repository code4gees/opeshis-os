<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\EClaimsController;

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['permission:module_billing'])->group(function () {
        Route::get('/billing', [BillingController::class, 'index'])->name('billing');
        Route::post('/billing/action', [BillingController::class, 'action'])->name('billing.action');
        Route::get('/billing/invoice/{id}', [BillingController::class, 'invoice'])->name('billing.invoice');
    });

    Route::middleware(['permission:core_admin'])->group(function () {
        Route::get('/billing/payments', [PaymentsController::class, 'index'])->name('billing.payments');
        Route::get('/billing/eclaims', [EClaimsController::class, 'index'])->name('billing.eclaims');
        Route::get('/billing/reconcile', [BillingController::class, 'reconcile'])->name('billing.reconcile');
    });

    Route::post('/billing/payments/callback', [PaymentsController::class, 'callback'])->name('payments.callback')->withoutMiddleware(['auth']);
});

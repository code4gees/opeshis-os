<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\KioskController;

/*
|--------------------------------------------------------------------------
| Opeshis OS - Master Routing Gateway
|--------------------------------------------------------------------------
*/

// Public Institutional Portal
Route::get('/', [PublicController::class, 'landing'])->name('landing');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/features', [PublicController::class, 'features'])->name('features');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/blog', [PublicController::class, 'blog'])->name('blog');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'contactSubmit'])->name('contact.submit');

// Authentication Infrastructure
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/login/otp', [AuthController::class, 'showOtpForm'])->name('login.otp');
Route::post('/login/otp', [AuthController::class, 'verifyOtp']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Institutional Workspace (Protected)
Route::middleware(['auth'])->group(function () {
    
    // Command Center
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Modular Monolith - Route Inclusions
    require __DIR__.'/modules/registry.php';
    require __DIR__.'/modules/clinical.php';
    require __DIR__.'/modules/specialty.php';
    require __DIR__.'/modules/operations.php';
    require __DIR__.'/modules/finance.php';
    require __DIR__.'/modules/admin.php';
    require __DIR__.'/modules/system.php';
});

// Self-Service Kiosk
Route::get('/kiosk/triage', [KioskController::class, 'triage'])->name('kiosk.triage');
Route::post('/kiosk/triage', [KioskController::class, 'submit']);

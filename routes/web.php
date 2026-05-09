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

/*
|--------------------------------------------------------------------------
| Opeshis OS - Master Routing Gateway
|--------------------------------------------------------------------------
| This gateway orchestrates institutional traffic across modular domains.
| URL structures are optimized for SEO (Public) and Security (Internal).
*/

// Domain: Public Institutional Portal
Route::name('public.')->group(function () {
    Route::get('/', [PublicController::class, 'landing'])->name('landing');
    Route::get('/about-us', [PublicController::class, 'about'])->name('about');
    Route::get('/platform-features', [PublicController::class, 'features'])->name('features');
    Route::get('/institutional-faq', [PublicController::class, 'faq'])->name('faq');
    Route::get('/clinical-insights', [PublicController::class, 'blog'])->name('blog');
    Route::get('/clinical-insights/{slug}', [PublicController::class, 'blogPost'])->name('blog.post');
    Route::get('/contact-support', [PublicController::class, 'contact'])->name('contact');
    Route::post('/contact-support', [PublicController::class, 'contactSubmit'])->name('contact.submit');
});

// Redirects for SEO Consistency (Legacy/Short Aliases)
Route::redirect('/about', '/about-us', 301);
Route::redirect('/features', '/platform-features', 301);
Route::redirect('/faq', '/institutional-faq', 301);
Route::redirect('/blog', '/clinical-insights', 301);
Route::redirect('/contact', '/contact-support', 301);

// Domain: Authentication & Identity Infrastructure
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/login/otp', 'showOtpForm')->name('login.otp');
    Route::post('/login/otp', 'verifyOtp')->name('login.otp.verify');
    Route::post('/logout', 'logout')->name('logout');
});

// Domain: Institutional Workspace (Secure Access)
Route::middleware(['auth'])->group(function () {
    
    // Command Center
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Modular Monolith Gateway
     * Routes are segmented by institutional domain to ensure isolation and scalability.
     */
    Route::prefix('registry')->group(fn() => require __DIR__.'/modules/registry.php');
    Route::prefix('clinical')->group(fn() => require __DIR__.'/modules/clinical.php');
    Route::prefix('specialty')->group(fn() => require __DIR__.'/modules/specialty.php');
    Route::prefix('operations')->group(fn() => require __DIR__.'/modules/operations.php');
    Route::prefix('finance')->group(fn() => require __DIR__.'/modules/finance.php');
    Route::prefix('admin')->group(fn() => require __DIR__.'/modules/admin.php');
    Route::prefix('system')->group(fn() => require __DIR__.'/modules/system.php');
});

// Domain: Self-Service Kiosk Terminal
Route::prefix('kiosk')->name('kiosk.')->controller(KioskController::class)->group(function () {
    Route::get('/triage', 'triage')->name('triage');
    Route::post('/triage', 'submit')->name('submit');
});

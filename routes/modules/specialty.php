<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ICUController;
use App\Http\Controllers\HDUController;
use App\Http\Controllers\NICUController;
use App\Http\Controllers\ObstetricsController;
use App\Http\Controllers\FamilyPlanningController;
use App\Http\Controllers\OncologyController;
use App\Http\Controllers\PsychController;
use App\Http\Controllers\TBController;
use App\Http\Controllers\MalariaController;
use App\Http\Controllers\WoundCareController;
use App\Http\Controllers\PFTController;
use App\Http\Controllers\DermatologyController;
use App\Http\Controllers\IsolationController;
use App\Http\Controllers\SurveillanceController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\NarcoticsController;
use App\Http\Controllers\DentalController;
use App\Http\Controllers\EyeController;
use App\Http\Controllers\ENTController;
use App\Http\Controllers\EndoscopyController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\PhysioController;
use App\Http\Controllers\DialysisController;
use App\Http\Controllers\SpecialtyController;

Route::middleware(['auth', 'permission:module_clinical'])->group(function () {
    
    // Critical Care
    Route::prefix('clinical')->group(function () {
        Route::get('/icu', [ICUController::class, 'index'])->name('clinical.icu');
        Route::post('/icu/admit', [ICUController::class, 'admit']);
        Route::post('/icu/vitals', [ICUController::class, 'logVitals']);
        Route::post('/icu/sofa', [ICUController::class, 'saveSOFA']);
        Route::post('/icu/{id}/discharge', [ICUController::class, 'discharge']);

        Route::get('/hdu', [HDUController::class, 'index'])->name('clinical.hdu');
        Route::post('/hdu/admit', [HDUController::class, 'admit']);
        Route::post('/hdu/vitals', [HDUController::class, 'logVitals']);
        Route::post('/hdu/{id}/escalate', [HDUController::class, 'escalateToICU']);
        Route::post('/hdu/{id}/discharge', [HDUController::class, 'discharge']);

        Route::get('/nicu', [NICUController::class, 'index'])->name('clinical.nicu');
        Route::post('/nicu/admit', [NICUController::class, 'admitBaby']);
        Route::post('/nicu/vitals', [NICUController::class, 'logVitals']);
        Route::post('/nicu/feeding', [NICUController::class, 'logFeeding']);
        Route::post('/nicu/{id}/phototherapy', [NICUController::class, 'startPhototherapy']);
        Route::post('/nicu/{id}/discharge', [NICUController::class, 'discharge']);
    });

    // Specialty Clinics
    Route::prefix('clinical')->group(function () {
        Route::get('/dental', [DentalController::class, 'index'])->name('clinical.dental');
        Route::post('/dental/procedure', [DentalController::class, 'recordProcedure']);
        
        Route::get('/eye', [EyeController::class, 'index'])->name('clinical.eye');
        Route::post('/eye/examination', [EyeController::class, 'recordExamination']);
        
        Route::get('/ent', [ENTController::class, 'index'])->name('clinical.ent');
        Route::get('/endoscopy', [EndoscopyController::class, 'index'])->name('clinical.endoscopy');
        Route::get('/nutrition', [NutritionController::class, 'index'])->name('clinical.nutrition');
        
        Route::get('/psych', [PsychController::class, 'index'])->name('clinical.psych');
        Route::post('/psych/mse', [PsychController::class, 'recordMSE']);
        
        Route::get('/oncology', [OncologyController::class, 'index'])->name('clinical.oncology');
        Route::post('/oncology/plan', [OncologyController::class, 'createPlan']);
    });

    // Chronic & Infectious
    Route::prefix('clinical')->group(function () {
        Route::get('/tb', [TBController::class, 'index'])->name('clinical.tb');
        
        Route::get('/malaria', [MalariaController::class, 'index'])->name('clinical.malaria');
        Route::post('/malaria/register', [MalariaController::class, 'registerCase']);
        
        Route::get('/wound', [WoundCareController::class, 'index'])->name('clinical.wound');
        Route::post('/wound/register', [WoundCareController::class, 'register']);
        Route::post('/wound/dressing', [WoundCareController::class, 'recordDressing']);
        Route::post('/wound/{id}/close', [WoundCareController::class, 'close']);
        
        Route::get('/pft', [PFTController::class, 'index'])->name('clinical.pft');
        Route::get('/dermatology', [DermatologyController::class, 'index'])->name('clinical.dermatology');
        Route::get('/isolation', [IsolationController::class, 'index'])->name('clinical.isolation');
        Route::get('/surveillance', [SurveillanceController::class, 'index'])->name('clinical.surveillance');
        Route::get('/referrals', [ReferralController::class, 'index'])->name('clinical.referrals');
        Route::get('/narcotics', [NarcoticsController::class, 'index'])->name('clinical.narcotics');
    });
});

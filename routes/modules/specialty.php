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

// Note: Auth middleware and 'specialty' prefix are applied in web.php gateway

Route::middleware(['permission:module_clinical'])->group(function () {
    
    // Critical Care Domain
    Route::prefix('critical-care')->name('specialty.critical.')->group(function () {
        Route::prefix('icu')->name('icu.')->group(function() {
            Route::get('/', [ICUController::class, 'index'])->name('index');
            Route::post('/admit', [ICUController::class, 'admit'])->name('admit');
            Route::post('/vitals', [ICUController::class, 'logVitals'])->name('vitals');
            Route::post('/sofa', [ICUController::class, 'saveSOFA'])->name('sofa');
            Route::post('/{id}/discharge', [ICUController::class, 'discharge'])->name('discharge');
        });

        Route::prefix('hdu')->name('hdu.')->group(function() {
            Route::get('/', [HDUController::class, 'index'])->name('index');
            Route::post('/admit', [HDUController::class, 'admit'])->name('admit');
            Route::post('/vitals', [HDUController::class, 'logVitals'])->name('vitals');
            Route::post('/{id}/escalate', [HDUController::class, 'escalateToICU'])->name('escalate');
            Route::post('/{id}/discharge', [HDUController::class, 'discharge'])->name('discharge');
        });

        Route::prefix('nicu')->name('nicu.')->group(function() {
            Route::get('/', [NICUController::class, 'index'])->name('index');
            Route::post('/admit', [NICUController::class, 'admitBaby'])->name('admit');
            Route::post('/vitals', [NICUController::class, 'logVitals'])->name('vitals');
            Route::post('/feeding', [NICUController::class, 'logFeeding'])->name('feeding');
            Route::post('/{id}/phototherapy', [NICUController::class, 'startPhototherapy'])->name('phototherapy');
            Route::post('/{id}/discharge', [NICUController::class, 'discharge'])->name('discharge');
        });
    });

    // Specialized Clinics Domain
    Route::prefix('clinics')->name('specialty.clinics.')->group(function () {
        Route::prefix('dental')->name('dental.')->group(function() {
            Route::get('/', [DentalController::class, 'index'])->name('index');
            Route::post('/register', [DentalController::class, 'registerPatient'])->name('register');
            Route::post('/procedure', [DentalController::class, 'recordProcedure'])->name('procedure');
            Route::post('/chart', [DentalController::class, 'updateToothChart'])->name('chart');
            Route::post('/appointment', [DentalController::class, 'scheduleAppointment'])->name('appointment');
        });
        
        Route::prefix('eye')->name('eye.')->group(function() {
            Route::get('/', [EyeController::class, 'index'])->name('index');
            Route::post('/register', [EyeController::class, 'registerPatient'])->name('register');
            Route::post('/examination', [EyeController::class, 'recordExamination'])->name('examination');
            Route::post('/refraction', [EyeController::class, 'recordRefraction'])->name('refraction');
            Route::post('/iop', [EyeController::class, 'logIOP'])->name('iop');
            Route::post('/surgery/plan', [EyeController::class, 'planSurgery'])->name('surgery.plan');
            Route::post('/surgery/complete/{id}', [EyeController::class, 'completeSurgery'])->name('surgery.complete');
        });
        
        Route::get('/ent', [ENTController::class, 'index'])->name('ent.index');
        Route::get('/endoscopy', [EndoscopyController::class, 'index'])->name('endoscopy.index');
        Route::get('/nutrition', [NutritionController::class, 'index'])->name('nutrition.index');
        
        Route::get('/psych', [PsychController::class, 'index'])->name('psych.index');
        Route::post('/psych/mse', [PsychController::class, 'recordMSE'])->name('psych.mse');
        
        Route::get('/oncology', [OncologyController::class, 'index'])->name('oncology.index');
        Route::post('/oncology/plan', [OncologyController::class, 'createPlan'])->name('oncology.plan');
    });

    // Chronic & Infectious Disease Domain
    Route::prefix('chronic')->name('specialty.chronic.')->group(function () {
        Route::get('/tb', [TBController::class, 'index'])->name('tb.index');
        
        Route::get('/malaria', [MalariaController::class, 'index'])->name('malaria.index');
        Route::post('/malaria/register', [MalariaController::class, 'registerCase'])->name('malaria.register');
        
        Route::prefix('wound-care')->name('wound.')->group(function() {
            Route::get('/', [WoundCareController::class, 'index'])->name('index');
            Route::post('/register', [WoundCareController::class, 'register'])->name('register');
            Route::post('/dressing', [WoundCareController::class, 'recordDressing'])->name('dressing');
            Route::post('/{id}/close', [WoundCareController::class, 'close'])->name('close');
        });
        
        Route::get('/pft', [PFTController::class, 'index'])->name('pft.index');
        Route::get('/dermatology', [DermatologyController::class, 'index'])->name('dermatology.index');
        Route::get('/isolation', [IsolationController::class, 'index'])->name('isolation.index');
        Route::get('/surveillance', [SurveillanceController::class, 'index'])->name('surveillance.index');
        Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals.index');
        Route::get('/narcotics', [NarcoticsController::class, 'index'])->name('narcotics.index');
    });

    // Generic Specialty Hub Commitment
    Route::post('/save', [SpecialtyController::class, 'save'])->name('specialty.save');
});

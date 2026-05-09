<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\FhirController;

// Note: Auth middleware and 'system' prefix are applied in web.php gateway

/**
 * Institutional Support & Help Protocol
 */
Route::get('/support', function () { return view('support'); })->name('system.support');

/**
 * Sentinel Interop & Documentation Services
 */
Route::get('/print/{type}/{id}', [PrintController::class, 'generate'])->name('system.print');
Route::get('/fhir/metadata', [FhirController::class, 'metadata'])->name('system.fhir');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\FhirController;

Route::middleware(['auth'])->group(function () {
    /**
     * Institutional Support & Help Protocol
     */
    Route::get('/support', function () { return view('support'); })->name('support');

    /**
     * Sentinel Interop & Documentation Services
     */
    Route::get('/print/{type}/{id}', [PrintController::class, 'generate'])->name('print.document');
    Route::get('/fhir/metadata', [FhirController::class, 'metadata'])->name('fhir.metadata');
});

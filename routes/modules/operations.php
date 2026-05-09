<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\RadiologyController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LogisticsController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\BloodBankController;
use App\Http\Controllers\MortuaryController;
use App\Http\Controllers\DietaryController;
use App\Http\Controllers\CSSDController;
use App\Http\Controllers\IncidentController;

// Note: Auth middleware and 'operations' prefix are applied in web.php gateway

// Diagnostics Domain
Route::prefix('diagnostics')->name('operations.diagnostics.')->group(function() {
    Route::middleware(['permission:module_pharmacy'])->group(function () {
        Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy.index');
        Route::post('/pharmacy/action', [PharmacyController::class, 'action'])->name('pharmacy.action');
    });

    Route::middleware(['permission:module_lab'])->group(function () {
        Route::get('/lab', [LabController::class, 'index'])->name('lab.index');
    });

    Route::middleware(['permission:module_radiology'])->group(function () {
        Route::get('/radiology', [RadiologyController::class, 'index'])->name('radiology.index');
        Route::post('/radiology/action', [RadiologyController::class, 'action'])->name('radiology.action');
        Route::post('/radiology/order', [RadiologyController::class, 'quickOrder'])->name('radiology.order');
    });
});

// Supply Chain Domain
Route::prefix('supply-chain')->name('operations.supply.')->group(function() {
    Route::middleware(['permission:module_warehouse'])->group(function () {
        Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::post('/warehouse/action', [WarehouseController::class, 'action'])->name('warehouse.action');
    });

    Route::middleware(['permission:module_inventory'])->group(function () {
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::post('/inventory/action', [InventoryController::class, 'action'])->name('inventory.action');
    });
});

// Facilities & Logistics Domain
Route::prefix('logistics')->name('operations.logistics.')->group(function() {
    Route::middleware(['permission:module_assets'])->group(function () {
        Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
        Route::post('/assets/maintenance', [AssetController::class, 'updateMaintenance'])->name('assets.maintenance');
    });

    Route::middleware(['permission:core_admin'])->group(function () {
        Route::get('/laundry', [LaundryController::class, 'index'])->name('laundry.index');
        Route::get('/fleet', [FleetController::class, 'index'])->name('fleet.index');
    });
});

// Clinical Support Domain
Route::prefix('clinical-support')->name('operations.clinical.')->group(function() {
    Route::middleware(['permission:module_clinical'])->group(function () {
        Route::get('/bloodbank', [BloodBankController::class, 'index'])->name('bloodbank.index');
        Route::get('/mortuary', [MortuaryController::class, 'index'])->name('mortuary.index');
        Route::get('/dietary', [DietaryController::class, 'index'])->name('dietary.index');
        Route::get('/cssd', [CSSDController::class, 'index'])->name('cssd.index');
        
        // Quality & Risk Management
        Route::prefix('incidents')->name('incidents.')->group(function() {
            Route::get('/', [IncidentController::class, 'index'])->name('index');
            Route::post('/', [IncidentController::class, 'submit'])->name('submit');
            Route::post('/{id}/investigate', [IncidentController::class, 'investigate'])->name('investigate');
        });
    });
});

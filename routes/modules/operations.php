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

Route::middleware(['auth'])->group(function () {
    
    // Diagnostics
    Route::middleware(['permission:module_pharmacy'])->group(function () {
        Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy');
        Route::post('/pharmacy/action', [PharmacyController::class, 'action'])->name('pharmacy.action');
    });

    Route::middleware(['permission:module_lab'])->group(function () {
        Route::get('/lab', [LabController::class, 'index'])->name('lab');
    });

    Route::middleware(['permission:module_radiology'])->group(function () {
        Route::get('/radiology', [RadiologyController::class, 'index'])->name('radiology');
        Route::post('/radiology/action', [RadiologyController::class, 'action'])->name('radiology.action');
        Route::post('/radiology/order', [RadiologyController::class, 'quickOrder'])->name('radiology.order');
    });

    // Supply Chain
    Route::middleware(['permission:module_warehouse'])->group(function () {
        Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse');
        Route::post('/warehouse/action', [WarehouseController::class, 'action'])->name('warehouse.action');
    });

    Route::middleware(['permission:module_inventory'])->group(function () {
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
        Route::post('/inventory/action', [InventoryController::class, 'action'])->name('inventory.action');
    });

    // Facilities & Logistics
    Route::middleware(['permission:module_assets'])->group(function () {
        Route::get('/assets', [AssetController::class, 'index'])->name('assets');
        Route::post('/assets/maintenance', [AssetController::class, 'updateMaintenance'])->name('assets.maintenance');
    });

    Route::middleware(['permission:core_admin'])->group(function () {
        Route::get('/ops/laundry', [LaundryController::class, 'index'])->name('ops.laundry');
        Route::get('/ops/fleet', [FleetController::class, 'index'])->name('ops.fleet');
    });

    // Clinical Support
    Route::middleware(['permission:module_clinical'])->group(function () {
        Route::get('/bloodbank', [BloodBankController::class, 'index'])->name('bloodbank.index');
        Route::get('/mortuary', [MortuaryController::class, 'index'])->name('mortuary.index');
        Route::get('/dietary', [DietaryController::class, 'index'])->name('dietary.index');
        Route::get('/cssd', [CSSDController::class, 'index'])->name('cssd');
        
        // Quality & Risk Management
        Route::get('/ops/incidents', [IncidentController::class, 'index'])->name('ops.incidents');
        Route::post('/ops/incidents', [IncidentController::class, 'submit']);
        Route::post('/ops/incidents/{id}/investigate', [IncidentController::class, 'investigate']);
    });
});

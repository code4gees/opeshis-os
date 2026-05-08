<?php

namespace App\Actions;

use App\Models\Prescription;
use App\Models\Inventory;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DispenseMedicationAction
{
    /**
     * Dispense medication and update inventory.
     * Includes stock validation and institutional logging.
     */
    public function execute(string $prescriptionId): void
    {
        DB::transaction(function () use ($prescriptionId) {
            $prescription = Prescription::with('inventory')->findOrFail($prescriptionId);
            $inventory = $prescription->inventory;

            if (!$inventory || ($inventory->stock_level ?? 0) < $prescription->quantity) {
                throw new \Exception("Insufficient stock to dispense {$prescription->quantity} units.");
            }

            // Deep Intelligence: Drug-Drug Interaction Check (Mocked for now)
            // $interactions = \App\Helpers\MedicalEngine::checkInteractions($prescription->patient_id, $inventory->id);
            // if ($interactions->isNotEmpty()) { ... }

            $prescription->update([
                'status' => 'dispensed',
                'dispensed_at' => now()
            ]);

            $inventory->decrement('stock_level', $prescription->quantity);

            Opeshis::logAction(
                'PHARMACY_DISPENSE',
                'prescriptions',
                $prescriptionId,
                "Dispensed {$prescription->quantity} units of medication."
            );
        });
    }
}

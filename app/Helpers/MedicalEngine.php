<?php

namespace App\Helpers;

use App\Models\MedicalTerm;
use App\Models\WarehouseStock;
use App\Models\Prescription;
use App\Models\DrugInteraction;
use App\Models\InsuranceProvider;
use Illuminate\Support\Collection;

class MedicalEngine
{
    /**
     * Search for Institutional ICD-11 / SNOMED Codes
     */
    public static function searchTerms(string $query): Collection
    {
        return MedicalTerm::where('term_name', 'ILIKE', "%{$query}%")
            ->orWhere('code', 'ILIKE', "%{$query}%")
            ->limit(20)
            ->get();
    }

    /**
     * Search for Institutional Drugs/Stock Intelligence
     */
    public static function searchDrugs(string $query): Collection
    {
        return WarehouseStock::where('item_name', 'ILIKE', "%{$query}%")
            ->where('bulk_quantity', '>', 0)
            ->limit(20)
            ->get();
    }

    /**
     * Check for Institutional Drug-Drug Interactions (DDI)
     * Protocol: Compares a new drug against the patient's active prescriptions.
     */
    public static function checkInteractions(string $patientId, string $newDrugId): Collection
    {
        $activeMeds = Prescription::where('patient_id', $patientId)
            ->where('status', 'active')
            ->pluck('inventory_id');

        if ($activeMeds->isEmpty()) {
            return collect();
        }

        $allMeds = $activeMeds->push($newDrugId);

        return DrugInteraction::whereIn('drug_a_id', $allMeds)
            ->whereIn('drug_b_id', $allMeds)
            ->get();
    }

    /**
     * Calculate Institutional Insurance Co-Pay Intelligence
     */
    public static function calculateCoPay(string $providerId, float $basePrice): array
    {
        $provider = InsuranceProvider::find($providerId);
        if (!$provider) {
            return ['patient' => $basePrice, 'insurance' => 0];
        }

        $rate = $provider->default_co_pay_rate / 100;
        $patientDue = $basePrice * $rate;
        $insuranceDue = $basePrice - $patientDue;

        return [
            'patient' => $patientDue,
            'insurance' => $insuranceDue,
        ];
    }
}

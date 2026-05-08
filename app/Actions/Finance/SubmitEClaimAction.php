<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Models\EClaim;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;

class SubmitEClaimAction
{
    /**
     * Authorize Institutional E-Claim Submission Protocol
     */
    public function execute(array $data): EClaim
    {
        $claimNumber = 'CLM-' . strtoupper(Str::random(8));

        $claim = EClaim::create([
            'claim_number' => $claimNumber,
            'patient_id' => $data['patient_id'],
            'provider_id' => $data['provider_id'],
            'encounter_date' => $data['encounter_date'],
            'diagnosis_codes' => $data['diagnosis_codes'],
            'total_claimed' => $data['total'],
            'status' => 'submitted',
            'submitted_by' => auth()->id(),
        ]);

        Opeshis::logAction('ECLAIM_SUBMIT', 'eclaims', $claim->id, "Protocol: Institutional eClaim {$claimNumber} submitted to insurer.");

        return $claim;
    }
}

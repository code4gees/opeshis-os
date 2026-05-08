<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisPatient;

class UpdateDialysisDryWeightAction
{
    public function execute(array $data): void
    {
        DialysisPatient::findOrFail($data['dialysis_patient_id'])->update([
            'dry_weight' => $data['dry_weight'],
            'dry_weight_updated_at' => now(),
        ]);
    }
}

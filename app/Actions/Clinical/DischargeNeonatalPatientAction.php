<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\NicuAdmission;

class DischargeNeonatalPatientAction
{
    public function execute(string $id): void
    {
        NicuAdmission::findOrFail($id)->update([
            'status' => 'discharged', 
            'discharged_at' => now()
        ]);
    }
}

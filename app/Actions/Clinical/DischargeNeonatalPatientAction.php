<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;

class DischargeNeonatalPatientAction
{
    public function execute(string $id): void
    {
        Admission::findOrFail($id)->update([
            'status' => 'discharged', 
            'discharged_at' => now()
        ]);
    }
}

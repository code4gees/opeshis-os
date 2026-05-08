<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsImmunisation;
use Illuminate\Support\Facades\Auth;

class LogPaedsImmunisationAction
{
    public function execute(array $data): PaedsImmunisation
    {
        return PaedsImmunisation::create([
            'admission_id' => $data['admission_id'],
            'vaccine' => $data['vaccine'],
            'dose_number' => $data['dose_number'],
            'batch_no' => $data['batch_no'],
            'site' => $data['site'],
            'administered_by' => Auth::id(),
        ]);
    }
}

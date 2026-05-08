<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PftMeasurement;
use Illuminate\Support\Facades\Auth;

class RecordPftMeasurementAction
{
    public function execute(array $data): PftMeasurement
    {
        return PftMeasurement::create([
            'session_id' => $data['session_id'],
            'fvc' => $data['fvc'],
            'fev1' => $data['fev1'],
            'fev1_fvc_ratio' => ($data['fev1'] && $data['fvc']) ? round($data['fev1'] / $data['fvc'] * 100, 1) : null,
            'pef' => $data['pef'],
            'recorded_by' => Auth::id(),
        ]);
    }
}

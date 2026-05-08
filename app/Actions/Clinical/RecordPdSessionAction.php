<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisPdSession;
use Illuminate\Support\Facades\Auth;

class RecordPdSessionAction
{
    public function execute(array $data): DialysisPdSession
    {
        return DialysisPdSession::create([
            'dialysis_patient_id' => $data['dialysis_patient_id'],
            'fill_volume' => $data['fill_volume'],
            'dwell_time' => $data['dwell_time'],
            'drain_volume' => $data['drain_volume'],
            'ultrafiltration' => $data['uf'],
            'solution_type' => $data['solution'],
            'status' => 'completed',
            'recorded_by' => Auth::id(),
        ]);
    }
}

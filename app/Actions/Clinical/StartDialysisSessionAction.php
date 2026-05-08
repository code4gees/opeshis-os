<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisSession;
use App\Models\DialysisMachine;
use Illuminate\Support\Facades\Auth;

class StartDialysisSessionAction
{
    public function execute(array $data): DialysisSession
    {
        $session = DialysisSession::create([
            'dialysis_patient_id' => $data['dialysis_patient_id'],
            'machine_id' => $data['machine_id'],
            'pre_weight' => $data['pre_weight'],
            'uf_goal' => $data['uf_goal'],
            'duration_hours' => $data['duration'],
            'blood_flow_rate' => $data['bfr'],
            'dialysate_flow_rate' => $data['dfr'],
            'status' => 'in_progress',
            'started_by' => Auth::id(),
            'started_at' => now(),
        ]);
        
        DialysisMachine::where('id', $data['machine_id'])->update(['status' => 'in_use']);
        
        return $session;
    }
}

<?php

namespace App\Actions\Clinical;

use App\Models\TheatreCase;
use App\Models\TheatreRecovery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogSurgicalRecoveryAction
{
    /**
     * Authorize Institutional Recovery Unit Surveillance Initiation
     */
    public function execute(array $data): void
    {
        DB::transaction(function () use ($data) {
            TheatreRecovery::create([
                'case_id' => $data['case_id'],
                'arrival_time' => now(),
                'aldrete_score' => $data['aldrete'],
                'pain_score' => $data['pain'],
                'nausea' => $data['nausea'],
                'discharge_time' => $data['discharge_time'] ?? null,
                'recorded_by' => Auth::id(),
            ]);

            TheatreCase::where('id', $data['case_id'])->update(['status' => 'completed']);
        });
    }
}

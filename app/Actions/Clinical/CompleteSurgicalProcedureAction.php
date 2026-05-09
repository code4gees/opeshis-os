<?php

namespace App\Actions\Clinical;

use App\Models\TheatreCase;
use App\Models\TheatreIntraop;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CompleteSurgicalProcedureAction
{
    /**
     * Finalize Institutional Surgical Procedure Protocol
     */
    public function execute(array $data): void
    {
        DB::transaction(function () use ($data) {
            TheatreIntraop::where('case_id', $data['case_id'])->update([
                'closure_time' => now(),
                'operative_findings' => $data['findings'],
                'estimated_blood_loss' => $data['ebl'],
                'specimens_sent' => $data['specimens'] ?? null,
                'status' => 'completed',
                'completed_by' => Auth::id(),
            ]);

            TheatreCase::where('id', $data['case_id'])->update(['status' => 'recovery']);

            Opeshis::logAction('THEATRE_COMPLETE', 'theatre_cases', $data['case_id'], 'Institutional surgical procedure finalized');
        });
    }
}

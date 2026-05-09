<?php

namespace App\Actions\Clinical;

use App\Models\TheatreCase;
use App\Models\TheatreIntraop;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StartSurgicalProcedureAction
{
    /**
     * Authorize Institutional Surgical Procedure Initiation
     */
    public function execute(array $data): void
    {
        DB::transaction(function () use ($data) {
            $intraop = TheatreIntraop::create([
                'case_id' => $data['case_id'],
                'anaesthesia_type' => $data['anaesthesia_type'],
                'surgeon_id' => $data['surgeon_id'],
                'anaesthetist_id' => Auth::id(),
                'incision_time' => now(),
                'status' => 'in_progress',
            ]);

            TheatreCase::where('id', $data['case_id'])->update([
                'status' => 'in_progress',
                'started_at' => now(),
            ]);

            Opeshis::logAction('THEATRE_START', 'theatre_intraop', $intraop->id, 'Institutional surgical incision started');
        });
    }
}

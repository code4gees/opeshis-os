<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;

class CloseConsultationAction
{
    public function execute(string $encounterId): void
    {
        DB::beginTransaction();

        try {
            $encounter = \App\Models\OpdEncounter::find($encounterId);
            if ($encounter) {
                $encounter->update(['status' => 'completed']);
            }

            $queueItem = \App\Models\ActiveQueue::find($encounterId);
            if ($queueItem) {
                $queueItem->update(['status' => 'completed']);
            }

            Opeshis::logAction(
                'CLINICAL_CONSULT_CLOSE',
                'opd_encounters',
                $encounterId,
                'Finalized clinical consultation and closed encounter.'
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

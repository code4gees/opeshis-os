<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoFollowup;

class ScheduleOncoFollowupAction
{
    public function execute(array $data): OncoFollowup
    {
        return OncoFollowup::create([
            'onco_patient_id' => $data['onco_patient_id'],
            'scheduled_date' => $data['date'],
            'type' => $data['type'],
            'status' => 'scheduled',
        ]);
    }
}

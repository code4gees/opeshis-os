<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoCycle;

class ScheduleOncoCycleAction
{
    public function execute(array $data): OncoCycle
    {
        return OncoCycle::create([
            'plan_id' => $data['plan_id'],
            'cycle_number' => $data['cycle_number'],
            'scheduled_date' => $data['date'],
            'status' => 'scheduled',
        ]);
    }
}

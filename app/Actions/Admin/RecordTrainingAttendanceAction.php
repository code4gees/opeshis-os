<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\TrainingAttendance;
use App\Helpers\Opeshis;

class RecordTrainingAttendanceAction
{
    public function execute(array $data): void
    {
        foreach ($data['staff_ids'] as $staffId) {
            TrainingAttendance::firstOrCreate([
                'session_id' => $data['session_id'],
                'staff_id' => $staffId,
            ]);
        }

        Opeshis::logAction('TRAINING_ATTEND', 'training_attendance', $data['session_id'], "Protocol: " . count($data['staff_ids']) . " staff attendances recorded.");
    }
}

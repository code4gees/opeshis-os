<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Models\TrainingSessions;

class ScheduleTrainingSessionAction
{
    public function execute(array $data): TrainingSessions
    {
        return TrainingSessions::create([
            'course_id' => $data['course_id'],
            'facilitator' => $data['facilitator'],
            'venue' => $data['venue'],
            'session_date' => $data['date'],
        ]);
    }
}

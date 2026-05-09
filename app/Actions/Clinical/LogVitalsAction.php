<?php

namespace App\Actions\Clinical;

use App\Models\ActiveQueue;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;

class LogVitalsAction
{
    /**
     * Synchronize patient vitals and update queue status
     *
     * @param array $data
     * @return ActiveQueue
     */
    public function execute(array $data): ActiveQueue
    {
        return DB::transaction(function () use ($data) {
            $queue = ActiveQueue::findOrFail($data['queue_id']);

            $vitals = [
                'temp' => $data['temp'] ?? null,
                'bp_sys' => $data['bp_sys'] ?? null,
                'bp_dia' => $data['bp_dia'] ?? null,
                'spo2' => $data['spo2'] ?? null,
                'pulse' => $data['pulse'] ?? null,
                'weight' => $data['weight'] ?? null,
                'height' => $data['height'] ?? null,
            ];

            $complaint = [
                'chief_complaint' => $data['chief_complaint'] ?? null,
                'history' => $data['history'] ?? null,
            ];

            $queue->update([
                'vitals_data' => $vitals,
                'complaint_data' => $complaint,
                'status' => 'awaiting_consultation'
            ]);

            Opeshis::logAction(
                'TRIAGE_VITALS_CAPTURE',
                'active_queue',
                $queue->id,
                "Captured vitals and clinical presentation for patient: {$queue->patient->medical_id}"
            );

            return $queue;
        });
    }
}

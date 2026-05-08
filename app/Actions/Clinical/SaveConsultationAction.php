<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;

class SaveConsultationAction
{
    public function execute(\App\DTOs\ConsultationDTO $dto): void
    {
        DB::beginTransaction();

        try {
            // Ensure encounter exists
            $encounter = \App\Models\OpdEncounter::find($dto->encounterId);
            
            if (!$encounter) {
                $queueItem = \App\Models\ActiveQueue::find($dto->encounterId);
                if ($queueItem) {
                    $encounter = \App\Models\OpdEncounter::create([
                        'id' => $dto->encounterId,
                        'patient_id' => $queueItem->patient_id,
                        'doctor_id' => $dto->doctorId,
                        'status' => 'active'
                    ]);
                }
            }

            if ($encounter) {
                // Update or Create Consultation via Relationship
                $encounter->consultation()->updateOrCreate(
                    ['encounter_id' => $dto->encounterId],
                    [
                        'subjective' => $dto->subjective,
                        'objective' => $dto->objective,
                        'assessment' => $dto->assessment,
                        'plan' => $dto->plan
                    ]
                );
            }

            Opeshis::logAction(
                'CLINICAL_CONSULT_SAVE',
                'opd_consultations',
                $dto->encounterId,
                'Saved SOAP notes for encounter via Eloquent.'
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

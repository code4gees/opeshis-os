<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PftSession;
use App\Helpers\Opeshis;

class CreatePftSessionAction
{
    /**
     * Authorize Institutional PFT Session
     */
    public function execute(array $data): PftSession
    {
        $session = PftSession::create([
            'patient_id' => $data['patient_id'],
            'indication' => $data['indication'],
            'created_by' => auth()->id(),
        ]);

        Opeshis::logAction('PFT_SESSION_START', 'pft_sessions', $session->id, "Indication: {$data['indication']}");

        return $session;
    }
}

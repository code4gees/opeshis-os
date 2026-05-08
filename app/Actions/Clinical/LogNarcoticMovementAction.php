<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\NarcoticMovement;
use App\Helpers\Opeshis;

class LogNarcoticMovementAction
{
    /**
     * Authorize Institutional Controlled Substance Movement
     */
    public function execute(array $data): NarcoticMovement
    {
        $movement = NarcoticMovement::create([
            'stock_id' => $data['stock_id'],
            'movement_type' => $data['type'],
            'quantity' => $data['quantity'],
            'balance_after' => $data['balance_after'],
            'patient_id' => $data['patient_id'] ?? null,
            'witnessed_by' => $data['witness'],
            'recorded_by' => auth()->id(),
        ]);

        Opeshis::logAction('NARC_MOVEMENT', 'narcotics_movements', $movement->id, "Security: Controlled substance {$data['type']} protocol recorded.");

        return $movement;
    }
}

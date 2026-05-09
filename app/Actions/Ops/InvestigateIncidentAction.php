<?php

namespace App\Actions\Ops;

use App\Models\IncidentReport;
use Illuminate\Support\Facades\Auth;

class InvestigateIncidentAction
{
    /**
     * Authorize Institutional Incident Investigation
     */
    public function execute(string $id, array $data): void
    {
        $incident = IncidentReport::findOrFail($id);

        $incident->update([
            'root_cause' => $data['root_cause'],
            'corrective_action' => $data['action'],
            'status' => 'investigated',
            'investigated_by' => Auth::id(),
            'investigated_at' => now(),
        ]);
    }
}

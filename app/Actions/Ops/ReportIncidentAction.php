<?php

namespace App\Actions\Ops;

use App\Models\IncidentReport;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\Auth;

class ReportIncidentAction
{
    /**
     * Authorize Institutional Incident Reporting
     */
    public function execute(array $data): IncidentReport
    {
        $incident = IncidentReport::create([
            'incident_type' => $data['incident_type'],
            'date_of_incident' => $data['date_of_incident'] ?? now(),
            'location' => $data['location'] ?? 'Unknown',
            'description' => $data['description'],
            'immediate_action' => $data['immediate_action'] ?? null,
            'severity' => $data['severity'],
            'status' => 'reported',
            'reported_by' => ($data['is_anonymous'] ?? false) ? null : Auth::id(),
            'is_anonymous' => $data['is_anonymous'] ?? false,
            'branch_id' => Auth::user()->branch_id ?? null,
        ]);

        Opeshis::logAction('INCIDENT_REPORT', 'incident_reports', $incident->id, "Protocol: Institutional incident reported - Type: {$data['incident_type']}, Severity: {$data['severity']}.");

        return $incident;
    }
}

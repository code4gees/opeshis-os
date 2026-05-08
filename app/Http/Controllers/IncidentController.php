<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReport;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class IncidentController extends Controller
{
    /**
     * Institutional Quality & Incident Matrix
     */
    public function index(): View
    {
        $incidents = IncidentReport::with('reporter')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ops.incidents', compact('incidents'));
    }

    /**
     * Authorize Institutional Incident Reporting Protocol
     */
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|string', // Near Miss, Adverse Event, Sentinel Event
            'incident_date' => 'required|date',
            'location' => 'required|string',
            'description' => 'required|string',
            'immediate_action' => 'required|string',
            'severity' => 'required|string', // low, medium, high, critical
        ]);

        $incident = IncidentReport::create([
            'incident_type' => $validated['type'],
            'date_of_incident' => $validated['incident_date'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'immediate_action' => $validated['immediate_action'],
            'severity' => $validated['severity'],
            'status' => 'reported',
            'reported_by' => auth()->id(),
        ]);

        Opeshis::logAction('INCIDENT_REPORT', 'incident_reports', $incident->id, "Protocol: Institutional incident reported - Type: {$validated['type']}, Severity: {$validated['severity']}.");
        
        return redirect()->back()->with('success', 'Institutional incident report submitted to Quality Surveillance.');
    }

    /**
     * Authorize Institutional Incident Investigation Protocol
     */
    public function investigate(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'root_cause' => 'required|string',
            'action' => 'required|string',
        ]);

        IncidentReport::findOrFail($id)->update([
            'root_cause' => $validated['root_cause'],
            'corrective_action' => $validated['action'],
            'status' => 'investigated',
            'investigated_by' => auth()->id(),
            'investigated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Institutional investigation findings committed.');
    }
}

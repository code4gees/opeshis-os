<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncidentReport;
use App\Models\CapaAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class QualityController extends Controller
{
    /**
     * Institutional Quality & Safety Hub
     */
    public function index(): View
    {
        $incidents = IncidentReport::with('reporter')
            ->orderBy('created_at', 'desc')
            ->get();

        $capas = CapaAction::with(['incident', 'assignee'])
            ->orderBy('deadline', 'asc')
            ->get();

        return view('quality.index', compact('incidents', 'capas'));
    }

    /**
     * Report Institutional Incident Protocol
     */
    public function store(Request $request, \App\Actions\Ops\ReportIncidentAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'incident_type' => 'required|string',
            'severity_level' => 'required|string',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'is_anonymous' => 'nullable|string',
        ]);

        try {
            $action->execute([
                'incident_type' => $validated['incident_type'],
                'severity' => $validated['severity_level'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'is_anonymous' => $request->input('is_anonymous') === 'true',
            ]);
            return redirect()->back()->with('success', 'Institutional incident report transmitted to safety office.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Reporting failure: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidents;
use App\Models\CapaActions;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class QualityController extends Controller
{
    /**
     * Institutional Quality & Safety Hub
     */
    public function index(): View
    {
        $incidents = Incidents::with('reporter')
            ->orderBy('incident_date', 'desc')
            ->get();

        $capas = CapaActions::with(['incident', 'assignee'])
            ->orderBy('deadline', 'asc')
            ->get();

        return view('quality.index', compact('incidents', 'capas'));
    }

    /**
     * Report Institutional Incident Protocol
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'incident_type' => 'required|string',
            'severity_level' => 'required|string',
            'description' => 'required|string',
        ]);

        Incidents::create([
            'reporter_id' => $request->input('is_anonymous') === 'true' ? null : auth()->id(),
            'incident_type' => $request->input('incident_type'),
            'severity_level' => $request->input('severity_level'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'incident_date' => now(),
            'is_anonymous' => $request->input('is_anonymous') === 'true',
            'status' => 'reported',
        ]);

        return redirect()->back()->with('success', 'Institutional incident report transmitted to safety office.');
    }
}

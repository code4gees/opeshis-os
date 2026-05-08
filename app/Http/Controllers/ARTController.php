<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtRecord;
use App\Models\Patient;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ARTController extends Controller
{
    /**
     * Institutional ART Registry
     */
    public function index(): View
    {
        $records = ArtRecord::with('patient')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.art', compact('records'));
    }

    /**
     * Authorize Institutional ART Enrollment
     */
    public function enroll(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'regimen' => 'required|string',
            'start_date' => 'required|date',
        ]);

        $record = ArtRecord::create([
            'patient_id' => $validated['patient_id'],
            'regimen_code' => $validated['regimen'],
            'start_date' => $validated['start_date'],
            'status' => 'active',
        ]);

        Opeshis::logAction('ART_ENROLL', 'art_records', $record->id, "Protocol: ART enrollment authorized for patient.");
        
        return redirect()->back()->with('success', 'Institutional ART enrollment authorized.');
    }
}

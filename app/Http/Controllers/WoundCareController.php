<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WoundRecord;
use App\Models\WoundDressing;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WoundCareController extends Controller
{
    /**
     * Institutional Wound Management Hub
     */
    public function index(): View
    {
        $wounds = WoundRecord::with('patient')
            ->where('status', 'open')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('clinical.wound', compact('wounds'));
    }

    /**
     * Authorize Institutional Wound Registry Protocol
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'type' => 'required|string',
            'location' => 'required|string',
            'size' => 'required|numeric',
            'stage' => 'required|string',
        ]);

        $wound = WoundRecord::create([
            'patient_id' => $validated['patient_id'],
            'wound_type' => $validated['type'],
            'location' => $validated['location'],
            'size_cm' => $validated['size'],
            'stage' => $validated['stage'],
            'status' => 'open',
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('WOUND_REGISTER', 'wound_records', $wound->id, "Protocol: Wound registered for management.");
        
        return redirect()->back()->with('success', 'Institutional wound registry authorized.');
    }

    /**
     * Commit Institutional Dressing Protocol
     */
    public function recordDressing(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'wound_id' => 'required|uuid|exists:wound_records,id',
            'dressing_type' => 'required|string',
            'wound_bed' => 'required|string',
            'exudate' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        WoundDressing::create([
            'wound_id' => $validated['wound_id'],
            'dressing_type' => $validated['dressing_type'],
            'wound_bed' => $validated['wound_bed'],
            'exudate' => $validated['exudate'],
            'odour' => $request->input('odour') === 'yes',
            'notes' => $validated['notes'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional dressing protocol committed.');
    }

    /**
     * Authorize Institutional Wound Closure Protocol
     */
    public function close(Request $request, string $id): RedirectResponse
    {
        WoundRecord::findOrFail($id)->update([
            'status' => 'healed',
            'healed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Institutional wound closure protocol authorized.');
    }
}

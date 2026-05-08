<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelemedicineSessions;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TelemedicineController extends Controller
{
    /**
     * Institutional Telemedicine Hub
     */
    public function index(): View
    {
        $consultations = TelemedicineSessions::with(['patient', 'doctor'])
            ->where('status', '!=', 'completed')
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('telemedicine.index', compact('consultations'));
    }

    /**
     * Schedule Institutional Virtual Visit
     */
    public function schedule(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'scheduled_at' => 'required|date',
        ]);

        $id = (string) Str::uuid();
        $sessionCode = 'TC-' . date('Y') . '-' . strtoupper(Str::random(6));
        $token = bin2hex(random_bytes(32));
        $meetingLink = "https://meet.opeshis.os/room/{$id}?token={$token}";

        $session = TelemedicineSessions::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => auth()->id(),
            'scheduled_at' => $validated['scheduled_at'],
            'meeting_link' => $meetingLink,
            'status' => 'scheduled',
        ]);

        Opeshis::logAction('TELEMED_SCHEDULE', 'telemedicine_sessions', $session->id, "Scheduled institutional virtual session $sessionCode");

        return redirect()->back()->with('success', "Institutional Telemedicine session $sessionCode scheduled. Secure link generated.");
    }
}

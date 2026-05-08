<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActiveQueue;
use App\Models\Patient;
use App\Helpers\Opeshis;

class TriageController extends Controller
{
    /**
     * Show the Institutional Triage Worklist
     */
    public function index(Request $request)
    {
        $roomId = $request->query('room_id', session('triage_room_id', 'Triage-A'));
        session(['triage_room_id' => $roomId]);

        $activeQueue = ActiveQueue::with('patient')
            ->whereIn('status', ['waiting', 'awaiting_consultation'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('triage', compact('activeQueue', 'roomId'));
    }

    /**
     * Save patient vitals protocol
     */
    public function saveVitals(Request $request)
    {
        $request->validate([
            'queue_id' => 'required|uuid|exists:active_queue,id',
            'temp' => 'nullable|numeric|between:30,45',
            'bp_sys' => 'nullable|numeric|between:50,250',
            'bp_dia' => 'nullable|numeric|between:30,150',
            'spo2' => 'nullable|numeric|between:0,100',
            'pulse' => 'nullable|numeric|between:0,300',
            'weight' => 'nullable|numeric|between:0,500',
            'height' => 'nullable|numeric|between:0,300',
        ]);

        $queue = ActiveQueue::findOrFail($request->input('queue_id'));
        
        $vitals = [
            'temp' => $request->input('temp'),
            'bp_sys' => $request->input('bp_sys'),
            'bp_dia' => $request->input('bp_dia'),
            'spo2' => $request->input('spo2'),
            'pulse' => $request->input('pulse'),
            'weight' => $request->input('weight'),
            'height' => $request->input('height'),
        ];

        $complaint = [
            'chief_complaint' => $request->input('chief_complaint'),
            'history' => $request->input('history'),
        ];

        try {
            $queue->update([
                'vitals_data' => $vitals,
                'complaint_data' => $complaint,
                'status' => 'awaiting_consultation'
            ]);

            Opeshis::logAction(
                'TRIAGE_VITALS_CAPTURE',
                'active_queue',
                $queue->id,
                "Captured vitals and complaint for patient: {$queue->patient->medical_id}"
            );

            return redirect()->back()->with('success', 'Vitals logged and patient moved to consultation queue.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Operational disruption: ' . $e->getMessage());
        }
    }
}

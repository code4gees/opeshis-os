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
    public function saveVitals(Request $request, \App\Actions\Clinical\LogVitalsAction $action)
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
            'chief_complaint' => 'required|string',
        ]);

        try {
            $action->execute($request->all());
            return redirect()->back()->with('success', 'Vitals logged and patient synchronized with clinical queue.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Operational disruption: ' . $e->getMessage());
        }
    }
}

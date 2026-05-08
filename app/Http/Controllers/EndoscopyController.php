<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EndoscopyBooking;
use App\Models\EndoscopyReport;
use App\Models\EndoscopyBiopsy;
use App\Models\EndoscopyReprocessing;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EndoscopyController extends Controller
{
    /**
     * Show Institutional Endoscopy Command Hub
     */
    public function index(): View
    {
        $dailyList = EndoscopyBooking::with(['patient'])
            ->whereDate('scheduled_date', today())
            ->get();

        $allBookings = EndoscopyBooking::with(['patient'])
            ->orderBy('scheduled_date', 'desc')
            ->take(50)
            ->get();

        return view('clinical.endoscopy', compact('dailyList', 'allBookings'));
    }

    /**
     * Authorize Institutional Endoscopy Booking Protocol
     */
    public function createBooking(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid', 'exists:patients,id'],
            'procedure_type' => ['required', 'string'],
            'indication' => ['required', 'string'],
            'scheduled_date' => ['required', 'date'],
            'scope_id' => ['required', 'string'],
        ]);

        $booking = EndoscopyBooking::create([
            'patient_id' => $validated['patient_id'],
            'procedure_type' => $validated['procedure_type'],
            'indication' => $validated['indication'],
            'scheduled_date' => $validated['scheduled_date'],
            'scope_id' => $validated['scope_id'],
            'status' => 'booked',
            'booked_by' => auth()->id(),
        ]);

        Opeshis::logAction('ENDO_BOOKING', 'endoscopy_bookings', $booking->id, "Institutional Endoscopy Booking authorized: {$validated['procedure_type']}");

        return redirect()->back()->with('success', 'Institutional endoscopy booking protocol authorized.');
    }

    /**
     * Commit Institutional Endoscopy Procedure Intelligence
     */
    public function saveReport(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'booking_id' => ['required', 'uuid', 'exists:endoscopy_bookings,id'],
            'macroscopic' => ['required', 'string'],
            'microscopic' => ['nullable', 'string'],
            'impression' => ['required', 'string'],
            'recommendations' => ['required', 'string'],
        ]);

        $report = EndoscopyReport::create([
            'booking_id' => $validated['booking_id'],
            'macroscopic_findings' => $validated['macroscopic'],
            'microscopic_findings' => $validated['microscopic'],
            'impression' => $validated['impression'],
            'recommendations' => $validated['recommendations'],
            'reported_by' => auth()->id(),
        ]);

        EndoscopyBooking::findOrFail($validated['booking_id'])->update(['status' => 'reported']);

        Opeshis::logAction('ENDO_REPORT', 'endoscopy_reports', $report->id, "Institutional Endoscopy Procedure Intelligence committed.");

        return redirect()->back()->with('success', 'Institutional endoscopy procedure intelligence committed.');
    }

    /**
     * Commit Institutional Endoscopic Biopsy Intelligence
     */
    public function addBiopsy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'booking_id' => ['required', 'uuid', 'exists:endoscopy_bookings,id'],
            'site' => ['required', 'string'],
            'pieces' => ['required', 'numeric'],
            'histology' => ['required', 'boolean'],
        ]);

        $biopsy = EndoscopyBiopsy::create([
            'booking_id' => $validated['booking_id'],
            'site' => $validated['site'],
            'number_of_pieces' => $validated['pieces'],
            'sent_to_histology' => $validated['histology'],
            'recorded_by' => auth()->id(),
        ]);

        Opeshis::logAction('ENDO_BIOPSY', 'endoscopy_biopsies', $biopsy->id, "Institutional Endoscopic Biopsy Intelligence committed.");

        return redirect()->back()->with('success', 'Institutional endoscopic biopsy intelligence committed.');
    }

    /**
     * Commit Institutional Scope Reprocessing Intelligence
     */
    public function logReprocessing(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'scope_id' => ['required', 'string'],
            'cycle_type' => ['required', 'string'],
            'disinfectant' => ['required', 'string'],
            'passed' => ['required', 'boolean'],
        ]);

        EndoscopyReprocessing::create([
            'scope_id' => $validated['scope_id'],
            'cycle_type' => $validated['cycle_type'],
            'disinfectant' => $validated['disinfectant'],
            'passed_test' => $validated['passed'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional scope reprocessing intelligence committed.');
    }
}


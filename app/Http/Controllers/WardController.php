<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Opeshis;
use App\Models\Ward;
use App\Models\WardBed;
use App\Models\Admission;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class WardController extends Controller
{
    /**
     * Show Institutional Ward Management Pulse
     */
    public function index(): View
    {
        $wards = Ward::with(['beds'])->orderBy('name')->get();
        
        $admissions = Admission::with(['patient', 'bed.ward'])
            ->where('admission_type', 'general')
            ->where('status', 'admitted')
            ->orderBy('admission_date', 'desc')
            ->get();

        $occupancyRate = WardBed::count() > 0
            ? round(WardBed::where('status', 'occupied')->count() / WardBed::count() * 100)
            : 0;

        return view('clinical.ward', compact('wards', 'admissions', 'occupancyRate'));
    }

    /**
     * Retrieve Institutional Available Bed Inventory
     */
    public function getAvailableBeds(Request $request): JsonResponse
    {
        $beds = WardBed::where('status', 'available')
            ->where('ward_id', $request->ward_id)
            ->get();

        return response()->json($beds);
    }

    /**
     * Authorize Institutional Ward Admission Protocol
     */
    public function admit(Request $request, \App\Actions\Clinical\AdmitPatientToWardAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required', // Support UUID or Medical ID
            'ward_id' => 'required|uuid|exists:wards,id',
            'bed_id' => 'required|uuid|exists:ward_beds,id',
            'diagnosis' => 'required|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('wards')->with('success', 'Institutional ward admission protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->route('wards')->with('error', 'Admission failure: ' . $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Ward Discharge Protocol
     */
    public function discharge(Request $request, string $id, \App\Actions\Clinical\DischargePatientFromWardAction $action): RedirectResponse
    {
        try {
            $action->execute($id, $request->input('summary'));
            return redirect()->route('wards')->with('success', 'Institutional patient discharge finalized.');
        } catch (\Exception $e) {
            return redirect()->route('wards')->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Bed Sanitization and Release
     */
    public function releaseBed(string $id): RedirectResponse
    {
        WardBed::where('id', $id)->update([
            'status' => 'available',
            'patient_id' => null,
            'released_at' => now()
        ]);

        return redirect()->route('wards')->with('success', 'Institutional bed sanitized and released to inventory.');
    }
}

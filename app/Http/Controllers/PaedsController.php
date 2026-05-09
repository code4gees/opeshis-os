<?php
namespace App\Http\Controllers;
use App\Models\Admission;
use App\Models\PaedsOrder;
use App\Models\PaedsVital;
use App\Actions\Clinical\AdmitPaedsPatientAction;
use App\Actions\Clinical\DischargePaedsPatientAction;
use App\Actions\Clinical\LogPaedsVitalsAction;
use App\Actions\Clinical\LogPaedsGrowthAction;
use App\Actions\Clinical\LogPaedsDrugAdminAction;
use App\Actions\Clinical\LogPaedsImmunisationAction;
use App\Actions\Clinical\CreatePaedsOrderAction;
use App\Actions\Clinical\AcknowledgePaedsOrderAction;
use App\Actions\Clinical\CompletePaedsOrderAction;
use App\Actions\Clinical\LogPaedsNursingNoteAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaedsController extends Controller
{
    /**
     * Institutional Paediatric Command Center
     */
    public function index(): View
    {
        $census = Admission::where('admission_type', 'paeds')
            ->when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient', 'paedsVitals'])
            ->whereIn('status', ['active', 'admitted'])
            ->orderBy('admission_date', 'desc')
            ->get()
            ->map(function ($admission) {
                $admission->latest_vitals = $admission->paedsVitals()->latest()->first();
                $admission->age_days = \Carbon\Carbon::parse($admission->patient->date_of_birth ?? now())->diffInDays(now());
                return $admission;
            });

        $stats = [
            'active' => $census->count(),
            'pending_orders' => PaedsOrder::where('status', 'pending')->count()
        ];

        return view('clinical.paeds', compact('census', 'stats'));
    }

    /**
     * Authorize Institutional Paediatric Admission Protocol via Action
     */
    public function admit(Request $request, AdmitPaedsPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'ward' => 'required|string',
            'diagnosis' => 'required|string',
            'weight' => 'required|numeric',
            'bed_number' => 'nullable|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Paediatric patient admitted to institutional ward.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Paediatric Discharge Protocol via Action
     */
    public function discharge(Request $request, string $id, DischargePaedsPatientAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'summary' => 'required|string',
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Paediatric patient discharged from institutional registry.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Paediatric Vitals Protocol via Action
     */
    public function logVitals(Request $request, LogPaedsVitalsAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'temperature' => 'nullable|numeric',
            'heart_rate' => 'nullable|integer',
            'resp_rate' => 'nullable|integer',
            'spo2' => 'nullable|integer',
            'bp_systolic' => 'nullable|integer',
            'bp_diastolic' => 'nullable|integer',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Clinical vitals recorded in institutional telemetry.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Growth Monitoring Protocol via Action
     */
    public function logGrowth(Request $request, LogPaedsGrowthAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'hc' => 'required|numeric',
            'muac' => 'required|numeric',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Institutional growth measurements saved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Paediatric Drug Administration Protocol via Action
     */
    public function logDrug(Request $request, LogPaedsDrugAdminAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'drug' => 'required|string',
            'dose' => 'required|string',
            'route' => 'required|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Drug administration logged in institutional registry.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Immunisation Protocol via Action
     */
    public function logImmunisation(Request $request, LogPaedsImmunisationAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'vaccine' => 'required|string',
            'dose_number' => 'required|string',
            'batch_no' => 'required|string',
            'site' => 'required|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Institutional immunisation record established.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Paediatric Clinical Order via Action
     */
    public function createOrder(Request $request, CreatePaedsOrderAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'type' => 'required|string',
            'order_text' => 'required|string',
            'priority' => 'required|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Clinical order established in institutional queue.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Paediatric Order Acknowledgment via Action
     */
    public function acknowledgeOrder(Request $request, string $id, AcknowledgePaedsOrderAction $action): RedirectResponse
    {
        try {
            $action->execute($id);
            return redirect()->route('clinical.paeds.index')->with('success', 'Institutional order acknowledged.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Finalize Institutional Paediatric Order Completion via Action
     */
    public function completeOrder(Request $request, string $id, CompletePaedsOrderAction $action): RedirectResponse
    {
        try {
            $action->execute($id, $request->only('notes'));
            return redirect()->route('clinical.paeds.index')->with('success', 'Institutional order finalized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Paediatric Nursing Note via Action
     */
    public function addNursingNote(Request $request, LogPaedsNursingNoteAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|uuid|exists:admissions,id',
            'note' => 'required|string',
            'shift' => 'required|string',
        ]);

        try {
            $action->execute($validated);
            return redirect()->route('clinical.paeds.index')->with('success', 'Nursing documentation saved to institutional record.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}


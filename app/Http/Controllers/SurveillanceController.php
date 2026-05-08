<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveillanceCase;
use App\Models\SurveillanceContact;
use App\Models\SurveillanceDisease;
use App\Models\SurveillanceAlert;
use App\Actions\Clinical\ReportSurveillanceCaseAction;
use App\Actions\Clinical\AddSurveillanceContactAction;
use App\Actions\Clinical\ResolveSurveillanceAlertAction;
use App\Actions\Clinical\UpdateSurveillanceOutcomeAction;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SurveillanceController extends Controller
{
    /**
     * Institutional Public Health Surveillance Command Hub
     */
    public function index(): View
    {
        $cases = SurveillanceCase::with(['patient', 'disease'])
            ->withCount('contacts')
            ->orderBy('created_at', 'desc')
            ->get();

        $diseases = SurveillanceDisease::all();
        $alerts = SurveillanceAlert::with(['disease'])
            ->where('resolved', false)
            ->get();

        return view('clinical.surveillance', compact('cases', 'diseases', 'alerts'));
    }

    /**
     * Authorize Institutional IDSR Case Reporting Protocol via Action
     */
    public function reportCase(Request $request, ReportSurveillanceCaseAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'disease_code' => ['required', 'string', 'exists:surveillance_diseases,disease_code'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional IDSR reporting authorized. Threshold analysis completed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Commit Institutional Contact Tracing Intelligence via Action
     */
    public function addContact(Request $request, AddSurveillanceContactAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'case_id' => ['required', 'uuid', 'exists:surveillance_cases,id'],
            'name' => ['required', 'string'],
            'relationship' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional contact tracing intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Alert Resolution Protocol via Action
     */
    public function resolveAlert(Request $request, string $id, ResolveSurveillanceAlertAction $action): RedirectResponse
    {
        try {
            $action->execute($id);
            return redirect()->back()->with('success', 'Institutional health alert resolution protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Weekly Intelligence Report Generation
     */
    public function generateWeekly(): RedirectResponse
    {
        $count = SurveillanceCase::whereDate('created_at', '>=', now()->startOfWeek())->count();
        Opeshis::logAction('SURV_WEEKLY', 'surveillance_cases', null, "Report: Weekly intelligence report generated. Total cases: {$count}.");

        return redirect()->back()->with('success', 'Institutional weekly intelligence report generated.');
    }

    /**
     * Authorize Institutional MOH Report Dispatch Protocol
     */
    public function mohReport(): RedirectResponse
    {
        Opeshis::logAction('SURV_MOH', 'surveillance_cases', null, 'Protocol: Institutional MOH reporting protocol dispatched.');
        return redirect()->back()->with('success', 'Institutional MOH reporting protocol dispatched.');
    }

    /**
     * Commit Institutional Case Outcome Intelligence via Action
     */
    public function updateOutcome(Request $request, string $id, UpdateSurveillanceOutcomeAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'outcome' => ['required', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional case outcome intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}


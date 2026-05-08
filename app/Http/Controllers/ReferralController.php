<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferralOutbound;
use App\Models\ReferralInbound;
use App\Actions\Clinical\AuthorizeOutboundReferralAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ReferralController extends Controller
{
    /**
     * Institutional Referral Coordination Hub
     */
    public function index(): View
    {
        $outbound = ReferralOutbound::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->with(['patient'])
            ->orderBy('created_at', 'desc')
            ->get();

        $inbound = ReferralInbound::when(auth()->user()->branch_id, function ($query, $branchId) {
                return $query->where('branch_id', $branchId);
            })
            ->orderBy('created_at', 'desc')->get();

        return view('clinical.referrals', compact('outbound', 'inbound'));
    }

    /**
     * Authorize Institutional Outbound Referral Protocol via Action
     */
    public function createOutbound(Request $request, AuthorizeOutboundReferralAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'uuid'],
            'facility' => ['required', 'string'],
            'reason' => ['required', 'string'],
            'urgency' => ['required', 'string'],
        ]);

        $action->execute($validated);

        return redirect()->back()->with('success', 'Institutional outbound referral protocol authorized.');
    }

    /**
     * Commit Institutional Inbound Referral Intelligence via Action
     */
    public function createInbound(Request $request, \App\Actions\Clinical\CreateInboundReferralAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'patient_name' => ['required', 'string'],
            'facility' => ['required', 'string'],
            'reason' => ['required', 'string'],
        ]);

        try {
            $action->execute($validated);
            return redirect()->back()->with('success', 'Institutional inbound referral intelligence committed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Authorize Institutional Counter-Referral Protocol via Action
     */
    public function sendCounter(Request $request, string $id, \App\Actions\Clinical\AuthorizeCounterReferralAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'notes' => ['required', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional counter-referral protocol authorized.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update Institutional Referral Status Intelligence via Action
     */
    public function updateStatus(Request $request, string $id, \App\Actions\Clinical\UpdateReferralStatusAction $action): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        try {
            $action->execute($id, $validated);
            return redirect()->back()->with('success', 'Institutional referral status intelligence updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

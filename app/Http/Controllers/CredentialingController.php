<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StaffCredentials;
use App\Models\User;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class CredentialingController extends Controller
{
    /**
     * Institutional Personnel Credentialing Hub
     */
    public function index(): View
    {
        $staff = User::withCount('credentials')
            ->withCount(['credentials as expired_count' => function ($query) {
                $query->where('expires_at', '<', now());
            }])
            ->get();

        $expiringAlerts = StaffCredentials::with('user')
            ->where('expires_at', '<=', now()->addDays(30))
            ->where('expires_at', '>=', now())
            ->get();

        $expiredCount = StaffCredentials::where('expires_at', '<', now())->count();

        return view('admin.credentialing', compact('staff', 'expiringAlerts', 'expiredCount'));
    }

    /**
     * Retrieve Institutional Staff Credential Profile
     */
    public function getStaffProfile(string $userId): JsonResponse
    {
        $user = User::findOrFail($userId);
        $credentials = StaffCredentials::where('user_id', $userId)
            ->orderBy('expires_at')
            ->get();

        return response()->json([
            'user' => $user,
            'credentials' => $credentials
        ]);
    }

    /**
     * Authorize Institutional Credential Enrollment
     */
    public function addCredential(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'type' => 'required|string',
            'number' => 'required|string',
            'issuing_body' => 'required|string',
            'issued_date' => 'required|date',
            'expires_at' => 'required|date',
        ]);

        $credential = StaffCredentials::create([
            'user_id' => $validated['user_id'],
            'credential_type' => $validated['type'],
            'credential_number' => $validated['number'],
            'issuing_body' => $validated['issuing_body'],
            'issued_date' => $validated['issued_date'],
            'expires_at' => $validated['expires_at'],
            'status' => 'active',
            'added_by' => auth()->id(),
        ]);

        Opeshis::logAction('CRED_ADD', 'staff_credentials', $credential->id, "Protocol: Personnel credential established: {$validated['type']}.");
        
        return redirect()->back()->with('success', 'Institutional credential record established.');
    }

    /**
     * Authorize Institutional Credential Update Protocol
     */
    public function updateCredential(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'number' => 'required|string',
            'expires_at' => 'required|date',
            'status' => 'required|string',
        ]);

        StaffCredentials::findOrFail($id)->update([
            'credential_number' => $validated['number'],
            'expires_at' => $validated['expires_at'],
            'status' => $validated['status'],
            'updated_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional credential profile updated.');
    }

    /**
     * Acknowledge Institutional Credential Alert
     */
    public function acknowledgeAlert(Request $request, string $id): RedirectResponse
    {
        StaffCredentials::findOrFail($id)->update([
            'alert_acknowledged_at' => now(),
            'acknowledged_by' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Institutional alert acknowledged.');
    }

    /**
     * Authorize Institutional Expiry Audit
     */
    public function runExpiryCheck(): RedirectResponse
    {
        $count = StaffCredentials::where('expires_at', '<=', now()->addDays(30))->count();
        Opeshis::logAction('CRED_EXPIRY_CHECK', 'staff_credentials', null, "Protocol: Institutional expiry audit complete. Alerts: {$count}.");
        
        return redirect()->back()->with('success', "Institutional audit complete: {$count} credentials flagged.");
    }
}

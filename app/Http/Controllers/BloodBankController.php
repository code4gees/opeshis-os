<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodBankInventory;
use App\Models\BloodBankDonor;
use App\Models\BloodTransfusion;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BloodBankController extends Controller
{
    /**
     * Institutional Hematology & Blood Bank Control
     */
    public function index(): View
    {
        $stats = [
            'total_units' => BloodBankInventory::where('status', 'available')->count(),
            'donors' => BloodBankDonor::count(),
            'transfusions_mtd' => BloodTransfusion::whereMonth('created_at', now()->month)->count(),
        ];

        $stock = BloodBankInventory::select('blood_group', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->where('status', 'available')
            ->groupBy('blood_group')
            ->get();

        return view('clinical.bloodbank', compact('stats', 'stock'));
    }

    /**
     * Authorize Institutional Donor Enrollment
     */
    public function enrollDonor(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'blood_group' => 'required|string',
            'contact' => 'required|string',
        ]);

        $donor = BloodBankDonor::create($validated);

        Opeshis::logAction('BLOOD_DONOR_ENROLL', 'blood_bank_donors', $donor->id, "Protocol: Blood donor enrolled.");
        
        return redirect()->back()->with('success', 'Institutional donor enrollment authorized.');
    }

    /**
     * Commit Institutional Blood Unit Log
     */
    public function addUnit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'blood_group' => 'required|string',
            'units' => 'required|integer',
        ]);

        for ($i = 0; $i < $validated['units']; $i++) {
            BloodBankInventory::create([
                'blood_group' => $validated['blood_group'],
                'status' => 'available',
            ]);
        }

        return redirect()->back()->with('success', "Institutional blood units committed to inventory.");
    }
}

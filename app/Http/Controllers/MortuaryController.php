<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MortuarySlot;
use App\Models\MortuaryAdmission;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class MortuaryController extends Controller
{
    /**
     * Institutional Mortuary Command Hub
     */
    public function index(): View
    {
        $slots = MortuarySlot::orderBy('slot_number', 'asc')->get();
        $admissions = MortuaryAdmission::with(['slot', 'patient'])
            ->where('status', 'admitted')
            ->get();

        return view('mortuary.index', compact('slots', 'admissions'));
    }

    /**
     * Authorize Deceased Admission Protocol
     */
    public function admit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'deceased_name' => ['required', 'string'],
            'slot_id' => ['required', 'uuid', 'exists:mortuary_slots,id'],
            'date_of_death' => ['required', 'date'],
            'patient_id' => ['nullable', 'uuid'],
            'cause_of_death' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated) {
            $admission = MortuaryAdmission::create([
                'patient_id' => $validated['patient_id'],
                'deceased_name' => $validated['deceased_name'],
                'slot_id' => $validated['slot_id'],
                'date_of_death' => $validated['date_of_death'],
                'date_of_admission' => now(),
                'cause_of_death' => $validated['cause_of_death'],
                'status' => 'admitted',
                'admitted_by' => auth()->id(),
            ]);

            MortuarySlot::where('id', $validated['slot_id'])->update(['status' => 'Occupied']);
            
            Opeshis::logAction('MORTUARY_ADMIT', 'mortuary_admissions', $admission->id, $validated['deceased_name']);
        });

        return redirect()->back()->with('success', 'Institutional admission protocol finalized.');
    }

    /**
     * Authorize Deceased Release Protocol
     */
    public function release(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'released_to_name' => ['required', 'string'],
            'released_to_id_number' => ['nullable', 'string'],
        ]);

        $admission = MortuaryAdmission::findOrFail($id);

        DB::transaction(function () use ($admission, $validated) {
            $admission->update([
                'released_to_name' => $validated['released_to_name'],
                'released_to_id_number' => $validated['released_to_id_number'],
                'release_date' => now(),
                'status' => 'released',
                'completed_by' => auth()->id(),
            ]);

            $admission->slot()->update(['status' => 'Vacant']);
            
            Opeshis::logAction('MORTUARY_RELEASE', 'mortuary_admissions', $admission->id, $admission->deceased_name);
        });

        return redirect()->back()->with('success', 'Institutional release protocol authorized.');
    }
}

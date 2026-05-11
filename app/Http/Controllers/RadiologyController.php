<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RadiologyOrder;
use App\Models\RadiologyCatalog;
use App\Models\User;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RadiologyController extends Controller
{
    /**
     * Institutional Radiology Command Center
     */
    public function index(Request $request): View
    {
        $tab = $request->query('subtab', 'pending');
        
        $data = [
            'tab' => $tab,
            'catalog' => Cache::remember('sys_radiology_catalog', 3600, function() {
                return RadiologyCatalog::orderBy('category')->orderBy('name')->get();
            }),
            'technicians' => User::orderBy('name')->get(),
        ];

        if ($tab === 'pending') {
            $data['orders'] = RadiologyOrder::with(['patient', 'doctor'])
                ->where('status', 'pending')
                ->orderBy('ordered_at', 'asc')
                ->get();

        } elseif ($tab === 'archive') {
            $data['orders'] = RadiologyOrder::with(['patient', 'doctor', 'radiologist'])
                ->where('status', 'completed')
                ->orderBy('completed_at', 'desc')
                ->limit(50)
                ->get();
        }

        return view('radiology', $data);
    }

    /**
     * Handle Radiology Actions Protocol
     */
    public function action(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'action' => ['required', 'string', 'in:submit_result'],
            'order_id' => ['required', 'uuid', 'exists:radiology_orders,id'],
            'findings' => ['required', 'string'],
            'impression' => ['required', 'string'],
            'scan_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,dcm', 'max:10240'],
            'technician_id' => ['nullable', 'uuid', 'exists:users,id']
        ]);

        $user_id = auth()->id();

        try {
            if ($validated['action'] === 'submit_result') {
                $imageUrl = '';

                if ($request->hasFile('scan_file')) {
                    $path = $request->file('scan_file')->store('radiology', 'public');
                    $imageUrl = '/storage/' . $path;
                }

                RadiologyOrder::findOrFail($validated['order_id'])->update([
                    'findings' => $validated['findings'],
                    'impression' => $validated['impression'],
                    'image_url' => $imageUrl,
                    'status' => 'completed',
                    'completed_at' => now(),
                    'radiologist_id' => $user_id,
                    'technician_id' => $validated['technician_id'] ?? $user_id
                ]);

                return redirect()->route('operations.diagnostics.radiology.index', ['subtab' => 'archive'])->with('success', 'Institutional radiology report finalized.');
            }
            
            } catch (\Exception $e) {
            return redirect()->route('operations.diagnostics.radiology.index', ['subtab' => 'pending'])->with('error', $e->getMessage());
        }

        return redirect()->route('operations.diagnostics.radiology.index');
    }

    /**
     * Quick Order Imaging (with Automated Billing Integration)
     */
    public function quickOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => ['required'], // Support UUID or Medical ID
            'test_name' => ['required', 'string', 'max:100'],
            'indications' => ['nullable', 'string']
        ]);

        try {
            // Resolve Institutional Identity
            $patient = \App\Models\Patient::where('id', $request->patient_id)
                ->orWhere('medical_id', $request->patient_id)
                ->firstOrFail();

            DB::transaction(function () use ($validated, $patient) {
                $order = RadiologyOrder::create([
                    'patient_id' => $patient->id,
                    'doctor_id' => auth()->id(),
                    'test_name' => $validated['test_name'],
                    'status' => 'pending',
                    'ordered_at' => now(),
                    'indications' => $validated['indications'] ?? null
                ]);

                Opeshis::logAction('RAD_ORDER', 'radiology_orders', $order->id, "Protocol: Ordered {$validated['test_name']} for patient.");

                // Dispatch institutional event for background billing integration
                \App\Events\RadiologyOrderCompleted::dispatch($patient->id, $validated['test_name']);
            });

            return redirect()->route('operations.diagnostics.radiology.index')->with('success', "Institutional imaging order for {$validated['test_name']} finalized.");
        } catch (\Exception $e) {
            return redirect()->route('operations.diagnostics.radiology.index')->with('error', $e->getMessage());
        }
    }
}

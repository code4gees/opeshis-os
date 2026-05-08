<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DietaryPlans;
use App\Models\KitchenDeliveries;
use App\Models\Admission;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DietaryController extends Controller
{
    /**
     * Institutional Dietary & Nutrition Dashboard
     */
    public function index(): View
    {
        $activePlans = DietaryPlans::with(['admission.patient', 'deliveries' => function($query) {
                $query->whereDate('delivery_date', now());
            }])
            ->whereHas('admission', function($query) {
                $query->where('status', 'admitted');
            })
            ->get();

        return view('dietary.index', compact('activePlans'));
    }

    /**
     * Authorize Institutional Dietary Plan Protocol
     */
    public function storePlan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'admission_id' => 'required|exists:admissions,id',
            'meal_type' => 'required|string',
            'restrictions' => 'nullable|string',
            'instructions' => 'nullable|string',
        ]);

        DietaryPlans::create([
            'admission_id' => $validated['admission_id'],
            'meal_type' => $validated['meal_type'],
            'restrictions' => $validated['restrictions'],
            'instructions' => $validated['instructions'],
            'prescribed_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional dietary plan authorized.');
    }

    /**
     * Commit Institutional Meal Delivery Log
     */
    public function logDelivery(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:dietary_plans,id',
            'meal_name' => 'required|string',
            'status' => 'nullable|string',
        ]);

        KitchenDeliveries::create([
            'plan_id' => $validated['plan_id'],
            'delivery_date' => now()->toDateString(),
            'meal_name' => $validated['meal_name'],
            'meal_status' => $validated['status'] ?? 'delivered',
            'delivered_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Institutional meal delivery protocol committed.');
    }
}

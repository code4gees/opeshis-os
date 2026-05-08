<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FleetVehicles;
use App\Models\FleetTrips;
use App\Models\FleetRequests;
use App\Models\FleetFuel;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FleetController extends Controller
{
    /**
     * Institutional Fleet & Logistics Dashboard
     */
    public function index(): View
    {
        $fleet = FleetVehicles::orderBy('registration')->get();
        
        $trips = FleetTrips::with('vehicle')
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        $requests = FleetRequests::where('status', 'pending')->get();
        
        $fuelStats = FleetFuel::selectRaw('sum(litres) as total_litres, sum(cost) as total_cost')
            ->whereDate('created_at', '>=', now()->startOfMonth())
            ->first();

        return view('ops.fleet', compact('fleet', 'trips', 'requests', 'fuelStats'));
    }

    /**
     * Authorize Institutional Trip Protocol
     */
    public function logTrip(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|uuid|exists:fleet_vehicles,id',
            'driver' => 'required|string',
            'purpose' => 'required|string',
            'departure_km' => 'required|numeric',
            'destination' => 'required|string',
            'departed_at' => 'required|date',
        ]);

        $trip = FleetTrips::create([
            'vehicle_id' => $validated['vehicle_id'],
            'driver_name' => $validated['driver'],
            'purpose' => $validated['purpose'],
            'departure_km' => $validated['departure_km'],
            'destination' => $validated['destination'],
            'departed_at' => $validated['departed_at'],
            'status' => 'in_progress',
            'logged_by' => auth()->id(),
        ]);

        FleetVehicles::findOrFail($validated['vehicle_id'])->update(['status' => 'on_trip']);

        Opeshis::logAction('FLEET_TRIP_LOG', 'fleet_trips', $trip->id, "Protocol: Fleet trip initiated.");

        return redirect()->back()->with('success', 'Institutional trip protocol authorized.');
    }

    /**
     * Authorize Institutional Trip Completion
     */
    public function completeTrip(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'return_km' => 'required|numeric',
        ]);

        $trip = FleetTrips::findOrFail($id);
        
        $trip->update([
            'return_km' => $validated['return_km'],
            'distance_covered' => $validated['return_km'] - $trip->departure_km,
            'returned_at' => now(),
            'status' => 'completed',
        ]);

        FleetVehicles::findOrFail($trip->vehicle_id)->update([
            'status' => 'available',
            'current_km' => $validated['return_km']
        ]);

        return redirect()->back()->with('success', 'Institutional trip protocol completed.');
    }

    /**
     * Authorize Institutional Fleet Request
     */
    public function createRequest(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'purpose' => 'required|string',
            'destination' => 'required|string',
            'required_date' => 'required|date',
            'passengers' => 'required|integer',
        ]);

        FleetRequests::create([
            'requested_by' => auth()->id(),
            'purpose' => $validated['purpose'],
            'destination' => $validated['destination'],
            'required_date' => $validated['required_date'],
            'passengers' => $validated['passengers'],
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Institutional fleet request submitted.');
    }

    /**
     * Commit Institutional Fuel Log
     */
    public function logFuel(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|uuid|exists:fleet_vehicles,id',
            'litres' => 'required|numeric',
            'cost' => 'required|numeric',
            'odometer' => 'required|numeric',
        ]);

        FleetFuel::create([
            'vehicle_id' => $validated['vehicle_id'],
            'litres' => $validated['litres'],
            'cost' => $validated['cost'],
            'odometer' => $validated['odometer'],
            'recorded_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Institutional fuel log committed.');
    }
}

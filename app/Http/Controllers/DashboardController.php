<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\Patient;
use App\Models\ActiveQueue;
use App\Models\Appointment;
use App\Models\Admission;
use App\Models\LabOrder;
use App\Models\RadiologyOrder;
use App\Models\Prescription;
use App\Models\BillingInvoice;
use App\Models\Inventory;
use App\Models\Ward;
use App\Models\LabOrderItem;
use App\Models\MedicalRecord;

class DashboardController extends Controller
{
    /**
     * Show the Central Command Hub
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Institutional Smart Redirection Gateway
        if ($user->hasPermission('module_admin') && !$request->has('force_dashboard')) {
            return redirect()->route('admin.index');
        }

        if ($user->hasPermission('module_pharmacy') && !$user->hasPermission('module_clinical') && !$request->has('force_dashboard')) {
            return redirect()->route('operations.diagnostics.pharmacy.index');
        }

        if ($user->hasPermission('module_lab') && !$user->hasPermission('module_clinical') && !$request->has('force_dashboard')) {
            return redirect()->route('operations.diagnostics.lab.index');
        }
        
        $user_id = $user->id;

        // Cache only the DATA — never cache a View object (Closures are not serializable)
        $data = Cache::remember("dashboard_telemetry_{$user_id}", now()->addMinutes(5), function () use ($user_id) {

            $stats = [
                'total_patients'     => Patient::count(),
                'active_visits'      => ActiveQueue::where('status', '!=', 'completed')->count(),
                'appointments_today' => Appointment::whereDate('appointment_date', now()->toDateString())->count(),
                'pending_radiology'  => RadiologyOrder::where('status', 'pending')->count(),
                'pharmacy_orders'    => Prescription::where('status', 'pending')->count(),
                'revenue_today'      => BillingInvoice::whereDate('updated_at', now()->toDateString())->where('status', 'paid')->sum('total_amount') ?: 0,
                'low_stock_items'    => Inventory::where('stock_level', '<', 10)->count(),
                'kiosk_vitals_today' => ActiveQueue::whereDate('created_at', now()->toDateString())->where('vitals_data->source', 'kiosk')->count(),
            ];

            $myAppointments = Appointment::with('patient')
                ->where('doctor_id', $user_id)
                ->whereDate('appointment_date', now()->toDateString())
                ->whereIn('status', ['scheduled', 'confirmed'])
                ->get();

            $myInpatients = Admission::with(['patient', 'bed.ward'])
                ->where('status', 'admitted')->get();

            // Resolve to plain stdClass — Closures in map() cannot be serialized to file cache
            $bioSignals = LabOrderItem::with(['order.patient', 'test'])
                ->whereIn('flag', ['High', 'Low', 'Critical', 'Abnormal'])
                ->orderBy('created_at', 'desc')->limit(5)->get()
                ->map(fn($item) => (object)[
                    'full_name'    => optional(optional($item->order)->patient)->full_name ?? 'Unknown',
                    'test_name'    => optional($item->test)->name ?? '—',
                    'result_value' => $item->result_value,
                    'flag'         => $item->flag,
                ])->toArray();

            $patientTrend = Patient::select(DB::raw("DATE(created_at) as date"), DB::raw("COUNT(*) as count"))
                ->where('created_at', '>=', now()->subDays(7))
                ->groupBy('date')->orderBy('date')->get();

            $revenueTrend = BillingInvoice::select(DB::raw("DATE(updated_at) as date"), DB::raw("SUM(total_amount) as total"))
                ->where('updated_at', '>=', now()->subDays(7))->where('status', 'paid')
                ->groupBy('date')->orderBy('date')->get();

            // Resolve withCount to stdClass — Closures cannot be serialized
            $wardOccupancy = Ward::withCount([
                'beds',
                'beds as occupied_beds_count' => fn($q) => $q->where('status', 'occupied'),
            ])->get()->map(fn($w) => (object)[
                'name'                => $w->name,
                'beds_count'          => $w->beds_count,
                'occupied_beds_count' => $w->occupied_beds_count,
            ])->toArray();

            $recent_patients = Patient::orderBy('created_at', 'desc')->limit(5)->get();

            $active_queue = ActiveQueue::with('patient')
                ->where('status', '!=', 'completed')
                ->orderBy('created_at', 'desc')->limit(10)->get();

            $morbidityPulse = MedicalRecord::select('diagnosis', DB::raw("COUNT(*) as count"))
                ->whereNotNull('diagnosis')->groupBy('diagnosis')
                ->orderBy('count', 'desc')->limit(5)->get();

            $auditLogs = \App\Models\AuditLog::with('user')
                ->orderBy('created_at', 'desc')->limit(5)->get();

            $systemAlerts = [
                ['type' => 'security', 'message' => 'Zero-Trust Protocol Active', 'time' => '1m ago'],
                ['type' => 'clinical', 'message' => 'ICU Capacity at 85%',         'time' => '12m ago'],
                ['type' => 'supply',   'message' => 'Blood Bank: O+ Low Stock',    'time' => '45m ago'],
            ];

            return compact(
                'stats', 'recent_patients', 'active_queue', 'patientTrend',
                'revenueTrend', 'wardOccupancy', 'myAppointments', 'myInpatients',
                'bioSignals', 'morbidityPulse', 'auditLogs', 'systemAlerts'
            );
        });

        // Render view OUTSIDE the cache block — View objects contain Closures and cannot be serialized
        return view('dashboard', $data);
    }
}

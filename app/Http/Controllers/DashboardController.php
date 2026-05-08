<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function index()
    {
        $user_id = auth()->id();

        // Institutional Telemetry Caching (Neural Link Synchronization)
        return \Illuminate\Support\Facades\Cache::remember(
            "dashboard_telemetry_{$user_id}",
            now()->addMinutes(5),
            function () use ($user_id) {
                $stats = [
                    'total_patients' => Patient::count(),
                    'active_visits' => ActiveQueue::where('status', '!=', 'completed')->count(),
                    'appointments_today' => Appointment::whereDate('appointment_date', now()->toDateString())->count(),
                    'active_admissions' => Admission::where('status', 'admitted')->count(),
                    'pending_labs' => LabOrder::where('status', 'pending')->count(),
                    'pending_radiology' => RadiologyOrder::where('status', 'pending')->count(),
                    'pharmacy_orders' => Prescription::where('status', 'pending')->count(),
                    'revenue_today' => BillingInvoice::whereDate('updated_at', now()->toDateString())->where('status', 'paid')->sum('total_amount') ?: 0,
                    'low_stock_items' => Inventory::where('stock_level', '<', 10)->count(), 
                ];

                // My Appointments Today
                $myAppointments = Appointment::with('patient')
                    ->where('doctor_id', $user_id)
                    ->whereDate('appointment_date', now()->toDateString())
                    ->whereIn('status', ['scheduled', 'confirmed'])
                    ->get();

                // My Active Inpatients
                $myInpatients = Admission::with(['patient', 'bed.ward'])
                    ->where('status', 'admitted')
                    ->get();

                // Lab/Radiology Alerts (Critical Results)
                $bioSignals = LabOrderItem::with(['order.patient', 'test'])
                    ->whereIn('flag', ['High', 'Low', 'Critical', 'Abnormal'])
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                        ->get()
                        ->map(fn($item) => (object)[
                            'full_name' => $item->order->patient->full_name,
                            'test_name' => $item->test->name,
                            'result_value' => $item->result_value,
                            'flag' => $item->flag
                        ]);

                // Chart: Patient Enrollment Trend (Last 7 Days)
                $patientTrend = Patient::select(DB::raw("DATE(created_at) as date"), DB::raw("COUNT(*) as count"))
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

                // Chart: Revenue Pulse (Last 7 Days)
                $revenueTrend = BillingInvoice::select(DB::raw("DATE(updated_at) as date"), DB::raw("SUM(total_amount) as total"))
                    ->where('updated_at', '>=', now()->subDays(7))
                    ->where('status', 'paid')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

                // Ward Census (New Infrastructure)
                $wardOccupancy = Ward::withCount(['beds', 'beds as occupied_beds' => function($query) {
                    $query->where('status', 'occupied');
                }])->get();

                $recent_patients = Patient::orderBy('created_at', 'desc')->limit(5)->get();

                $active_queue = ActiveQueue::with('patient')
                    ->where('status', '!=', 'completed')
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get();

                // Morbidity Pulse: Top 5 Diagnoses
                $morbidityPulse = MedicalRecord::select('diagnosis', DB::raw("COUNT(*) as count"))
                    ->whereNotNull('diagnosis')
                    ->groupBy('diagnosis')
                    ->orderBy('count', 'desc')
                    ->limit(5)
                    ->get();

                // Institutional Forensic Pulse: Recent Audit Logs
                $auditLogs = \App\Models\AuditLog::with('user')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

                // System Alerts / Notifications
                $systemAlerts = [
                    ['type' => 'security', 'message' => 'Zero-Trust Protocol Active', 'time' => '1m ago'],
                    ['type' => 'clinical', 'message' => 'ICU Capacity at 85%', 'time' => '12m ago'],
                    ['type' => 'supply', 'message' => 'Blood Bank: O+ Low Stock', 'time' => '45m ago'],
                ];

                return view('dashboard', compact(
                    'stats', 
                    'recent_patients', 
                    'active_queue', 
                    'patientTrend', 
                    'revenueTrend', 
                    'wardOccupancy', 
                    'myAppointments', 
                    'myInpatients', 
                    'bioSignals',
                    'morbidityPulse',
                    'auditLogs',
                    'systemAlerts'
                ));
            }
        );
    }
}

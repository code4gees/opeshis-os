<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
use App\Models\ActiveQueue;
use App\Models\Appointment;
use App\Models\Admission;
use App\Models\BillingInvoice;
use App\Models\LabOrder;
use App\Models\RadiologyOrder;
use App\Models\Prescription;
use App\Models\Inventory;

class DashboardStats extends Component
{
    public $stats = [];

    public function mount()
    {
        $this->refreshStats();
    }

    public function refreshStats()
    {
        $this->stats = [
            'active_visits' => ActiveQueue::where('status', '!=', 'completed')->count(),
            'appointments_today' => Appointment::whereDate('appointment_date', now()->toDateString())->count(),
            'active_admissions' => Admission::where('status', 'admitted')->count(),
            'pending_labs' => LabOrder::where('status', 'pending')->count(),
            'pending_radiology' => RadiologyOrder::where('status', 'pending')->count(),
            'pharmacy_orders' => Prescription::where('status', 'pending')->count(),
            'revenue_today' => BillingInvoice::whereDate('updated_at', now()->toDateString())->where('status', 'paid')->sum('total_amount') ?: 0,
            'low_stock_items' => Inventory::where('stock_level', '<', 10)->count(),
        ];
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}

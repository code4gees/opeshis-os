<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vitals;
use Illuminate\Support\Collection;

class VitalsMonitor extends Component
{
    public string $patientId;
    public Collection $vitals;

    public function mount(string $patientId)
    {
        $this->patientId = $patientId;
        $this->refreshVitals();
    }

    public function refreshVitals()
    {
        $this->vitals = Vitals::where('patient_id', $this->patientId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.vitals-monitor');
    }
}

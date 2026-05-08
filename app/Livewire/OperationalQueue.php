<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ActiveQueue;

class OperationalQueue extends Component
{
    public $queue = [];

    public function mount()
    {
        $this->refreshQueue();
    }

    public function refreshQueue()
    {
        $this->queue = ActiveQueue::with('patient')
            ->where('status', '!=', 'completed')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.operational-queue');
    }
}

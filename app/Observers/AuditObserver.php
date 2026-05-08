<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditObserver
{
    /**
     * Handle the Model "created" event.
     */
    public function created($model): void
    {
        $this->logAction($model, 'CREATE');
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated($model): void
    {
        $this->logAction($model, 'UPDATE');
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted($model): void
    {
        $this->logAction($model, 'DELETE');
    }

    /**
     * Log the action to the institutional forensic trail.
     */
    protected function logAction($model, string $actionType): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => $actionType . '_' . strtoupper($model->getTable()),
            'table_name' => $model->getTable(),
            'record_id' => $model->id,
            'details' => json_encode($model->getDirty()),
            'ip_address' => Request::ip(),
        ]);
    }
}

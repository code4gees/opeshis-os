<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CapaAction extends Model
{
    use HasUuids;
    protected $table = 'capa_actions';
    protected $guarded = [];

    public function incident()
    {
        return $this->belongsTo(IncidentReport::class, 'incident_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
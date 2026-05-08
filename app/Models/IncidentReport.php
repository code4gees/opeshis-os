<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class IncidentReport extends Model
{
    use HasUuids;

    protected $fillable = [
        'incident_type', 
        'date_of_incident', 
        'location', 
        'description', 
        'immediate_action', 
        'severity', 
        'status', 
        'reported_by',
        'root_cause',
        'corrective_action',
        'investigated_by',
        'investigated_at'
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function investigator()
    {
        return $this->belongsTo(User::class, 'investigated_by');
    }
}
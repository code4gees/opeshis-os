<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NCDMetric extends Model
{
    use HasUuids;

    protected $table = 'ncd_metrics';

    protected $fillable = [
        'patient_id',
        'metric_type',
        'metric_value',
        'metric_unit',
        'noted_by',
        'measured_at'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'noted_by');
    }
}

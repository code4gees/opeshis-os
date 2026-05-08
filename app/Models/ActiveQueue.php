<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ActiveQueue extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'active_queue';

    protected $fillable = [
        'patient_id',
        'room_id',
        'assigned_doctor_id',
        'intent',
        'pre_check_data',
        'status',
        'complaint_data',
        'vitals_data',
        'is_nurse_validated',
        'branch_id'
    ];

    protected $casts = [
        'pre_check_data' => 'array',
        'complaint_data' => 'array',
        'vitals_data' => 'array',
        'is_nurse_validated' => 'boolean',
    ];

    /**
     * Institutional PII Protection
     */
    protected function complaintData(): Attribute { return $this->castPII('complaint_data'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'assigned_doctor_id');
    }
}

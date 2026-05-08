<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NCDRegistry extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'ncd_registry';

    protected $fillable = [
        'patient_id',
        'condition_type',
        'enrolled_by',
        'status'
    ];

    protected function conditionType(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('condition_type'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function metrics()
    {
        return $this->hasMany(NCDMetric::class, 'patient_id', 'patient_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'enrolled_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VitalsRecord extends Model
{
    use HasUuids;

    const CREATED_AT = 'recorded_at';
    const UPDATED_AT = null;

    protected $fillable = [
        'admission_id',
        'round_id',
        'temp',
        'pulse',
        'respiratory_rate',
        'bp_sys',
        'bp_dia',
        'spo2',
        'news2_score',
        'risk_level',
        'recorded_by',
        'recorded_at'
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function round()
    {
        return $this->belongsTo(NursingRound::class, 'round_id');
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}

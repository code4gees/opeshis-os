<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TheatreVital extends Model
{
    use HasUuids;

    protected $table = 'theatre_vitals';

    protected $fillable = [
        'case_id',
        'bp_systolic',
        'bp_diastolic',
        'heart_rate',
        'spo2',
        'etco2',
        'temperature',
        'recorded_by'
    ];

    public function case()
    {
        return $this->belongsTo(TheatreCase::class, 'case_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}

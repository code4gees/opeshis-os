<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaedsGrowth extends Model
{
    use HasUuids;

    protected $table = 'paeds_growth_records';

    protected $fillable = [
        'admission_id',
        'weight_kg',
        'height_cm',
        'head_circumference_cm',
        'muac_cm',
        'recorded_by'
    ];

    public function admission()
    {
        return $this->belongsTo(PaedsAdmission::class, 'admission_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}

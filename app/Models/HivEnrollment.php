<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HivEnrollment extends Model
{
    use HasUuids;
    protected $table = 'hiv_enrollments';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function currentRegimen()
    {
        return $this->hasOne(HivArtRecord::class, 'enrollment_id')->whereNull('end_date');
    }

    public function latestViralLoad()
    {
        return $this->hasOne(HivVlRecord::class, 'enrollment_id')
            ->where('test_type', 'VIRAL_LOAD')
            ->latestOfMany('test_date');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

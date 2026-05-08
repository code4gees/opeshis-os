<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class IcuSofaScore extends Model
{
    use HasUuids;

    protected $table = 'icu_sofa_scores';

    protected $fillable = [
        'admission_id',
        'respiratory',
        'coagulation',
        'liver',
        'cardiovascular',
        'cns',
        'renal',
        'total_score',
        'recorded_by'
    ];

    public function admission()
    {
        return $this->belongsTo(IcuAdmission::class, 'admission_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}

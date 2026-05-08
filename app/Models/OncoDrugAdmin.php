<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OncoDrugAdmin extends Model
{
    use HasUuids;

    protected $table = 'onco_drug_administrations';

    protected $fillable = [
        'plan_id',
        'drug_name',
        'dose',
        'unit',
        'route',
        'cycle_number',
        'administered_by',
        'administered_at'
    ];

    public function plan()
    {
        return $this->belongsTo(OncoTreatmentPlan::class, 'plan_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'administered_by');
    }
}

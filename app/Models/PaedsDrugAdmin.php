<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaedsDrugAdmin extends Model
{
    use HasUuids;

    protected $table = 'paeds_drug_administrations';

    protected $fillable = [
        'admission_id',
        'drug_name',
        'dose',
        'route',
        'administered_by',
        'administered_at'
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'administered_by');
    }
}

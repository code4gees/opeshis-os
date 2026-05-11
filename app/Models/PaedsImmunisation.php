<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaedsImmunisation extends Model
{
    use HasUuids;

    protected $table = 'paeds_immunisations';

    protected $fillable = [
        'admission_id',
        'vaccine',
        'dose_number',
        'batch_no',
        'site',
        'administered_by'
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

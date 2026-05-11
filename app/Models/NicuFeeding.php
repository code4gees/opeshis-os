<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NicuFeeding extends Model
{
    use HasUuids;

    protected $table = 'nicu_feeding_log';
    protected $guarded = [];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }
}

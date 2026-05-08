<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HduAdmission extends Model
{
    use HasUuids;

    protected $table = 'hdu_admissions';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function vitals()
    {
        return $this->hasMany(HduVital::class, 'admission_id');
    }

    public function latestVital()
    {
        return $this->hasOne(HduVital::class, 'admission_id')->latestOfMany();
    }
}

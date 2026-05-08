<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FpClient extends Model
{
    use HasUuids;

    protected $table = 'fp_clients';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function methods()
    {
        return $this->hasMany(FpMethod::class, 'client_id');
    }

    public function visits()
    {
        return $this->hasMany(FpVisit::class, 'client_id');
    }

    public function currentMethod()
    {
        return $this->hasOne(FpMethod::class, 'client_id')->where('active', true);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BillingItem extends Model
{
    use HasUuids;
    protected $table = 'billing_items';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}

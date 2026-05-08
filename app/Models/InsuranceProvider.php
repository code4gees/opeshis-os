<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class InsuranceProvider extends Model
{
    use HasUuids;

    protected $table = 'insurance_providers';

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'status',
        'default_co_pay_rate'
    ];

    public function invoices()
    {
        return $this->hasMany(BillingInvoice::class, 'provider_id');
    }
}

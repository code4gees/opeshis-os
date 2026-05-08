<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BillingInvoice extends Model
{
    use HasUuids;

    protected $table = 'billing_invoices';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'provider_id',
        'invoice_number',
        'total_amount',
        'patient_due_amount',
        'insurance_due_amount',
        'status',
        'payment_method',
        'claim_status',
        'claim_reference'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function provider()
    {
        return $this->belongsTo(InsuranceProvider::class, 'provider_id');
    }

    public function encounter()
    {
        return $this->belongsTo(OpdEncounter::class, 'visit_id');
    }

    public function logs()
    {
        return $this->hasMany(AuditLog::class, 'record_id');
    }
}

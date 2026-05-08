<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Models\BillingInvoice;
use App\Models\Prescription;
use App\Models\LabOrder;
use App\Helpers\MedicalEngine;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;

class ProcessInvoicePaymentAction
{
    /**
     * Authorize Institutional Financial Settlement Protocol
     */
    public function execute(string $invoiceId, string $method): void
    {
        DB::transaction(function() use ($invoiceId, $method) {
            $inv = BillingInvoice::findOrFail($invoiceId);
            
            if ($inv->provider_id) {
                $split = MedicalEngine::calculateCoPay($inv->provider_id, $inv->total_amount);
                $inv->update([
                    'patient_due_amount' => $split['patient'],
                    'insurance_due_amount' => $split['insurance']
                ]);
            }

            $inv->update([
                'status' => 'paid',
                'payment_method' => $method,
            ]);
            
            Prescription::where('visit_id', $inv->visit_id)->update(['status' => 'paid']);
            LabOrder::where('visit_id', $inv->visit_id)->update(['status' => 'paid']);

            Opeshis::logAction(
                'BILLING_PAYMENT',
                'billing_invoices',
                $inv->id,
                "Institutional Settlement: {$method}. Amount: {$inv->patient_due_amount}"
            );
        });
    }
}

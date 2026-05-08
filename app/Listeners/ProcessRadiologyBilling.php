<?php

namespace App\Listeners;

use App\Events\RadiologyOrderCompleted;
use App\Models\RadiologyCatalog;
use App\Models\BillingInvoice;
use App\Models\BillingItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessRadiologyBilling implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the institutional radiology billing event.
     */
    public function handle(RadiologyOrderCompleted $event): void
    {
        $patientId = $event->patientId;
        $testName = $event->testName;

        DB::transaction(function () use ($patientId, $testName) {
            $price = RadiologyCatalog::where('name', $testName)->value('price') ?: 0;
            
            $invoice = BillingInvoice::where('patient_id', $patientId)
                ->where('status', 'unpaid')
                ->first();

            if (!$invoice) {
                $invoice = BillingInvoice::create([
                    'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
                    'patient_id' => $patientId,
                    'total_amount' => $price,
                    'patient_due_amount' => $price,
                    'radiology_fee' => $price,
                    'status' => 'unpaid',
                ]);
            } else {
                $invoice->update([
                    'total_amount' => $invoice->total_amount + $price,
                    'patient_due_amount' => $invoice->patient_due_amount + $price,
                    'radiology_fee' => $invoice->radiology_fee + $price,
                ]);
            }

            BillingItem::create([
                'invoice_id' => $invoice->id,
                'item_type' => 'Radiology',
                'item_name' => $testName,
                'quantity' => 1,
                'unit_price' => $price,
                'total_price' => $price,
            ]);
        });
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Models\BillingInvoice;
use App\Helpers\Opeshis;

class ProcessBillingRefundAction
{
    public function execute(string $id): void
    {
        $invoice = BillingInvoice::findOrFail($id);
        $invoice->update(['status' => 'refunded']);
        Opeshis::logAction('BILLING_REFUND', 'billing_invoices', $id, "Institutional Refund: {$invoice->invoice_number} Processed");
    }
}

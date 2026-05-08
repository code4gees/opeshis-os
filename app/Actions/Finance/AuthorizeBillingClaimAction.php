<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Models\BillingInvoice;
use App\Helpers\Opeshis;

class AuthorizeBillingClaimAction
{
    public function execute(string $invoiceId): void
    {
        BillingInvoice::where('id', $invoiceId)->update(['claim_status' => 'submitted']);
        Opeshis::logAction('BILLING_CLAIM_SUBMIT', 'billing_invoices', $invoiceId, "Institutional Claim Submission Authorized");
    }
}

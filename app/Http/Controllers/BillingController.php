<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillingInvoice;
use App\Models\InsuranceProvider;
use App\Actions\Finance\ProcessInvoicePaymentAction;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BillingController extends Controller
{
    /**
     * Show the Institutional Financial Command Hub
     */
    public function index(Request $request): View
    {
        $tab = $request->query('subtab', 'pending');
        $search = $request->query('search', '');

        $kpis = [
            'patient_unpaid' => BillingInvoice::where('status', 'unpaid')->sum('patient_due_amount'),
            'insurance_unpaid' => BillingInvoice::whereIn('claim_status', ['pending', 'submitted'])->sum('insurance_due_amount'),
            'revenue_today' => BillingInvoice::where(function($q) {
                    $q->where('status', 'paid')->orWhereIn('claim_status', ['paid', 'settled']);
                })->whereDate('updated_at', today())->sum('total_amount'),
        ];

        $data = [
            'tab' => $tab,
            'kpis' => $kpis,
            'search' => $search,
            'allProviders' => InsuranceProvider::orderBy('name')->get(),
        ];

        if ($tab !== 'providers') {
            $query = BillingInvoice::when(auth()->user()->branch_id, function ($query, $branchId) {
                    return $query->whereHas('patient', function ($q) use ($branchId) {
                        $q->where('branch_id', $branchId);
                    });
                })
                ->with(['patient', 'provider']);

            if ($tab === 'pending') {
                $query->where('status', 'unpaid')->orderBy('created_at', 'asc');
            } elseif ($tab === 'insurance') {
                $query->where('claim_status', '!=', 'none')
                      ->whereNotIn('claim_status', ['paid', 'settled'])
                      ->orderBy('created_at', 'asc');
            } else {
                $query->where(function($q) {
                    $q->where('status', 'paid')->orWhereIn('claim_status', ['paid', 'settled']);
                })->orderBy('updated_at', 'desc')->limit(50);
            }

            if ($search) {
                $query->whereHas('patient', function($q) use ($search) {
                    $q->where('full_name', 'like', "%{$search}%")
                      ->orWhere('medical_id', 'like', "%{$search}%");
                });
            }

            $data['invoices'] = $query->get();
        }

        return view('billing', $data);
    }

    /**
     * Handle Institutional Billing Actions Protocol via Action
     */
    public function action(
        Request $request, 
        ProcessInvoicePaymentAction $paymentAction,
        \App\Actions\Finance\AuthorizeBillingClaimAction $claimAction,
        \App\Actions\Finance\AddInsuranceProviderAction $providerAction
    ): RedirectResponse {
        $action = $request->input('action');

        try {
            if ($action === 'pay_invoice') {
                $request->validate([
                    'invoice_id' => 'required|uuid',
                    'payment_method' => 'required|string',
                ]);
                $paymentAction->execute($request->input('invoice_id'), $request->input('payment_method'));
                return redirect()->route('finance.billing.index', ['subtab' => 'pending'])->with('success', 'Institutional patient settlement recorded.');

            } elseif ($action === 'submit_claim') {
                $request->validate(['invoice_id' => 'required|uuid']);
                $claimAction->execute($request->input('invoice_id'));
                return redirect()->route('finance.billing.index', ['subtab' => 'insurance'])->with('success', 'Institutional claim submitted to provider.');

            } elseif ($action === 'add_provider') {
                $validated = $request->validate([
                    'name' => 'required|string',
                    'contact' => 'required|string',
                    'email' => 'required|email',
                    'phone' => 'required|string',
                    'co_pay' => 'nullable|numeric'
                ]);
                $providerAction->execute($validated);
                return redirect()->route('finance.billing.index', ['subtab' => 'providers'])->with('success', 'Institutional insurance provider enrolled.');
            }
        } catch (\Exception $e) {
            return redirect()->route('finance.billing.index', ['subtab' => 'pending'])->with('error', $e->getMessage());
        }

        return redirect()->route('finance.billing.index');
    }

    /**
     * Handle Institutional Invoice Refund Protocol via Action
     */
        try {
            $action->execute($id);
            return redirect()->route('finance.billing.index', ['subtab' => 'history'])->with('success', 'Institutional refund successfully processed.');
        } catch (\Exception $e) {
            return redirect()->route('finance.billing.index', ['subtab' => 'history'])->with('error', $e->getMessage());
        }

    /**
     * Institutional Payment Reconciliation Hub
     */
    public function reconcile(): View
    {
        $mismatches = BillingInvoice::where('status', 'paid')
            ->whereDoesntHave('logs', function($q) {
                $q->where('action', 'BILLING_PAYMENT');
            })
            ->get();

        return view('ops.reconciliation', compact('mismatches'));
    }
}

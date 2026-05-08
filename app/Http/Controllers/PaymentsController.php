<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentTransactions;
use App\Models\PaymentProviders;
use App\Models\Patient;
use App\Services\PaymentService;
use App\Helpers\Opeshis;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class PaymentsController extends Controller
{
    /**
     * Institutional Billing & Collections Dashboard
     */
    public function index(): View
    {
        $transactions = PaymentTransactions::with('patient')
            ->orderBy('created_at', 'desc')
            ->take(100)
            ->get();

        $stats = [
            'today_collected' => PaymentTransactions::whereDate('created_at', today())
                ->where('status', 'success')
                ->sum('amount'),
            'pending' => PaymentTransactions::where('status', 'pending')->count(),
        ];

        return view('billing.payments', compact('transactions', 'stats'));
    }

    /**
     * Initiate Institutional Payment Protocol
     */
    public function initiate(Request $request, PaymentService $service): RedirectResponse
    {
        $validated = $request->validate([
            'patient_id' => 'required|uuid|exists:patients,id',
            'amount' => 'required|numeric',
            'phone' => 'required|string',
            'description' => 'nullable|string',
            'currency' => 'nullable|string',
        ]);

        $ref = 'PAY-' . strtoupper(Str::random(10));

        $provider = PaymentProviders::where('is_active', true)->first();
        if (!$provider) {
            return redirect()->back()->with('error', 'No active payment provider configured.');
        }

        $result = $service->initiate($provider->id, (float)$validated['amount'], $validated['phone'], $ref, ['message' => $validated['description']]);

        if ($result['success']) {
            $tx = PaymentTransactions::create([
                'reference' => $ref,
                'patient_id' => $validated['patient_id'],
                'amount' => $validated['amount'],
                'currency' => $validated['currency'] ?? 'XAF',
                'provider' => $provider->display_name,
                'provider_id' => $provider->id,
                'phone_number' => $validated['phone'],
                'description' => $validated['description'],
                'status' => 'pending',
                'provider_reference' => $result['external_id'] ?? null,
                'initiated_by' => auth()->id(),
            ]);

            Opeshis::logAction('PAYMENT_INIT', 'payment_transactions', $tx->id, "{$provider->display_name}: {$validated['amount']}");
            return redirect()->back()->with('success', "Payment initiated via {$provider->display_name}. Ref: {$ref}");
        }

        return redirect()->back()->with('error', "Payment initialization failed: " . ($result['error'] ?? 'Unknown Error'));
    }

    /**
     * Handle Institutional Payment Callback
     */
    public function callback(Request $request): JsonResponse
    {
        Log::info('Payment callback', $request->all());

        $transaction = PaymentTransactions::where('reference', $request->input('reference'))->first();
        if ($transaction) {
            $status = $request->input('status') === 'SUCCESSFUL' ? 'success' : 'failed';
            $transaction->update([
                'status' => $status,
                'provider_reference' => $request->input('provider_reference'),
                'callback_data' => json_encode($request->all()),
                'processed_at' => now(),
            ]);
        }

        return response()->json(['status' => 'received']);
    }

    /**
     * Institutional Payment Reconciliation Protocol
     */
    public function reconcile(Request $request): View
    {
        $unmatched = PaymentTransactions::where('status', 'pending')
            ->where('created_at', '<', now()->subHours(2))
            ->get();

        return view('billing.payment_reconciliation', compact('unmatched'));
    }

    /**
     * Authorize Institutional Refund Protocol
     */
    public function refund(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate(['reason' => 'required|string']);

        PaymentTransactions::findOrFail($id)->update([
            'status' => 'refunded',
            'refund_reason' => $validated['reason'],
            'refunded_by' => auth()->id(),
            'refunded_at' => now(),
        ]);

        Opeshis::logAction('PAYMENT_REFUND', 'payment_transactions', $id, $validated['reason']);
        return redirect()->back()->with('success', 'Institutional refund protocol recorded.');
    }
}

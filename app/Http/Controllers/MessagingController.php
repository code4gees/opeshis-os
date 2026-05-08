<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessagingProviders;
use App\Models\MessageQueue;
use App\Services\MessagingService;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MessagingController extends Controller
{
    /**
     * Institutional Messaging & Communications Hub
     */
    public function index(): View
    {
        $providers = MessagingProviders::where('status', 'active')->get();

        $stats = MessageQueue::selectRaw(
                "COUNT(*) FILTER (WHERE status = 'pending') as pending,
                 COUNT(*) FILTER (WHERE status = 'sent' AND created_at >= CURRENT_DATE) as sent_today,
                 COUNT(*) FILTER (WHERE status = 'failed' AND created_at >= CURRENT_DATE) as failed_today"
            )->first();

        $recent = MessageQueue::with('provider')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('messaging.index', compact('stats', 'recent', 'providers'));
    }

    /**
     * Compose and Dispatch Institutional Message
     */
    public function store(Request $request, MessagingService $messaging): RedirectResponse
    {
        $validated = $request->validate([
            'recipient' => 'required|string',
            'message' => 'required|string',
            'provider_id' => 'required|uuid|exists:messaging_providers,id',
        ]);

        // 1. Queue the message
        $queued = MessageQueue::create([
            'provider_id' => $validated['provider_id'],
            'recipient_phone' => $validated['recipient'],
            'resolved_message' => $validated['message'],
            'channel' => 'SMS',
            'status' => 'pending',
        ]);

        // 2. Immediate Dispatch (In production, this is a background job)
        $result = $messaging->send(
            $validated['provider_id'],
            $validated['recipient'],
            $validated['message']
        );

        // 3. Update status based on dispatch result
        if ($result['success']) {
            $queued->update([
                'status' => 'sent',
                'provider_message_id' => $result['id'],
                'processed_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Message transmitted successfully.');
        }

        $queued->update([
            'status' => 'failed',
            'error_log' => $result['error'],
            'processed_at' => now(),
        ]);
        return redirect()->back()->with('error', 'Transmission failed: ' . $result['error']);
    }
}

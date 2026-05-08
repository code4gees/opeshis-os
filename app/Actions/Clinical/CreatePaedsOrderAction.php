<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsOrder;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\Auth;

class CreatePaedsOrderAction
{
    public function execute(array $data): PaedsOrder
    {
        $order = PaedsOrder::create([
            'admission_id' => $data['admission_id'],
            'order_type' => $data['type'],
            'order_text' => $data['order_text'],
            'priority' => $data['priority'],
            'status' => 'pending',
            'ordered_by' => Auth::id(),
        ]);

        Opeshis::logAction('PAEDS_ORDER', 'paeds_orders', $order->id, "Institutional Order: " . $data['type']);

        return $order;
    }
}

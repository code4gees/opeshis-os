<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\ObstetricsDelivery;
use App\Models\Admission;
use Illuminate\Support\Facades\Auth;

class RecordObstetricsDeliveryAction
{
    public function execute(array $data): ObstetricsDelivery
    {
        $delivery = ObstetricsDelivery::create([
            'admission_id' => $data['admission_id'],
            'delivery_mode' => $data['mode'],
            'baby_weight_kg' => $data['baby_weight'],
            'apgar_1min' => $data['apgar_1'],
            'apgar_5min' => $data['apgar_5'],
            'complications' => $data['complications'] ?? null,
            'delivered_by' => Auth::id(),
            'delivered_at' => now(),
        ]);

        Admission::findOrFail($data['admission_id'])->update(['status' => 'delivered', 'outcome' => 'delivered']);

        return $delivery;
    }
}

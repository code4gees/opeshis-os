<?php

namespace App\Actions\Ops;

use App\Models\Vendor;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\Auth;

class RegisterVendorAction
{
    /**
     * Authorize Institutional Vendor Registration
     */
    public function execute(array $data): Vendor
    {
        $vendor = Vendor::create([
            'name' => $data['name'],
            'contact_person' => $data['contact_person'],
            'email' => $data['email'],
            'status' => 'active',
        ]);
        
        Opeshis::logAction('VENDOR_REGISTER', 'vendors', $vendor->id, "Protocol: Registered new vendor: {$vendor->name}.");
        
        return $vendor;
    }
}

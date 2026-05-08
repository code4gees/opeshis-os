<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SysAsset;
use App\Helpers\Opeshis;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AssetController extends Controller
{
    /**
     * Institutional Asset & Maintenance Control
     */
    public function index(): View
    {
        $assets = SysAsset::orderBy('next_maintenance_date')->get();
        
        $maintenanceAlerts = SysAsset::where('next_maintenance_date', '<=', now()->addDays(7))
            ->where('status', '!=', 'under_maintenance')
            ->get();

        return view('ops.assets', compact('assets', 'maintenanceAlerts'));
    }

    /**
     * Authorize Institutional Maintenance Protocol
     */
    public function recordMaintenance(Request $request, string $id): RedirectResponse
    {
        $asset = SysAsset::findOrFail($id);
        
        $asset->update([
            'status' => $request->input('status', 'operational'),
            'next_maintenance_date' => $request->input('next_date'),
        ]);

        Opeshis::logAction('ASSET_MAINTENANCE', 'sys_assets', $id, "Protocol: Asset maintenance recorded for {$asset->asset_name}.");
        
        return redirect()->back()->with('success', 'Institutional asset maintenance record established.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    /**
     * Show Institutional Global System Settings
     */
    public function index(): View
    {
        $settings = SystemSetting::pluck('setting_value', 'setting_key');
        return view('settings', compact('settings'));
    }

    /**
     * Update Institutional Global Configuration
     */
    public function update(Request $request): RedirectResponse
    {
        $inputs = $request->input('settings', []);
        
        DB::transaction(function() use ($inputs, $request) {
            foreach ($inputs as $key => $value) {
                SystemSetting::updateOrCreate(
                    ['setting_key' => $key],
                    ['setting_value' => $value]
                );
            }

            // Handle File Uploads
            foreach (['hospital_logo', 'hospital_watermark'] as $key) {
                if ($request->hasFile($key)) {
                    $path = $request->file($key)->store('system', 'public');
                    $url = '/storage/' . $path;
                    
                    SystemSetting::updateOrCreate(
                        ['setting_key' => $key],
                        ['setting_value' => $url]
                    );
                }
            }
        });

        return redirect()->route('settings')->with('success', 'Institutional global configuration updated.');
    }
}

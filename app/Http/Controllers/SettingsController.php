<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SysSetting;
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
        $settings = SysSetting::pluck('value', 'key');
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
                SysSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            // Handle File Uploads
            foreach (['hospital_logo', 'hospital_watermark'] as $key) {
                if ($request->hasFile($key)) {
                    $path = $request->file($key)->store('system', 'public');
                    $url = '/storage/' . $path;
                    
                    SysSetting::updateOrCreate(
                        ['key' => $key],
                        ['value' => $url]
                    );
                }
            }
        });

        return redirect()->route('admin.settings.index')->with('success', 'Institutional global configuration updated.');
    }
}

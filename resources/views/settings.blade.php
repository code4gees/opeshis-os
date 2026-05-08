<x-cc-shell title='Opeshis OS'>

@section('title', 'System Settings - Opeshis OS')


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
    
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-slate-800 border border-slate-700/60 rounded-xl p-6 shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-slate-100 tracking-tight">System Settings</h1>
            <p class="text-sm text-slate-400 mt-1">Configure hospital identity, localization, and system-wide preferences.</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center gap-3">
            <span class="text-[10px] font-bold text-blue-500 uppercase tracking-wider">System Version: 2.1.0-Elite</span>
            <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
        </div>
    </header>

    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-sm font-medium">
            System configuration updated successfully.
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Hospital Identity -->
            <div class="bg-slate-800 rounded-xl p-8 border border-slate-700/60 shadow-sm">
                <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-8 border-b border-slate-700/60 pb-4">
                    Hospital Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Hospital Name</label>
                        <input type="text" name="settings[hospital_name]" value="{{ $settings['hospital_name'] ?? 'Opeshis General Hospital' }}" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Primary Email</label>
                        <input type="email" name="settings[hospital_email]" value="{{ $settings['hospital_email'] ?? 'contact@opeshis.com' }}" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Phone Number</label>
                        <input type="text" name="settings[hospital_phone]" value="{{ $settings['hospital_phone'] ?? '+237 000 000 000' }}" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>
            </div>

            <!-- Localization -->
            <div class="bg-slate-800 rounded-xl p-8 border border-slate-700/60 shadow-sm">
                <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-8 border-b border-slate-700/60 pb-4">
                    Localization & Regional Settings
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">System Currency</label>
                        <select name="settings[currency_symbol]" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="FCFA" {{ ($settings['currency_symbol'] ?? '') === 'FCFA' ? 'selected' : '' }}>FCFA (XAF)</option>
                            <option value="USD" {{ ($settings['currency_symbol'] ?? '') === 'USD' ? 'selected' : '' }}>US Dollar (USD)</option>
                            <option value="EUR" {{ ($settings['currency_symbol'] ?? '') === 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Operational Mode</label>
                        <select name="settings[multi_branch_mode]" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="OFF" {{ ($settings['multi_branch_mode'] ?? 'OFF') === 'OFF' ? 'selected' : '' }}>Single Facility</option>
                            <option value="ON" {{ ($settings['multi_branch_mode'] ?? 'OFF') === 'ON' ? 'selected' : '' }}>Multi-Branch (Enterprise)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branding Sidebar -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-6">Hospital Branding</h3>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Official Logo</label>
                        <div class="w-full aspect-square bg-slate-900 rounded-lg border border-slate-700 border-dashed flex items-center justify-center overflow-hidden mb-4 p-4">
                            @if(!empty($settings['hospital_logo']))
                                <img src="{{ $settings['hospital_logo'] }}" class="max-h-full max-w-full object-contain">
                            @else
                                <div class="text-center">
                                    <svg class="w-10 h-10 text-slate-700 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold text-slate-600 uppercase">No Logo Uploaded</span>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="hospital_logo" class="w-full text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-slate-700 file:text-slate-300 hover:file:bg-slate-600">
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-sm font-bold shadow-lg shadow-blue-500/20 transition-all border border-blue-500/50">
                Save System Settings
            </button>
        </div>
    </form>
</div>
</x-cc-shell>

<aside class="w-[260px] bg-obsidian border-r border-subtle flex flex-col h-screen sticky top-0 shrink-0">
    <div class="h-16 flex items-center px-6 border-b border-subtle">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-[#131824] border border-[#1e293b] flex items-center justify-center">
                <div class="w-3 h-3 bg-sage rounded-sm"></div>
            </div>
            <div>
                <h1 class="text-sm font-bold text-white tracking-wide">Opeshis <span class="text-slate-500 font-normal">OS</span></h1>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1 custom-scrollbar">
        @php
        $userRole = auth()->user()->role ?? 'Guest';
        $userPermissions = \Illuminate\Support\Facades\Cache::remember("sidebar_perms_v3_{$userRole}", 60, function() use ($userRole) {
            if (in_array($userRole, ['Admin', 'SuperAdmin', 'System Core'])) return ['all'];
            return \Illuminate\Support\Facades\DB::table('sys_role_permissions')
                ->where(\Illuminate\Support\Facades\DB::raw('TRIM(LOWER(role_name))'), trim(strtolower($userRole)))
                ->pluck('permission_code')
                ->toArray();
        });

        $hasPerm = function($perm) use ($userPermissions) {
            return in_array('all', $userPermissions) || in_array($perm, $userPermissions);
        };

        $nav = function($href, $label, $icon, $pattern) {
            $active = request()->is(ltrim($pattern,'/').'*') || request()->is(ltrim($href,'/'));
            $cls = $active
                ? 'bg-[#131824] text-white font-medium'
                : 'text-slate-400 hover:text-slate-200 hover:bg-[#131824]/50';
            $iconCls = $active ? 'text-sage' : 'text-slate-500';
            
            return "
            <a href=\"{$href}\" class=\"flex items-center gap-3 px-3 py-2.5 text-xs rounded-lg {$cls} transition-colors\">
                <i class=\"fas {$icon} w-4 text-center {$iconCls}\"></i>
                {$label}
            </a>";
        };
        @endphp

        <div class="mb-6">
            <p class="px-3 mb-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Overview</p>
            {!! $nav('/dashboard', 'Dashboard', 'fa-layer-group', 'dashboard') !!}
            @if($hasPerm('module_patients') || $hasPerm('core_admin')) {!! $nav('/patients', 'Patient Registry', 'fa-hospital-user', 'patients') !!} @endif
            @if($hasPerm('module_appointments') || $hasPerm('core_admin')) {!! $nav('/appointments', 'Appointments', 'fa-calendar', 'appointments') !!} @endif
        </div>

        @if($hasPerm('module_clinical') || $hasPerm('module_vitals') || $hasPerm('module_emergency') || $hasPerm('module_maternal') || $hasPerm('module_paeds') || $hasPerm('module_chronic') || $hasPerm('module_telemedicine') || $hasPerm('core_admin'))
        <div class="mb-6">
            <p class="px-3 mb-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Clinical Care</p>
            @if($hasPerm('module_clinical') || $hasPerm('core_admin')) {!! $nav('/emr', 'Consultations', 'fa-stethoscope', 'emr') !!} @endif
            @if($hasPerm('module_vitals') || $hasPerm('core_admin')) {!! $nav('/triage', 'Triage', 'fa-heart-pulse', 'triage') !!} @endif
            @if($hasPerm('module_emergency') || $hasPerm('core_admin')) {!! $nav('/emergency', 'Emergency', 'fa-truck-medical', 'emergency') !!} @endif
            @if($hasPerm('module_maternal') || $hasPerm('core_admin')) {!! $nav('/maternal', 'Maternal Health', 'fa-baby', 'maternal') !!} @endif
            @if($hasPerm('module_paeds') || $hasPerm('core_admin')) {!! $nav('/paeds', 'Pediatrics', 'fa-child', 'paeds') !!} @endif
            @if($hasPerm('module_chronic') || $hasPerm('core_admin')) {!! $nav('/ncd', 'Chronic Care', 'fa-staff-snake', 'ncd') !!} @endif
        </div>
        @endif

        @if($hasPerm('module_pharmacy') || $hasPerm('module_lab') || $hasPerm('module_radiology') || $hasPerm('core_admin'))
        <div class="mb-6">
            <p class="px-3 mb-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Diagnostics</p>
            @if($hasPerm('module_pharmacy') || $hasPerm('core_admin')) {!! $nav('/pharmacy', 'Pharmacy', 'fa-pills', 'pharmacy') !!} @endif
            @if($hasPerm('module_lab') || $hasPerm('core_admin')) {!! $nav('/lab', 'Laboratory', 'fa-microscope', 'lab') !!} @endif
            @if($hasPerm('module_radiology') || $hasPerm('core_admin')) {!! $nav('/radiology', 'Radiology', 'fa-x-ray', 'radiology') !!} @endif
        </div>
        @endif

        @if($hasPerm('module_warehouse') || $hasPerm('module_assets') || $hasPerm('module_billing') || $hasPerm('core_admin'))
        <div class="mb-6">
            <p class="px-3 mb-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">Operations</p>
            @if($hasPerm('module_warehouse') || $hasPerm('core_admin')) {!! $nav('/warehouse', 'Warehouse', 'fa-boxes-stacked', 'warehouse') !!} @endif
            @if($hasPerm('module_assets') || $hasPerm('core_admin')) {!! $nav('/assets', 'Assets', 'fa-box', 'assets') !!} @endif
            @if($hasPerm('module_billing') || $hasPerm('core_admin')) {!! $nav('/billing', 'Billing', 'fa-file-invoice-dollar', 'billing') !!} @endif
        </div>
        @endif
        
        @if($hasPerm('core_admin') || $hasPerm('module_tech'))
        <div class="mb-2">
            <p class="px-3 mb-2 text-[10px] font-semibold text-slate-500 uppercase tracking-widest">System</p>
            @if($hasPerm('core_admin') || $hasPerm('module_tech')) {!! $nav('/analytics', 'Analytics', 'fa-chart-pie', 'analytics') !!} @endif
            @if($hasPerm('core_admin')) {!! $nav('/settings', 'Settings', 'fa-gear', 'settings') !!} @endif
        </div>
        @endif
    </nav>

    <div class="p-4 border-t border-subtle">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium text-slate-400 hover:bg-[#131824] hover:text-white transition-colors group">
                <div class="flex items-center gap-3">
                    <i class="fas fa-arrow-right-from-bracket text-slate-500 group-hover:text-white"></i>
                    <span>Log out</span>
                </div>
            </button>
        </form>
    </div>
</aside>

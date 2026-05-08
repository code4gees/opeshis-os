<aside class="w-[240px] bg-sidebar flex flex-col h-screen sticky top-0 shrink-0">
    <div class="pt-8 pb-6 px-6">
        <div class="flex items-center gap-3">
            <div class="grid grid-cols-2 gap-0.5">
                <div class="w-2 h-2 rounded-sm bg-sage"></div>
                <div class="w-2 h-2 rounded-sm bg-slate-500"></div>
                <div class="w-2 h-2 rounded-sm bg-slate-500"></div>
                <div class="w-2 h-2 rounded-sm bg-sage"></div>
            </div>
            <h1 class="text-lg font-medium text-white tracking-wide">Hospital</h1>
        </div>
    </div>

    <nav class="flex-1 px-4 py-2 flex flex-col gap-2">
        @php
        $nav = function($href, $label, $icon, $active) {
            $cls = $active
                ? 'bg-sage text-sidebar font-medium shadow-md shadow-[#82c09a]/20'
                : 'text-slate-400 hover:text-white transition-colors';
            $iconCls = $active ? 'text-[#16191f]' : 'text-slate-500';
            $textCls = $active ? 'text-[#16191f]' : '';
            
            return "
            <a href=\"{$href}\" class=\"flex items-center gap-4 px-4 py-2.5 rounded-lg {$cls}\">
                <i class=\"fas {$icon} w-4 text-center text-sm {$iconCls}\"></i>
                <span class=\"text-[13px] {$textCls}\">{$label}</span>
            </a>";
        };
        @endphp

        {!! $nav('/dashboard', 'Dashboard', 'fa-grip-vertical', true) !!}
        {!! $nav('/patients', 'Patients', 'fa-user-injured', false) !!}
        {!! $nav('/clinical', 'Clinical', 'fa-syringe', false) !!}
        {!! $nav('/appointments', 'Appointments', 'fa-calendar-check', false) !!}
        {!! $nav('/wards', 'Wards', 'fa-door-open', false) !!}
        {!! $nav('/analytics', 'Analytics', 'fa-chart-line', false) !!}
        
        <div class="mt-auto pb-4">
            {!! $nav('/settings', 'Settings', 'fa-gear', false) !!}
        </div>
    </nav>
</aside>

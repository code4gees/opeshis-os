<aside class="w-[260px] bg-sidebar flex flex-col h-screen sticky top-0 shrink-0 border-r border-white/[0.02]">
    <div class="pt-10 pb-8 px-8">
        <div class="flex items-center gap-4">
            <div class="grid grid-cols-2 gap-1">
                <div class="w-2.5 h-2.5 rounded-[3px] bg-sage shadow-[0_0_10px_rgba(130,192,154,0.3)]"></div>
                <div class="w-2.5 h-2.5 rounded-[3px] bg-white/10"></div>
                <div class="w-2.5 h-2.5 rounded-[3px] bg-white/10"></div>
                <div class="w-2.5 h-2.5 rounded-[3px] bg-sage shadow-[0_0_10px_rgba(130,192,154,0.3)]"></div>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white tracking-tighter leading-tight">Opeshis</h1>
                <p class="text-[9px] font-bold text-white/20 uppercase tracking-[0.2em]">Institutional OS</p>
            </div>
        </div>
    </div>

 <nav class="flex-1 px-4 py-2 flex flex-col gap-2">
    @php
    $nav = function($href, $label, $icon, $pattern) {
        $active = request()->is($pattern);
        $cls = $active
            ? 'bg-sage text-[#1a1d24] font-bold shadow-[0_0_15px_rgba(130,192,154,0.2)]'
            : 'text-white/30 hover:text-white hover:bg-white/5 transition-all duration-300';
        $iconCls = $active ? 'text-[#1a1d24]' : 'text-white/20';
        
        return "
            <a href=\"{$href}\" class=\"flex items-center gap-4 px-5 py-3 rounded-xl {$cls} group\">
                <i class=\"fas {$icon} w-5 text-center text-[13px] {$iconCls} group-hover:scale-110 transition-transform\"></i>
                <span class=\"text-[12px] tracking-tight\">{$label}</span>
            </a>";
    };
    @endphp

     {!! $nav(route('dashboard'), 'Dashboard', 'fa-grip-vertical', 'dashboard') !!}

    @if(auth()->user()->hasPermission('module_patients'))
        {!! $nav(route('patients.index'), 'Patients', 'fa-user-injured', 'registry/patients*') !!}
    @endif

    @if(auth()->user()->hasPermission('module_clinical'))
        {!! $nav(route('emr.main'), 'Clinical Hub', 'fa-file-medical', 'clinical/emr*') !!}
    @endif

    @if(auth()->user()->hasPermission('module_appointments'))
        {!! $nav(route('appointments.index'), 'Appointments', 'fa-calendar-check', 'clinical/appointments*') !!}
    @endif

    @if(auth()->user()->hasPermission('module_clinical'))
        {!! $nav(route('wards'), 'Inpatient Ward', 'fa-door-open', 'clinical/wards*') !!}
    @endif

    @if(auth()->user()->hasPermission('module_paeds'))
        {!! $nav(route('clinical.paeds.index'), 'Pediatrics', 'fa-baby', 'clinical/paeds*') !!}
    @endif

    @if(auth()->user()->hasPermission('module_maternal'))
        {!! $nav(route('clinical.obstetrics.index'), 'Obstetrics', 'fa-person-breastfeeding', 'clinical/obstetrics*') !!}
    @endif

    @if(auth()->user()->hasPermission('module_clinical') || auth()->user()->hasPermission('module_emergency'))
        <div class="px-6 mt-8 mb-3">
            <span class="text-[9px] font-bold text-white/10 uppercase tracking-[0.25em] px-2">Clinical Command</span>
        </div>
        @if(auth()->user()->hasPermission('module_clinical'))
            {!! $nav(route('specialty.critical.icu.index'), 'ICU Command', 'fa-heart-pulse', 'specialty/critical-care/icu*') !!}
            {!! $nav(route('specialty.critical.hdu.index'), 'HDU Command', 'fa-house-medical', 'specialty/critical-care/hdu*') !!}
            {!! $nav(route('specialty.critical.nicu.index'), 'NICU Command', 'fa-baby-carriage', 'specialty/critical-care/nicu*') !!}
        @endif
        @if(auth()->user()->hasPermission('module_emergency'))
            {!! $nav(route('clinical.emergency.index'), 'Emergency / A&E', 'fa-truck-medical', 'clinical/emergency*') !!}
        @endif
    @endif

    @if(auth()->user()->hasPermission('module_pharmacy') || auth()->user()->hasPermission('module_lab') || auth()->user()->hasPermission('module_radiology') || auth()->user()->hasPermission('module_warehouse') || auth()->user()->hasPermission('module_inventory'))
        <div class="px-6 mt-8 mb-3">
            <span class="text-[9px] font-bold text-white/10 uppercase tracking-[0.25em] px-2">Diagnostics & Supply</span>
        </div>
        @if(auth()->user()->hasPermission('module_pharmacy'))
            {!! $nav(route('operations.diagnostics.pharmacy.index'), 'Pharmacy Hub', 'fa-pills', 'operations/diagnostics/pharmacy*') !!}
        @endif
        @if(auth()->user()->hasPermission('module_lab'))
            {!! $nav(route('operations.diagnostics.lab.index'), 'Laboratory Hub', 'fa-flask', 'operations/diagnostics/lab*') !!}
        @endif
        @if(auth()->user()->hasPermission('module_radiology'))
            {!! $nav(route('operations.diagnostics.radiology.index'), 'Radiology Unit', 'fa-x-ray', 'operations/diagnostics/radiology*') !!}
        @endif
        @if(auth()->user()->hasPermission('module_warehouse'))
            {!! $nav(route('operations.supply.warehouse.index'), 'Warehouse', 'fa-warehouse', 'operations/supply-chain/warehouse*') !!}
        @endif
        @if(auth()->user()->hasPermission('module_inventory'))
            {!! $nav(route('operations.supply.inventory.index'), 'Inventory Matrix', 'fa-boxes-stacked', 'operations/supply-chain/inventory*') !!}
        @endif
    @endif

    @if(auth()->user()->hasPermission('module_assets') || auth()->user()->hasPermission('core_admin'))
        <div class="px-6 mt-8 mb-3">
            <span class="text-[9px] font-bold text-white/10 uppercase tracking-[0.25em] px-2">Logistics & Support</span>
        </div>
        @if(auth()->user()->hasPermission('module_assets'))
            {!! $nav(route('operations.logistics.assets.index'), 'Asset Register', 'fa-microchip', 'operations/logistics/assets*') !!}
        @endif
        @if(auth()->user()->hasPermission('core_admin'))
            {!! $nav(route('operations.logistics.laundry.index'), 'Laundry Unit', 'fa-shirt', 'operations/logistics/laundry*') !!}
            {!! $nav(route('operations.logistics.fleet.index'), 'Fleet Management', 'fa-van-shuttle', 'operations/logistics/fleet*') !!}
        @endif
        @if(auth()->user()->hasPermission('module_clinical'))
            {!! $nav(route('operations.clinical.bloodbank.index'), 'Blood Bank', 'fa-droplet', 'operations/clinical/bloodbank*') !!}
            {!! $nav(route('operations.clinical.mortuary.index'), 'Mortuary Services', 'fa-tombstone', 'operations/clinical/mortuary*') !!}
        @endif
    @endif

    @if(auth()->user()->hasPermission('module_billing'))
        <div class="px-6 mt-8 mb-3">
            <span class="text-[9px] font-bold text-white/10 uppercase tracking-[0.25em] px-2">Finance</span>
        </div>
        {!! $nav(route('finance.billing.index'), 'Financial Command', 'fa-file-invoice-dollar', 'finance*') !!}
    @endif

    @if(auth()->user()->hasPermission('module_admin'))
        <div class="px-6 mt-8 mb-3">
            <span class="text-[9px] font-bold text-white/10 uppercase tracking-[0.25em] px-2">Governance</span>
        </div>
        {!! $nav(route('admin.index'), 'Control Plane', 'fa-shield-halved', 'admin*') !!}
        {!! $nav(route('analytics.index'), 'Analytics Hub', 'fa-chart-mixed', 'analytics*') !!}
        {!! $nav(route('reporting.index'), 'Reporting Command', 'fa-file-chart-column', 'reporting*') !!}
    @endif


 
    <div class="mt-auto pb-8 px-4">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-5 py-3 rounded-xl text-white/20 hover:text-alert hover:bg-alert/5 transition-all duration-300 group">
                <i class="fas fa-sign-out-alt w-5 text-center text-[13px] group-hover:scale-110 transition-transform"></i>
                <span class="text-[12px] font-bold uppercase tracking-widest">Terminate Session</span>
            </button>
        </form>
    </div>
 </nav>
</aside>

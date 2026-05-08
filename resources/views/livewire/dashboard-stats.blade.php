<div wire:poll.10s="refreshStats" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @php
        $user = auth()->user();
    @endphp
    
    @if($user->hasPermission('module_clinical'))
    <x-cc-stat 
        label="Patient Queue" 
        :value="$stats['active_visits'] ?? 0" 
        icon="fa-users" 
        trend="Live" 
        color="blue" 
    />
    @endif

    @if($user->hasPermission('module_appointments'))
    <x-cc-stat 
        label="Appointments" 
        :value="$stats['appointments_today'] ?? 0" 
        icon="fa-calendar-check" 
        color="violet" 
    />
    @endif

    @if($user->hasPermission('module_clinical'))
    <x-cc-stat 
        label="Active Admissions" 
        :value="$stats['active_admissions'] ?? 0" 
        icon="fa-bed-pulse" 
        trend="Stable" 
        color="emerald" 
    />
    @endif

    @if($user->hasPermission('module_billing'))
    <x-cc-stat 
        label="Daily Revenue" 
        :value="'FCFA ' . number_format($stats['revenue_today'] ?? 0)" 
        icon="fa-file-invoice-dollar" 
        trend="+2.4%" 
        color="emerald" 
    />
    @endif

    @if($user->hasPermission('module_laboratory') || $user->hasPermission('module_radiology'))
    <x-cc-stat 
        label="Pending Diagnostics" 
        :value="($stats['pending_labs'] ?? 0) + ($stats['pending_radiology'] ?? 0)" 
        icon="fa-microscope" 
        trend="Critical" 
        :trendUp="false"
        color="amber" 
    />
    @endif

    @if($user->hasPermission('module_inventory') || $user->hasPermission('module_pharmacy'))
    <x-cc-stat 
        label="Stock Alerts" 
        :value="$stats['low_stock_items'] ?? 0" 
        icon="fa-boxes-stacked" 
        trend="Action Required" 
        :trendUp="false"
        color="rose" 
    />
    @endif
</div>

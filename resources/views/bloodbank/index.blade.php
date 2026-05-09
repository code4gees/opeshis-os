<x-cc-shell title='Blood Bank Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Blood Bank Command</h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Serology Surveillance · Strategic Reserve Monitoring</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-users" color="slate" variant="ghost" onclick="window.location.href='{{ route('bloodbank.donors') }}'">
                Donor Registry
            </x-cc-button>
            <x-cc-button icon="fa-layer-group" color="rose" onclick="window.location.href='{{ route('bloodbank.inventory') }}'">
                Inventory Matrix
            </x-cc-button>
        </div>
    </div>

    <!-- Stock Metrics Matrix: Responsive Surveillance -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-12">
        <x-cc-card class="p-8 flex flex-col justify-center bg-gradient-to-br from-white/5 to-transparent">
            <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-4">Total Reserves</p>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-extrabold text-white tracking-tighter">{{ $stats['total_units'] }}</span>
                <span class="text-[10px] font-bold text-white/10 uppercase tracking-widest">Units</span>
            </div>
        </x-cc-card>

        @foreach(['A+', 'B+', 'O+', 'AB+'] as $group)
            @php $count = $stock->where('blood_group', $group)->first()->total ?? 0; @endphp
            <x-cc-card class="relative overflow-hidden group hover:border-rose-500/30 transition-all duration-500">
                <div class="p-8">
                    <div class="absolute -right-4 -top-4 opacity-5 font-black text-7xl group-hover:opacity-10 transition-opacity duration-700">{{ $group }}</div>
                    <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-4">Group {{ $group }}</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold {{ $count > 5 ? 'text-white' : 'text-rose-500 animate-pulse' }} tracking-tighter">{{ $count }}</span>
                        <span class="text-[10px] font-bold text-white/10 uppercase tracking-widest">Units</span>
                    </div>
                    <div class="w-full h-1.5 bg-white/5 rounded-full mt-6 overflow-hidden">
                        <div class="h-full bg-rose-600 shadow-[0_0_12px_rgba(225,29,72,0.6)] transition-all duration-1000" style="width: {{ min(100, $count * 10) }}%"></div>
                    </div>
                </div>
            </x-cc-card>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Strategic Alerts & Analytics -->
        <div class="lg:col-span-4 space-y-8">
            <x-cc-card class="p-10 bg-gradient-to-br from-rose-600/[0.05] to-transparent border-rose-500/20">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-2 h-2 bg-rose-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(244,63,94,0.5)]"></div>
                    <h3 class="text-[11px] font-bold text-rose-500 uppercase tracking-widest">Critical Reserve Alert</h3>
                </div>
                <p class="text-[12px] text-white/40 font-bold leading-relaxed mb-10 uppercase tracking-tight">Stock levels for <span class="text-rose-400">O-</span> and <span class="text-rose-400">B-</span> have descended below institutional safety thresholds. Strategic mobilization required.</p>
                <x-cc-button color="rose" class="w-full">
                    Execute Donor Campaign
                </x-cc-button>
            </x-cc-card>

            <x-cc-card class="p-10 flex flex-col justify-center">
                <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-6">Compatibility Sync</p>
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <span class="text-[12px] font-bold text-white/60 uppercase tracking-tight">Universal Donor (O-)</span>
                        <span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-500 text-[8px] font-black uppercase border border-rose-500/20">Critical</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[12px] font-bold text-white/60 uppercase tracking-tight">Universal Recipient (AB+)</span>
                        <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-500 text-[8px] font-black uppercase border border-emerald-500/20">Stable</span>
                    </div>
                </div>
            </x-cc-card>
        </div>

        <!-- Transfusion Matrix -->
        <div class="lg:col-span-8 h-full min-h-[500px] flex">
            <x-cc-card class="flex-1 flex flex-col overflow-hidden">
                <div class="px-10 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Live Transfusion Chain</h3>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-[9px] font-bold text-white/10 uppercase tracking-widest">Sync: Operational</span>
                    </div>
                </div>
                <div class="flex-1 flex flex-col items-center justify-center p-20 text-center">
                    <div class="w-20 h-20 bg-white/5 rounded-[2.5rem] flex items-center justify-center mb-10 border border-white/5 text-white/10 group hover:text-rose-500/20 transition-colors duration-700">
                        <i class="fas fa-droplet text-3xl transition-transform group-hover:scale-110"></i>
                    </div>
                    <p class="text-[11px] font-bold text-white/10 uppercase tracking-[0.2em] max-w-xs leading-relaxed">No active transfusion records identified in the current 24-hour window.</p>
                </div>
            </x-cc-card>
        </div>
    </div>
</div>
</x-cc-shell>

<x-cc-shell title='Sterile Logistics | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Sterile <span class="text-sage">Logistics</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Central Sterile Services Department · Load Tracking · Biological Surveillance Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="sage" variant="ghost" onclick="document.getElementById('loadModal').classList.remove('hidden')">
                Start Sterilization Load
            </x-cc-button>
        </div>
    </div>

    <!-- Sterilization Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Today's Loads" :value="$loadStats->total ?? 0" icon="fa-layer-group" trend="Institutional Log" color="indigo" />
        <x-cc-stat title="Passed Cycles" :value="$loadStats->passed ?? 0" icon="fa-check-double" trend="Compliance Signal" color="emerald" />
        <x-cc-stat title="Failed / Quarantined" :value="$loadStats->failed ?? 0" icon="fa-biohazard" trend="Critical Alert" color="rose" />
        <x-cc-stat title="Expiring Sterile Stock" :value="$expiringCount" icon="fa-hourglass-half" trend="Storage Surveillance" color="amber" />
    </div>

    <!-- Active Sterilization Cycles Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Active Sterilization Cycles Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Surveillance Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Load Number', 'Sterilizer Modality', 'Sterilization Method', 'Cycle Status', 'Expiry Projection', 'Strategic Action']">
            @forelse($todayLoads as $l)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $l->load_number }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ date('H:i', strtotime($l->created_at)) }} HRS · LOGGED</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">{{ $l->sterilizer_name }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-white/40 uppercase tracking-widest">
                            {{ $l->sterilization_method }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusCls = match($l->load_status) {
                                'passed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                'in_progress' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20 animate-pulse',
                                default => 'bg-rose-500/10 text-rose-500 border-rose-500/20'
                            };
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $statusCls }} text-[9px] font-black uppercase tracking-widest">
                            {{ str_replace('_',' ',$l->load_status) }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-[11px] font-bold text-white/20 uppercase tracking-tighter">
                        {{ $l->expiry_date ?: 'TBD_SIGNAL' }}
                    </td>
                    <td class="px-8 py-6 text-right">
                        @if($l->load_status === 'in_progress')
                            <x-cc-button variant="ghost" size="sm" icon="fa-shield-check" color="sage">Verify Load</x-cc-button>
                        @else
                            <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">Protocol Archived</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <i class="fas fa-layer-group text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No sterilization loads recorded in the current cycle.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Start Sterilization Load -->
<x-cc-modal id="loadModal" title="Initiate Sterilization Cycle" icon="fa-plus-circle">
    <form method="POST" action="{{ url('/clinical/cssd/start') }}" class="space-y-6">
        @csrf
        <x-cc-select label="Select Sterilizer Modality" name="sterilizer_id" icon="fa-microchip">
            @foreach($sterilizers as $s)
                <option value="{{ $s->id }}">{{ $s->sterilizer_name }}</option>
            @endforeach
        </x-cc-select>
        <x-cc-select label="Sterilization Method Matrix" name="method" icon="fa-flask-vial">
            <option value="Steam Autoclave (134°C)">Steam Autoclave (134°C)</option>
            <option value="Hydrogen Peroxide Plasma">Hydrogen Peroxide Plasma</option>
            <option value="Ethylene Oxide (ETO)">Ethylene Oxide (ETO)</option>
            <option value="Dry Heat">Dry Heat</option>
        </x-cc-select>
        <div class="pt-4">
            <x-cc-button type="submit" color="sage" class="w-full">Authorize Cycle Initiation</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

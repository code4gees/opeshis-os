<x-cc-shell title='Opeshis OS'>

@section('title', 'Institutional Referrals - Opeshis OS')

<div class="space-y-8 pb-20 animate-fade-in">
    
    <!-- Institutional Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Referral <span class="text-indigo-500">Matrix</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Inbound & Outbound Transfer Command · Facility Coordination Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-paper-plane" color="indigo" onclick="document.getElementById('outModal').classList.remove('hidden')">
                Authorize Transfer
            </x-cc-button>
            <x-cc-button icon="fa-inbox" color="emerald" onclick="document.getElementById('inModal').classList.remove('hidden')">
                Log Inbound
            </x-cc-button>
        </div>
    </header>

    <!-- Referral Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Outbound Pipeline" 
            value="{{ $outbound->count() }}" 
            icon="fa-arrow-up-right-from-square" 
            trend="Active Transfers" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Inbound Intake" 
            value="{{ $inbound->count() }}" 
            icon="fa-arrow-down-left-and-arrow-up-right-to-center" 
            trend="Pending Admissions" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Emergency Vectors" 
            value="{{ $outbound->where('urgency', 'emergency')->count() }}" 
            icon="fa-truck-medical" 
            trend="Critical Priority" 
            color="rose" 
        />
        <x-cc-stat 
            title="Coordination Index" 
            value="Nominal" 
            icon="fa-network-wired" 
            trend="Operational" 
            color="slate" 
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Outbound Registry -->
        <x-clinical-card title="Outbound Transfer Registry" icon="fa-paper-plane" badge="Institutional Exit">
            <x-data-table :headers="['Patient Profile', 'Destination & Urgency', 'Rationale Matrix']">
                @forelse($outbound as $r)
                    <tr class="group hover:bg-indigo-500/[0.02] transition-colors border-b border-white/5 last:border-0">
                        <td class="px-6 py-4">
                            <div class="font-black text-white uppercase text-xs group-hover:text-indigo-400 transition-colors italic">{{ $r->patient->full_name }}</div>
                            <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ $r->patient->medical_id }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] font-black text-indigo-500 uppercase tracking-widest mb-2 italic leading-tight">{{ $r->facility_name }}</div>
                            @php
                                $urgency = match($r->urgency) {
                                    'emergency' => 'critical',
                                    'urgent' => 'pending',
                                    default => 'completed'
                                };
                            @endphp
                            <x-status-badge :status="$urgency" />
                            <span class="text-[8px] font-black text-slate-500 uppercase ml-2 italic">{{ strtoupper($r->urgency) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-[10px] text-slate-400 font-bold leading-relaxed uppercase tracking-tight italic line-clamp-2">"{{ $r->reason }}"</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-600 italic text-xs uppercase tracking-widest">No outbound transfers.</td>
                    </tr>
                @endforelse
            </x-data-table>
        </x-clinical-card>

        <!-- Inbound Registry -->
        <x-clinical-card title="Inbound Admission Registry" icon="fa-inbox" badge="External Entry">
            <x-data-table :headers="['Patient Identity', 'Origin Facility', 'Admission Rationale']">
                @forelse($inbound as $r)
                    <tr class="group hover:bg-emerald-500/[0.02] transition-colors border-b border-white/5 last:border-0">
                        <td class="px-6 py-4">
                            <div class="font-black text-white uppercase text-xs group-hover:text-emerald-400 transition-colors italic">{{ $r->patient_name }}</div>
                            <x-status-badge status="completed" />
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] font-black text-emerald-500 uppercase tracking-widest italic">{{ $r->referring_facility }}</div>
                            <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($r->created_at)->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-[10px] text-slate-400 font-bold leading-relaxed uppercase tracking-tight italic line-clamp-2">"{{ $r->reason }}"</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-600 italic text-xs uppercase tracking-widest">No inbound signals.</td>
                    </tr>
                @endforelse
            </x-data-table>
        </x-clinical-card>
    </div>
</div>

<!-- Modals follow the same high-density pattern -->

</x-cc-shell>

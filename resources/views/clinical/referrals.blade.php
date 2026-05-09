<x-cc-shell title='Referrals Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Referral <span class="text-sage">Matrix</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Inbound & Outbound Transfer Command · Facility Coordination Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-paper-plane" color="indigo" variant="ghost" onclick="document.getElementById('outModal').classList.remove('hidden')">
                Authorize Transfer
            </x-cc-button>
            <x-cc-button icon="fa-inbox" color="emerald" variant="ghost" onclick="document.getElementById('inModal').classList.remove('hidden')">
                Log Inbound
            </x-cc-button>
        </div>
    </div>

    <!-- Referral Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Outbound Pipeline" :value="$outbound->count()" icon="fa-arrow-up-right-from-square" trend="Active Transfers" color="indigo" />
        <x-cc-stat title="Inbound Intake" :value="$inbound->count()" icon="fa-arrow-down-left-and-arrow-up-right-to-center" trend="Pending Admissions" color="emerald" />
        <x-cc-stat title="Emergency Vectors" :value="$outbound->where('urgency', 'emergency')->count()" icon="fa-truck-medical" trend="Critical Priority" color="rose" />
        <x-cc-stat title="Coordination Index" value="Nominal" icon="fa-network-wired" trend="Operational" color="slate" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Outbound Registry -->
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Outbound Transfer Registry</h3>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                    <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">Institutional Exit</span>
                </div>
            </div>

            <x-cc-table :headers="['Patient Profile', 'Destination & Urgency', 'Rationale Matrix']">
                @forelse($outbound as $r)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                    {{ substr($r->patient->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $r->patient->full_name }}</div>
                                    <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $r->patient->medical_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[11px] font-bold text-indigo-400 uppercase tracking-tight line-clamp-1 mb-2">{{ $r->facility_name }}</div>
                            @php
                                $uCls = match($r->urgency) {
                                    'emergency' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse',
                                    'urgent' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                    default => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20'
                                };
                            @endphp
                            <span class="px-3 py-1.5 rounded-xl border {{ $uCls }} text-[9px] font-black uppercase tracking-widest">
                                {{ strtoupper($r->urgency) }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-[11px] font-bold text-white/40 uppercase tracking-tight line-clamp-2">"{{ $r->reason }}"</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-20 text-center">
                            <i class="fas fa-paper-plane text-white/5 text-2xl mb-4"></i>
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No outbound transfers.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>

        <!-- Inbound Registry -->
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Inbound Admission Registry</h3>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">External Entry</span>
                </div>
            </div>

            <x-cc-table :headers="['Patient Identity', 'Origin Facility', 'Admission Rationale']">
                @forelse($inbound as $r)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-emerald-400 transition-colors">{{ $r->patient_name }}</div>
                            <span class="px-3 py-1.5 mt-2 inline-block bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest">RECEIVED</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[11px] font-bold text-emerald-400 uppercase tracking-tight">{{ $r->referring_facility }}</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($r->created_at)->diffForHumans() }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-[11px] font-bold text-white/40 uppercase tracking-tight line-clamp-2">"{{ $r->reason }}"</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-20 text-center">
                            <i class="fas fa-inbox text-white/5 text-2xl mb-4"></i>
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No inbound signals.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>
    </div>
</div>

<!-- Modal: Outbound Transfer -->
<x-cc-modal id="outModal" title="Authorize Outbound Transfer Protocol" icon="fa-paper-plane">
    <form method="POST" action="{{ url('/clinical/referrals/outbound') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Institutional Patient ID" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
            <x-cc-select label="Transfer Urgency Signal" name="urgency" icon="fa-triangle-exclamation">
                <option value="routine">ROUTINE_TRANSFER</option>
                <option value="urgent">URGENT_PROTOCOL</option>
                <option value="emergency">EMERGENCY_VECTOR</option>
            </x-cc-select>
        </div>
        <x-cc-input label="Destination Facility Identity" name="facility_name" required placeholder="e.g. NATIONAL REFERRAL CENTER" icon="fa-hospital" />
        <x-cc-input label="Clinical Transfer Rationale" name="reason" required placeholder="RATIONALE_MATRIX..." icon="fa-stethoscope" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Transfer Pipeline</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Inbound Log -->
<x-cc-modal id="inModal" title="Log Inbound Referral Signal" icon="fa-inbox">
    <form method="POST" action="{{ url('/clinical/referrals/inbound') }}" class="space-y-6">
        @csrf
        <x-cc-input label="External Patient Identity" name="patient_name" required placeholder="ENTER_FULL_NAME" icon="fa-user" />
        <x-cc-input label="Originating Facility Identity" name="referring_facility" required placeholder="e.g. DISTRICT CLINIC A" icon="fa-building-ngo" />
        <x-cc-input label="Clinical Admission Rationale" name="reason" required placeholder="RATIONALE_MATRIX..." icon="fa-stethoscope" />
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Commit Inbound Intake</x-cc-button>
        </div>
    </form>
</x-cc-modal>

</x-cc-shell>

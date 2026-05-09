<x-cc-shell title='{{ strtoupper($type) }} Command Hub | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">{{ $type }} <span class="text-sage">Command Hub</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Specialized Intelligence · Clinical Procedural Hub · Strategic Assessment Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="sage" variant="ghost" onclick="document.getElementById('sessionModal').classList.remove('hidden')">
                Authorize Session
            </x-cc-button>
        </div>
    </div>

    <!-- Specialized Telemetry KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Today's Visits" :value="$patients->where('created_at', '>=', now()->startOfDay())->count()" icon="fa-user-nurse" trend="Active Registry" color="indigo" />
        <x-cc-stat title="Total Registry" :value="$patients->count()" icon="fa-book-medical" trend="Institutional Log" color="slate" />
        <x-cc-stat title="Procedure Yield" :value="$patients->whereNotNull('procedure_done')->count()" icon="fa-scalpel-path" trend="Interventions" color="emerald" />
        <x-cc-stat title="Protocol Status" value="Nominal" icon="fa-shield-heart" trend="Operational" color="amber" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Consultation Registry Matrix -->
        <div class="lg:col-span-8">
            <x-cc-card class="overflow-hidden h-full">
                <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Specialized Clinical Matrix</h3>
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                        <span class="text-[9px] font-black text-sage uppercase tracking-widest">Registry Sync: Active</span>
                    </div>
                </div>

                <x-cc-table :headers="['Patient Profile', 'Clinical Intelligence', 'Intervention Matrix', 'Temporal Log']">
                    @forelse($patients as $p)
                        <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-sage/10 group-hover:text-sage group-hover:border-sage/20 transition-all">
                                        {{ substr($p->patient->full_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $p->patient->full_name }}</div>
                                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $p->patient->medical_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight line-clamp-2" title="{{ $p->clinical_findings }}">"{{ $p->clinical_findings }}"</div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @php
                                    $procCls = $p->procedure_done ? 'text-sage bg-sage/10 border-sage/20' : 'text-white/20 bg-white/5 border-white/10';
                                @endphp
                                <span class="px-3 py-1.5 rounded-xl border {{ $procCls }} text-[9px] font-black uppercase tracking-widest">
                                    {{ $p->procedure_done ?? 'ASSESSMENT_ONLY' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="text-[11px] font-bold text-white uppercase tracking-tighter">{{ \Carbon\Carbon::parse($p->created_at)->format('d M') }} Z</div>
                                <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($p->created_at)->format('H:i') }}</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <i class="fas fa-stethoscope text-white/5 text-2xl mb-4"></i>
                                <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No specialized clinical records identified.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Session Authorization Sidebar -->
        <div class="lg:col-span-4">
            <x-cc-card title="Authorize Clinical Session" icon="fa-shield-halved">
                <form method="POST" action="{{ route('specialty.save') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="clinic_type" value="{{ $type }}">
                    <x-cc-input label="Patient Identity Protocol" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
                    <x-cc-input label="Clinical Intelligence Disclosure" name="findings" required placeholder="CLINICAL_FINDINGS..." icon="fa-clipboard-list" />
                    <x-cc-input label="Intervention Protocol Executed" name="procedure" placeholder="e.g. MINOR_SURGICAL_INTERVENTION" icon="fa-scalpel-path" />
                    <div class="pt-4">
                        <x-cc-button type="submit" color="sage" class="w-full">Authorize Record Relay</x-cc-button>
                    </div>
                </form>
            </x-cc-card>
        </div>
    </div>
</div>

<!-- Modal: Session Authorization (Overlay Alternative) -->
<x-cc-modal id="sessionModal" title="Specialized Session Authorization" icon="fa-plus-circle">
    <form method="POST" action="{{ route('specialty.save') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="clinic_type" value="{{ $type }}">
        <x-cc-input label="Patient Identity Protocol" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Clinical Intelligence Disclosure" name="findings" required placeholder="CLINICAL_FINDINGS..." icon="fa-clipboard-list" />
        <x-cc-input label="Intervention Protocol Executed" name="procedure" placeholder="e.g. MINOR_SURGICAL_INTERVENTION" icon="fa-scalpel-path" />
        <div class="pt-4">
            <x-cc-button type="submit" color="sage" class="w-full">Authorize Record Relay</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

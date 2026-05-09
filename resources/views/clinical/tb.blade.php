<x-cc-shell title='TB Command Hub | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">TB Command <span class="text-amber-500">Hub</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional DOTS Monitoring · TB Case Management · Therapeutic Adherence Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="amber" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Authorize TB Case
            </x-cc-button>
        </div>
    </div>

    <!-- TB Intelligence KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active TB Census" :value="$cases->count()" icon="fa-lungs-virus" trend="Active Registry" color="amber" />
        <x-cc-stat title="DOTS Sessions" :value="$cases->sum('dots_logs_count')" icon="fa-prescription-bottle-medical" trend="Therapeutic Adherence" color="indigo" />
        <x-cc-stat title="Adherence Signal" value="94%" icon="fa-chart-line" trend="Nominal Performance" color="emerald" />
        <x-cc-stat title="Surveillance Status" value="Synced" icon="fa-tower-broadcast" trend="Institutional Log" color="slate" />
    </div>

    <!-- DOTS Clinical Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional DOTS Clinical Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-amber-500 uppercase tracking-widest">Protocol: Active Surveillance</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Profile Identity', 'Classification Matrix', 'Therapeutic Regimen', 'Adherence Profile', 'Strategic Action']">
            @forelse($cases as $c)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-amber-500/10 group-hover:text-amber-500 group-hover:border-amber-500/20 transition-all">
                                {{ substr($c->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors">{{ $c->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest">
                            {{ strtoupper($c->tb_type) }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">{{ $c->regimen }}</div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-[13px] font-extrabold text-white tracking-tighter">{{ $c->dots_logs_count }}</span>
                            <span class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Observed Sessions</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <form method="POST" action="{{ url('/clinical/tb/'.$c->id.'/dots') }}">
                            @csrf
                            <input name="observed" value="yes" hidden>
                            <x-cc-button type="submit" variant="ghost" size="sm" icon="fa-check-circle" color="amber">Log DOTS</x-cc-button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-lungs-virus text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active TB cases identified in the clinical registry matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Authorize TB Registration -->
<x-cc-modal id="regModal" title="Authorize TB Case Registration" icon="fa-plus-circle">
    <form method="POST" action="{{ url('/clinical/tb/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="TB Classification Matrix" name="tb_type" icon="fa-lungs-virus">
                <option value="PTB_PROTOCOL">PTB_PROTOCOL</option>
                <option value="EPTB_PROTOCOL">EPTB_PROTOCOL</option>
                <option value="MDR_TB_RESISTANCE">MDR_TB_RESISTANCE</option>
            </x-cc-select>
            <x-cc-input label="Treatment Regimen Code" name="regimen" required placeholder="e.g. 2RHZE_4RH" icon="fa-prescription-bottle-medical" />
        </div>
        <x-cc-input label="Sputum Baseline Result" name="sputum" placeholder="e.g. SMEAR POSITIVE" icon="fa-microscope" />
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

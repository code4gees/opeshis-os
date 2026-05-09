<x-cc-shell title='HIV/ART Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">HIV/ART <span class="text-sage">Program</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">UNAIDS 95-95-95 Surveillance · Longitudinal Regimen Tracking · Virological Failures</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" variant="ghost" onclick="document.getElementById('enrollModal').classList.remove('hidden')">
                Authorize Enrollment
            </x-cc-button>
        </div>
    </div>

    <!-- UNAIDS 95-95-95 Indicators Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        <x-cc-stat title="1st 95: Diagnosed" value="{{ number_format($metrics['first_95'], 1) }}%" icon="fa-id-card-clip" trend="Diagnosed PLHIV" color="indigo" />
        <x-cc-stat title="2nd 95: On ART" value="{{ number_format($metrics['second_95'], 1) }}%" icon="fa-pills" trend="Active Treatment" color="amber" />
        <x-cc-stat title="3rd 95: Suppressed" value="{{ number_format($metrics['third_95'], 1) }}%" icon="fa-virus-slash" trend="Virological Suppression" color="emerald" />
    </div>

    <!-- ART Program Longitudinal Registry -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">ART Program Longitudinal Registry</h3>
            <div class="flex items-center gap-4">
                <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-white/40 uppercase tracking-widest">{{ $metrics['counts']['on_art'] }} ACTIVE_ON_ART</span>
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Unique ART Number', 'Active Therapeutic Regimen', 'WHO Clinical Stage', 'Viral Load Signal', 'Operational Action']">
            @forelse($enrollments as $e)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($e->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $e->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">AGE: {{ $e->age }} · {{ strtoupper($e->gender) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-[11px] font-bold text-sage uppercase tracking-widest font-mono">{{ $e->art_number }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight">{{ $e->current_regimen ?: 'TREATMENT_PENDING' }}</div>
                        @if($e->regimen_line)
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ $e->regimen_line }} LINE_PROTOCOL</div>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-white/40 uppercase tracking-widest">
                            STAGE_{{ $e->who_stage }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @if($e->last_vl !== null)
                            <div class="text-[13px] font-bold {{ $e->last_vl >= 1000 ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }} tracking-tight">
                                {{ number_format($e->last_vl) }} COPIES/ML
                            </div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ date('d M Y', strtotime($e->last_vl_date)) }}</div>
                        @else
                            <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">SIGNAL_MISSING</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-cc-button variant="ghost" size="sm" icon="fa-calendar-day" color="indigo" onclick="openVisitModal('{{ $e->id }}')">Visit</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-arrows-rotate" color="amber" onclick="openRegimenModal('{{ $e->id }}', '{{ $e->current_regimen }}')">Regimen</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <i class="fas fa-virus text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active HIV enrollments identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Enrollment Protocol -->
<x-cc-modal id="enrollModal" title="Authorize Program Enrollment" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/hiv/enroll') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Patient Identity" name="patient_id" required placeholder="PID-000000" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="ART Matrix Number" name="art_number" required placeholder="ART-XXX-XXXX" icon="fa-hashtag" />
            <x-cc-select label="Enrollment WHO Stage" name="who_stage" icon="fa-triangle-exclamation">
                <option value="1">STAGE_1_PROTOCOL</option>
                <option value="2">STAGE_2_PROTOCOL</option>
                <option value="3">STAGE_3_PROTOCOL</option>
                <option value="4">STAGE_4_PROTOCOL</option>
            </x-cc-select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Enrollment Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Regimen Transition Matrix -->
<x-cc-modal id="regimenModal" title="Regimen Transition Matrix" icon="fa-arrows-rotate">
    <div class="mb-8 p-4 bg-amber-500/10 border border-amber-500/20 rounded-2xl">
        <p class="text-[11px] text-amber-500 font-bold uppercase tracking-widest flex items-center gap-2">
            <i class="fas fa-triangle-exclamation"></i>
            Terminating current regimen node and authorizing new therapeutic line
        </p>
    </div>
    <form method="POST" action="{{ url('/clinical/hiv/regimen-change') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="enrollment_id" id="regimenEnrollmentId">
        <x-cc-input label="Active Treatment Matrix" id="currentRegimenText" readonly icon="fa-lock" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="New Therapeutic Code" name="regimen_code" required placeholder="TLD_PROTOCOL" icon="fa-flask" />
            <x-cc-select label="Therapeutic Line Matrix" name="regimen_line" icon="fa-layer-group">
                <option value="1st">1ST_LINE_OPTIMIZATION</option>
                <option value="2nd">2ND_LINE_FAILURE_RECOVERY</option>
                <option value="3rd">3RD_LINE_SALVAGE_PROTOCOL</option>
            </x-cc-select>
        </div>
        <x-cc-select label="Transition Rationale Vector" name="reason" icon="fa-route">
            <option value="Routine Switch">ROUTINE_OPTIMIZATION_SWITCH</option>
            <option value="Treatment Failure">VIROLOGICAL_TREATMENT_FAILURE</option>
            <option value="Adverse Reaction">ADVERSE_DRUG_REACTION_NODE</option>
            <option value="Stock Out">PHARMACEUTICAL_STOCK_OUT</option>
        </x-cc-select>
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Authorize Treatment Update</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openRegimenModal(id, current) {
    document.getElementById('regimenEnrollmentId').value = id;
    document.getElementById('currentRegimenText').value = current || 'NO_ACTIVE_REGIMEN';
    document.getElementById('regimenModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

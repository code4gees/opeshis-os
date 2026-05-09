<x-cc-shell title='PFT Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Respiratory <span class="text-sky-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Spirometry, Lung Volume & Respiratory Dynamics Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-lungs" color="sky" onclick="document.getElementById('sessionModal').classList.remove('hidden')">
                Initialize PFT Session
            </x-cc-button>
        </div>
    </div>

    <!-- Respiratory Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Sessions" :value="$sessions->count()" icon="fa-file-medical-alt" trend="Institutional Log" color="sky" />
        <x-cc-stat title="Total Audits" value="128" icon="fa-clipboard-check" trend="Active Matrix" color="indigo" />
        <x-cc-stat title="Critical Signals" :value="$sessions->where('measurement.fev1_fvc_ratio', '<', 70)->count()" icon="fa-wind-warning" trend="Obstruction Risk" color="rose" />
        <x-cc-stat title="Registry Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <!-- Respiratory Session Registry -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Respiratory Session Registry</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-sky-500 uppercase tracking-widest">Live Surveillance</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Protocol', 'Indication Matrix', 'Spirometry Profile', 'Strategic Actions']">
            @forelse($sessions as $s)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-sky-500/10 group-hover:text-sky-500 group-hover:border-sky-500/20 transition-all">
                                {{ substr($s->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sky-400 transition-colors">{{ $s->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $s->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight line-clamp-2">"{{ $s->indication }}"</div>
                    </td>
                    <td class="px-8 py-6">
                        @if($s->measurement)
                            <div class="flex items-center gap-4">
                                <span class="px-3 py-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-xl text-[9px] font-black uppercase tracking-widest">COMPLETED</span>
                                <div class="text-[13px] font-extrabold text-white tracking-tighter">{{ $s->measurement->fev1_fvc_ratio }}% <span class="text-[9px] text-white/20 uppercase ml-1">FEV1/FVC</span></div>
                            </div>
                        @else
                            <div class="flex items-center gap-4">
                                <span class="px-3 py-1.5 bg-white/5 border border-white/10 text-white/20 rounded-xl text-[9px] font-black uppercase tracking-widest">PENDING</span>
                                <span class="text-[11px] font-bold text-white/10 uppercase tracking-widest">BASELINE_PENDING</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-ruler" color="sky" onclick="openMeasureModal('{{ $s->id }}')">Measure</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-sync" color="indigo" onclick="openReversibilityModal('{{ $s->id }}')">Rev</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-file-signature" color="emerald" onclick="openReportModal('{{ $s->id }}')">Report</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <i class="fas fa-lungs text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active respiratory sessions identified in the matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: New Session -->
<x-cc-modal id="sessionModal" title="Authorize PFT Session" icon="fa-lungs">
    <form method="POST" action="{{ url('/clinical/pft/session') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Clinical Indication Matrix" name="indication" required placeholder="PROTOCOL_RATIONALE..." icon="fa-notes-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full">Authorize PFT Session</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Measure -->
<x-cc-modal id="measureModal" title="Spirometry Measurement Protocol" icon="fa-ruler">
    <form method="POST" action="{{ url('/clinical/pft/measure') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="session_id" id="measureSessionId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="FEV1 (L)" name="fev1" type="number" step="0.01" required placeholder="0.00" icon="fa-wind" />
            <x-cc-input label="FVC (L)" name="fvc" type="number" step="0.01" required placeholder="0.00" icon="fa-lungs" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="FEV1/FVC Ratio (%)" name="fev1_fvc_ratio" type="number" step="0.1" required placeholder="0.0" icon="fa-percent" />
            <x-cc-input label="PEF (L/s)" name="pef" type="number" step="0.01" required placeholder="0.00" icon="fa-gauge-high" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full">Commit Measurements</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Reversibility -->
<x-cc-modal id="reversibilityModal" title="Reversibility Testing Protocol" icon="fa-sync">
    <form method="POST" action="{{ url('/clinical/pft/reversibility') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="session_id" id="revSessionId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Post-BD FEV1 (L)" name="post_fev1" type="number" step="0.01" required placeholder="0.00" icon="fa-wind" />
            <x-cc-input label="Post-BD FVC (L)" name="post_fvc" type="number" step="0.01" required placeholder="0.00" icon="fa-lungs" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Post-BD FEV1/FVC (%)" name="post_ratio" type="number" step="0.1" required placeholder="0.0" icon="fa-percent" />
            <x-cc-input label="Bronchodilator Administered" name="bd_agent" required placeholder="e.g. Salbutamol 400mcg" icon="fa-spray-can-sparkles" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Reversibility Data</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Report -->
<x-cc-modal id="reportModal" title="Clinical Interpretation Protocol" icon="fa-file-signature">
    <form method="POST" action="{{ url('/clinical/pft/report') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="session_id" id="reportSessionId">
        <x-cc-select label="Diagnostic Impression" name="impression" icon="fa-stethoscope">
            <option value="Normal Spirometry">NORMAL_SPIROMETRY</option>
            <option value="Obstructive Defect">OBSTRUCTIVE_DEFECT</option>
            <option value="Restrictive Defect">RESTRICTIVE_DEFECT</option>
            <option value="Mixed Defect">MIXED_DEFECT</option>
        </x-cc-select>
        <x-cc-input label="Clinical Notes & Interpretation" name="notes" required placeholder="ENTER_INTERPRETATION..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Finalize Interpretation Report</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openMeasureModal(id) {
    document.getElementById('measureSessionId').value = id;
    document.getElementById('measureModal').classList.remove('hidden');
}
function openReversibilityModal(id) {
    document.getElementById('revSessionId').value = id;
    document.getElementById('reversibilityModal').classList.remove('hidden');
}
function openReportModal(id) {
    document.getElementById('reportSessionId').value = id;
    document.getElementById('reportModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

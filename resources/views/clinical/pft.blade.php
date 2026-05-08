<x-cc-shell title='Opeshis OS'>

@section('title', 'Pulmonary Function Testing - Opeshis OS')

<div class="space-y-8 pb-20 animate-fade-in">
    
    <!-- Institutional Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Respiratory <span class="text-sky-500">Command</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Spirometry, Lung Volume & Respiratory Dynamics Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-lungs" color="sky" onclick="document.getElementById('sessionModal').classList.remove('hidden')">
                Initialize PFT Session
            </x-cc-button>
        </div>
    </header>

    <!-- Respiratory Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Active Sessions" 
            value="{{ $sessions->count() }}" 
            icon="fa-file-medical-alt" 
            trend="Institutional Log" 
            color="sky" 
        />
        <x-cc-stat 
            title="Total Audits" 
            value="128" 
            icon="fa-clipboard-check" 
            trend="Active Matrix" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Critical Signals" 
            value="{{ $sessions->where('measurement.fev1_fvc_ratio', '<', 70)->count() }}" 
            icon="fa-wind-warning" 
            trend="Obstruction Risk" 
            color="rose" 
        />
        <x-cc-stat 
            title="Registry Pulse" 
            value="Synced" 
            icon="fa-network-wired" 
            trend="Institutional Log" 
            color="slate" 
        />
    </div>

    <!-- Respiratory Session Registry -->
    <x-clinical-card title="Institutional Respiratory Session Registry" icon="fa-database" badge="Live Surveillance">
        <x-data-table :headers="['Patient Protocol', 'Indication Matrix', 'Spirometry Profile', 'Strategic Actions']">
            @forelse($sessions as $s)
                <tr class="group hover:bg-sky-500/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4">
                        <div class="font-black text-white uppercase text-xs group-hover:text-sky-400 transition-colors italic">{{ $s->patient->full_name }}</div>
                        <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ $s->patient->medical_id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-[11px] font-black text-slate-400 leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $s->indication }}"</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($s->measurement)
                            <div class="flex items-center gap-4">
                                <x-status-badge status="completed" />
                                <div class="text-[10px] font-black text-white italic leading-none">{{ $s->measurement->fev1_fvc_ratio }}% <span class="text-[8px] text-slate-500 ml-1">FEV1/FVC</span></div>
                            </div>
                        @else
                            <x-status-badge status="pending" />
                            <span class="text-[9px] font-black text-slate-600 italic uppercase ml-2">BASELINE_PENDING</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-ruler" color="sky" onclick="openMeasureModal('{{ $s->id }}')">Measure</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-sync" color="indigo" onclick="openReversibilityModal('{{ $s->id }}')">Rev</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-file-signature" color="emerald" onclick="openReportModal('{{ $s->id }}')">Report</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-24 text-center">
                        <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                            <i class="fas fa-lungs text-2xl"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active respiratory sessions identified in the matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </x-clinical-card>
</div>

<!-- Modal: New Session -->
<x-cc-modal id="sessionModal" title="Authorize PFT Session" icon="fa-lungs">
    <form method="POST" action="{{ url('/clinical/pft/session') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Institutional Patient Identity (Medical ID)</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-sky-500/50 transition-all uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Clinical Indication Matrix</label>
            <textarea name="indication" required rows="3" placeholder="PROTOCOL_RATIONALE..." class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-sky-500/50 transition-all uppercase no-scrollbar"></textarea>
        </div>
        <x-cc-button type="submit" color="sky" class="w-full py-4">Authorize PFT Session</x-cc-button>
    </form>
</x-cc-modal>

<!-- Additional Modals (Measure, Rev, Report) should follow the same pattern -->

<script>
function openMeasureModal(id) {
    document.getElementById('measureSessionId').value = id;
    document.getElementById('measureModal').classList.remove('hidden');
}
function openReversibilityModal(id) {
    // ...
}
function openReportModal(id) {
    // ...
}
</script>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Oncology Command - Opeshis OS')

<div class="space-y-8 pb-20 animate-fade-in">
    
    <!-- Institutional Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Oncology <span class="text-indigo-500">Command</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Cancer Registry Surveillance · Chemotherapy Protocols · Therapeutic Matrices</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Enroll Patient
            </x-cc-button>
        </div>
    </header>

    <!-- Registry Telemetry KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Registry Census" 
            value="{{ $patients->count() }}" 
            icon="fa-dna" 
            trend="Active Cases" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Active Protocols" 
            value="{{ $patients->whereNotNull('activePlan')->count() }}" 
            icon="fa-vials" 
            trend="In Therapy" 
            color="rose" 
        />
        <x-cc-stat 
            title="Tx Intent: Curative" 
            value="{{ $patients->filter(fn($p) => optional($p->activePlan)->intent === 'Curative')->count() }}" 
            icon="fa-shield-heart" 
            trend="Strategic Goal" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Registry High-Risk" 
            value="{{ $patients->filter(fn($p) => $p->stage === 'IV')->count() }}" 
            icon="fa-radiation" 
            trend="Stage IV Status" 
            color="amber" 
        />
    </div>

    <!-- Registry Surveillance Matrix -->
    <x-clinical-card title="Institutional Cancer Registry Matrix" icon="fa-database" badge="Live Surveillance">
        <x-data-table :headers="['Patient Identity', 'Classification Matrix', 'Clinical Staging', 'Active Protocol', 'Strategic Action']">
            @forelse($patients as $p)
                <tr class="group hover:bg-indigo-500/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4">
                        <div class="font-black text-white uppercase text-xs group-hover:text-indigo-400 transition-colors">{{ $p->patient->full_name }}</div>
                        <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ $p->patient->medical_id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-[11px] font-black text-indigo-400 uppercase tracking-tight italic">{{ $p->cancer_type }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">ICD: {{ $p->icd_code }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <x-status-badge status="critical" />
                        <div class="text-[8px] font-black text-rose-500 uppercase mt-1 tracking-widest">Stage {{ strtoupper($p->stage) }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1 italic">Hist: {{ $p->histology }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($p->activePlan)
                            <div class="text-[10px] font-black text-slate-200 uppercase italic tracking-tight">{{ $p->activePlan->protocol->name ?? 'CUSTOM_REGIMEN' }}</div>
                            <div class="text-[8px] font-black text-slate-600 uppercase tracking-widest mt-1 italic">Intent: {{ strtoupper($p->activePlan->intent) }}</div>
                        @else
                            <span class="text-[9px] font-black text-slate-600 uppercase italic tracking-widest leading-none">NO_ACTIVE_PROTOCOL</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            @if($p->activePlan)
                                <x-cc-button variant="ghost" size="sm" icon="fa-vial-circle-check" color="rose" onclick="openCycleModal('{{ $p->activePlan->id }}')">Cycle</x-cc-button>
                                <x-cc-button variant="ghost" size="sm" icon="fa-prescription-bottle-medical" color="amber" onclick="openDrugModal('{{ $p->activePlan->id }}')">Admin</x-cc-button>
                            @else
                                <x-cc-button variant="ghost" size="sm" icon="fa-scroll" color="indigo" onclick="openPlanModal('{{ $p->id }}')">Plan</x-cc-button>
                            @endif
                            <x-cc-button variant="ghost" size="sm" icon="fa-calendar-plus" color="emerald" onclick="openFollowupModal('{{ $p->id }}')">Followup</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-24 text-center">
                        <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                            <i class="fas fa-dna text-2xl"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">Cancer registry census is currently baseline (empty).</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </x-clinical-card>
</div>

<!-- Modal: Enrollment -->
<x-cc-modal id="regModal" title="Oncology Registry Enrollment" icon="fa-dna">
    <form method="POST" action="{{ url('/clinical/oncology/register') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Patient Identity (Medical ID)</label>
                <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Neoplasm Classification</label>
                <input name="type" required placeholder="e.g. Adenocarcinoma" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">ICD_11 Diagnostic Code</label>
                <input name="icd" required placeholder="e.g. 2B50.0" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Clinical TNM Staging</label>
                <select name="stage" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                    <option value="I">STAGE I</option>
                    <option value="II">STAGE II</option>
                    <option value="III">STAGE III</option>
                    <option value="IV">STAGE IV (METASTATIC)</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Histology Protocol & Findings</label>
            <input name="histology" required placeholder="Pathology Interpretation" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Date of Diagnosis</label>
            <input name="diagnosis_date" type="date" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
        </div>
        <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Registry Enrollment</x-cc-button>
    </form>
</x-cc-modal>

<!-- Modal: Authorize Therapeutic Protocol -->
<x-cc-modal id="planModal" title="Authorize Chemotherapy Protocol" icon="fa-scroll">
    <form method="POST" action="{{ url('/clinical/oncology/plan') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="onco_patient_id" id="planPatientId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Institutional Protocol</label>
                <select name="protocol_id" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none">
                    @foreach($protocols as $proto)
                        <option value="{{ $proto->id }}">{{ $proto->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Treatment Intent</label>
                <select name="intent" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none">
                    <option value="Curative">CURATIVE_PROTOCOL</option>
                    <option value="Palliative">PALLIATIVE_CARE</option>
                    <option value="Adjuvant">ADJUVANT_THERAPY</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Weight (KG)</label>
                <input name="weight" type="number" step="0.1" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Height (CM)</label>
                <input name="height" type="number" step="0.1" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Total Cycles</label>
                <input name="cycles" type="number" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
        </div>
        <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Therapeutic Protocol</x-cc-button>
    </form>
</x-cc-modal>

<!-- Additional Modals (Cycle, Drug, Followup) should follow the same pattern -->

<script>
function openPlanModal(id) {
    document.getElementById('planPatientId').value = id;
    document.getElementById('planModal').classList.remove('hidden');
}
function openCycleModal(id) {
    // Implement cycle management logic
}
function openDrugModal(id) {
    // Implement drug admin logic
}
function openFollowupModal(id) {
    // Implement followup scheduling logic
}
</script>
</x-cc-shell>

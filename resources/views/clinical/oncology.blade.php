<x-cc-shell title='Oncology Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Oncology <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Cancer Registry Surveillance · Chemotherapy Protocols · Therapeutic Matrices</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Enroll Patient
            </x-cc-button>
        </div>
    </div>

    <!-- Registry Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Registry Census" value="{{ $patients->count() }}" icon="fa-dna" trend="Active Cases" color="indigo" />
        <x-cc-stat title="Active Protocols" value="{{ $patients->whereNotNull('activePlan')->count() }}" icon="fa-vials" trend="In Therapy" color="rose" />
        <x-cc-stat title="Tx Intent: Curative" value="{{ $patients->filter(fn($p) => optional($p->activePlan)->intent === 'Curative')->count() }}" icon="fa-shield-heart" trend="Strategic Goal" color="emerald" />
        <x-cc-stat title="Registry High-Risk" value="{{ $patients->filter(fn($p) => $p->stage === 'IV')->count() }}" icon="fa-radiation" trend="Stage IV Status" color="amber" />
    </div>

    <!-- Registry Surveillance Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Cancer Registry Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Surveillance Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Classification Matrix', 'Clinical Staging', 'Active Protocol', 'Strategic Action']">
            @forelse($patients as $p)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($p->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $p->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $p->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-sage uppercase tracking-tight">{{ $p->cancer_type }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">ICD: {{ $p->icd_code }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <span class="px-2 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest">Stage {{ strtoupper($p->stage) }}</span>
                            <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">Hist: {{ $p->histology }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($p->activePlan)
                            <div class="text-[11px] font-bold text-white uppercase tracking-tight">{{ $p->activePlan->protocol->name ?? 'CUSTOM_REGIMEN' }}</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Intent: {{ strtoupper($p->activePlan->intent) }}</div>
                        @else
                            <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">NO_ACTIVE_PROTOCOL</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
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
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-dna text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Cancer registry census is empty.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Enrollment -->
<x-cc-modal id="regModal" title="Oncology Registry Enrollment" icon="fa-dna">
    <form method="POST" action="{{ url('/clinical/oncology/register') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
            <x-cc-input label="Neoplasm Classification" name="type" required placeholder="Adenocarcinoma" icon="fa-microscope" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="ICD_11 Diagnostic Code" name="icd" required placeholder="2B50.0" icon="fa-hashtag" />
            <x-cc-select label="Clinical TNM Staging" name="stage" icon="fa-triangle-exclamation">
                <option value="I">STAGE I</option>
                <option value="II">STAGE II</option>
                <option value="III">STAGE III</option>
                <option value="IV">STAGE IV (METASTATIC)</option>
            </x-cc-select>
        </div>
        <x-cc-input label="Histology Protocol & Findings" name="histology" required placeholder="Pathology Interpretation" icon="fa-file-medical" />
        <x-cc-input label="Date of Diagnosis" name="diagnosis_date" type="date" required icon="fa-calendar-day" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Registry Enrollment</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Authorize Therapeutic Protocol -->
<x-cc-modal id="planModal" title="Authorize Chemotherapy Protocol" icon="fa-scroll">
    <form method="POST" action="{{ url('/clinical/oncology/plan') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="onco_patient_id" id="planPatientId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Institutional Protocol" name="protocol_id" icon="fa-list-check">
                @foreach($protocols as $proto)
                    <option value="{{ $proto->id }}">{{ $proto->name }}</option>
                @endforeach
            </x-cc-select>
            <x-cc-select label="Treatment Intent" name="intent" icon="fa-shield-heart">
                <option value="Curative">CURATIVE_PROTOCOL</option>
                <option value="Palliative">PALLIATIVE_CARE</option>
                <option value="Adjuvant">ADJUVANT_THERAPY</option>
            </x-cc-select>
        </div>
        <div class="grid grid-cols-3 gap-6">
            <x-cc-input label="Weight (KG)" name="weight" type="number" step="0.1" required icon="fa-weight-scale" />
            <x-cc-input label="Height (CM)" name="height" type="number" step="0.1" required icon="fa-ruler-vertical" />
            <x-cc-input label="Total Cycles" name="cycles" type="number" required icon="fa-arrows-rotate" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Therapeutic Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openPlanModal(id) {
    document.getElementById('planPatientId').value = id;
    document.getElementById('planModal').classList.remove('hidden');
}
function openCycleModal(id) { /* Logic */ }
function openDrugModal(id) { /* Logic */ }
function openFollowupModal(id) { /* Logic */ }
</script>
</x-cc-shell>

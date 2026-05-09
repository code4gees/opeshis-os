<x-cc-shell title='Dermatology Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Dermatology <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Skin Intelligence · Case Registry · Histopathology Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Enroll Skin Case
            </x-cc-button>
        </div>
    </div>

    <!-- Integumentary Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Census" value="{{ $patients->count() }}" icon="fa-hospital-user" trend="Institutional Log" color="indigo" />
        <x-cc-stat title="Daily Consults" value="24" icon="fa-stethoscope" trend="Active Matrix" color="emerald" />
        <x-cc-stat title="Biopsy Queue" value="08" icon="fa-microscope" trend="Pending Signal" color="rose" />
        <x-cc-stat title="Registry Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <!-- Integumentary Case Registry -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Integumentary Case Registry Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Intelligence: Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Protocol', 'Primary Skin Diagnosis', 'Evaluation Status', 'Treatment Vector', 'Strategic Action']">
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
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight">"{{ $p->primary_diagnosis }}"</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Provisional Deduction</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest">
                            ASSESSMENT_SYNCED
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-emerald-500 uppercase tracking-tight">ACTIVE_PRESCRIPTION</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Clinical Protocol</div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-notes-medical" color="indigo" onclick="openConsultModal('{{ $p->id }}')">Log Consult</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-camera" color="emerald" onclick="openImageModal('{{ $p->id }}')">Capture Image</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-hand-dots text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active dermatology cases in the clinical registry.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Enroll Case -->
<x-cc-modal id="regModal" title="Skin Case Enrollment Protocol" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/dermatology/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Primary Skin Diagnosis" name="diagnosis" required placeholder="CLINICAL_DIAGNOSIS_DISCLOSURE..." icon="fa-stethoscope" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Case Enrollment</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Consult -->
<x-cc-modal id="consultModal" title="Integumentary Consultation Intelligence" icon="fa-notes-medical">
    <form method="POST" action="{{ url('/clinical/dermatology/record-consultation') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="derm_patient_id" id="consultPatientId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Anatomical Body Area" name="body_area" required placeholder="BODY_AREA_NODE" icon="fa-child-reaching" />
            <x-cc-input label="Treatment Protocol" name="treatment" required placeholder="TREATMENT_PROTOCOL" icon="fa-pills" />
        </div>
        <x-cc-input label="Skin Findings Intelligence" name="findings" required placeholder="CLINICAL_FINDINGS_INTELLIGENCE..." icon="fa-magnifying-glass-pulse" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Consultation Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openConsultModal(id) {
    document.getElementById('consultPatientId').value = id;
    document.getElementById('consultModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

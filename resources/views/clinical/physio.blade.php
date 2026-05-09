<x-cc-shell title='Rehab Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Rehab <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Physiotherapy Surveillance · Kinetic Recovery · Outcome Analytics</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" variant="ghost" onclick="document.getElementById('registerModal').classList.remove('hidden')">
                Enroll New Case
            </x-cc-button>
        </div>
    </div>

    <!-- Rehab Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Census" value="{{ $cases->count() }}" icon="fa-person-walking" trend="Active Programs" color="indigo" />
        <x-cc-stat title="Total Sessions" value="{{ $cases->sum('sessions_count') }}" icon="fa-calendar-check" trend="Intensity" color="slate" />
        <x-cc-stat title="Recovery Velocity" value="84%" icon="fa-bolt" trend="Kinetic Progress" color="emerald" />
        <x-cc-stat title="Critical Nodes" value="02" icon="fa-triangle-exclamation" trend="Strategic Focus" color="rose" />
    </div>

    <!-- Case Management Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Physiotherapy Registry</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Active Protocols Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Diagnosis Matrix', 'Strategy & Goals', 'Intensity', 'Strategic Action']">
            @forelse($cases as $case)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($case->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $case->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $case->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-black text-sage uppercase tracking-widest">{{ $case->referral_diagnosis }}</div>
                        <div class="text-[9px] font-bold text-white/10 uppercase tracking-tighter mt-1">SRC: {{ $case->referral_source }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] text-white/40 font-bold leading-relaxed uppercase tracking-tight line-clamp-2 max-w-[250px]" title="{{ $case->goals }}">"{{ $case->goals }}"</div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[13px] font-black text-white">
                            {{ $case->sessions_count }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-clipboard-check" color="slate" onclick="openAssessmentModal('{{ $case->id }}')">Assess</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-calendar-day" color="indigo" onclick="openSessionModal('{{ $case->id }}')">Log Session</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-flag-checkered" color="emerald" onclick="openOutcomeModal('{{ $case->id }}')">Discharge</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-person-walking text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active physiotherapy cases identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Enroll Physio Case -->
<x-cc-modal id="registerModal" title="Physiotherapy Case Enrollment" icon="fa-user-plus">
    <form method="POST" action="{{ url('/physio/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient ID" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Referral Diagnosis" name="diagnosis" required placeholder="e.g. POST-OP ACL RECON" icon="fa-stethoscope" />
            <x-cc-input label="Referral Source" name="source" required placeholder="e.g. ORTHOPAEDICS" icon="fa-hospital" />
        </div>
        <x-cc-input label="Strategic Rehab Goals" name="goals" placeholder="ENTER FUNCTIONAL RECOVERY GOALS..." icon="fa-bullseye" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Enrollment Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Clinical Assessment Intelligence -->
<x-cc-modal id="assessmentModal" title="Clinical Assessment Intelligence" icon="fa-clipboard-check">
    <form method="POST" action="{{ url('/physio/assessment') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="case_id" id="assessmentCaseId">
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Subjective Disclosure" name="subjective" required placeholder="PATIENT_REPORTED..." icon="fa-comment-dots" />
            <x-cc-input label="Objective Findings" name="objective" required placeholder="CLINICAL_OBSERVATIONS..." icon="fa-microscope" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Range of Motion (ROM)" name="rom" placeholder="e.g. 0-120 DEG FLEXION" icon="fa-arrows-up-down" />
            <x-cc-input label="Muscle Strength (MMT)" name="strength" placeholder="e.g. 4/5 QUADRICEPS" icon="fa-dumbbell" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Clinical Assessment" name="assessment" required placeholder="CLINICAL_RATIONALE..." icon="fa-brain" />
            <x-cc-input label="Therapeutic Plan" name="plan" required placeholder="MANAGEMENT_STRATEGY..." icon="fa-route" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Assessment Matrix</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Therapy Session Protocol -->
<x-cc-modal id="sessionModal" title="Therapy Session Protocol" icon="fa-calendar-day">
    <form method="POST" action="{{ url('/physio/session') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="case_id" id="sessionCaseId">
        <x-cc-input label="Strategic Interventions" name="interventions" required placeholder="MANUAL_THERAPY_EXERCISES..." icon="fa-kit-medical" />
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Duration (Minutes)" name="duration" type="number" required placeholder="45" icon="fa-clock" />
            <x-cc-input label="Patient Response" name="response" placeholder="TOLERATED_WELL" icon="fa-heart-pulse" />
        </div>
        <x-cc-input label="Home Exercise Protocol (HEP)" name="home_exercise" placeholder="DAILY_STRETCHING_ROUTINE..." icon="fa-house-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Session Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Finalize Rehabilitation Outcome -->
<x-cc-modal id="outcomeModal" title="Finalize Rehabilitation Outcome" icon="fa-flag-checkered">
    <form method="POST" action="{{ url('/physio/outcome') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="case_id" id="outcomeCaseId">
        <x-cc-input label="Functional Outcome Disclosure" name="outcome" required placeholder="RECOVERY_STATUS..." icon="fa-chart-line" />
        <x-cc-select label="Goals Achieved" name="achieved" icon="fa-check-double">
            <option value="1">GOALS_ACHIEVED_FULLY</option>
            <option value="0">PARTIAL_RECOVERY_PROTOCOL</option>
        </x-cc-select>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Finalize Case Outcome</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openAssessmentModal(id) {
    document.getElementById('assessmentCaseId').value = id;
    document.getElementById('assessmentModal').classList.remove('hidden');
}
function openSessionModal(id) {
    document.getElementById('sessionCaseId').value = id;
    document.getElementById('sessionModal').classList.remove('hidden');
}
function openOutcomeModal(id) {
    document.getElementById('outcomeCaseId').value = id;
    document.getElementById('outcomeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

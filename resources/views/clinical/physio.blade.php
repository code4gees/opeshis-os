<x-cc-shell title='Opeshis OS'>

@section('title', 'Rehab & Physiotherapy Command - Opeshis OS')

<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-sage uppercase tracking-tighter">Rehab Command Hub</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Physiotherapy Surveillance · Kinetic Recovery · Outcome Analytics</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-user-plus" color="indigo" onclick="document.getElementById('registerModal').classList.remove('hidden')">
 Enroll New Case
 </x-cc-button>
 </div>
 </div>

 <!-- Rehab Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active Rehab Census" 
 value="{{ $cases->count() }}" 
 icon="fa-person-walking" 
 trend="Active Programs" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Total Sessions" 
 value="{{ $cases->sum('sessions_count') }}" 
 icon="fa-calendar-check" 
 trend="Therapeutic Intensity" 
 color="slate" 
 />
 <x-cc-stat 
 title="Recovery Velocity" 
 value="84%" 
 icon="fa-bolt" 
 trend="Kinetic Progress" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Critical Nodes" 
 value="02" 
 icon="fa-triangle-exclamation" 
 trend="Strategic Focus" 
 color="rose" 
 />
 </div>

 <!-- Case Management Matrix -->
 <x-clinical-card title="Institutional Physiotherapy Registry" icon="fa-database" badge="Active Protocols">
 <x-data-table :headers="['Patient Protocol Identity', 'Referral / Diagnosis Matrix', 'Rehab Strategy & Goals', 'Intensity (Sessions)', 'Strategic Action']">
 @forelse($cases as $case)
 <tr class="group hover:bg-sage/[0.02] transition-colors">
 <td class="whitespace-nowrap px-6 py-4">
 <div class="flex items-center">
 <div class="h-10 w-10 flex-shrink-0 rounded-xl bg-sage/10 flex items-center justify-center border border-indigo-500/20 text-sage font-bold text-xs uppercase">
 {{ substr($case->patient->full_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors ">{{ $case->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $case->patient->medical_id }}</div>
 </div>
 </div>
 </td>
 <td class="px-6 py-4">
 <div class="text-xs font-semibold text-sage uppercase tracking-tight">{{ $case->referral_diagnosis }}</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1 ">Source: {{ $case->referral_source }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-[12px] text-slate-400 line-clamp-2 uppercase tracking-tight" title="{{ $case->goals }}">"{{ $case->goals }}"</div>
 </td>
 <td class="whitespace-nowrap px-6 py-4 text-center">
 <span class="px-3 py-1 bg-card border border-slate-700 rounded text-[12px] font-semibold text-slate-200 font-medium">
 {{ $case->sessions_count }}
 </span>
 </td>
 <td class="whitespace-nowrap px-6 py-4 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-clipboard-check" color="slate" onclick="openAssessmentModal('{{ $case->id }}')">Assess</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-calendar-day" color="indigo" onclick="openSessionModal('{{ $case->id }}')">Log Session</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-flag-checkered" color="emerald" onclick="openOutcomeModal('{{ $case->id }}')">Discharge</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active physiotherapy cases identified in the registry matrix.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>
</div>

<!-- Modal: Enroll Physio Case -->
<x-cc-modal id="registerModal" title="Physiotherapy Case Enrollment" icon="fa-user-plus">
 <form method="POST" action="{{ url('/physio/register') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient ID</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Referral Diagnosis</label>
 <input name="diagnosis" required placeholder="e.g. POST-OP ACL RECON" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Referral Source</label>
 <input name="source" required placeholder="e.g. ORTHOPAEDICS" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Strategic Rehab Goals</label>
 <textarea name="goals" rows="4" placeholder="ENTER FUNCTIONAL RECOVERY GOALS..." class="w-full bg-card/50 border border-subtle rounded-2xl px-4 py-4 text-sm font-bold text-slate-200 outline-none no-scrollbar resize-none focus:ring-2 focus:ring-indigo-600 uppercase"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full font-medium">Authorize Enrollment Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Clinical Assessment Intelligence -->
<x-cc-modal id="assessmentModal" title="Clinical Assessment Intelligence" icon="fa-clipboard-check">
 <form method="POST" action="{{ url('/physio/assessment') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="case_id" id="assessmentCaseId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Subjective Disclosure</label>
 <textarea name="subjective" required rows="3" placeholder="PATIENT_REPORTED_SYMPTOMS..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Objective Findings</label>
 <textarea name="objective" required rows="3" placeholder="CLINICAL_OBSERVATIONS..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Range of Motion (ROM)</label>
 <input name="rom" placeholder="e.g. 0-120 DEG FLEXION" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Muscle Strength (MMT)</label>
 <input name="strength" placeholder="e.g. 4/5 QUADRICEPS" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Clinical Assessment</label>
 <textarea name="assessment" required rows="2" placeholder="CLINICAL_RATIONALE..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Therapeutic Plan Vector</label>
 <textarea name="plan" required rows="2" placeholder="MANAGEMENT_STRATEGY..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full font-medium">Commit Assessment Matrix</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Therapy Session Protocol -->
<x-cc-modal id="sessionModal" title="Therapy Session Protocol" icon="fa-calendar-day">
 <form method="POST" action="{{ url('/physio/session') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="case_id" id="sessionCaseId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Strategic Interventions</label>
 <textarea name="interventions" required rows="3" placeholder="MANUAL_THERAPY_EXERCISES..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Session Duration (Minutes)</label>
 <input name="duration" type="number" required placeholder="45" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Patient Response Vector</label>
 <input name="response" placeholder="TOLERATED_WELL" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Home Exercise Protocol (HEP)</label>
 <textarea name="home_exercise" rows="2" placeholder="DAILY_STRETCHING_ROUTINE..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full font-medium">Commit Session Intelligence</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Finalize Rehabilitation Outcome -->
<x-cc-modal id="outcomeModal" title="Finalize Rehabilitation Outcome" icon="fa-flag-checkered">
 <form method="POST" action="{{ url('/physio/outcome') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="case_id" id="outcomeCaseId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Functional Outcome Disclosure</label>
 <textarea name="outcome" required rows="3" placeholder="RECOVERY_STATUS_ON_DISCHARGE..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600 uppercase no-scrollbar"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Rehabilitation Goals Achieved</label>
 <select name="achieved" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
 <option value="1">GOALS_ACHIEVED_FULLY</option>
 <option value="0">PARTIAL_RECOVERY_PROTOCOL</option>
 </select>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="emerald" class="w-full font-medium">Finalize Case Outcome</x-cc-button>
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

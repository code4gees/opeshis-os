<x-cc-shell title='Opeshis OS'>

@section('title', 'Dermatology Hub - Opeshis OS')

<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">Dermatology <span class="text-sage">Command</span></h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Skin Intelligence · Case Registry · Histopathology Matrix</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-user-plus" color="indigo" onclick="document.getElementById('regModal').classList.remove('hidden')">
 Enroll Skin Case Protocol
 </x-cc-button>
 </div>
 </div>

 <!-- Integumentary Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active Census" 
 value="{{ $patients->count() }}" 
 icon="fa-hospital-user" 
 trend="Institutional Log" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Daily Consults" 
 value="24" 
 icon="fa-stethoscope" 
 trend="Active Matrix" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Biopsy Queue" 
 value="08" 
 icon="fa-microscope" 
 trend="Pending Signal" 
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

 <!-- Integumentary Case Registry -->
 <x-clinical-card title="Integumentary Case Registry Matrix" icon="fa-database" badge="Intelligence: Active">
 <x-data-table :headers="['Patient Protocol', 'Primary Skin Diagnosis', 'Evaluation Status', 'Treatment Vector', 'Strategic Action']">
 @forelse($patients as $p)
 <tr class="group hover:bg-sage/[0.02] transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors ">{{ $p->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium mt-1">{{ $p->patient->medical_id }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-xs font-semibold text-slate-300 uppercase ">"{{ $p->primary_diagnosis }}"</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Provisional Deduction</div>
 </td>
 <td class="px-6 py-4">
 <x-status-badge status="completed" />
 <div class="text-[8px] font-semibold text-slate-400 uppercase mt-1 tracking-wider">ASSESSMENT_SYNCED</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-[12px] font-semibold text-emerald-500 font-medium ">ACTIVE_PRESCRIPTION</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Clinical Protocol</div>
 </td>
 <td class="px-6 py-4 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-notes-medical" color="indigo" onclick="openConsultModal('{{ $p->id }}')">Log Consult</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-camera" color="emerald" onclick="openImageModal('{{ $p->id }}')">Capture Image</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active dermatology cases in the clinical registry.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>
</div>

<!-- Modal: Enroll Case -->
<x-cc-modal id="regModal" title="Skin Case Enrollment Protocol" icon="fa-user-plus">
 <form method="POST" action="{{ url('/clinical/dermatology/register') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient Identity</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Primary Skin Diagnosis Disclosure</label>
 <textarea name="diagnosis" required rows="3" placeholder="CLINICAL_DIAGNOSIS_DISCLOSURE..." class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar focus:border-indigo-500/50 transition-all uppercase"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Case Enrollment</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Log Consult -->
<x-cc-modal id="consultModal" title="Commit Integumentary Consultation Intelligence" icon="fa-notes-medical">
 <form method="POST" action="{{ url('/clinical/dermatology/record-consultation') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="derm_patient_id" id="consultPatientId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Anatomical Body Area Vector</label>
 <input name="body_area" required placeholder="BODY_AREA_NODE" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Clinical Treatment Protocol</label>
 <input name="treatment" required placeholder="TREATMENT_PROTOCOL" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-emerald-500/50 transition-all uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Skin Findings Intelligence</label>
 <textarea name="findings" required rows="3" placeholder="CLINICAL_FINDINGS_INTELLIGENCE..." class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar focus:border-indigo-500/50 transition-all uppercase"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full py-4">Commit Consultation Intelligence</x-cc-button>
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

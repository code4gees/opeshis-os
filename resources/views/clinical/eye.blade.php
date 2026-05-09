<x-cc-shell title='Opeshis OS'>

@section('title', 'Ophthalmology Clinical Hub — Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">Eye Command</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Ophthalmology Intelligence · Vision Science Matrix · Clinical Procedural Hub</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-eye" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
 Register Eye Node
 </x-cc-button>
 </div>
 </div>

 <!-- Eye Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Total Registry" 
 value="{{ $patients->count() }}" 
 icon="fa-users-viewfinder" 
 trend="Institutional Log" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Surgical Queue" 
 value="{{ $surgicalList->count() }}" 
 icon="fa-scalpel-path" 
 trend="Planned Matrix" 
 color="sky" 
 />
 <x-cc-stat 
 title="Eye Signal" 
 value="Nominal" 
 icon="fa-eye-dropper" 
 trend="Operational" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Hub Pulse" 
 value="Synced" 
 icon="fa-network-wired" 
 trend="Institutional Log" 
 color="slate" 
 />
 </div>

 <!-- Eye Clinical Surveillance Matrix -->
 <x-cc-card title="Eye Clinical Surveillance Matrix" icon="fa-database">
 <x-cc-table :headers="['Patient Identity', 'Chief Complaint Profile', 'Clinical Matrix Status', 'Strategic Actions']">
 @forelse($patients as $p)
 <tr class="group hover:bg-sage/[0.02] transition-colors border-b border-slate-800/50 last:border-0">
 <td class="px-5 py-6">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors ">{{ $p->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium mt-1">{{ $p->patient->medical_id }}</div>
 </td>
 <td class="px-5 py-6">
 <div class="p-3 bg-card/50 rounded-xl border border-subtle ">
 <p class="text-[12px] text-slate-400 font-bold leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $p->chief_complaint }}"</p>
 </div>
 </td>
 <td class="px-5 py-6">
 <div class="flex items-center gap-2">
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 border border-subtle rounded-lg text-[8px] font-semibold font-medium /5">
 REG_OK
 </span>
 </div>
 </td>
 <td class="px-5 py-6 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-stethoscope" color="indigo" onclick="openExamModal('{{ $p->id }}')">Exam</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-glasses" color="sky" onclick="openRefModal('{{ $p->id }}')">Refract</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-scalpel" color="rose" onclick="openSurgModal('{{ $p->id }}')">Surgery</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-sm">No active eye principals identified in the matrix.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: Eye Registration -->
<x-cc-modal id="regModal" title="Register Eye Principal Node" icon="fa-user-plus">
 <form method="POST" action="{{ route('specialty.clinics.eye.register') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient Identity</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Operational Chief Complaint</label>
 <textarea name="complaint" required rows="3" placeholder="ACUTE_PROTOCOL_RATIONALE..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full font-medium">Authorize Registration Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Log Examination -->
<x-cc-modal id="examModal" title="Authorize Clinical Eye Examination" icon="fa-stethoscope">
 <form method="POST" action="{{ route('specialty.clinics.eye.examination') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="eye_patient_id" id="examPatientId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">VA Right Eye</label>
 <input name="va_right" required placeholder="6/6_PROTOCOL" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">VA Left Eye</label>
 <input name="va_left" required placeholder="6/6_PROTOCOL" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">IOP Right (mmHg)</label>
 <input name="iop_right" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">IOP Left (mmHg)</label>
 <input name="iop_left" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Clinical Diagnosis Matrix</label>
 <input name="diagnosis" required placeholder="DIAGNOSIS_PROTOCOL" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Therapeutic Plan Vector</label>
 <textarea name="plan" required rows="2" placeholder="MANAGEMENT_PROTOCOL..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full font-medium">Commit Examination Matrix</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Refraction -->
<x-cc-modal id="refModal" title="Commit Eye Refraction Intelligence" icon="fa-glasses">
 <form method="POST" action="{{ route('specialty.clinics.eye.refraction') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="eye_patient_id" id="refPatientId">
 <div class="grid grid-cols-3 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Sphere Right</label>
 <input name="sphere_right" type="number" step="0.25" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Cylinder Right</label>
 <input name="cylinder_right" type="number" step="0.25" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Axis Right</label>
 <input name="axis_right" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 </div>
 <div class="grid grid-cols-3 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Sphere Left</label>
 <input name="sphere_left" type="number" step="0.25" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Cylinder Left</label>
 <input name="cylinder_left" type="number" step="0.25" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Axis Left</label>
 <input name="axis_left" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="sky" class="w-full font-medium">Commit Refraction Matrix</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Surgery -->
<x-cc-modal id="surgModal" title="Authorize Eye Surgery Protocol" icon="fa-scalpel">
 <form method="POST" action="{{ route('specialty.clinics.eye.surgery.plan') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="eye_patient_id" id="surgPatientId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Surgical Procedure Matrix</label>
 <input name="procedure" required placeholder="CATARACT_EXTRACTION_PROTOCOL" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Target Eye side</label>
 <select name="eye_side" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
 <option value="right">RIGHT_EYE</option>
 <option value="left">LEFT_EYE</option>
 <option value="bilateral">BILATERAL_PROTOCOL</option>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Scheduled Date</label>
 <input name="scheduled_date" type="date" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
 </div>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="rose" class="w-full font-medium">Authorize Surgical Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<script>
function openExamModal(id) {
 document.getElementById('examPatientId').value = id;
 document.getElementById('examModal').classList.remove('hidden');
}
function openRefModal(id) {
 document.getElementById('refPatientId').value = id;
 document.getElementById('refModal').classList.remove('hidden');
}
function openSurgModal(id) {
 document.getElementById('surgPatientId').value = id;
 document.getElementById('surgModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

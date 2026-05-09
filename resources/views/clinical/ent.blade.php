<x-cc-shell title='Opeshis OS'>

@section('title', 'ENT Clinical Hub — Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">ENT Command</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Otolaryngology Intelligence · Audiology Matrix · Clinical Procedural Hub</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-plus" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
 Register ENT Node
 </x-cc-button>
 </div>
 </div>

 <!-- ENT Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Total Registry" 
 value="{{ $patients->count() }}" 
 icon="fa-users-gear" 
 trend="Institutional Log" 
 color="indigo" 
 />
 <x-cc-stat 
 title="ENT Signal" 
 value="Nominal" 
 icon="fa-ear-listen" 
 trend="Operational" 
 color="sky" 
 />
 <x-cc-stat 
 title="Audiometry Hub" 
 value="Active" 
 icon="fa-wave-square" 
 trend="Telemetry Synced" 
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

 <!-- ENT Clinical Surveillance Matrix -->
 <x-cc-card title="ENT Clinical Surveillance Matrix" icon="fa-database">
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
 <x-cc-button variant="ghost" size="sm" icon="fa-stethoscope" color="indigo" onclick="openExamModal('{{ $p->id }}')">Log Exam</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-wave-square" color="sky" onclick="openAudioModal('{{ $p->id }}')">Audiogram</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-sm">No active ENT principals identified in the matrix.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: ENT Registration -->
<x-cc-modal id="regModal" title="Register ENT Principal Node" icon="fa-user-plus">
 <form method="POST" action="{{ url('/clinical/ent/register') }}" class="space-y-6">
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

<!-- Modal: Log ENT Examination -->
<x-cc-modal id="examModal" title="Authorize Clinical ENT Examination" icon="fa-stethoscope">
 <form method="POST" action="{{ url('/clinical/ent/examination') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="ent_patient_id" id="examPatientId">
 <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Ear Findings</label>
 <textarea name="ear_findings" rows="2" placeholder="OTOSCOPY_DATA..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Nose Findings</label>
 <textarea name="nose_findings" rows="2" placeholder="RHINOSCOPY_DATA..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Throat Findings</label>
 <textarea name="throat_findings" rows="2" placeholder="LARYNGOSCOPY_DATA..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
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

<!-- Modal: Audiogram -->
<x-cc-modal id="audioModal" title="Commit Audiological Telemetry Intelligence" icon="fa-wave-square">
 <form method="POST" action="{{ url('/clinical/ent/audiogram') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="ent_patient_id" id="audioPatientId">
 <div class="grid grid-cols-2 gap-8">
 <div class="space-y-4">
 <h4 class="text-[12px] font-semibold text-sage font-medium border-b border-indigo-500/20 pb-2">Right Ear Thresholds (dB)</h4>
 <div class="grid grid-cols-2 gap-4">
 <input name="right_500" type="number" placeholder="500Hz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 <input name="right_1k" type="number" placeholder="1kHz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 <input name="right_2k" type="number" placeholder="2kHz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 <input name="right_4k" type="number" placeholder="4kHz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 </div>
 <div class="space-y-4">
 <h4 class="text-[12px] font-semibold text-sky-500 font-medium border-b border-sky-500/20 pb-2">Left Ear Thresholds (dB)</h4>
 <div class="grid grid-cols-2 gap-4">
 <input name="left_500" type="number" placeholder="500Hz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 <input name="left_1k" type="number" placeholder="1kHz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 <input name="left_2k" type="number" placeholder="2kHz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 <input name="left_4k" type="number" placeholder="4kHz" class="bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
 </div>
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Clinical Interpretation Matrix</label>
 <textarea name="interpretation" required rows="2" placeholder="AUDIOLOGICAL_RATIONALE..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600 uppercase no-scrollbar"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="sky" class="w-full font-medium">Commit Audiogram Intelligence</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<script>
function openExamModal(id) {
 document.getElementById('examPatientId').value = id;
 document.getElementById('examModal').classList.remove('hidden');
}
function openAudioModal(id) {
 document.getElementById('audioPatientId').value = id;
 document.getElementById('audioModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

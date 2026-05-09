<x-cc-shell title='Opeshis OS'>

@section('title', 'Isolation & Infection Control - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">Isolation & IPC Command</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Infection Prevention · Biohazard Containment Matrix · IPC Protocol</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-biohazard" color="rose" variant="ghost" onclick="document.getElementById('placeModal').classList.remove('hidden')">
 Activate Isolation Protocol
 </x-cc-button>
 </div>
 </div>

 <!-- Biohazard Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active Isolation" 
 value="{{ $isolations->count() }}" 
 icon="fa-door-closed" 
 trend="Institutional Log" 
 color="rose" 
 />
 <x-cc-stat 
 title="IPC Compliance" 
 value="98.2%" 
 icon="fa-shield-virus" 
 trend="Audit Target" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Biohazard Signal" 
 value="Nominal" 
 icon="fa-radiational" 
 trend="Global Surveillance" 
 color="amber" 
 />
 <x-cc-stat 
 title="Registry Pulse" 
 value="Synced" 
 icon="fa-network-wired" 
 trend="Institutional Log" 
 color="slate" 
 />
 </div>

 <!-- Containment Registry -->
 <x-cc-card title="Institutional Containment Registry Matrix" icon="fa-database">
 <x-cc-table :headers="['Patient Protocol', 'Precaution Matrix', 'Isolation Zone', 'Admission Intelligence', 'Containment Action']">
 @forelse($isolations as $i)
 <tr class="group hover:bg-rose-500/[0.02] transition-colors border-b border-slate-800/50 last:border-0">
 <td class="px-5 py-6">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors ">{{ $i->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium mt-1">{{ $i->patient->medical_id }}</div>
 </td>
 <td class="px-5 py-6">
 @php
 $typeCls = match($i->isolation_type) {
 'Airborne' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
 'Droplet' => 'bg-sky-500/10 text-sky-500 border-sky-500/20',
 'Contact' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
 default => 'bg-[#2a2e38]/50 text-slate-500 border-slate-700/50'
 };
 @endphp
 <span class="px-3 py-1 rounded-lg border {{ $typeCls }} text-[8px] font-semibold font-medium /5">
 {{ strtoupper($i->isolation_type) }} PRECAUTIONS
 </span>
 </td>
 <td class="px-5 py-6">
 <div class="text-[12px] font-semibold text-slate-300 uppercase tracking-wider">{{ $i->room_number }}</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Assigned containment node</div>
 </td>
 <td class="px-5 py-6">
 <div class="text-[12px] font-semibold text-slate-400 uppercase ">"{{ $i->reason }}"</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Placed: {{ \Carbon\Carbon::parse($i->placed_at)->format('d M, H:i') }}</div>
 </td>
 <td class="px-5 py-6 text-right">
 <div class="flex justify-end gap-2">
 <form method="POST" action="{{ url('/clinical/isolation/lift/'.$i->id) }}">
 @csrf
 <x-cc-button type="submit" variant="ghost" size="sm" icon="fa-unlock" color="rose">Lift Precautions</x-cc-button>
 </form>
 <x-cc-button variant="ghost" size="sm" icon="fa-virus" color="amber" onclick="openHAIModal('{{ $i->patient_id }}')">Log HAI</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active isolation cases in the containment registry.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>

 <!-- Outbreak Declaration Control -->
 <div class="flex justify-center pt-8">
 <x-cc-button icon="fa-triangle-exclamation" color="rose" class="px-12 py-6 rounded-2xl /30 font-medium" onclick="document.getElementById('outbreakModal').classList.remove('hidden')">
 Authorize Institutional Outbreak Declaration
 </x-cc-button>
 </div>
</div>

<!-- Modal: Activate Isolation -->
<x-cc-modal id="placeModal" title="Authorize Bio-Isolation Precautions" icon="fa-biohazard">
 <form method="POST" action="{{ url('/clinical/isolation/place') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient Identity</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Precaution Type Selection</label>
 <select name="type" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
 <option value="Contact">CONTACT_PRECAUTIONS</option>
 <option value="Droplet">DROPLET_PRECAUTIONS</option>
 <option value="Airborne">AIRBORNE_PRECAUTIONS</option>
 <option value="Neutropenic">NEUTROPENIC_PRECAUTIONS</option>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Containment Room / Node</label>
 <input name="room" required placeholder="ISO-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Clinical Rationale for Containment</label>
 <textarea name="reason" required rows="3" placeholder="CLINICAL_RATIONALE_DISCLOSURE..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="rose" class="w-full font-medium">Authorize Isolation Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Log HAI -->
<x-cc-modal id="haiModal" title="Commit Institutional HAI Intelligence" icon="fa-virus">
 <form method="POST" action="{{ url('/clinical/isolation/record-hai') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="patient_id" id="haiPatientId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Infection Type Matrix</label>
 <input name="infection_type" required placeholder="INFECTION_NODE" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Causative Organism Disclosure</label>
 <input name="organism" required placeholder="MICROBIAL_SIGNAL" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
 </div>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="amber" class="w-full font-medium">Commit HAI Intelligence</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Declare Outbreak -->
<x-cc-modal id="outbreakModal" title="Authorize Institutional Outbreak Declaration" icon="fa-triangle-exclamation">
 <form method="POST" action="{{ url('/clinical/isolation/outbreak') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Target Disease Signal</label>
 <input name="disease" required placeholder="OUTBREAK_DISEASE_NODE" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase">
 </div>
 <div class="p-6 bg-rose-500/10 border border-rose-500/20 rounded-2xl">
 <p class="text-[12px] font-semibold text-rose-500 font-medium leading-relaxed text-center">WARNING: This action will activate institutional outbreak response protocols and notify all surveillance units. Proceed only with executive clinical authorization.</p>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="rose" class="w-full font-medium">Finalize Outbreak Declaration</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<script>
function openHAIModal(id) {
 document.getElementById('haiPatientId').value = id;
 document.getElementById('haiModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

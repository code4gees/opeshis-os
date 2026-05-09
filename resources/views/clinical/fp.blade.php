<x-cc-shell title='Opeshis OS'>

@section('title', 'Family Planning - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">Family Planning Command</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Reproductive Health Intelligence · Client Registry · Method Tracking Hub</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-user-plus" color="rose" variant="ghost" onclick="document.getElementById('enrModal').classList.remove('hidden')">
 Authorize Client Enrollment
 </x-cc-button>
 </div>
 </div>

 <!-- Reproductive Health Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active Clients" 
 value="{{ $clients->count() }}" 
 icon="fa-users-between-lines" 
 trend="Institutional Log" 
 color="rose" 
 />
 <x-cc-stat 
 title="Method Diversity" 
 value="High" 
 icon="fa-layer-group" 
 trend="Active Matrix" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Return Flux" 
 value="Nominal" 
 icon="fa-calendar-check" 
 trend="Operational" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Programme Yield" 
 value="Synced" 
 icon="fa-network-wired" 
 trend="Institutional Log" 
 color="slate" 
 />
 </div>

 <!-- Client Registry Matrix -->
 <x-cc-card title="Institutional Reproductive Health Matrix" icon="fa-database">
 <x-cc-table :headers="['Client Identity', 'Current Therapeutic Method', 'Temporal Return Matrix', 'Operational Action']">
 @forelse($clients as $c)
 <tr class="group hover:bg-rose-500/[0.02] transition-colors border-b border-slate-800/50 last:border-0">
 <td class="px-5 py-6">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors ">{{ $c->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium mt-1">{{ $c->patient->medical_id }}</div>
 </td>
 <td class="px-5 py-6">
 @if($c->currentMethod)
 <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-lg text-[8px] font-semibold font-medium /5">
 {{ strtoupper($c->currentMethod->method_name) }}
 </span>
 @else
 <span class="px-3 py-1 bg-[#2a2e38]/50 text-slate-600 border border-slate-700/50 rounded-lg text-[8px] font-semibold font-medium ">PROTOCOL_PENDING</span>
 @endif
 </td>
 <td class="px-5 py-6">
 @if($c->currentMethod && $c->currentMethod->next_visit)
 <div class="text-[12px] font-semibold text-slate-400 uppercase tracking-wider">{{ \Carbon\Carbon::parse($c->currentMethod->next_visit)->format("d M Y") }}</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Scheduled return node</div>
 @else
 <div class="text-[12px] font-semibold text-slate-600 font-medium leading-none">—</div>
 @endif
 </td>
 <td class="px-5 py-6 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-exchange-alt" color="rose" onclick="openMethodModal('{{ $c->id }}')">Transition Method</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-notes-medical" color="indigo" onclick="openVisitModal('{{ $c->id }}')">Log Session</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-sm">No active reproductive health clients identified in the registry matrix.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: Authorize Enrollment -->
<x-cc-modal id="enrModal" title="Authorize Client Enrollment Protocol" icon="fa-user-plus">
 <form method="POST" action="{{ url('/clinical/fp/enroll') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient Identity</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="rose" class="w-full font-medium">Authorize Enrollment Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Transition Method -->
<x-cc-modal id="methodModal" title="Authorize Method Transition Protocol" icon="fa-exchange-alt">
 <form method="POST" action="{{ url('/clinical/fp/record-method') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="client_id" id="methodClientId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Therapeutic Method Selection</label>
 <select name="method" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
 @foreach($methods as $m)
 <option value="{{ $m }}">{{ strtoupper($m) }}</option>
 @endforeach
 </select>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Start Date Intelligence</label>
 <input name="start_date" type="date" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Return Visit Vector</label>
 <input name="next_visit" type="date" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
 </div>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="rose" class="w-full font-medium">Authorize Method Transition</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Log Session -->
<x-cc-modal id="visitModal" title="Commit Counseling Session Intelligence" icon="fa-notes-medical">
 <form method="POST" action="{{ url('/clinical/fp/record-visit') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="client_id" id="visitClientId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Counseling Session Intelligence</label>
 <textarea name="notes" required rows="3" placeholder="SESSION_INTELLIGENCE..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Side Effects / Complications Matrix</label>
 <textarea name="side_effects" rows="2" placeholder="CLINICAL_COMPLICATIONS..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="indigo" class="w-full font-medium">Commit Session Intelligence</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<script>
function openMethodModal(id) {
 document.getElementById('methodClientId').value = id;
 document.getElementById('methodModal').classList.remove('hidden');
}
function openVisitModal(id) {
 document.getElementById('visitClientId').value = id;
 document.getElementById('visitModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

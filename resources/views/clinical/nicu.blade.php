<x-cc-shell title='Opeshis OS'>

@section('title', 'NICU Command - Opeshis OS')

<div class="space-y-8 pb-20 animate-fade-in">
 
 <!-- Institutional Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">NICU <span class="text-sage">Command</span></h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Neonatal Intelligence · Feeding & Phototherapy Surveillance</p>
 </div>
 <div class="flex gap-4">
 <x-cc-button icon="fa-plus-circle" color="indigo" onclick="document.getElementById('admitModal').classList.remove('hidden')">
 Authorize Intake
 </x-cc-button>
 </div>
 </header>

 <!-- Neonatal KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Neonatal Census" 
 value="{{ $census->count() }}" 
 icon="fa-baby" 
 trend="Active Protocols" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Phototherapy" 
 value="{{ $census->where('phototherapy', true)->count() }}" 
 icon="fa-lightbulb" 
 trend="Active Units" 
 color="amber" 
 />
 <x-cc-stat 
 title="Avg Weight" 
 value="{{ number_format($census->avg('birth_weight'), 2) }} kg" 
 icon="fa-weight-scale" 
 trend="Unit Baseline" 
 color="blue" 
 />
 <x-cc-stat 
 title="Critical Care" 
 value="Active" 
 icon="fa-shield-heart" 
 trend="Surveillance" 
 color="emerald" 
 />
 </div>

 <!-- NICU Census Matrix -->
 <x-clinical-card title="Institutional Neonatal Census Matrix" icon="fa-dna" badge="Live Surveillance">
 <x-data-table :headers="['Neonate / Maternal', 'Weight / Age', 'Status Signals', 'Nutritional Log', 'Strategic Actions']">
 @forelse($census as $c)
 <tr class="group hover:bg-sage/[0.02] transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4">
 <div class="font-semibold text-white uppercase text-xs group-hover:text-sage transition-colors ">Baby of {{ $c->mother->full_name }}</div>
 <div class="text-[12px] text-slate-500 mt-1 uppercase">{{ $c->patient->medical_id }}</div>
 </td>
 <td class="px-6 py-4 text-center">
 <div class="text-[12px] font-semibold text-white tracking-wider uppercase ">{{ $c->birth_weight }} KG</div>
 <div class="text-[8px] font-semibold text-slate-600 uppercase mt-1 tracking-wider">{{ $c->gestational_age }} WEEKS GA</div>
 </td>
 <td class="px-6 py-4 text-center">
 @if($c->phototherapy)
 <x-status-badge status="pending" />
 <span class="text-[8px] font-semibold text-amber-500 uppercase ml-2 animate-pulse">PHOTOTHERAPY_ON</span>
 @else
 <x-status-badge status="completed" />
 <span class="text-[8px] font-semibold text-slate-600 uppercase ml-2">PT_OFF</span>
 @endif
 </td>
 <td class="px-6 py-4">
 @php $f = $c->latestFeeding; @endphp
 @if($f)
 <div class="text-[12px] font-semibold text-slate-200 uppercase tracking-tight ">{{ $f->feeding_type }} · {{ $f->volume_ml }}ML</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Last Intake Log</div>
 @else
 <span class="text-[12px] font-semibold text-slate-700 font-medium leading-none">BASELINE_NA</span>
 @endif
 </td>
 <td class="px-6 py-4 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-heart-pulse" color="indigo" onclick="openVitalsModal('{{ $c->id }}')">Vitals</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-utensils" color="blue" onclick="openFeedingModal('{{ $c->id }}')">Feed</x-cc-button>
 @if(!$c->phototherapy)
 <form method="POST" action="{{ route('specialty.critical.nicu.phototherapy', $c->id) }}" class="inline-block">
 @csrf
 <x-cc-button variant="ghost" size="sm" icon="fa-lightbulb" color="amber" type="submit">PT On</x-cc-button>
 </form>
 @endif
 <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald" onclick="openDischargeModal('{{ $c->id }}')">End</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <i class="fas fa-baby text-2xl"></i>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">Neonatal census matrix is currently baseline (empty).</p>
 </td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>
</div>

<!-- Modal: Intake Authorization -->
<x-cc-modal id="admitModal" title="Neonatal Intake Authorization" icon="fa-baby">
 <form method="POST" action="{{ route('specialty.critical.nicu.admit') }}" class="space-y-6">
 @csrf
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Neonate Patient ID</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Maternal Patient ID</label>
 <input name="mother_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Birth Weight (KG)</label>
 <input name="birth_weight" type="number" step="0.01" required placeholder="0.00" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Gestational Age (WEEKS)</label>
 <input name="gestational_age" type="number" required placeholder="0" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Admitting Diagnosis Protocol</label>
 <textarea name="diagnosis" required rows="3" placeholder="Indicate clinical rationale..." class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase no-scrollbar"></textarea>
 </div>
 <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Neonatal Intake</x-cc-button>
 </form>
</x-cc-modal>

<!-- Additional Modals (Vitals, Feeding, Discharge) should follow the same pattern -->

<script>
function openVitalsModal(id) {
 document.getElementById('vitalsAdmissionId').value = id;
 document.getElementById('vitalsModal').classList.remove('hidden');
}
function openFeedingModal(id) {
 document.getElementById('feedingAdmissionId').value = id;
 document.getElementById('feedingModal').classList.remove('hidden');
}
function openDischargeModal(id) {
  let url = "{{ route('specialty.critical.nicu.discharge', ':id') }}";
  document.getElementById('dischargeForm').action = url.replace(':id', id);
  document.getElementById('dischargeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

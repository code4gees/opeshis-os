<x-cc-shell title='Opeshis OS'>

@section('title', 'HDU Command - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-amber-500 uppercase tracking-tighter">High Dependency Command</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional HDU Surveillance · Step-Down Intelligence · ICU Escalation Hub</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-plus-circle" color="amber" onclick="document.getElementById('admitModal').classList.remove('hidden')">
 Authorize Admission
 </x-cc-button>
 </div>
 </div>

 <!-- HDU KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active Census" 
 value="{{ $census->count() }}" 
 icon="fa-bed-pulse" 
 trend="Active Cases" 
 color="amber" 
 />
 <x-cc-stat 
 title="Critical Risk" 
 value="{{ $census->filter(fn($c) => ($c->latestVital->spo2 ?? 100) < 90)->count() }}" 
 icon="fa-triangle-exclamation" 
 trend="Hypoxia Signal" 
 color="rose" 
 />
 <x-cc-stat 
 title="Avg Pulse" 
 value="{{ number_format($census->avg(fn($c) => $c->latestVital->heart_rate ?? 0), 0) }} bpm" 
 icon="fa-heart-pulse" 
 trend="Unit Baseline" 
 color="blue" 
 />
 <x-cc-stat 
 title="Step-Down" 
 value="Active" 
 icon="fa-stairs" 
 trend="Operational" 
 color="emerald" 
 />
 </div>

 <!-- HDU Census Matrix -->
 <x-cc-card title="Institutional HDU Census Matrix" icon="fa-hospital-user">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-[12px] font-semibold font-medium animate-pulse">Live Surveillance</span>
 </x-slot>

 <x-cc-table :headers="['Patient Identity', 'Bed / Unit', 'Diagnosis Profile', 'Hemodynamics', 'Strategic Actions']">
 @forelse($census as $c)
 <tr class="group hover:bg-amber-500/[0.02] transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-amber-500/10 flex items-center justify-center border border-amber-500/20 text-amber-500 font-bold text-xs">
 {{ substr($c->patient->full_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-amber-400 transition-colors">{{ $c->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $c->patient->medical_id }}</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 <span class="px-2 py-1 bg-card/40 border border-subtle rounded text-[12px] font-semibold text-amber-400 font-medium">
 {{ $c->bed_number }}
 </span>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <div class="text-[12px] font-semibold text-slate-400 uppercase tracking-tight truncate max-w-xs leading-relaxed">"{{ $c->admitting_diagnosis }}"</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Primary Rationale</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 @php $v = $c->latestVital; @endphp
 @if($v)
 <div class="flex gap-4">
 <div class="text-center">
 <div class="text-[12px] font-semibold text-slate-200">{{ $v->bp_systolic }}/{{ $v->bp_diastolic }}</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium">BP</div>
 </div>
 <div class="text-center">
 <div class="text-[12px] font-semibold {{ $v->spo2 < 90 ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }}">
 {{ $v->spo2 }}%
 </div>
 <div class="text-[8px] font-bold text-slate-600 font-medium">SpO₂</div>
 </div>
 </div>
 @else
 <span class="text-[12px] font-semibold text-slate-700 font-medium ">BASELINE_NA</span>
 @endif
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-heart-pulse" color="amber" onclick="openVitalsModal('{{ $c->id }}')">Vitals</x-cc-button>
 <form method="POST" action="{{ route('specialty.critical.hdu.escalate', $c->id) }}" class="inline-block">
 @csrf
 <x-cc-button variant="ghost" size="sm" icon="fa-arrow-up" color="rose" type="submit">ICU</x-cc-button>
 </form>
 <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald" onclick="openDischargeModal('{{ $c->id }}')">End</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">HDU census matrix is currently baseline (empty).</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: Intake Authorization -->
<x-cc-modal id="admitModal" title="High Dependency Intake" icon="fa-hospital-user">
 <form method="POST" action="{{ route('specialty.critical.hdu.admit') }}" class="space-y-6">
 @csrf
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Patient Identity ID</label>
 <input name="patient_id" required placeholder="UUID / Medical ID" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Bed Allocation</label>
 <input name="bed_number" required placeholder="HDU-XX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 transition-all uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Admitting Diagnosis Protocol</label>
 <input name="diagnosis" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 transition-all uppercase" placeholder="Disclosure of rationale...">
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="amber" class="w-full font-medium">Authorize HDU Admission</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Vitals Logging -->
<x-cc-modal id="vitalsModal" title="Hemodynamic Surveillance Log" icon="fa-heart-pulse">
 <form method="POST" action="{{ route('specialty.critical.hdu.vitals') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="admission_id" id="vitalsAdmissionId">
 <div class="grid grid-cols-2 gap-4">
 @foreach(['bp_systolic'=>'Sys BP','bp_diastolic'=>'Dia BP','heart_rate'=>'HR','spo2'=>'SpO2 (%)','temperature'=>'Temp (°C)'] as $name => $label)
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">{{ $label }}</label>
 <input name="{{ $name }}" type="number" step="0.1" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 @endforeach
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="amber" class="w-full">Commit Hemodynamic Data</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Discharge -->
<x-cc-modal id="dischargeModal" title="HDU Discharge Protocol" icon="fa-door-open">
 <form method="POST" id="dischargeForm" class="space-y-6">
 @csrf
 <p class="text-[12px] font-bold text-slate-400 leading-relaxed font-medium">
 ⚠ Confirming discharge will finalize the high dependency care protocol for this node. Ensure all clinical indicators are stable.
 </p>
 <div class="pt-4">
 <x-cc-button type="submit" color="emerald" class="w-full font-medium">Authorize Final Discharge</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<script>
function openVitalsModal(id) {
 document.getElementById('vitalsAdmissionId').value = id;
 document.getElementById('vitalsModal').classList.remove('hidden');
}
function openDischargeModal(id) {
  let url = "{{ route('specialty.critical.hdu.discharge', ':id') }}";
  document.getElementById('dischargeForm').action = url.replace(':id', id);
  document.getElementById('dischargeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

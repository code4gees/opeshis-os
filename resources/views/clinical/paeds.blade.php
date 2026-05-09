<x-cc-shell title='Opeshis OS'>

@section('title', 'Pediatrics Command - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-white uppercase tracking-tighter">Pediatric Clinical Hub</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Inpatient Pediatric Census & Monitoring</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-plus-circle" onclick="document.getElementById('admitModal').classList.remove('hidden')">
 Authorize Intake
 </x-cc-button>
 </div>
 </div>

 <!-- Ward KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Ward Occupancy" 
 value="{{ $stats['active'] }}" 
 icon="fa-bed" 
 trend="Active Census" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Pending Orders" 
 value="{{ $stats['pending_orders'] }}" 
 icon="fa-clipboard-check" 
 trend="Needs Attention" 
 color="amber" 
 />
 <x-cc-stat 
 title="Stability Index" 
 value="98.5%" 
 icon="fa-heart-pulse" 
 trend="Protocol Standard" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Unit Protocol" 
 value="Level II" 
 icon="fa-shield-halved" 
 trend="Active Monitoring" 
 color="slate" 
 />
 </div>

 <!-- Census Matrix -->
 <x-cc-card title="Inpatient Pediatric Census" icon="fa-users-viewfinder">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-sage/10 text-sage border border-indigo-500/20 rounded text-[12px] font-semibold font-medium">Active Monitoring</span>
 </x-slot>

 <x-cc-table :headers="['Patient Identity', 'Age / Growth', 'Ward / Bed', 'Vital Stability', 'Operations']">
 @forelse($census as $c)
 <tr class="group hover:bg-card transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-sage/10 flex items-center justify-center border border-indigo-500/20 text-sage font-bold text-xs">
 {{ substr($c->patient->full_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors">{{ $c->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $c->patient->medical_id }}</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <div class="text-xs font-semibold text-slate-300 uppercase">
 {{ $c->age_days < 365 ? $c->age_days." Days" : floor($c->age_days/365)." Years" }}
 </div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">Weight: {{ $c->weight_kg }} kg</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 border border-subtle rounded-lg text-[12px] font-semibold font-medium">
 {{ $c->ward }} · Bed {{ $c->bed_number }}
 </span>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 @php $spo2 = optional($c->latest_vitals)->spo2; @endphp
 <div class="flex items-center gap-3">
 <span class="text-xs font-semibold {{ $spo2 && $spo2 < 92 ? 'text-rose-500' : ($spo2 ? 'text-emerald-500' : 'text-slate-600') }}">
 {{ $spo2 ? $spo2.'%' : '—' }}
 </span>
 <div class="w-12 h-1 bg-[#2a2e38] rounded-full overflow-hidden">
 <div class="h-full {{ $spo2 && $spo2 < 92 ? 'bg-rose-500' : 'bg-emerald-500' }}" style="width: {{ $spo2 ?: 0 }}%"></div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-chart-line" onclick="openVitals('{{ $c->id }}')">
 Vitals
 </x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-ruler-vertical" onclick="openGrowth('{{ $c->id }}')">
 Growth
 </x-cc-button>
 <form method="POST" action="{{ route('clinical.paeds.discharge', $c->id) }}" class="inline-block">
 @csrf
 <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald">
 Discharge
 </x-cc-button>
 </form>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active paediatric admissions in the census.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: Intake Authorization -->
<x-cc-modal id="admitModal" title="Intake Authorization" icon="fa-hospital-user">
 <form method="POST" action="{{ route('clinical.paeds.admit') }}" class="space-y-6">
 @csrf
 <div class="space-y-4">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Patient UUID</label>
 <input name="patient_id" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Current Weight (KG)</label>
 <input name="weight" type="number" step="0.1" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Ward Allocation</label>
 <input name="ward" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Bed Designation</label>
 <input name="bed_number" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Admitting Clinical Diagnosis</label>
 <textarea name="diagnosis" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none h-24 no-scrollbar"></textarea>
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <x-cc-button type="submit" class="w-full">Authorize Pediatric Intake</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Vitals Logging -->
<x-cc-modal id="vitalsModal" title="Clinical Vitals Matrix" icon="fa-chart-line">
 <form method="POST" action="{{ route('clinical.paeds.vitals') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="admission_id" id="vitalsId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Temp (°C)</label>
 <input name="temperature" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Heart Rate (BPM)</label>
 <input name="heart_rate" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Resp Rate</label>
 <input name="resp_rate" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">SpO₂ (%)</label>
 <input name="spo2" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <x-cc-button type="submit" class="w-full">Record Vitals</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Growth Monitoring -->
<x-cc-modal id="growthModal" title="Growth Telemetry" icon="fa-ruler-vertical">
 <form method="POST" action="{{ route('clinical.paeds.growth') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="admission_id" id="growthId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Weight (KG)</label>
 <input name="weight" step="0.01" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Height (CM)</label>
 <input name="height" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Head Circ (CM)</label>
 <input name="hc" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">MUAC (CM)</label>
 <input name="muac" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <x-cc-button type="submit" class="w-full">Save Growth Data</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<script>
function openVitals(id){ document.getElementById('vitalsId').value=id; document.getElementById('vitalsModal').classList.remove('hidden'); }
function openGrowth(id){ document.getElementById('growthId').value=id; document.getElementById('growthModal').classList.remove('hidden'); }
</script>
</x-cc-shell>

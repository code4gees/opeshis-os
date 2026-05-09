<x-cc-shell title='Opeshis OS'>

@section('title', 'Emergency & Trauma Hub - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-rose-500 uppercase tracking-tighter">Emergency & Trauma</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Accident & Emergency (A&E) Department Command</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-plus-circle" color="rose" onclick="document.getElementById('intakeModal').classList.remove('hidden')">
 Authorize Intake
 </x-cc-button>
 </div>
 </div>

 <!-- Emergency Status KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Trauma Queue" 
 value="{{ $activeEmergencies->count() }}" 
 icon="fa-truck-medical" 
 trend="Active Waiting" 
 color="rose" 
 />
 <x-cc-stat 
 title="ER Capacity" 
 value="4/6" 
 icon="fa-bed" 
 trend="Beds Available" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Triage Latency" 
 value="12m" 
 icon="fa-clock" 
 trend="Target < 15m" 
 color="blue" 
 />
 <x-cc-stat 
 title="Critical Cases" 
 value="{{ $resuscitationCases->count() }}" 
 icon="fa-heart-pulse" 
 trend="ICU/Resus" 
 color="amber" 
 />
 </div>

 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 <!-- Main Column: Active Queue -->
 <div class="lg:col-span-2 space-y-8">
 <x-cc-card title="Active Trauma & Resuscitation Queue" icon="fa-list-ul">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[12px] font-semibold font-medium">Live Updates</span>
 </x-slot>

 <x-cc-table :headers="['Patient Identity', 'Vital Status', 'Priority', 'Arrival', 'Strategic Actions']">
 @forelse($activeEmergencies as $ae)
 <tr class="group hover:bg-rose-500/[0.02] transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-rose-500/10 flex items-center justify-center border border-rose-500/20 text-rose-500 font-bold text-xs">
 {{ substr($ae->patient->full_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $ae->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $ae->patient->medical_id }}</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 @php $vitals = json_decode($ae->vitals_data ?? '{}', true); @endphp
 <div class="flex gap-4">
 <div class="text-center">
 <div class="text-[12px] font-semibold {{ ($vitals['temp'] ?? 0) > 37.5 ? 'text-rose-500 animate-pulse' : 'text-slate-300' }}">{{ $vitals['temp'] ?? '--' }}°C</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium">TEMP</div>
 </div>
 <div class="text-center">
 <div class="text-[12px] font-semibold text-slate-300">{{ $vitals['bp_sys'] ?? '--' }}/{{ $vitals['bp_dia'] ?? '--' }}</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium">BP</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 <span class="px-2 py-0.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[12px] font-semibold font-medium animate-pulse">
 RED CODE
 </span>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <div class="text-xs font-semibold text-slate-300 uppercase tracking-tight">{{ \Carbon\Carbon::parse($ae->created_at)->format('H:i') }}</div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">{{ \Carbon\Carbon::parse($ae->created_at)->diffForHumans(null, true) }}</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <x-cc-button variant="ghost" size="sm" icon="fa-bolt-lightning" color="rose" href="{{ route('emr.main', ['id' => $ae->patient_id]) }}">
 Initialize Care
 </x-cc-button>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active emergency cases in the queue.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
 </div>

 <!-- Right Column: Resuscitation Cases -->
 <div class="space-y-8">
 <x-cc-card title="ICU / Resus Monitoring" icon="fa-heart-pulse">
 <div class="space-y-4">
 @forelse($resuscitationCases as $rc)
 <div class="p-4 rounded-xl bg-rose-500/[0.03] border border-rose-500/10 hover:border-rose-500/30 transition-all group">
 <div class="flex justify-between items-start">
 <div class="flex gap-3">
 <div class="w-10 h-10 rounded-lg bg-rose-500/10 text-rose-500 border border-rose-500/20 flex items-center justify-center font-bold text-sm">
 {{ substr($rc->patient->full_name, 0, 1) }}
 </div>
 <div>
 <h4 class="text-xs font-semibold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $rc->patient->full_name }}</h4>
 <p class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">{{ $rc->bed->ward->name }} · Bed {{ $rc->bed->bed_number }}</p>
 </div>
 </div>
 <span class="text-[12px] font-semibold text-rose-600 font-medium">CRITICAL</span>
 </div>
 </div>
 @empty
 <div class="py-12 text-center">
 <p class="text-xs font-bold text-slate-600 font-medium">Stability Baseline</p>
 </div>
 @endforelse
 </div>
 </x-cc-card>
 </div>
 </div>
</div>

<!-- Modal: Rapid Intake -->
<x-cc-modal id="intakeModal" title="Rapid Trauma Intake" icon="fa-truck-medical">
 <form method="POST" action="{{ route('clinical.emergency.intake') }}" class="space-y-6">
 @csrf
 <div class="space-y-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Subject Identity / Description</label>
 <input type="text" name="full_name" required placeholder="e.g. John Doe or 'Unknown Male 01'" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Gender Selection</label>
 <select name="gender" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
 <option value="Male">Male</option>
 <option value="Female">Female</option>
 <option value="Indeterminate">Indeterminate / Unknown</option>
 </select>
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <x-cc-button type="submit" color="rose" class="w-full">Initialize Emergency Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>
</x-cc-shell>

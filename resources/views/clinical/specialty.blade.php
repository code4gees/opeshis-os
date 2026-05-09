<x-cc-shell title='Opeshis OS'>

@section('title', strtoupper($type) . ' Specialized Clinic - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">{{ $type }} Command Hub</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Specialized Intelligence · Clinical Procedural Hub · Strategic Assessment Hub</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-plus-circle" color="slate" variant="ghost" onclick="document.getElementById('sessionModal').classList.remove('hidden')">
 Authorize Session
 </x-cc-button>
 </div>
 </div>

 <!-- Specialized Telemetry KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Today's Visits" 
 value="{{ $patients->where('created_at', '>=', now()->startOfDay())->count() }}" 
 icon="fa-user-nurse" 
 trend="Active Registry" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Total Registry" 
 value="{{ $patients->count() }}" 
 icon="fa-book-medical" 
 trend="Institutional Log" 
 color="slate" 
 />
 <x-cc-stat 
 title="Procedure Yield" 
 value="{{ $patients->whereNotNull('procedure_done')->count() }}" 
 icon="fa-scalpel-path" 
 trend="Interventions" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Protocol Status" 
 value="Nominal" 
 icon="fa-shield-heart" 
 trend="Operational" 
 color="amber" 
 />
 </div>

 <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
 <!-- Consultation Registry Matrix -->
 <div class="lg:col-span-8">
 <x-cc-card title="Institutional Specialized Clinical Matrix" icon="fa-database">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-sage/10 text-sage border border-indigo-500/20 rounded text-[12px] font-semibold font-medium ">Registry Sync: Active</span>
 </x-slot>

 <x-cc-table :headers="['Patient Profile Identity', 'Clinical Findings Intelligence', 'Intervention Matrix', 'Temporal Log']">
 @forelse($patients as $p)
 <tr class="group hover:bg-sage/[0.02] transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-[#2a2e38] flex items-center justify-center border border-slate-700 text-slate-400 font-bold text-xs uppercase">
 {{ substr($p->patient->full_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors ">{{ $p->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $p->patient->medical_id }}</div>
 </div>
 </div>
 </td>
 <td class="px-5 py-4">
 <div class="text-[12px] font-bold text-slate-400 leading-relaxed uppercase tracking-tight line-clamp-2" title="{{ $p->clinical_findings }}">"{{ $p->clinical_findings }}"</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 @php
 $procCls = $p->procedure_done ? 'bg-sage/10 text-sage border-indigo-500/20' : 'bg-card/50 text-slate-600 border-subtle ';
 @endphp
 <span class="px-3 py-1 rounded-lg border {{ $procCls }} text-[8px] font-semibold font-medium ">
 {{ $p->procedure_done ?? 'ASSESSMENT_ONLY' }}
 </span>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <div class="text-[12px] font-semibold text-slate-500 font-medium ">
 {{ \Carbon\Carbon::parse($p->created_at)->format('d M') }}
 <span class="block text-[12px] text-slate-600 mt-1">{{ \Carbon\Carbon::parse($p->created_at)->format('H:i') }}</span>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-sm">No specialized clinical records identified in the matrix.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
 </div>

 <!-- Session Authorization Sidebar -->
 <div class="lg:col-span-4">
 <x-cc-card title="Authorize Clinical Session" icon="fa-shield-halved">
 <form method="POST" action="{{ url('/specialty/save') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="clinic_type" value="{{ $type }}">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Patient Identity Protocol</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Clinical Intelligence Disclosure</label>
 <textarea name="findings" rows="6" required placeholder="ENTER CLINICAL FINDINGS..." class="w-full bg-card/50 border border-subtle rounded-2xl px-4 py-4 text-sm font-bold text-slate-200 outline-none no-scrollbar resize-none focus:ring-2 focus:ring-indigo-600 uppercase"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Intervention Protocol Executed</label>
 <input name="procedure" placeholder="e.g. MINOR_SURGICAL_INTERVENTION" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 <div class="pt-2">
 <x-cc-button type="submit" color="indigo" class="w-full font-medium">Authorize Record Relay</x-cc-button>
 </div>
 </form>
 </x-cc-card>
 </div>
 </div>
</div>

<!-- Modal: Session Authorization (Overlay Alternative) -->
<x-cc-modal id="sessionModal" title="Specialized Session Authorization" icon="fa-plus-circle">
 <!-- Form content same as sidebar but for mobile/quick access -->
</x-cc-modal>
</x-cc-shell>

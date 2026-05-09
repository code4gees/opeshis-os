<x-cc-shell title='Opeshis OS'>

@section('title', 'Tuberculosis Clinical Hub - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">TB Command Hub</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional DOTS Monitoring · TB Case Management · Therapeutic Adherence Hub</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-plus-circle" color="amber" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
 Authorize TB Case
 </x-cc-button>
 </div>
 </div>

 <!-- TB Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active TB Census" 
 value="{{ $cases->count() }}" 
 icon="fa-lungs-virus" 
 trend="Active Registry" 
 color="amber" 
 />
 <x-cc-stat 
 title="DOTS Sessions" 
 value="{{ $cases->sum('dots_logs_count') }}" 
 icon="fa-prescription-bottle-medical" 
 trend="Therapeutic Adherence" 
 color="indigo" 
 />
 <x-cc-stat 
 title="Adherence Signal" 
 value="94%" 
 icon="fa-chart-line" 
 trend="Nominal Performance" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Surveillance Status" 
 value="Synced" 
 icon="fa-tower-broadcast" 
 trend="Institutional Log" 
 color="slate" 
 />
 </div>

 <!-- DOTS Clinical Matrix -->
 <x-cc-card title="Institutional DOTS Clinical Matrix" icon="fa-database">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-[12px] font-semibold font-medium ">Protocol: Active Surveillance</span>
 </x-slot>

 <x-cc-table :headers="['Patient Profile Identity', 'Classification Matrix', 'Therapeutic Regimen', 'Adherence Profile', 'Strategic Action']">
 @forelse($cases as $c)
 <tr class="group hover:bg-amber-500/[0.02] transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-[#2a2e38] flex items-center justify-center border border-slate-700 text-slate-400 font-bold text-xs uppercase">
 {{ substr($c->patient->full_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-amber-400 transition-colors ">{{ $c->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $c->patient->medical_id }}</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <span class="px-3 py-1 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-lg text-[8px] font-semibold font-medium /5">
 {{ strtoupper($c->tb_type) }}
 </span>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <div class="text-[12px] font-semibold text-slate-400 font-medium ">{{ $c->regimen }}</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 <div class="flex flex-col items-center">
 <span class="text-lg font-semibold text-slate-200 leading-none">{{ $c->dots_logs_count }}</span>
 <span class="text-[8px] font-semibold text-slate-600 uppercase mt-1 ">Observed Sessions</span>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <form method="POST" action="{{ url('/clinical/tb/'.$c->id.'/dots') }}">
 @csrf
 <input name="observed" value="yes" hidden>
 <x-cc-button type="submit" variant="ghost" size="sm" icon="fa-check-circle" color="amber">Log DOTS Session</x-cc-button>
 </form>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active TB cases identified in the clinical registry matrix.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: Authorize TB Registration -->
<x-cc-modal id="regModal" title="Authorize TB Case Registration" icon="fa-plus-circle">
 <form method="POST" action="{{ url('/clinical/tb/register') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient Identity</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">TB Classification Matrix</label>
 <select name="tb_type" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 <option value="PTB_PROTOCOL">PTB_PROTOCOL</option>
 <option value="EPTB_PROTOCOL">EPTB_PROTOCOL</option>
 <option value="MDR_TB_RESISTANCE">MDR_TB_RESISTANCE</option>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Treatment Regimen Code</label>
 <input name="regimen" required placeholder="e.g. 2RHZE_4RH" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Sputum Baseline Result</label>
 <input name="sputum" placeholder="e.g. SMEAR POSITIVE" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="amber" class="w-full font-medium">Authorize Registration Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Malaria Clinic - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">Malaria Command Hub</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Case Registration · Epidemiological Surveillance · Parasite Matrix Hub</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-user-plus" color="amber" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
 Register New Case
 </x-cc-button>
 </div>
 </div>

 <!-- Malaria Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 label="Active Surveillance" 
 value="{{ $cases->count() }}" 
 icon="fa-microscope" 
 trend="Active Registry" 
 color="amber" 
 />
 <x-cc-stat 
 label="Positivity Yield" 
 value="{{ $cases->where('result', 'POSITIVE_SIGNAL')->count() }}" 
 icon="fa-virus-covid" 
 trend="Signal Detection" 
 color="rose" 
 />
 <x-cc-stat 
 label="Testing Velocity" 
 value="High" 
 icon="fa-bolt-lightning" 
 trend="Operational" 
 color="indigo" 
 />
 <x-cc-stat 
 label="Epidemiology" 
 value="Nominal" 
 icon="fa-tower-broadcast" 
 trend="Institutional Log" 
 color="slate" 
 />
 </div>

 <!-- Case Surveillance Matrix -->
 <x-cc-card title="Institutional Malaria Surveillance Matrix" icon="fa-database">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-[12px] font-semibold font-medium ">Registry Sync: Active</span>
 </x-slot>

 <x-cc-table :headers="['Patient Profile Identity', 'Species Matrix', 'Diagnostic Vector', 'Result Outcome', 'Therapeutic Action', 'Temporal Log']">
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
 <div class="text-[12px] font-semibold text-amber-500 tracking-wider uppercase">{{ $c->species }}</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-[12px] font-semibold text-slate-500 font-medium ">
 {{ $c->test_type }}
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 @php
 $statusCls = str_contains($c->result, 'POSITIVE') ? 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20';
 @endphp
 <span class="px-3 py-1.5 rounded-lg border {{ $statusCls }} text-[8px] font-semibold font-medium ">
 {{ strtoupper($c->result) }}
 </span>
 </td>
 <td class="px-5 py-4">
 <div class="text-[12px] font-semibold text-slate-400 uppercase tracking-tight line-clamp-1" title="{{ $c->treatment_given }}">{{ $c->treatment_given }}</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <div class="text-[12px] font-semibold text-slate-500 font-medium ">
 {{ \Carbon\Carbon::parse($c->created_at)->format('d M Y') }}
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class="px-6 py-12 text-center text-slate-600 text-sm">No active malaria cases identified in the surveillance matrix.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: Register Malaria Case -->
<x-cc-modal id="regModal" title="Authorize Malaria Case Registration" icon="fa-user-plus">
 <form method="POST" action="{{ url('/clinical/malaria/register') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient Identity</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Parasite Species Matrix</label>
 <select name="species" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 <option value="P. falciparum">P. falciparum</option>
 <option value="P. vivax">P. vivax</option>
 <option value="P. malariae">P. malariae</option>
 <option value="UNKNOWN_SIGNAL">UNKNOWN_SIGNAL</option>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Diagnostic Vector</label>
 <select name="test_type" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 <option value="RDT_KIT_SURVEILLANCE">RDT_KIT_SURVEILLANCE</option>
 <option value="MICROSCOPY_LAB_PROTOCOL">MICROSCOPY_LAB_PROTOCOL</option>
 <option value="PCR_GENOMIC_ANALYSIS">PCR_GENOMIC_ANALYSIS</option>
 </select>
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Diagnostic Outcome Result</label>
 <select name="result" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 <option value="POSITIVE_SIGNAL">POSITIVE_SIGNAL</option>
 <option value="NEGATIVE_SIGNAL">NEGATIVE_SIGNAL</option>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Therapeutic Action Executed</label>
 <input name="treatment" placeholder="e.g. ARTEMETHER_LUMEFANTRINE" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="amber" class="w-full font-medium">Authorize Registration Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>
</x-cc-shell>

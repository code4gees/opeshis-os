<x-cc-shell title='Opeshis OS'>

@section('title', 'CSSD Strategic Command — Opeshis OS')


<div class="space-y-8 animate-fade-in">
 <!-- Header: CSSD Command Hub -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">CSSD Command</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Sterile Services · Infection Control Surveillance · Asset Validation</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('loadModal').classList.remove('hidden')" class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Initiate Sterilization Cycle
 </button>
 </div>
 </header>

 <!-- CSSD Telemetry KPIs -->
 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-indigo-500/5 to-transparent flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-4">Cycles Processed (Today)</p>
 <h3 class="text-4xl font-semibold text-white tracking-tighter">{{ $loadStats->total ?? 0 }}</h3>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-emerald-500/5 to-transparent flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-emerald-500 font-medium mb-4">Validation: PASSED</p>
 <h3 class="text-4xl font-semibold text-emerald-500 tracking-tighter">{{ $loadStats->passed ?? 0 }}</h3>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-rose-500/5 to-transparent flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-rose-500 font-medium mb-4">Quarantined / Failed</p>
 <h3 class="text-4xl font-semibold text-rose-500 tracking-tighter">{{ $loadStats->failed ?? 0 }}</h3>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-amber-500/5 to-transparent flex flex-col justify-center relative overflow-hidden">
 <p class="text-[12px] font-semibold text-amber-500 font-medium mb-4 ">Expiring Protocol (14D)</p>
 <h3 class="text-4xl font-semibold text-white tracking-tighter">{{ $expiringCount }}</h3>
 @if($expiringCount > 0)
 <div class="absolute top-8 right-8 w-2 h-2 bg-rose-500 rounded-full animate-ping"></div>
 @endif
 </div>
 </div>

 <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
 <!-- Active Sterilization Matrix -->
 <div class="lg:col-span-8 bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Live Sterilization Ledger</h3>
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 rounded-lg text-[8px] font-semibold font-medium border border-subtle ">Chain Sync: Operational</span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Load Protocol Matrix</th>
 <th class="px-6 py-6">Sterilizer Unit ID</th>
 <th class="px-6 py-6">Methodology</th>
 <th class="px-6 py-6 text-center">Status</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 @foreach($todayLoads as $l)
 <tr class="hover:bg-[#2a2e38] transition-all group">
 <td class="px-10 py-6">
 <div class="font-semibold text-sage text-sm uppercase group-hover:text-indigo-300 transition-colors">{{ $l->load_number }}</div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-0.5 ">EXPIRY_SYNC: {{ \Carbon\Carbon::parse($l->expiry_date)->format('d M Y') }}</div>
 </td>
 <td class="px-6 py-6">
 <div class="text-[12px] font-semibold text-white font-medium ">{{ $l->sterilizer_name }}</div>
 </td>
 <td class="px-6 py-6">
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $l->sterilization_method }}</div>
 </td>
 <td class="px-6 py-6 text-center">
 @php
 $statusCls = [
 'passed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
 'in_progress' => 'bg-sage/10 text-sage border-indigo-500/20 animate-pulse /10',
 'failed' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
 ];
 $cls = $statusCls[$l->load_status] ?? 'bg-[#2a2e38] text-slate-400 border-subtle';
 @endphp
 <span class="px-3 py-1 rounded-lg border {{ $cls }} text-[8px] font-semibold font-medium">
 {{ str_replace('_', ' ', $l->load_status) }}
 </span>
 </td>
 </tr>
 @endforeach
 @if($todayLoads->isEmpty())
 <tr>
 <td colspan="4" class="px-10 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No active sterilization cycles identified in the current window.</p>
 </td>
 </tr>
 @endif
 </tbody>
 </table>
 </div>
 </div>

 <!-- Sterilizer Fleet Status -->
 <div class="lg:col-span-4 space-y-8">
 <div class="bg-card rounded-[3rem] p-10 border border-subtle relative overflow-hidden bg-card">
 <h3 class="text-xs font-semibold text-white font-medium mb-10 border-b border-subtle pb-4 ">Fleet Validation Status</h3>
 <div class="space-y-4 relative z-10">
 @foreach($sterilizers as $st)
 @php $overdue = (\Carbon\Carbon::parse($st->next_validation_due)->isPast()); @endphp
 <div class="p-6 rounded-3xl border {{ $overdue ? 'border-rose-500/30 bg-rose-500/5 /5' : 'border-subtle bg-[#2a2e38]' }} transition-all group hover:border-indigo-500/30">
 <div class="flex justify-between items-start mb-4">
 <div>
 <h3 class="text-[12px] font-semibold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $st->sterilizer_name }}</h3>
 <p class="text-[8px] font-semibold text-slate-500 uppercase mt-1 tracking-wider">{{ $st->sterilizer_type }}</p>
 </div>
 @if($overdue)
 <span class="px-2 py-1 bg-rose-600 text-white rounded text-[7px] font-semibold font-medium animate-pulse">Overdue</span>
 @else
 <span class="px-2 py-1 bg-emerald-500 text-white rounded text-[7px] font-semibold font-medium">Validated</span>
 @endif
 </div>
 <div class="flex justify-between items-center text-[8px] font-semibold font-medium text-slate-500">
 <span class="">Next Validation:</span>
 <span class="{{ $overdue ? 'text-rose-500' : 'text-white' }}">{{ \Carbon\Carbon::parse($st->next_validation_due)->format('d M Y') }}</span>
 </div>
 </div>
 @endforeach
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-sage/5 rounded-full blur-3xl"></div>
 </div>
 </div>
 </div>
</div>

<!-- Modal: Initiate Sterilization -->
<div id="loadModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-8 uppercase tracking-tight">Initiate Sterilization Protocol</h3>
 <form method="POST" action="{{ route('cssd.store') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Unit Fleet Selection</label>
 <select name="sterilizer_id" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 @foreach($sterilizers as $st)
 <option value="{{ $st->id }}">{{ $st->sterilizer_name }}</option>
 @endforeach
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Sterilization Methodology</label>
 <select name="method" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 <option>Steam Autoclave (134°C / 4 min)</option>
 <option>Plasma (Hydrogen Peroxide)</option>
 <option>EO Gas (Ethylene Oxide)</option>
 <option>Dry Heat (160°C / 2 hrs)</option>
 </select>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('loadModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-[12px] font-semibold font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Start Cycle</button>
 </div>
 </form>
 </div>
</div>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Institutional Reporting & DHIS2 — Opeshis OS')


<div class="space-y-8 animate-fade-in">
 <!-- Header: Reporting Command -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Reporting Command</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional HMIS Aggregation · DHIS2 National Data Link · Strategic Analytics</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('generateModal').classList.remove('hidden')" class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Generate Period Report
 </button>
 </div>
 </header>

 <!-- DHIS2 Integration Status -->
 <div class="bg-card rounded-[2.5rem] border border-subtle p-10 flex items-center justify-between bg-gradient-to-br from-indigo-500/5 to-transparent relative overflow-hidden">
 <div class="flex items-center gap-10 relative z-10">
 <div class="w-20 h-20 bg-sage/10 rounded-[2rem] border border-indigo-500/20 flex items-center justify-center relative ">
 <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="text-sage"><path d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>
 <div class="absolute -top-2 -right-2 w-5 h-5 bg-emerald-500 rounded-full border-4 border-slate-900 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
 </div>
 <div>
 <h3 class="text-sm font-semibold text-white font-medium">DHIS2 National Instance</h3>
 <p class="text-[12px] font-bold text-slate-500 font-medium mt-2 ">{{ $config->instance_url ?? 'UNCONFIGURED_INSTANCE_LINK' }}</p>
 </div>
 </div>
 <div class="text-right relative z-10">
 <div class="flex items-center justify-end gap-2 mb-2">
 <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
 <p class="text-[12px] font-semibold text-emerald-500 font-medium">Linked & Operational</p>
 </div>
 <p class="text-[12px] font-bold text-slate-500 font-medium">Last Payload Sync: {{ date('M d, H:i') }}</p>
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-sage/5 rounded-full blur-3xl"></div>
 </div>

 <!-- Reporting Registry Matrix -->
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Institutional Reporting Ledger</h3>
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 rounded-lg text-[8px] font-semibold font-medium border border-subtle">Registry Sync: Active</span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Reporting Period Protocol</th>
 <th class="px-6 py-6">Form Matrix (MoH)</th>
 <th class="px-6 py-6">Authorized By</th>
 <th class="px-6 py-6 text-center">Transmission Status</th>
 <th class="px-10 py-6 text-right">Strategic Action</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 @forelse($reports as $r)
 <tr class="hover:bg-[#2a2e38] transition-all group">
 <td class="px-10 py-6">
 <div class="font-semibold text-white text-sm uppercase group-hover:text-sage transition-colors">{{ $r->report_period }}</div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-0.5">{{ date('M d, Y · H:i', strtotime($r->created_at)) }}</div>
 </td>
 <td class="px-6 py-6">
 <span class="px-3 py-1 bg-sage/10 border border-indigo-500/20 rounded-lg text-[12px] font-semibold text-sage font-medium">{{ $r->report_type }}</span>
 </td>
 <td class="px-6 py-6">
 <div class="text-[12px] font-semibold text-white font-medium">{{ $r->generator }}</div>
 <div class="text-[8px] font-bold text-slate-500 font-medium mt-1">Authorizing Officer</div>
 </td>
 <td class="px-6 py-6 text-center">
 @php $isTransmitted = $r->status === 'TRANSMITTED'; @endphp
 <span class="px-3 py-1 rounded-lg border text-[8px] font-semibold font-medium
 {{ $isTransmitted ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20 animate-pulse' }}">
 {{ $r->status }}
 </span>
 </td>
 <td class="px-10 py-6 text-right">
 <div class="flex justify-end gap-3">
 <button onclick="viewPayload('{{ $r->id }}')" class="px-4 py-2 bg-[#2a2e38] text-slate-400 border border-subtle rounded-lg text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">View Payload</button>
 @if($r->status === 'DRAFT')
 <form method="POST" action="{{ url('/reporting/export') }}">
 @csrf
 <input type="hidden" name="report_id" value="{{ $r->id }}">
 <button class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-[12px] font-semibold font-medium /20 hover:bg-emerald-700 transition-all border border-emerald-500/50">Transmit to MoH</button>
 </form>
 @else
 <span class="px-4 py-2 bg-[#2a2e38] text-slate-600 border border-subtle rounded-lg text-[12px] font-semibold font-medium ">Archived Matrix</span>
 @endif
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-10 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No institutional periodic reports identified in the registry.</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
</div>

<!-- Modal: Generate Period Report -->
<div id="generateModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-8 uppercase tracking-tight">Generate Institutional Analytics</h3>
 <form method="POST" action="{{ url('/reporting/generate') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Strategic Reporting Period</label>
 <input name="period" type="month" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Report Framework Matrix (MoH Standard)</label>
 <select name="type" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 <option value="HMIS-105">HMIS 105: Strategic Outpatient Surveillance</option>
 <option value="HMIS-108">HMIS 108: Institutional Inpatient Census</option>
 <option value="IDSR-WEEKLY">IDSR Weekly Epidemiological Surveillance</option>
 <option value="ART-QUARTERLY">ART Quarterly Institutional Performance</option>
 </select>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('generateModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-[12px] font-semibold font-medium /20">Aggregate & Generate Report</button>
 </div>
 </form>
 </div>
</div>

</x-cc-shell>

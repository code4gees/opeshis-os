<x-cc-shell title='Opeshis OS'>

@section('title', 'UHC & Social Health Monitor — Opeshis OS')


<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: UHC & National Health Link -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">National Health Link</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Social Health Interoperability · UHC Insurance Linkage · National Registry Sync</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('enrollModal').classList.remove('hidden')" class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Link National Registry ID
 </button>
 </div>
 </header>

 <!-- UHC Interoperability Telemetry -->
 <div class="grid grid-cols-1 xl:grid-cols-4 gap-8 mb-10">
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-indigo-500/5 to-transparent flex flex-col justify-center relative overflow-hidden">
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-4 ">Covered Census Population</p>
 <h3 class="text-4xl font-semibold text-white tracking-tighter">{{ $enrollments->count() }} <span class="text-xs font-semibold text-sage ml-1 uppercase">Lives</span></h3>
 <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-sage/5 rounded-full blur-2xl"></div>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-amber-500/5 to-transparent flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-amber-500 font-medium mb-4 ">Active Claims (Pending Cycle)</p>
 <h3 class="text-4xl font-semibold text-amber-500 tracking-tighter">{{ $recentClaims->where('claim_status', 'pending')->count() }}</h3>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-emerald-500/5 to-transparent flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-emerald-500 font-medium mb-4 ">Institutional Yield Performance</p>
 <h3 class="text-4xl font-semibold text-emerald-500 tracking-tighter">94.2%</h3>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-4 ">National Registry Link</p>
 <div class="flex items-center gap-3">
 <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
 <h3 class="text-xl font-semibold text-white uppercase tracking-tighter">Synchronized</h3>
 </div>
 </div>
 </div>

 <div class="grid grid-cols-1 xl:grid-cols-12 gap-10">
 <!-- Enrollment Ledger Matrix -->
 <div class="xl:col-span-8 bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">UHC / Insurance Linkage Ledger</h3>
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 rounded-lg text-[8px] font-semibold font-medium border border-subtle ">Interoperability: Operational</span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Patient Institutional Identity</th>
 <th class="px-6 py-6">National Health ID (NID)</th>
 <th class="px-6 py-6">Coverage Framework</th>
 <th class="px-6 py-6 text-center">Verification Protocol</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 @foreach ($enrollments as $e)
 <tr class="hover:bg-[#2a2e38] transition-all group">
 <td class="px-10 py-6">
 <div class="font-semibold text-white text-sm uppercase group-hover:text-sage transition-colors">{{ $e->full_name }}</div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-0.5 ">{{ $e->medical_id }}</div>
 </td>
 <td class="px-6 py-6">
 <div class="text-[12px] font-semibold text-sage font-mono tracking-wider uppercase">{{ $e->uhc_id }}</div>
 <div class="text-[8px] font-bold text-slate-500 font-medium mt-1 ">Verified National Identifier</div>
 </td>
 <td class="px-6 py-6">
 <div class="text-[12px] font-semibold text-slate-400 font-medium">{{ $e->scheme_name }}</div>
 </td>
 <td class="px-6 py-6 text-center">
 <span class="px-4 py-1.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-xl text-[8px] font-semibold font-medium /5">Verified Institutional Link</span>
 </td>
 </tr>
 @endforeach
 @if($enrollments->isEmpty())
 <tr>
 <td colspan="4" class="px-10 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No institutional-national health linkages identified in the matrix.</p>
 </td>
 </tr>
 @endif
 </tbody>
 </table>
 </div>
 </div>

 <!-- Real-time Claim Stream Matrix -->
 <div class="xl:col-span-4 space-y-8">
 <div class="bg-card rounded-[3rem] p-10 border border-subtle relative overflow-hidden bg-card">
 <h3 class="text-xs font-semibold text-white font-medium mb-10 border-b border-subtle pb-4 ">Real-time Claims Stream</h3>
 <div class="space-y-4 relative z-10">
 @foreach($recentClaims as $c)
 <div class="p-8 rounded-[2.5rem] border border-subtle bg-[#2a2e38] group hover:border-indigo-500/30 transition-all">
 <div class="flex justify-between items-start mb-6">
 <span class="text-[8px] font-semibold text-slate-500 font-medium">CLAIM_PROTOCOL_#{{ $c->insurance_claim_id }}</span>
 <span class="px-2 py-1 bg-amber-500/10 text-amber-500 rounded text-[7px] font-semibold font-medium animate-pulse border border-amber-500/20">{{ $c->claim_status }}</span>
 </div>
 <h5 class="text-[12px] font-semibold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $c->full_name }}</h5>
 <div class="mt-8 flex justify-between items-center">
 <span class="text-[12px] font-semibold text-white ">{{ number_format($c->total_amount, 0) }} <span class="text-[8px] text-slate-500">FCFA</span></span>
 <button class="px-4 py-2 bg-[#2a2e38] text-sage border border-subtle rounded-xl text-[8px] font-semibold font-medium hover:bg-sage hover:text-white transition-all">Vouch Payload &rarr;</button>
 </div>
 </div>
 @endforeach
 @if($recentClaims->isEmpty())
 <p class="text-[12px] text-slate-600 font-semibold font-medium text-center py-20">No active claims identified in the live stream.</p>
 @endif
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-sage/5 rounded-full blur-3xl"></div>
 </div>
 </div>
 </div>
</div>

<!-- Modal: National Linkage Protocol -->
<div id="enrollModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-8 uppercase tracking-tight">Institutional-National Health Linkage</h3>
 <form method="POST" action="{{ route('uhc.enroll') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Institutional Patient ID</label>
 <input type="text" name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">National Health Identity (NID / Social Security)</label>
 <input type="text" name="uhc_id" required placeholder="ENTER_NATIONAL_IDENTIFIER" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Target Insurance Coverage Framework</label>
 <select name="scheme" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 <option>Universal Basic Coverage (UBC)</option>
 <option>Civil Servant Social Security (CSSS)</option>
 <option>Military Health Strategy (MHS)</option>
 <option>Private Corporate Tier 01 Protocol</option>
 </select>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('enrollModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Cancel Linkage</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-[12px] font-semibold font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Establish Connectivity</button>
 </div>
 </form>
 </div>
</div>
</x-cc-shell>

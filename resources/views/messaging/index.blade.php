<x-cc-shell title='Opeshis OS'>

@section('title', 'Institutional Messaging Engine — Opeshis OS')


<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: Messaging Command Hub -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Messaging Command</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Notification Engine · Real-time Alert Relay · Transmission Surveillance</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('composeModal').classList.remove('hidden')" class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Authorize Message Dispatch
 </button>
 </div>
 </header>
 
 @if(session('success'))
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[12px] font-semibold font-medium mb-8 animate-pulse">
 {{ session('success') }}
 </div>
 @endif

 <!-- Transmission Telemetry Grid -->
 <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-indigo-500/5 to-transparent flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-4 ">Active Queue Status</p>
 <div class="flex items-end gap-3">
 <h2 class="text-5xl font-semibold text-white tracking-tighter">{{ $stats->pending ?? 0 }}</h2>
 <span class="text-[12px] font-semibold text-sage font-medium mb-2 ">Pending Payload</span>
 </div>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-emerald-500/5 to-transparent flex flex-col justify-center">
 <p class="text-[12px] font-semibold text-emerald-500 font-medium mb-4 ">Success Spectrum (24h)</p>
 <div class="flex items-end gap-3">
 <h2 class="text-5xl font-semibold text-emerald-500 tracking-tighter">{{ $stats->sent_today ?? 0 }}</h2>
 <span class="text-[12px] font-semibold text-emerald-500 font-medium mb-2 ">Transmitted</span>
 </div>
 </div>
 <div class="bg-card rounded-[2.5rem] p-10 border border-subtle bg-gradient-to-br from-rose-500/5 to-transparent flex flex-col justify-center relative overflow-hidden">
 <p class="text-[12px] font-semibold text-rose-500 font-medium mb-4 ">Transmission Failures (24h)</p>
 <div class="flex items-end gap-3">
 <h2 class="text-5xl font-semibold text-rose-500 tracking-tighter">{{ $stats->failed_today ?? 0 }}</h2>
 <span class="text-[12px] font-semibold text-rose-500 font-medium mb-2 ">Error State</span>
 </div>
 @if(($stats->failed_today ?? 0) > 0)
 <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-rose-500/5 rounded-full blur-2xl"></div>
 @endif
 </div>
 </div>

 <!-- Live Transmission Matrix -->
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Real-time Transmission Stream</h3>
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 rounded-lg text-[8px] font-semibold font-medium border border-subtle ">Hub Sync: Operational</span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Temporal Matrix</th>
 <th class="px-6 py-6">Recipient Identity</th>
 <th class="px-6 py-6">Channel Vector</th>
 <th class="px-6 py-6">Message Intelligence</th>
 <th class="px-10 py-6 text-right">Payload Status</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 @foreach ($recent as $m)
 <tr class="hover:bg-[#2a2e38] transition-all group">
 <td class="px-10 py-6 text-[12px] font-semibold text-slate-500 font-medium">
 {{ \Carbon\Carbon::parse($m->created_at)->format('H:i:s') }}
 </td>
 <td class="px-6 py-6">
 <div class="font-semibold text-white text-sm uppercase group-hover:text-sage transition-colors">{{ $m->recipient_name ?: 'ANONYMOUS_RECIPIENT' }}</div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-1 ">{{ $m->recipient_phone }}</div>
 </td>
 <td class="px-6 py-6">
 <span class="px-3 py-1 bg-sage/10 text-sage border border-indigo-500/20 rounded-lg text-[8px] font-semibold font-medium">{{ $m->channel }}</span>
 </td>
 <td class="px-6 py-6">
 <div class="text-[12px] text-slate-400 max-w-sm truncate group-hover:whitespace-normal transition-all leading-relaxed uppercase tracking-tight">"{{ $m->resolved_message }}"</div>
 <div class="text-[7px] font-semibold text-slate-600 uppercase mt-2 tracking-wider">RELAY_SOURCE: {{ $m->provider ?? 'INSTITUTIONAL_CORE' }}</div>
 </td>
 <td class="px-10 py-6 text-right">
 @php
 $statusCls = match($m->status) {
 'sent' => 'bg-sage/10 text-sage border-indigo-500/20',
 'delivered' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
 'failed' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse',
 default => 'bg-[#2a2e38] text-slate-500 border-subtle'
 };
 @endphp
 <span class="px-4 py-1.5 rounded-xl text-[8px] font-semibold font-medium border {{ $statusCls }} /5">
 {{ $m->status }}
 </span>
 </td>
 </tr>
 @endforeach
 @if($recent->isEmpty())
 <tr>
 <td colspan="5" class="px-10 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No active message transmissions identified in the live stream.</p>
 </td>
 </tr>
 @endif
 </tbody>
 </table>
 </div>
 </div>
</div>

<!-- Modal: Compose Dispatch -->
<div id="composeModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-10 uppercase tracking-tight">Institutional Payload Dispatch</h3>
 <form method="POST" action="{{ route('messaging.store') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Transmission Relay Provider</label>
 <select name="provider_id" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 @foreach($providers as $p)
 <option value="{{ $p->id }}">{{ $p->display_name }} ({{ strtoupper($p->slug) }})</option>
 @endforeach
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Recipient Destination (MSISDN)</label>
 <input type="text" name="recipient" required placeholder="e.g. +237 600 000 000" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Message Intelligence Payload</label>
 <textarea name="message" required placeholder="Provide the strategic notification content..." class="w-full h-32 bg-[#2a2e38] border border-subtle rounded-3xl px-6 py-5 text-sm font-bold text-white outline-none no-scrollbar resize-none focus:border-indigo-500/50 transition-all"></textarea>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('composeModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Discard Dispatch</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-[12px] font-semibold font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Authorize Transmission</button>
 </div>
 </form>
 </div>
</div>
</x-cc-shell>

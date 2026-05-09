<x-cc-shell title='Opeshis OS'>

@section('title', 'Infrastructure Maintenance — Opeshis OS')

<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: Infrastructure Maintenance Command -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Infrastructure <span class="text-amber-500">Maintenance</span></h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Asset Surveillance · Biomedical Engineering · Facility Integrity Hub</p>
 </div>
 <div class="flex items-center gap-4">
 <x-cc-stat title="Open Faults" :value="$workOrders->where('status', 'open')->count()" icon="fa-triangle-exclamation" color="rose" />
 <x-cc-stat title="Active Orders" :value="$workOrders->where('status', 'in_progress')->count()" icon="fa-tools" color="amber" />
 <x-cc-button icon="fa-plus-circle" color="amber" onclick="document.getElementById('faultModal').classList.remove('hidden')">
 Log Institutional Fault
 </x-cc-button>
 </div>
 </header>

 @if(session('success'))
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[12px] font-semibold font-medium mb-8 animate-pulse ">
 Maintenance protocol transmission successful.
 </div>
 @endif

 <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
 <!-- Asset Maintenance Matrix -->
 <div class="lg:col-span-8">
 <x-clinical-card title="Institutional Asset Maintenance Matrix" icon="fa-database" badge="Uptime: 99.9%">
 <x-data-table :headers="['Asset / Tactical Equipment', 'Fault Profile', 'Urgency Vector', 'Status Spectrum', 'Strategic Action']">
 @forelse($workOrders as $r)
 <tr class="hover:bg-card transition-all group">
 <td class="px-6 py-4">
 <div class="font-semibold text-white text-base uppercase group-hover:text-amber-400 transition-colors">{{ $r->asset_description ?: 'FACILITY_INFRA' }}</div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-1 ">Raised By: {{ $r->raised_by_user->name ?? 'SYSTEM' }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-[12px] font-bold text-slate-300 uppercase tracking-tight leading-relaxed line-clamp-2">"{{ $r->fault_description }}"</div>
 </td>
 <td class="px-6 py-4 text-center">
 @php
 $status = match($r->priority) {
 'urgent' => 'critical',
 'routine' => 'pending',
 default => 'completed'
 };
 @endphp
 <x-status-badge :status="$status" />
 <div class="text-[8px] font-semibold text-slate-600 uppercase mt-1">{{ strtoupper($r->priority) }}</div>
 </td>
 <td class="px-6 py-4">
 <span class="text-[12px] font-semibold {{ $r->status === 'completed' ? 'text-emerald-500' : 'text-amber-500' }} font-medium ">
 {{ strtoupper($r->status) }}
 </span>
 </td>
 <td class="px-6 py-4 text-right">
 <div class="flex justify-end gap-2">
 @if($r->status === 'open')
 <form method="POST" action="{{ url('/ops/maintenance/'.$r->id.'/start') }}">
 @csrf
 <x-cc-button size="sm" variant="ghost" color="amber" icon="fa-play">Start</x-cc-button>
 </form>
 @elseif($r->status === 'in_progress')
 <x-cc-button size="sm" variant="ghost" color="emerald" icon="fa-check" onclick="openCompleteModal('{{ $r->id }}')">Complete</x-cc-button>
 @endif
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <i class="fas fa-wrench text-2xl"></i>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No active maintenance faults identified in the institutional matrix.</p>
 </td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>
 </div>

 <!-- Preventive Schedules Sidebar -->
 <div class="lg:col-span-4 space-y-8">
 <x-clinical-card title="Preventive Schedules" icon="fa-calendar-check" badge="Next 30 Days">
 <div class="space-y-4">
 @forelse($schedules as $s)
 <div class="p-4 bg-card/50 border border-subtle rounded-2xl group hover:border-amber-500/30 transition-all">
 <div class="flex justify-between items-start mb-2">
 <div class="font-semibold text-white text-[12px] uppercase tracking-tight">{{ $s->asset_description }}</div>
 <span class="text-[8px] font-semibold text-amber-500 uppercase">{{ $s->frequency }}</span>
 </div>
 <div class="flex justify-between items-center">
 <div class="text-[12px] font-bold text-slate-500 uppercase">Next Due: <span class="text-slate-300 ">{{ \Carbon\Carbon::parse($s->next_due)->format('d M Y') }}</span></div>
 @if(\Carbon\Carbon::parse($s->next_due)->isPast())
 <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
 @endif
 </div>
 </div>
 @empty
 <p class="text-[12px] font-semibold text-slate-600 uppercase text-center py-8">No preventive schedules identified.</p>
 @endforelse
 </div>
 <div class="mt-6 pt-6 border-t border-subtle">
 <x-cc-button color="slate" variant="ghost" class="w-full" onclick="document.getElementById('scheduleModal').classList.remove('hidden')">New Schedule</x-cc-button>
 </div>
 </x-clinical-card>
 </div>
 </div>
</div>

<!-- Modal: Log Fault -->
<x-cc-modal id="faultModal" title="Infrastructure Fault Disclosure" icon="fa-triangle-exclamation">
 <form method="POST" action="{{ url('/ops/maintenance/log') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Strategic Asset / Facility Designation</label>
 <input name="asset" required class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-amber-500/50 transition-all uppercase" placeholder="e.g. ICU_VENTILATOR_04">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Operational Fault Description</label>
 <textarea name="fault" required class="w-full h-32 bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar focus:border-amber-500/50 transition-all uppercase" placeholder="Provide strategic details of the infrastructure failure..."></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Urgency Spectrum Vector</label>
 <select name="priority" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-amber-500/50 transition-all">
 <option value="routine">ROUTINE_MAINTENANCE</option>
 <option value="planned">PLANNED_PROTOCOL</option>
 <option value="urgent">URGENT_INFRA_FAILURE</option>
 </select>
 </div>
 <x-cc-button type="submit" color="amber" class="w-full py-4">Authorize Fault Relay</x-cc-button>
 </form>
</x-cc-modal>

<!-- Modal: Complete Work Order -->
<x-cc-modal id="completeModal" title="Finalize Work Order" icon="fa-check-double">
 <form method="POST" id="completeForm" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Completion Intelligence Notes</label>
 <textarea name="notes" required class="w-full h-32 bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar focus:border-emerald-500/50 transition-all uppercase" placeholder="Final technical resolution disclosure..."></textarea>
 </div>
 <x-cc-button type="submit" color="emerald" class="w-full py-4">Finalize Resolution Protocol</x-cc-button>
 </form>
</x-cc-modal>

<script>
function openCompleteModal(id) {
 document.getElementById('completeForm').action = '/ops/maintenance/' + id + '/complete';
 document.getElementById('completeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

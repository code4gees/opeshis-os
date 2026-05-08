<x-cc-shell title='Opeshis OS'>

@section('title', strtoupper($module) . ' Operational Command — Opeshis OS')

<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Logistics & Back-Office Command -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">{{ $module }} <span class="text-indigo-500">Operations</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Back-Office Surveillance · Facility Management · Operational Flow Matrix</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex flex-col items-end">
                <span class="text-[9px] font-black uppercase text-indigo-400 tracking-[0.2em] italic">Operational State: Active</span>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest mt-1 italic">Module ID: {{ strtoupper($module) }}_CORE</span>
            </div>
            <div class="w-3 h-3 rounded-full bg-indigo-500 animate-pulse shadow-[0_0_10px_rgba(99,102,241,0.5)]"></div>
        </div>
    </header>

    @if(session('success'))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            Operational data payload synchronized successfully.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Operational Activity Ledger -->
        <div class="lg:col-span-8">
            <x-clinical-card title="Institutional Activity Forensics Ledger" icon="fa-database" badge="Ledger Sync: Operational">
                <x-data-table :headers="['Strategic Event Description', 'Operational Status', 'Temporal Matrix']">
                    @foreach($logs as $l)
                        <tr class="hover:bg-white/[0.02] transition-all group">
                            <td class="px-6 py-4">
                                <div class="text-sm font-black text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $l->event_description }}</div>
                                <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1 italic">Authorized Event Protocol</div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $status = match($l->status) {
                                        'completed' => 'completed',
                                        'flagged' => 'critical',
                                        default => 'pending'
                                    };
                                @endphp
                                <x-status-badge :status="$status" />
                            </td>
                            <td class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest italic">
                                {{ \Carbon\Carbon::parse($l->created_at)->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                    @if($logs->isEmpty())
                        <tr>
                            <td colspan="3" class="p-24 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                    <i class="fas fa-microchip text-2xl"></i>
                                </div>
                                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active operational logs identified in the matrix.</p>
                            </td>
                        </tr>
                    @endif
                </x-data-table>
            </x-clinical-card>
        </div>

        <!-- Operational Input Sidebar -->
        <div class="lg:col-span-4">
            <x-clinical-card title="Authorize Record Entry" icon="fa-plus-circle">
                <form method="POST" action="{{ route('logistics.record') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="module_type" value="{{ $module }}">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Event Detail Disclosure</label>
                        <textarea name="description" rows="4" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar focus:border-indigo-500/50 transition-all" placeholder="Provide strategic details of the operational event..."></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Operational Status Vector</label>
                        <select name="status" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                            <option value="completed">COMPLETED_PROTOCOL</option>
                            <option value="pending">IN_PROGRESS_MATRIX</option>
                            <option value="flagged">FLAGGED_OPERATIONAL_FAILURE</option>
                        </select>
                    </div>
                    <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Data Relay</x-cc-button>
                </form>
            </x-clinical-card>
        </div>
    </div>
</div>
</x-cc-shell>

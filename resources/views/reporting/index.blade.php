<x-cc-shell title='Opeshis OS'>

@section('title', 'Institutional Reporting & DHIS2 — Opeshis OS')

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Reporting <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional HMIS Aggregation · DHIS2 National Data Link · Strategic Analytics</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('generateModal').classList.remove('hidden')"
                class="cc-button-primary flex items-center gap-2">
                <i class="fas fa-plus-circle text-[10px]"></i>
                Generate Period Report
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="cc-card p-6 bg-emerald-500/5 border-emerald-500/20 text-emerald-400 text-[11px] font-bold uppercase tracking-widest mb-10 animate-pulse">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- DHIS2 Integration Status Matrix -->
    <div class="cc-card p-10 flex items-center justify-between bg-white/[0.02] border-white/[0.04] relative overflow-hidden">
        <div class="flex items-center gap-10 relative z-10">
            <div class="w-20 h-20 bg-sage/5 rounded-[2rem] border border-sage/20 flex items-center justify-center relative shadow-[inset_0_0_20px_rgba(130,192,154,0.05)]">
                <i class="fas fa-satellite-dish text-sage text-2xl"></i>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-4 border-[#1a1d24] shadow-[0_0_12px_rgba(16,185,129,0.4)] animate-pulse"></div>
            </div>
            <div>
                <h3 class="text-[12px] font-bold text-white uppercase tracking-widest">DHIS2 National Node</h3>
                <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-2">{{ $config->instance_url ?? 'UNCONFIGURED_INSTANCE_LINK' }}</p>
            </div>
        </div>
        <div class="text-right relative z-10">
            <div class="flex items-center justify-end gap-3 mb-3">
                <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Protocol: Linked & Operational</span>
            </div>
            <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Last Payload Sync: {{ date('M d, H:i') }}</p>
        </div>
    </div>

    <!-- Reporting Registry Matrix -->
    <x-cc-card>
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                <i class="fas fa-list-check text-sage text-[14px]"></i>
                Institutional Reporting Ledger
            </h2>
            <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Registry Sync: Active</span>
        </div>

        <x-cc-table :headers="['Reporting Period Protocol', 'Form Matrix (MoH)', 'Authorization', 'Status Matrix', 'Strategic Action']">
            @forelse($reports as $r)
                <tr class="group hover:bg-white/[0.01] transition-colors">
                    <td class="px-8 py-5">
                        <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $r->report_period }}</div>
                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ date('M d, Y · H:i', strtotime($r->created_at)) }}</div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[10px] font-bold text-white/40 uppercase tracking-widest">
                            {{ $r->report_type }}
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="text-[11px] font-bold text-white uppercase tracking-widest">{{ $r->generator->name ?? 'SYSTEM_ACTOR' }}</div>
                        <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-1">Authorizing Officer</div>
                    </td>
                    <td class="px-8 py-5">
                        @php $isTransmitted = $r->status === 'TRANSMITTED'; @endphp
                        <span class="px-3 py-1 rounded-lg text-[9px] font-bold uppercase tracking-widest border
                            {{ $isTransmitted ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20 animate-pulse' }}">
                            {{ $r->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-3">
                            <button class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                                <i class="fas fa-code-merge text-[10px]"></i>
                            </button>
                            @if($r->status === 'DRAFT')
                                <form method="POST" action="{{ route('reporting.export') }}">
                                    @csrf
                                    <input type="hidden" name="report_id" value="{{ $r->id }}">
                                    <button class="cc-button-primary py-1.5 px-4 text-[10px]">
                                        Transmit to MoH
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-ghost text-2xl text-white/10 mb-4 block"></i>
                        <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No institutional periodic reports identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Generate Period Report -->
<x-cc-modal id="generateModal" title="Generate Institutional Analytics" icon="fa-chart-pie-simple">
    <form method="POST" action="{{ route('reporting.generate') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Strategic Reporting Period</label>
            <input name="period" type="month" required class="cc-input w-full">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Report Framework Matrix (MoH Standard)</label>
            <select name="type" class="cc-input w-full">
                <option value="HMIS-105">HMIS 105: STRATEGIC OUTPATIENT SURVEILLANCE</option>
                <option value="HMIS-108">HMIS 108: INSTITUTIONAL INPATIENT CENSUS</option>
                <option value="IDSR-WEEKLY">IDSR WEEKLY EPIDEMIOLOGICAL SURVEILLANCE</option>
                <option value="ART-QUARTERLY">ART QUARTERLY INSTITUTIONAL PERFORMANCE</option>
            </select>
        </div>
        <div class="pt-6">
            <button type="submit" class="cc-button-primary w-full">Aggregate & Authorize Transmission</button>
        </div>
    </form>
</x-cc-modal>

</x-cc-shell>

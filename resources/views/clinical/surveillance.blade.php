<x-cc-shell title='Opeshis OS'>

@section('title', 'Epidemiological Surveillance — Opeshis OS')


<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-200 uppercase tracking-tighter">Surveillance Command</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Institutional IDSR Surveillance · Outbreak Intelligence · Contact Tracing Matrix</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-file-medical" color="rose" variant="ghost" onclick="document.getElementById('reportModal').classList.remove('hidden')">
                Report IDSR Protocol
            </x-cc-button>
            <div class="flex gap-2">
                <form action="{{ url('/clinical/surveillance/weekly') }}" method="POST">@csrf<x-cc-button type="submit" size="sm" color="slate" variant="ghost" icon="fa-calendar-week">Weekly Report</x-cc-button></form>
                <form action="{{ url('/clinical/surveillance/moh') }}" method="POST">@csrf<x-cc-button type="submit" size="sm" color="slate" variant="ghost" icon="fa-paper-plane">Dispatch MOH</x-cc-button></form>
            </div>
        </div>
    </div>

    <!-- Surveillance Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Active Alerts" 
            value="{{ count($alerts) }}" 
            icon="fa-bell-exclamation" 
            trend="Institutional Log" 
            color="rose" 
        />
        <x-cc-stat 
            title="Investigations" 
            value="{{ count($cases) }}" 
            icon="fa-microscope" 
            trend="Active Matrix" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Weekly Yield" 
            value="{{ $cases->where('created_at', '>=', now()->startOfWeek())->count() }}" 
            icon="fa-chart-line" 
            trend="Surveillance Pulse" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Registry Pulse" 
            value="Synced" 
            icon="fa-network-wired" 
            trend="Institutional Log" 
            color="slate" 
        />
    </div>

    <!-- Outbreak Alert Hub -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($alerts as $a)
            <div class="bg-slate-900/40 border border-rose-500/20 rounded-[2rem] p-8 relative overflow-hidden group shadow-2xl shadow-rose-900/10">
                <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i class="fas fa-biohazard text-6xl text-rose-500"></i>
                </div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                    <p class="text-[9px] font-black text-rose-500 uppercase tracking-[0.2em] italic">{{ $a->alert_level }} ALERT_PROTOCOL</p>
                </div>
                <h3 class="text-xl font-black text-white mb-4 uppercase tracking-tighter italic">Outbreak Detected: {{ $a->disease->disease_name }}</h3>
                <p class="text-[11px] text-slate-400 leading-relaxed italic mb-8 uppercase tracking-tight">"{{ $a->description }}"</p>
                <form method="POST" action="{{ url('/clinical/surveillance/resolve-alert/'.$a->id) }}">
                    @csrf
                    <x-cc-button type="submit" color="rose" variant="ghost" class="w-full uppercase tracking-widest text-[9px]">Mark Protocol Resolved</x-cc-button>
                </form>
            </div>
        @empty
            <div class="col-span-full bg-emerald-500/5 border border-emerald-500/20 rounded-[2rem] p-10 flex items-center gap-8">
                <div class="w-16 h-16 bg-emerald-500/10 text-emerald-500 rounded-2xl flex items-center justify-center border border-emerald-500/20">
                    <i class="fas fa-check-shield text-2xl"></i>
                </div>
                <div>
                    <h4 class="text-lg font-black text-white uppercase tracking-tighter italic">Institutional State: Equilibrium</h4>
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.2em] mt-2 italic">No active disease outbreaks or threshold alerts detected in the surveillance matrix.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- IDSR Investigative Matrix -->
    <x-cc-card title="Institutional IDSR Investigative Matrix" icon="fa-database">
        <x-cc-table :headers="['Patient Principal Profile', 'Infectious Classification', 'Outcome Matrix', 'Tracing Yield', 'Strategic Action']">
            @forelse($cases as $c)
                <tr class="group hover:bg-rose-500/[0.02] transition-colors border-b border-slate-800/50 last:border-0">
                    <td class="px-5 py-6">
                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors italic">{{ $c->patient->full_name ?? 'SYSTEM_GEN_PROTOCOL' }}</div>
                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-1">{{ $c->patient->medical_id ?? 'NODE_UNKNOWN' }}</div>
                    </td>
                    <td class="px-5 py-6">
                        <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest italic shadow-lg shadow-rose-500/5 animate-pulse">
                            {{ strtoupper($c->disease_code) }}
                        </span>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">{{ $c->disease->disease_name }}</div>
                    </td>
                    <td class="px-5 py-6">
                        <div class="text-[10px] font-black text-slate-300 uppercase italic tracking-widest">{{ str_replace('_',' ', $c->outcome) }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">Institutional Log</div>
                    </td>
                    <td class="px-5 py-6 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-lg font-black text-white italic leading-none">{{ $c->contacts_count }}</span>
                            <span class="text-[8px] font-black text-slate-600 uppercase mt-1 italic">Verified Trace</span>
                        </div>
                    </td>
                    <td class="px-5 py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-users-viewfinder" color="indigo" onclick="openTraceModal('{{ $c->id }}')">Trace</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-file-signature" color="emerald" onclick="openOutcomeModal('{{ $c->id }}')">Outcome</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-600 italic text-sm">No active IDSR investigations identified in the surveillance feed.</td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: IDSR Reporting Protocol -->
<x-cc-modal id="reportModal" title="Authorize IDSR Reporting Protocol" icon="fa-file-medical">
    <form method="POST" action="{{ url('/clinical/surveillance/report') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Institutional Patient Identity</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">IDSR Disease Classification Selection</label>
            <select name="disease_code" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
                @foreach($diseases as $d)
                    <option value="{{ $d->disease_code }}">{{ strtoupper($d->disease_name) }} ({{ strtoupper($d->disease_code) }})</option>
                @endforeach
            </select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full uppercase tracking-widest">Authorize Transmission</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Contact Tracing -->
<x-cc-modal id="traceModal" title="Commit Institutional Contact Tracing Intelligence" icon="fa-users-viewfinder">
    <form method="POST" action="{{ url('/clinical/surveillance/add-contact') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="case_id" id="traceCaseId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Contact Full Identity</label>
                <input name="name" required placeholder="CONTACT_FULL_NAME" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Anatomical Relationship Matrix</label>
                <input name="relationship" required placeholder="RELATIONSHIP_NODE" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Communication Node (Phone)</label>
            <input name="phone" required placeholder="PHONE_SIGNAL" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Commit Tracing Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Update Outcome -->
<x-cc-modal id="outcomeModal" title="Commit Case Outcome Intelligence" icon="fa-file-signature">
    <form method="POST" id="outcomeForm" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Final Investigative Outcome</label>
            <select name="outcome" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
                <option value="under_investigation">UNDER_INVESTIGATION</option>
                <option value="confirmed">CONFIRMED_CASE</option>
                <option value="discarded">DISCARDED_CASE</option>
                <option value="recovered">RECOVERED_PATIENT</option>
                <option value="deceased">DECEASED_PATIENT</option>
            </select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full uppercase tracking-widest">Commit Outcome Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openTraceModal(id) {
    document.getElementById('traceCaseId').value = id;
    document.getElementById('traceModal').classList.remove('hidden');
}
function openOutcomeModal(id) {
    document.getElementById('outcomeForm').action = `{{ url('/clinical/surveillance/update-outcome') }}/${id}`;
    document.getElementById('outcomeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

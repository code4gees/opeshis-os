<x-cc-shell title='Surveillance Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Surveillance <span class="text-rose-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional IDSR Surveillance · Outbreak Intelligence · Contact Tracing Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-file-medical" color="rose" variant="ghost" onclick="document.getElementById('reportModal').classList.remove('hidden')">
                Report IDSR Protocol
            </x-cc-button>
            <div class="flex gap-2">
                <form action="{{ url('/clinical/surveillance/weekly') }}" method="POST">@csrf<x-cc-button type="submit" size="sm" color="slate" variant="ghost" icon="fa-calendar-week">Weekly Report</x-cc-button></form>
                <form action="{{ url('/clinical/surveillance/moh') }}" method="POST">@csrf<x-cc-button type="submit" size="sm" color="slate" variant="ghost" icon="fa-paper-plane">Dispatch MOH</x-cc-button></form>
            </div>
        </div>
    </div>

    <!-- Surveillance Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Alerts" value="{{ count($alerts) }}" icon="fa-bell-exclamation" trend="Institutional Log" color="rose" />
        <x-cc-stat title="Investigations" value="{{ count($cases) }}" icon="fa-microscope" trend="Active Matrix" color="indigo" />
        <x-cc-stat title="Weekly Yield" value="{{ $cases->where('created_at', '>=', now()->startOfWeek())->count() }}" icon="fa-chart-line" trend="Surveillance Pulse" color="emerald" />
        <x-cc-stat title="Registry Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <!-- Outbreak Alert Hub -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @forelse($alerts as $a)
            <x-cc-card class="relative overflow-hidden group border-rose-500/20">
                <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
                    <i class="fas fa-biohazard text-6xl text-rose-500"></i>
                </div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                    <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest">{{ $a->alert_level }} ALERT_PROTOCOL</span>
                </div>
                <h3 class="text-lg font-bold text-white uppercase tracking-tight mb-4 leading-tight">Outbreak Detected: {{ $a->disease->disease_name }}</h3>
                <p class="text-[11px] font-bold text-white/20 uppercase tracking-tight leading-relaxed mb-8">"{{ $a->description }}"</p>
                <form method="POST" action="{{ url('/clinical/surveillance/resolve-alert/'.$a->id) }}">
                    @csrf
                    <x-cc-button type="submit" color="rose" variant="ghost" class="w-full">Mark Protocol Resolved</x-cc-button>
                </form>
            </x-cc-card>
        @empty
            <div class="col-span-full">
                <x-cc-card class="py-10 flex items-center gap-8 border-emerald-500/20 bg-emerald-500/[0.02]">
                    <div class="w-16 h-16 bg-emerald-500/10 text-emerald-500 rounded-2xl flex items-center justify-center border border-emerald-500/20">
                        <i class="fas fa-check-shield text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-[13px] font-bold text-white uppercase tracking-tight">Institutional State: Equilibrium</h4>
                        <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mt-1">No active disease outbreaks identified in the surveillance matrix.</p>
                    </div>
                </x-cc-card>
            </div>
        @endforelse
    </div>

    <!-- IDSR Investigative Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional IDSR Investigative Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest">Surveillance Feed Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Principal Profile', 'Infectious Classification', 'Outcome Matrix', 'Tracing Yield', 'Strategic Action']">
            @forelse($cases as $c)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-rose-500/10 group-hover:text-rose-500 group-hover:border-rose-500/20 transition-all">
                                {{ substr($c->patient->full_name ?? 'S', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $c->patient->full_name ?? 'SYSTEM_GEN_PROTOCOL' }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id ?? 'NODE_UNKNOWN' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest animate-pulse">
                            {{ strtoupper($c->disease_code) }}
                        </span>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ $c->disease->disease_name }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-widest">{{ str_replace('_',' ', $c->outcome) }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Institutional Log</div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-lg font-black text-white tracking-tighter">{{ $c->contacts_count }}</span>
                            <span class="text-[8px] font-black text-white/10 uppercase tracking-widest mt-1">Verified Trace</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-cc-button variant="ghost" size="sm" icon="fa-users-viewfinder" color="indigo" onclick="openTraceModal('{{ $c->id }}')">Trace</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-file-signature" color="emerald" onclick="openOutcomeModal('{{ $c->id }}')">Outcome</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-microscope text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active IDSR investigations identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: IDSR Reporting Protocol -->
<x-cc-modal id="reportModal" title="Authorize IDSR Reporting Protocol" icon="fa-file-medical">
    <form method="POST" action="{{ url('/clinical/surveillance/report') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-select label="Disease Classification" name="disease_code" icon="fa-biohazard">
            @foreach($diseases as $d)
                <option value="{{ $d->disease_code }}">{{ strtoupper($d->disease_name) }} ({{ strtoupper($d->disease_code) }})</option>
            @endforeach
        </x-cc-select>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Transmission</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Contact Tracing -->
<x-cc-modal id="traceModal" title="Commit Contact Tracing Intelligence" icon="fa-users-viewfinder">
    <form method="POST" action="{{ url('/clinical/surveillance/add-contact') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="case_id" id="traceCaseId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Contact Full Identity" name="name" required placeholder="CONTACT_FULL_NAME" icon="fa-user-tag" />
            <x-cc-input label="Relationship Matrix" name="relationship" required placeholder="RELATIONSHIP_NODE" icon="fa-people-arrows" />
        </div>
        <x-cc-input label="Communication Node" name="phone" required placeholder="PHONE_SIGNAL" icon="fa-phone" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Tracing Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Update Outcome -->
<x-cc-modal id="outcomeModal" title="Commit Case Outcome Intelligence" icon="fa-file-signature">
    <form method="POST" id="outcomeForm" class="space-y-6">
        @csrf
        <x-cc-select label="Final Investigative Outcome" name="outcome" icon="fa-flag-checkered">
            <option value="under_investigation">UNDER_INVESTIGATION</option>
            <option value="confirmed">CONFIRMED_CASE</option>
            <option value="discarded">DISCARDED_CASE</option>
            <option value="recovered">RECOVERED_PATIENT</option>
            <option value="deceased">DECEASED_PATIENT</option>
        </x-cc-select>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Commit Outcome Intelligence</x-cc-button>
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

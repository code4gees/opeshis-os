<x-cc-shell title='Family Planning | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Family <span class="text-rose-500">Planning</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Reproductive Health Intelligence · Client Registry · Method Tracking Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="rose" variant="ghost" onclick="document.getElementById('enrModal').classList.remove('hidden')">
                Authorize Client Enrollment
            </x-cc-button>
        </div>
    </div>

    <!-- Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Clients" :value="$clients->count()" icon="fa-users-between-lines" trend="Institutional Log" color="rose" />
        <x-cc-stat title="Method Diversity" value="High" icon="fa-layer-group" trend="Active Matrix" color="emerald" />
        <x-cc-stat title="Return Flux" value="Nominal" icon="fa-calendar-check" trend="Operational" color="indigo" />
        <x-cc-stat title="Programme Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <!-- Case Surveillance Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Reproductive Health Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest">Live Registry Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Client Identity', 'Current Therapeutic Method', 'Temporal Return Matrix', 'Operational Actions']">
            @forelse($clients as $c)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-rose-500/10 group-hover:text-rose-500 group-hover:border-rose-500/20 transition-all">
                                {{ substr($c->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $c->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($c->currentMethod)
                            <span class="px-3 py-1.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest">
                                {{ strtoupper($c->currentMethod->method_name) }}
                            </span>
                        @else
                            <span class="px-3 py-1.5 bg-white/5 text-white/20 border border-white/10 rounded-xl text-[9px] font-black uppercase tracking-widest">
                                PROTOCOL_PENDING
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        @if($c->currentMethod && $c->currentMethod->next_visit)
                            <div class="text-[11px] font-bold text-white uppercase tracking-tighter">{{ \Carbon\Carbon::parse($c->currentMethod->next_visit)->format("d M Y") }}</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Scheduled Return</div>
                        @else
                            <div class="text-[11px] font-bold text-white/10 uppercase tracking-widest">SIGNAL_MISSING</div>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-exchange-alt" color="rose" onclick="openMethodModal('{{ $c->id }}')">Transition</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-notes-medical" color="indigo" onclick="openVisitModal('{{ $c->id }}')">Log Session</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <i class="fas fa-users-between-lines text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active reproductive health clients identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Authorize Enrollment -->
<x-cc-modal id="enrModal" title="Authorize Client Enrollment" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/fp/enroll') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Enrollment Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Transition Method -->
<x-cc-modal id="methodModal" title="Authorize Method Transition" icon="fa-exchange-alt">
    <form method="POST" action="{{ url('/clinical/fp/record-method') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="client_id" id="methodClientId">
        <x-cc-select label="Therapeutic Method Selection" name="method" icon="fa-layer-group">
            @foreach($methods as $m)
                <option value="{{ $m }}">{{ strtoupper($m) }}</option>
            @endforeach
        </x-cc-select>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Start Date Matrix" name="start_date" type="date" required icon="fa-calendar-plus" />
            <x-cc-input label="Return Visit Vector" name="next_visit" type="date" required icon="fa-calendar-check" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Method Transition</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Session -->
<x-cc-modal id="visitModal" title="Commit Session Intelligence" icon="fa-notes-medical">
    <form method="POST" action="{{ url('/clinical/fp/record-visit') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="client_id" id="visitClientId">
        <x-cc-input label="Counseling Session Intelligence" name="notes" required placeholder="SESSION_INTELLIGENCE_DISCLOSURE..." icon="fa-comment-medical" />
        <x-cc-input label="Clinical Complications Matrix" name="side_effects" placeholder="SIDE_EFFECTS_SURVEILLANCE..." icon="fa-triangle-exclamation" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Session Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openMethodModal(id) {
    document.getElementById('methodClientId').value = id;
    document.getElementById('methodModal').classList.remove('hidden');
}
function openVisitModal(id) {
    document.getElementById('visitClientId').value = id;
    document.getElementById('visitModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

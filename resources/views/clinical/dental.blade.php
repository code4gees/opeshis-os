<x-cc-shell title='Dental Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Dental <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Tooth Chart Surveillance · Maxillofacial Procedures · Clinical Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Register Dental Node
            </x-cc-button>
        </div>
    </div>

    <!-- Dental Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Scheduled" value="{{ $todaySchedule->count() }}" icon="fa-calendar-check" trend="Active Cycles" color="indigo" />
        <x-cc-stat title="Registry" value="{{ $patients->count() }}" icon="fa-users" trend="Principals" color="slate" />
        <x-cc-stat title="Procedures" value="{{ $procedures->count() }}" icon="fa-list-ol" trend="Protocols" color="sky" />
        <x-cc-stat title="Hub Pulse" value="Synced" icon="fa-network-wired" trend="Operational" color="emerald" />
    </div>

    <!-- Patient Surveillance Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Dental Clinical Surveillance Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Registry Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Chief Complaint Profile', 'Registry Temporal', 'Strategic Actions']">
            @forelse($patients as $p)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($p->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $p->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $p->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="p-4 bg-white/[0.02] rounded-xl border border-white/[0.04] max-w-[300px]">
                            <p class="text-[11px] text-white/40 font-bold leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $p->chief_complaint }}"</p>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-[11px] font-bold text-white/20 uppercase tracking-tighter">
                        {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y, H:i') }} Z
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-tooth" color="indigo" onclick="openProcModal('{{ $p->id }}')">Procedure</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-map" color="sky" onclick="openChartModal('{{ $p->id }}')">Chart</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-calendar-plus" color="emerald" onclick="openApptModal('{{ $p->id }}')">Schedule</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <i class="fas fa-tooth text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active dental principals identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Patient Registration -->
<x-cc-modal id="regModal" title="Register Dental Principal Node" icon="fa-user-plus">
    <form method="POST" action="{{ route('specialty.clinics.dental.register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Operational Chief Complaint" name="complaint" required placeholder="ACUTE_PROTOCOL_RATIONALE..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Procedure -->
<x-cc-modal id="procModal" title="Authorize Clinical Dental Procedure" icon="fa-tooth">
    <form method="POST" action="{{ route('specialty.clinics.dental.procedure') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="dental_patient_id" id="procPatientId">
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Tooth Matrix (#)" name="tooth_number" type="number" min="1" max="32" icon="fa-hashtag" />
            <x-cc-select label="Strategic Procedure" name="procedure_code" icon="fa-list-check">
                @foreach($procedures as $proc)
                    <option value="{{ $proc->id }}">{{ strtoupper($proc->name) }}</option>
                @endforeach
            </x-cc-select>
        </div>
        <x-cc-input label="Clinical Findings" name="findings" placeholder="DISCLOSURE_OF_FINDINGS..." icon="fa-magnifying-glass-chart" />
        <x-cc-input label="Therapeutic Action" name="treatment" required placeholder="TREATMENT_PROTOCOL_EXECUTED" icon="fa-kit-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Relay Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Update Chart -->
<x-cc-modal id="chartModal" title="Commit Institutional Tooth Chart" icon="fa-map">
    <form method="POST" action="{{ route('specialty.clinics.dental.chart') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="dental_patient_id" id="chartPatientId">
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Tooth Matrix ID" name="tooth_number" type="number" min="1" max="32" required icon="fa-hashtag" />
            <x-cc-select label="Anatomical Status" name="status" icon="fa-heart-pulse">
                <option value="healthy">HEALTHY_STABLE</option>
                <option value="carious">CARIOUS_LESION</option>
                <option value="filled">RESTORATION_PRESENT</option>
                <option value="missing">ANATOMICAL_ABSENCE</option>
                <option value="extracted">SURGICAL_REMOVAL</option>
            </x-cc-select>
        </div>
        <x-cc-input label="Longitudinal Health Notes" name="notes" placeholder="OBSERVATION_DATA..." icon="fa-file-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full">Commit Chart Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Schedule Appointment -->
<x-cc-modal id="apptModal" title="Authorize Appointment Protocol" icon="fa-calendar-plus">
    <form method="POST" action="{{ route('specialty.clinics.dental.appointment') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="dental_patient_id" id="apptPatientId">
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Scheduled Date" name="date" type="date" required icon="fa-calendar-day" />
            <x-cc-input label="Scheduled Time" name="time" type="time" required icon="fa-clock" />
        </div>
        <x-cc-input label="Follow-up Rationale" name="reason" placeholder="SCHEDULED_PROTOCOL_RATIONALE..." icon="fa-clipboard-question" />
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Authorize Appointment Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openProcModal(id) {
    document.getElementById('procPatientId').value = id;
    document.getElementById('procModal').classList.remove('hidden');
}
function openChartModal(id) {
    document.getElementById('chartPatientId').value = id;
    document.getElementById('chartModal').classList.remove('hidden');
}
function openApptModal(id) {
    document.getElementById('apptPatientId').value = id;
    document.getElementById('apptModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

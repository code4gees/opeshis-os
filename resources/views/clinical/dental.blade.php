<x-cc-shell title='Opeshis OS'>

@section('title', 'Dental Clinical Hub — Opeshis OS')


<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-200 uppercase tracking-tighter">Dental Command</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Tooth Chart Surveillance · Maxillofacial Procedures · Clinical Matrix Hub</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-plus" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Register Dental Node
            </x-cc-button>
        </div>
    </div>

    <!-- Dental Telemetry Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Scheduled Encounters" 
            value="{{ $todaySchedule->count() }}" 
            icon="fa-calendar-check" 
            trend="Active Cycles" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Registry Volume" 
            value="{{ $patients->count() }}" 
            icon="fa-users" 
            trend="Principals" 
            color="slate" 
        />
        <x-cc-stat 
            title="Procedure Catalog" 
            value="{{ $procedures->count() }}" 
            icon="fa-list-ol" 
            trend="Available Protocols" 
            color="sky" 
        />
        <x-cc-stat 
            title="Hub Pulse" 
            value="Synced" 
            icon="fa-network-wired" 
            trend="Operational" 
            color="emerald" 
        />
    </div>

    <!-- Patient Surveillance Matrix -->
    <x-cc-card title="Dental Clinical Surveillance Matrix" icon="fa-database">
        <x-cc-table :headers="['Patient Identity', 'Chief Complaint Profile', 'Registry Temporal Matrix', 'Strategic Actions']">
            @forelse($patients as $p)
                <tr class="group hover:bg-indigo-500/[0.02] transition-colors border-b border-slate-800/50 last:border-0">
                    <td class="px-5 py-6">
                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-indigo-400 transition-colors italic">{{ $p->patient->full_name }}</div>
                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-1">{{ $p->patient->medical_id }}</div>
                    </td>
                    <td class="px-5 py-6">
                        <div class="p-3 bg-slate-900/50 rounded-xl border border-slate-700/60 italic">
                            <p class="text-[10px] text-slate-400 font-bold leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $p->chief_complaint }}"</p>
                        </div>
                    </td>
                    <td class="px-5 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest italic">
                        {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y, H:i') }}
                    </td>
                    <td class="px-5 py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-tooth" color="indigo" onclick="openProcModal('{{ $p->id }}')">Log Procedure</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-map" color="sky" onclick="openChartModal('{{ $p->id }}')">Update Chart</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-calendar-plus" color="emerald" onclick="openApptModal('{{ $p->id }}')">Schedule</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-600 italic text-sm">No active dental principals identified in the matrix.</td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Patient Registration -->
<x-cc-modal id="regModal" title="Register Dental Principal Node" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/dental/register') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Institutional Patient Identity</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Operational Chief Complaint</label>
            <textarea name="complaint" required rows="3" placeholder="ACUTE_PROTOCOL_RATIONALE..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Procedure -->
<x-cc-modal id="procModal" title="Authorize Clinical Dental Procedure" icon="fa-tooth">
    <form method="POST" action="{{ url('/clinical/dental/procedure') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="dental_patient_id" id="procPatientId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Tooth Identity Matrix (#)</label>
                <input name="tooth_number" type="number" min="1" max="32" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Strategic Procedure Matrix</label>
                <select name="procedure_code" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
                    @foreach($procedures as $proc)
                        <option value="{{ $proc->id }}">{{ strtoupper($proc->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Clinical Findings Disclosure</label>
            <textarea name="findings" rows="2" placeholder="DISCLOSURE_OF_FINDINGS..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Therapeutic Action Executed</label>
            <input name="treatment" required placeholder="TREATMENT_PROTOCOL_EXECUTED" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Authorize Relay Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Update Chart -->
<x-cc-modal id="chartModal" title="Commit Institutional Tooth Chart Intelligence" icon="fa-map">
    <form method="POST" action="{{ url('/clinical/dental/chart') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="dental_patient_id" id="chartPatientId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Tooth Matrix Identifier</label>
                <input name="tooth_number" type="number" min="1" max="32" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Anatomical Status Signal</label>
                <select name="status" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
                    <option value="healthy">HEALTHY_STABLE</option>
                    <option value="carious">CARIOUS_LESION</option>
                    <option value="filled">RESTORATION_PRESENT</option>
                    <option value="missing">ANATOMICAL_ABSENCE</option>
                    <option value="extracted">SURGICAL_REMOVAL</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Longitudinal Health Notes</label>
            <textarea name="notes" rows="2" placeholder="OBSERVATION_DATA..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600 uppercase no-scrollbar"></textarea>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full uppercase tracking-widest">Commit Chart Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Schedule Appointment -->
<x-cc-modal id="apptModal" title="Authorize Dental Appointment Protocol" icon="fa-calendar-plus">
    <form method="POST" action="{{ url('/clinical/dental/appointment') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="dental_patient_id" id="apptPatientId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Scheduled Date</label>
                <input name="date" type="date" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Scheduled Time</label>
                <input name="time" type="time" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Follow-up Clinical Rationale</label>
            <textarea name="reason" rows="2" placeholder="SCHEDULED_PROTOCOL_RATIONALE..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600 uppercase no-scrollbar"></textarea>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full uppercase tracking-widest">Authorize Appointment Protocol</x-cc-button>
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

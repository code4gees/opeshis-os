<x-cc-shell title='ENT Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">ENT <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Otolaryngology Intelligence · Audiology Matrix · Clinical Procedural Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Register ENT Node
            </x-cc-button>
        </div>
    </div>

    <!-- ENT Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Total Registry" value="{{ $patients->count() }}" icon="fa-users-gear" trend="Institutional Log" color="indigo" />
        <x-cc-stat title="ENT Signal" value="Nominal" icon="fa-ear-listen" trend="Operational" color="sky" />
        <x-cc-stat title="Audiometry Hub" value="Active" icon="fa-wave-square" trend="Telemetry Synced" color="emerald" />
        <x-cc-stat title="Hub Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <!-- ENT Clinical Surveillance Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">ENT Clinical Surveillance Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Surveillance Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Chief Complaint Profile', 'Clinical Matrix Status', 'Strategic Actions']">
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
                        <div class="p-3 bg-white/[0.02] rounded-xl border border-white/5">
                            <p class="text-[11px] text-white/40 font-bold leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $p->chief_complaint }}"</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-white/40 uppercase tracking-widest">
                            REG_OK
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-stethoscope" color="indigo" onclick="openExamModal('{{ $p->id }}')">Log Exam</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-wave-square" color="sky" onclick="openAudioModal('{{ $p->id }}')">Audiogram</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <i class="fas fa-ear-listen text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active ENT principals identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: ENT Registration -->
<x-cc-modal id="regModal" title="Register ENT Principal Node" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/ent/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Operational Chief Complaint" name="complaint" required placeholder="ACUTE_PROTOCOL_RATIONALE..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log ENT Examination -->
<x-cc-modal id="examModal" title="Authorize Clinical ENT Examination" icon="fa-stethoscope">
    <form method="POST" action="{{ url('/clinical/ent/examination') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="ent_patient_id" id="examPatientId">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-cc-input label="Ear Findings" name="ear_findings" placeholder="OTOSCOPY_DATA..." icon="fa-ear-listen" />
            <x-cc-input label="Nose Findings" name="nose_findings" placeholder="RHINOSCOPY_DATA..." icon="fa-nose-ridge" />
            <x-cc-input label="Throat Findings" name="throat_findings" placeholder="LARYNGOSCOPY_DATA..." icon="fa-lungs" />
        </div>
        <x-cc-input label="Clinical Diagnosis Matrix" name="diagnosis" required placeholder="DIAGNOSIS_PROTOCOL" icon="fa-file-medical" />
        <x-cc-input label="Therapeutic Plan Vector" name="plan" required placeholder="MANAGEMENT_PROTOCOL..." icon="fa-route" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Examination Matrix</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Audiogram -->
<x-cc-modal id="audioModal" title="Commit Audiological Telemetry Intelligence" icon="fa-wave-square">
    <form method="POST" action="{{ url('/clinical/ent/audiogram') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="ent_patient_id" id="audioPatientId">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <h4 class="text-[11px] font-bold text-sage uppercase tracking-[0.2em] border-b border-white/[0.04] pb-2">Right Ear Thresholds (dB)</h4>
                <div class="grid grid-cols-2 gap-4">
                    <x-cc-input name="right_500" type="number" placeholder="500Hz" />
                    <x-cc-input name="right_1k" type="number" placeholder="1kHz" />
                    <x-cc-input name="right_2k" type="number" placeholder="2kHz" />
                    <x-cc-input name="right_4k" type="number" placeholder="4kHz" />
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="text-[11px] font-bold text-sky-500 uppercase tracking-[0.2em] border-b border-white/[0.04] pb-2">Left Ear Thresholds (dB)</h4>
                <div class="grid grid-cols-2 gap-4">
                    <x-cc-input name="left_500" type="number" placeholder="500Hz" />
                    <x-cc-input name="left_1k" type="number" placeholder="1kHz" />
                    <x-cc-input name="left_2k" type="number" placeholder="2kHz" />
                    <x-cc-input name="left_4k" type="number" placeholder="4kHz" />
                </div>
            </div>
        </div>
        <x-cc-input label="Clinical Interpretation Matrix" name="interpretation" required placeholder="AUDIOLOGICAL_RATIONALE..." icon="fa-chart-area" />
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full">Commit Audiogram Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openExamModal(id) {
    document.getElementById('examPatientId').value = id;
    document.getElementById('examModal').classList.remove('hidden');
}
function openAudioModal(id) {
    document.getElementById('audioPatientId').value = id;
    document.getElementById('audioModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

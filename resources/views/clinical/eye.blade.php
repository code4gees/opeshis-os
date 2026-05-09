<x-cc-shell title='Eye Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Eye <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Ophthalmology Intelligence · Vision Science Matrix · Clinical Procedural Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-eye" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Register Eye Node
            </x-cc-button>
        </div>
    </div>

    <!-- Eye Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Registry" value="{{ $patients->count() }}" icon="fa-users-viewfinder" trend="Institutional Log" color="indigo" />
        <x-cc-stat title="Surgical Queue" value="{{ $surgicalList->count() }}" icon="fa-scalpel-path" trend="Planned Matrix" color="sky" />
        <x-cc-stat title="Eye Signal" value="Nominal" icon="fa-eye-dropper" trend="Operational" color="emerald" />
        <x-cc-stat title="Hub Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <!-- Eye Clinical Surveillance Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Eye Clinical Surveillance Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Vision Science Sync</span>
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
                        <div class="p-4 bg-white/[0.02] rounded-xl border border-white/[0.04] max-w-[300px]">
                            <p class="text-[11px] text-white/40 font-bold leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $p->chief_complaint }}"</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-widest">
                            REG_OK
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-stethoscope" color="indigo" onclick="openExamModal('{{ $p->id }}')">Exam</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-glasses" color="sky" onclick="openRefModal('{{ $p->id }}')">Refract</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-scalpel" color="rose" onclick="openSurgModal('{{ $p->id }}')">Surgery</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <i class="fas fa-eye text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active eye principals identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Eye Registration -->
<x-cc-modal id="regModal" title="Register Eye Principal Node" icon="fa-user-plus">
    <form method="POST" action="{{ route('specialty.clinics.eye.register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Operational Chief Complaint" name="complaint" required placeholder="ACUTE_PROTOCOL_RATIONALE..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Examination -->
<x-cc-modal id="examModal" title="Authorize Clinical Eye Examination" icon="fa-stethoscope">
    <form method="POST" action="{{ route('specialty.clinics.eye.examination') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="eye_patient_id" id="examPatientId">
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="VA Right Eye" name="va_right" required placeholder="6/6_PROTOCOL" icon="fa-eye" />
            <x-cc-input label="VA Left Eye" name="va_left" required placeholder="6/6_PROTOCOL" icon="fa-eye" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="IOP Right (mmHg)" name="iop_right" type="number" icon="fa-gauge-high" />
            <x-cc-input label="IOP Left (mmHg)" name="iop_left" type="number" icon="fa-gauge-high" />
        </div>
        <x-cc-input label="Clinical Diagnosis Matrix" name="diagnosis" required placeholder="DIAGNOSIS_PROTOCOL" icon="fa-magnifying-glass-chart" />
        <x-cc-input label="Therapeutic Plan Vector" name="plan" required placeholder="MANAGEMENT_PROTOCOL..." icon="fa-route" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Examination Matrix</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Refraction -->
<x-cc-modal id="refModal" title="Commit Eye Refraction Intelligence" icon="fa-glasses">
    <form method="POST" action="{{ route('specialty.clinics.eye.refraction') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="eye_patient_id" id="refPatientId">
        <div class="grid grid-cols-3 gap-4">
            <x-cc-input label="Sphere (R)" name="sphere_right" type="number" step="0.25" required icon="fa-circle-dot" />
            <x-cc-input label="Cylinder (R)" name="cylinder_right" type="number" step="0.25" icon="fa-dna" />
            <x-cc-input label="Axis (R)" name="axis_right" type="number" icon="fa-compass" />
        </div>
        <div class="grid grid-cols-3 gap-4">
            <x-cc-input label="Sphere (L)" name="sphere_left" type="number" step="0.25" required icon="fa-circle-dot" />
            <x-cc-input label="Cylinder (L)" name="cylinder_left" type="number" step="0.25" icon="fa-dna" />
            <x-cc-input label="Axis (L)" name="axis_left" type="number" icon="fa-compass" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full">Commit Refraction Matrix</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Surgery -->
<x-cc-modal id="surgModal" title="Authorize Eye Surgery Protocol" icon="fa-scalpel">
    <form method="POST" action="{{ route('specialty.clinics.eye.surgery.plan') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="eye_patient_id" id="surgPatientId">
        <x-cc-input label="Surgical Procedure Matrix" name="procedure" required placeholder="CATARACT_EXTRACTION_PROTOCOL" icon="fa-kit-medical" />
        <div class="grid grid-cols-2 gap-4">
            <x-cc-select label="Target Eye Side" name="eye_side" icon="fa-arrows-left-right">
                <option value="right">RIGHT_EYE</option>
                <option value="left">LEFT_EYE</option>
                <option value="bilateral">BILATERAL_PROTOCOL</option>
            </x-cc-select>
            <x-cc-input label="Scheduled Date" name="scheduled_date" type="date" required icon="fa-calendar-day" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Surgical Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openExamModal(id) {
    document.getElementById('examPatientId').value = id;
    document.getElementById('examModal').classList.remove('hidden');
}
function openRefModal(id) {
    document.getElementById('refPatientId').value = id;
    document.getElementById('refModal').classList.remove('hidden');
}
function openSurgModal(id) {
    document.getElementById('surgPatientId').value = id;
    document.getElementById('surgModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

<x-cc-shell title='OPD Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">OPD <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Outpatient Surveillance · Strategic Triage · Flow Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="indigo" variant="ghost" onclick="document.getElementById('registerModal').classList.remove('hidden')">
                Register OPD Intake
            </x-cc-button>
        </div>
    </div>

    <!-- OPD Flow KPIs Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Total Visits" value="{{ $stats['today'] }}" icon="fa-users-line" trend="+12% Flow" color="indigo" />
        <x-cc-stat title="Completed" value="{{ $stats['seen'] }}" icon="fa-check-double" trend="Discharged" color="emerald" />
        <x-cc-stat title="Waiting" value="{{ $stats['waiting'] }}" icon="fa-clock-rotate-left" trend="Priority: Normal" color="amber" />
        <x-cc-stat title="Avg Cycle" value="18" subValue="MIN" icon="fa-hourglass-half" trend="-2m Variance" color="slate" />
    </div>

    <!-- OPD Queue Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Live Outpatient Queue Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Flow Synchronization Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Protocol', 'Complaint / Department', 'Visit Type', 'Status', 'Strategic Action']">
            @forelse($queue as $encounter)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($encounter->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $encounter->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $encounter->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight">{{ $encounter->complaint }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ $encounter->department }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-widest">
                            {{ $encounter->visit_type }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusCls = [
                                'completed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                'waiting' => 'bg-amber-500/10 text-amber-500 border-amber-500/20 animate-pulse',
                                'in_progress' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20',
                            ];
                            $cls = $statusCls[$encounter->status] ?? 'bg-white/5 text-white/40 border-white/10';
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $cls }} text-[9px] font-black uppercase tracking-widest">
                            {{ $encounter->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            @if($encounter->status === 'waiting')
                                <x-cc-button onclick="openConsultModal('{{ $encounter->id }}', '{{ $encounter->patient->full_name }}')" variant="ghost" size="sm" color="indigo" icon="fa-stethoscope">Start Consult</x-cc-button>
                            @elseif($encounter->status === 'in_progress')
                                <x-cc-button onclick="openDischargeModal('{{ $encounter->id }}', '{{ $encounter->patient->full_name }}')" variant="ghost" size="sm" color="emerald" icon="fa-door-open">Discharge</x-cc-button>
                            @else
                                <span class="text-[10px] font-black text-white/10 uppercase tracking-widest">Cycle Complete</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-users-line text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active OPD visits identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Register OPD Visit -->
<x-cc-modal id="registerModal" title="OPD Intake Authorization" icon="fa-user-plus">
    <form method="POST" action="{{ route('clinical.opd.register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient ID" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Primary Complaint" name="complaint" required placeholder="Reason for encounter" icon="fa-comment-medical" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Target Department" name="department" icon="fa-building-medical">
                <option value="General OPD">General OPD</option>
                <option value="Specialty Clinic">Specialty Clinic</option>
                <option value="Triage">Triage</option>
            </x-cc-select>
            <x-cc-select label="Encounter Type" name="visit_type" icon="fa-clock-rotate-left">
                <option value="New Visit">New Visit</option>
                <option value="Follow-up">Follow-up</option>
                <option value="Emergency Referral">Emergency Referral</option>
            </x-cc-select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Intake</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Clinical Consultation -->
<x-cc-modal id="consultModal" title="Clinical Consultation Intelligence" icon="fa-stethoscope">
    <form method="POST" action="{{ route('clinical.opd.consult') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="visit_id" id="consult_visit_id">
        <div class="p-4 bg-white/[0.02] border border-white/[0.04] rounded-2xl mb-6">
            <p class="text-[10px] font-black text-white/20 uppercase tracking-widest mb-1">Patient Identity</p>
            <p id="consult_patient_name" class="text-[13px] font-bold text-white uppercase tracking-tight"></p>
        </div>
        <x-cc-input label="History of Presenting Complaint" name="history" required placeholder="Subjective data..." icon="fa-history" />
        <x-cc-input label="Physical Examination" name="examination" required placeholder="Objective findings..." icon="fa-magnifying-glass-pulse" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Impression (Assessment)" name="impression" required placeholder="Clinical diagnosis..." icon="fa-file-medical" />
            <x-cc-input label="Plan of Care" name="plan" required placeholder="Management protocol..." icon="fa-route" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Clinical Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Institutional Discharge -->
<x-cc-modal id="dischargeModal" title="Institutional Discharge Protocol" icon="fa-door-open">
    <form id="dischargeForm" method="POST" action="" class="space-y-6">
        @csrf
        <div class="p-4 bg-white/[0.02] border border-white/[0.04] rounded-2xl mb-6">
            <p class="text-[10px] font-black text-white/20 uppercase tracking-widest mb-1">Patient Identity</p>
            <p id="discharge_patient_name" class="text-[13px] font-bold text-white uppercase tracking-tight"></p>
        </div>
        <x-cc-input label="Discharge Instruction" name="instruction" required placeholder="Patient teaching and follow-up guidance..." icon="fa-comment-dots" />
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Finalize Discharge</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
    function openConsultModal(id, name) {
        document.getElementById('consult_visit_id').value = id;
        document.getElementById('consult_patient_name').innerText = name;
        document.getElementById('consultModal').classList.remove('hidden');
    }
    function openDischargeModal(id, name) {
        let url = "{{ route('clinical.opd.discharge', ':id') }}";
        document.getElementById('dischargeForm').action = url.replace(':id', id);
        document.getElementById('discharge_patient_name').innerText = name;
        document.getElementById('dischargeModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

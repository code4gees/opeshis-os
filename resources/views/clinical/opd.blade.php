<x-cc-shell title='Opeshis OS'>

@section('title', 'OPD Strategic Command — Opeshis OS')


<div class="space-y-8 animate-fade-in">
    <!-- Header: OPD Command Hub -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase italic">OPD Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Outpatient Surveillance · Strategic Triage · Flow Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button onclick="document.getElementById('registerModal').showModal()" type="primary">Register OPD Intake</x-cc-button>
        </div>
    </header>

    @if(session('success'))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-xs font-black uppercase tracking-widest mb-8 animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <!-- OPD Flow KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
        <x-cc-stat label="Total Visits (Today)" value="{{ $stats['today'] }}" trend="+12% Flow" color="indigo" />
        <x-cc-stat label="Completed Cycles" value="{{ $stats['seen'] }}" trend="Discharged" color="emerald" />
        <x-cc-stat label="Current Queue (Waiting)" value="{{ $stats['waiting'] }}" trend="Priority: Normal" color="amber" />
        <x-cc-stat label="Avg Cycle Time" value="18" subValue="MIN" trend="-2m Variance" color="slate" />
    </div>

    <!-- OPD Queue Matrix -->
    <x-cc-card title="Live Outpatient Queue Matrix" subtitle="Institutional Flow Synchronization Active">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-10 py-6">Patient Protocol</th>
                        <th class="px-6 py-6">Complaint / Department</th>
                        <th class="px-6 py-6">Visit Type</th>
                        <th class="px-6 py-6 text-center">Status</th>
                        <th class="px-10 py-6 text-right">Strategic Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($queue as $encounter)
                    <tr class="hover:bg-white/5 transition-all group">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center font-black text-indigo-500 text-[10px] border border-indigo-500/20">
                                    {{ substr($encounter->patient->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-black text-white text-sm uppercase group-hover:text-indigo-400 transition-colors">{{ $encounter->patient->full_name }}</div>
                                    <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">{{ $encounter->patient->medical_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-xs font-black text-slate-300 uppercase tracking-tight">{{ $encounter->complaint }}</div>
                            <div class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-1">{{ $encounter->department }}</div>
                        </td>
                        <td class="px-6 py-6">
                            <span class="px-3 py-1 bg-white/5 text-slate-400 border border-white/10 rounded-lg text-[9px] font-black uppercase tracking-widest italic">{{ $encounter->visit_type }}</span>
                        </td>
                        <td class="px-6 py-6 text-center">
                            @php
                                $statusCls = [
                                    'completed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    'waiting' => 'bg-amber-500/10 text-amber-500 border-amber-500/20 animate-pulse',
                                    'in_progress' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20 shadow-lg shadow-indigo-500/10',
                                ];
                                $cls = $statusCls[$encounter->status] ?? 'bg-white/5 text-slate-400 border-white/10';
                            @endphp
                            <span class="px-3 py-1 rounded-lg border {{ $cls }} text-[8px] font-black uppercase tracking-widest">
                                {{ $encounter->status }}
                            </span>
                        </td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                @if($encounter->status === 'waiting')
                                    <x-cc-button onclick="openConsultModal('{{ $encounter->id }}', '{{ $encounter->patient->full_name }}')" type="primary" size="sm">Start Consult</x-cc-button>
                                @elseif($encounter->status === 'in_progress')
                                    <x-cc-button onclick="openDischargeModal('{{ $encounter->id }}', '{{ $encounter->patient->full_name }}')" type="success" size="sm">Discharge</x-cc-button>
                                @else
                                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic">Cycle Complete</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-10 py-24 text-center">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic text-center">No active OPD visits identified for today.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-cc-card>
</div>

<!-- Modal: Register OPD Visit -->
<x-cc-modal id="registerModal" title="OPD Intake Authorization">
    <form method="POST" action="{{ route('clinical.opd.register') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Institutional Patient ID</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Primary Complaint</label>
            <input name="complaint" required placeholder="Reason for encounter" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Target Department</label>
                <select name="department" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
                    <option value="General OPD">General OPD</option>
                    <option value="Specialty Clinic">Specialty Clinic</option>
                    <option value="Triage">Triage</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Encounter Type</label>
                <select name="visit_type" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
                    <option value="New Visit">New Visit</option>
                    <option value="Follow-up">Follow-up</option>
                    <option value="Emergency Referral">Emergency Referral</option>
                </select>
            </div>
        </div>
        <div class="flex gap-4 mt-8">
            <x-cc-button type="secondary" onclick="document.getElementById('registerModal').close()" class="flex-1">Cancel</x-cc-button>
            <x-cc-button type="primary" class="flex-1">Authorize Intake</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Clinical Consultation -->
<x-cc-modal id="consultModal" title="Clinical Consultation Intelligence">
    <form method="POST" action="{{ route('clinical.opd.consult') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="visit_id" id="consult_visit_id">
        <div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Patient: <span id="consult_patient_name" class="text-white"></span></p>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">History of Presenting Complaint (Subjective)</label>
            <textarea name="history" rows="3" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all"></textarea>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Physical Examination (Objective)</label>
            <textarea name="examination" rows="3" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all"></textarea>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Impression (Assessment)</label>
                <input name="impression" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Plan of Care</label>
                <input name="plan" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>
        </div>
        <div class="flex gap-4 mt-8">
            <x-cc-button type="secondary" onclick="document.getElementById('consultModal').close()" class="flex-1">Cancel</x-cc-button>
            <x-cc-button type="primary" class="flex-1">Commit Clinical Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Institutional Discharge -->
<x-cc-modal id="dischargeModal" title="Institutional Discharge Protocol">
    <form method="POST" action="{{ route('clinical.opd.discharge') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="visit_id" id="discharge_visit_id">
        <div>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Patient: <span id="discharge_patient_name" class="text-white"></span></p>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Discharge Instruction</label>
            <textarea name="instruction" rows="4" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all" placeholder="Patient teaching and follow-up guidance..."></textarea>
        </div>
        <div class="flex gap-4 mt-8">
            <x-cc-button type="secondary" onclick="document.getElementById('dischargeModal').close()" class="flex-1">Cancel</x-cc-button>
            <x-cc-button type="success" class="flex-1">Finalize Discharge</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
    function openConsultModal(id, name) {
        document.getElementById('consult_visit_id').value = id;
        document.getElementById('consult_patient_name').innerText = name;
        document.getElementById('consultModal').showModal();
    }
    function openDischargeModal(id, name) {
        document.getElementById('discharge_visit_id').value = id;
        document.getElementById('discharge_patient_name').innerText = name;
        document.getElementById('dischargeModal').showModal();
    }
</script>
</x-cc-shell>

<x-cc-shell title='Nutrition Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Nutrition <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Nutritional Intelligence · Therapeutic Dietetics · Clinical Assessment Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Authorize Assessment
            </x-cc-button>
        </div>
    </div>

    <!-- Nutrition Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Surveillance" value="{{ $patients->count() }}" icon="fa-bowl-food" trend="Active Registry" color="indigo" />
        <x-cc-stat title="Therapeutic Yield" value="84%" icon="fa-chart-line" trend="Growth Recovery" color="emerald" />
        <x-cc-stat title="Severe Malnutrition" value="{{ $patients->where('nutritional_status', 'SAM')->count() }}" icon="fa-triangle-exclamation" trend="Critical Signal" color="rose" />
        <x-cc-stat title="Dietetic Capacity" value="Nominal" icon="fa-weight-scale" trend="Operational" color="slate" />
    </div>

    <!-- Nutrition Registry Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Nutrition Registry Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Protocol: Active Surveillance</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Profile Identity', 'Nutritional Status', 'Growth Matrix (MUAC/Weight)', 'Admissions Intelligence', 'Strategic Action']">
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
                        @php
                            $statusCls = $p->nutritional_status === 'SAM' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse' : ($p->nutritional_status === 'MAM' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20');
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $statusCls }} text-[9px] font-black uppercase tracking-widest">
                            {{ $p->nutritional_status }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight">MUAC: {{ $p->muac_cm }}cm</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Weight: {{ $p->weight_kg }}kg</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight line-clamp-1">"{{ $p->admission_reason }}"</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Admitted: {{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}</div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-pen-to-square" color="indigo" onclick="openVisitModal('{{ $p->id }}')">Log Visit</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald" onclick="openDischargeModal('{{ $p->id }}')">Discharge</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-bowl-food text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active nutrition cases in the surveillance matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Authorize Nutrition Admission -->
<x-cc-modal id="regModal" title="Authorize Nutrition Case Admission" icon="fa-plus-circle">
    <form method="POST" action="{{ url('/clinical/nutrition/admit') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Admission Reason Matrix" name="reason" required placeholder="e.g. SEVERE WASTING" icon="fa-file-medical" />
            <x-cc-select label="Nutritional Severity Status" name="status_type" icon="fa-triangle-exclamation">
                <option value="SAM">SAM (Severe)</option>
                <option value="MAM">MAM (Moderate)</option>
                <option value="NORMAL">NORMAL</option>
            </x-cc-select>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Baseline Weight (kg)" name="weight" type="number" step="0.1" required placeholder="0.0" icon="fa-weight-scale" />
            <x-cc-input label="MUAC Dimension (cm)" name="muac" type="number" step="0.1" required placeholder="0.0" icon="fa-ruler-horizontal" />
        </div>
        <div class="flex items-center gap-4 p-4 bg-white/[0.02] border border-white/[0.04] rounded-2xl group cursor-pointer">
            <input type="checkbox" name="oedema" value="1" id="oedema_chk" class="w-5 h-5 rounded-lg border-white/10 bg-white/5 checked:bg-indigo-500 transition-all cursor-pointer">
            <label for="oedema_chk" class="text-[11px] font-bold text-white/40 uppercase tracking-widest cursor-pointer group-hover:text-white transition-colors">Bilateral Pitting Oedema Detected</label>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Admission Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Commit Nutritional Follow-up Intelligence -->
<x-cc-modal id="visitModal" title="Commit Nutritional Follow-up Intelligence" icon="fa-pen-to-square">
    <form method="POST" action="{{ url('/clinical/nutrition/visit') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="case_id" id="visitCaseId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Current Weight (kg)" name="weight" type="number" step="0.1" required placeholder="0.0" icon="fa-weight-scale" />
            <x-cc-input label="Current MUAC (cm)" name="muac" type="number" step="0.1" required placeholder="0.0" icon="fa-ruler-horizontal" />
        </div>
        <x-cc-input label="Therapeutic Food Issued" name="food_issued" placeholder="e.g. RUTF 28 SACHETS" icon="fa-box-open" />
        <x-cc-input label="Clinical Complications Matrix" name="complications" placeholder="ENTER ANY COMPLICATIONS..." icon="fa-notes-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Visit Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Finalize Discharge Protocol -->
<x-cc-modal id="dischargeModal" title="Finalize Discharge Protocol" icon="fa-door-open">
    <form id="dischargeForm" method="POST" action="" class="space-y-6">
        @csrf
        <x-cc-input label="Discharge Weight (kg)" name="weight" type="number" step="0.1" required placeholder="0.0" icon="fa-weight-scale" />
        <x-cc-select label="Discharge Outcome Matrix" name="outcome" icon="fa-route">
            <option value="cured">CURED_PROTOCOL_NOMINAL</option>
            <option value="defaulter">DEFAULTER_SIGNAL_LOST</option>
            <option value="non-responder">NON_RESPONDER_MATRIX</option>
            <option value="transferred">TRANSFERRED_TO_STABILIZATION</option>
        </x-cc-select>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Finalize Discharge Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openVisitModal(id) {
    document.getElementById('visitCaseId').value = id;
    document.getElementById('visitModal').classList.remove('hidden');
}
function openDischargeModal(id) {
    document.getElementById('dischargeForm').action = "{{ url('/clinical/nutrition/discharge') }}/" + id;
    document.getElementById('dischargeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Nutritional Clinical Hub - Opeshis OS')


<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-200 uppercase tracking-tighter">Nutrition Command Hub</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Nutritional Intelligence · Therapeutic Dietetics · Clinical Assessment Hub</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-plus-circle" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Authorize New Assessment
            </x-cc-button>
        </div>
    </div>

    <!-- Nutrition Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Active Surveillance" 
            value="{{ $patients->count() }}" 
            icon="fa-bowl-food" 
            trend="Active Registry" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Therapeutic Yield" 
            value="84%" 
            icon="fa-chart-line" 
            trend="Growth Recovery" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Severe Malnutrition" 
            value="{{ $patients->where('nutritional_status', 'SAM')->count() }}" 
            icon="fa-triangle-exclamation" 
            trend="Critical Signal" 
            color="rose" 
        />
        <x-cc-stat 
            title="Dietetic Capacity" 
            value="Nominal" 
            icon="fa-weight-scale" 
            trend="Operational" 
            color="slate" 
        />
    </div>

    <!-- Nutrition Registry Matrix -->
    <x-cc-card title="Institutional Nutrition Registry Matrix" icon="fa-database">
        <x-slot name="action">
            <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-500 border border-indigo-500/20 rounded text-[9px] font-black uppercase tracking-widest italic">Protocol: Active Surveillance</span>
        </x-slot>

        <x-cc-table :headers="['Patient Profile Identity', 'Nutritional Status', 'Growth Matrix (MUAC/Weight)', 'Admissions Intelligence', 'Strategic Action']">
            @forelse($patients as $p)
                <tr class="group hover:bg-indigo-500/[0.02] transition-colors">
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="flex items-center">
                            <div class="h-9 w-9 flex-shrink-0 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-slate-400 font-bold text-xs uppercase">
                                {{ substr($p->patient->full_name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-indigo-400 transition-colors italic">{{ $p->patient->full_name }}</div>
                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $p->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        @php
                            $statusCls = $p->nutritional_status === 'SAM' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse' : ($p->nutritional_status === 'MAM' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20');
                        @endphp
                        <span class="px-3 py-1.5 rounded-lg border {{ $statusCls }} text-[8px] font-black uppercase tracking-widest italic">
                            {{ $p->nutritional_status }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest italic">MUAC: {{ $p->muac_cm }}cm</div>
                        <div class="text-[9px] font-black text-slate-600 uppercase mt-1 italic">Weight: {{ $p->weight_kg }}kg</div>
                    </td>
                    <td class="px-5 py-4">
                        <div class="text-[10px] font-black text-slate-300 uppercase italic line-clamp-1">"{{ $p->admission_reason }}"</div>
                        <div class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-1">Admitted: {{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}</div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-pen-to-square" color="indigo" onclick="openVisitModal('{{ $p->id }}')">Log Visit</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald" onclick="openDischargeModal('{{ $p->id }}')">Discharge</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-600 italic text-sm">No active nutrition cases identified in the surveillance matrix.</td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Authorize Nutrition Admission -->
<x-cc-modal id="regModal" title="Authorize Nutrition Case Admission" icon="fa-plus-circle">
    <form method="POST" action="{{ url('/clinical/nutrition/admit') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Institutional Patient Identity</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Admission Reason Matrix</label>
                <input name="reason" required placeholder="e.g. SEVERE WASTING" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Nutritional Severity Status</label>
                <select name="status_type" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
                    <option value="SAM">SAM (Severe)</option>
                    <option value="MAM">MAM (Moderate)</option>
                    <option value="NORMAL">NORMAL</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Baseline Weight (kg)</label>
                <input name="weight" type="number" step="0.1" required placeholder="0.0" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">MUAC Dimension (cm)</label>
                <input name="muac" type="number" step="0.1" required placeholder="0.0" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
        </div>
        <div>
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" name="oedema" value="1" class="w-5 h-5 bg-slate-900/50 border border-slate-700/60 rounded-lg checked:bg-indigo-600 transition-all outline-none">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-200 transition-colors italic">Bilateral Pitting Oedema Detected</span>
            </label>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Authorize Admission Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Commit Nutritional Follow-up Intelligence -->
<x-cc-modal id="visitModal" title="Commit Nutritional Follow-up Intelligence" icon="fa-pen-to-square">
    <form method="POST" action="{{ url('/clinical/nutrition/visit') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="case_id" id="visitCaseId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Current Weight (kg)</label>
                <input name="weight" type="number" step="0.1" required placeholder="0.0" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Current MUAC (cm)</label>
                <input name="muac" type="number" step="0.1" required placeholder="0.0" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Therapeutic Food Issued</label>
            <input name="food_issued" placeholder="e.g. RUTF 28 SACHETS" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Clinical Complications Matrix</label>
            <textarea name="complications" rows="2" placeholder="ENTER ANY COMPLICATIONS..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Commit Visit Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Finalize Discharge Protocol -->
<x-cc-modal id="dischargeModal" title="Finalize Discharge Protocol" icon="fa-door-open">
    <form id="dischargeForm" method="POST" action="" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Discharge Weight (kg)</label>
            <input name="weight" type="number" step="0.1" required placeholder="0.0" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Discharge Outcome Matrix</label>
            <select name="outcome" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
                <option value="cured">CURED_PROTOCOL_NOMINAL</option>
                <option value="defaulter">DEFAULTER_SIGNAL_LOST</option>
                <option value="non-responder">NON_RESPONDER_MATRIX</option>
                <option value="transferred">TRANSFERRED_TO_STABILIZATION</option>
            </select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full uppercase tracking-widest">Finalize Discharge Protocol</x-cc-button>
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

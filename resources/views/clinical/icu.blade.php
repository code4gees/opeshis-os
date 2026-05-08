<x-cc-shell title='Opeshis OS'>

@section('title', 'ICU Command - Opeshis OS')

<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-rose-500 uppercase tracking-tighter">Critical Care Command</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Institutional Intensive Care Surveillance · SOFA Strategic Scoring</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-plus-circle" color="rose" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Admission
            </x-cc-button>
        </div>
    </div>

    <!-- Critical Care KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Active Census" 
            value="{{ $census->count() }}" 
            icon="fa-bed-pulse" 
            trend="Active Cases" 
            color="rose" 
        />
        <x-cc-stat 
            title="High Risk" 
            value="{{ $census->filter(fn($c) => ($c->latestSofa->total_score ?? 0) >= 10)->count() }}" 
            icon="fa-triangle-exclamation" 
            trend="SOFA ≥ 10" 
            color="amber" 
        />
        <x-cc-stat 
            title="Avg SOFA" 
            value="{{ number_format($census->avg(fn($c) => $c->latestSofa->total_score ?? 0), 1) }}" 
            icon="fa-chart-line" 
            trend="Unit Index" 
            color="blue" 
        />
        <x-cc-stat 
            title="Surveillance" 
            value="Active" 
            icon="fa-eye" 
            trend="Real-time" 
            color="emerald" 
        />
    </div>

    <!-- ICU Census Matrix -->
    <x-clinical-card title="Live Critical Care Census" icon="fa-hospital-user" badge="Live Surveillance">
        <x-data-table :headers="['Patient Identity', 'Bed / Unit', 'Hemodynamics', 'SOFA Index', 'Strategic Actions']">
            @forelse($census as $c)
                <tr class="group hover:bg-rose-500/[0.02] transition-colors">
                    <td class="whitespace-nowrap px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 rounded-xl bg-rose-500/10 flex items-center justify-center border border-rose-500/20 text-rose-500 font-bold text-xs">
                                {{ substr($c->patient->full_name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $c->patient->full_name }}</div>
                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-center">
                        <span class="px-2 py-1 bg-slate-900/40 border border-slate-700/60 rounded text-[10px] font-black text-rose-400 uppercase tracking-widest">
                            {{ $c->bed_number }}
                        </span>
                        <div class="text-[8px] font-black text-slate-600 uppercase mt-1">{{ $c->source_unit ?? 'ORIGIN_NA' }}</div>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4">
                        @php $v = $c->latestVital; @endphp
                        <div class="flex gap-4">
                            <div class="text-center">
                                <div class="text-[10px] font-black text-slate-200">{{ $v ? $v->bp_systolic.'/'.$v->bp_diastolic : '—' }}</div>
                                <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest">BP</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[10px] font-black {{ ($v->spo2 ?? 100) < 90 ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }}">
                                    {{ $v ? $v->spo2.'%' : '—' }}
                                </div>
                                <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest">SpO₂</div>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-center">
                        @php $sofa = $c->latestSofa->total_score ?? null; @endphp
                        @if($sofa !== null)
                            <x-status-badge :status="$sofa >= 10 ? 'critical' : ($sofa >= 6 ? 'pending' : 'completed')" />
                            <div class="text-[10px] font-black text-slate-400 mt-1 uppercase tracking-widest">Score: {{ $sofa }}</div>
                        @else
                            <span class="text-[9px] font-black text-slate-600 uppercase tracking-widest italic">PENDING</span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-heart-pulse" color="rose" onclick="openVitalsModal('{{ $c->id }}')">Vitals</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-chart-simple" color="amber" onclick="openSOFAModal('{{ $c->id }}')">SOFA</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald" onclick="openDischargeModal('{{ $c->id }}')">Discharge</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-600 italic text-sm">Critical care census is currently baseline (empty).</td>
                </tr>
            @endforelse
        </x-data-table>
    </x-clinical-card>
</div>

<!-- Modal: ICU Admission -->
<x-cc-modal id="admitModal" title="Critical Intake Authorization" icon="fa-hospital-user">
    <form method="POST" action="{{ url('/clinical/icu/admit') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Institutional Patient ID</label>
                <input name="patient_id" required placeholder="UUID / Medical ID" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Bed Allocation</label>
                <input name="bed_number" required placeholder="ICU-XX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Primary Critical Diagnosis</label>
            <input name="diagnosis" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Referral Origin</label>
            <input name="source" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none uppercase" placeholder="e.g. EMERGENCY, THEATRE">
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Critical Care Admission</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Vitals Logging -->
<x-cc-modal id="vitalsModal" title="Hemodynamic Surveillance Log" icon="fa-heart-pulse">
    <form method="POST" action="{{ url('/clinical/icu/vitals') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="vitalsAdmissionId">
        <div class="grid grid-cols-3 gap-4">
            @foreach(['bp_systolic'=>'Sys BP','bp_diastolic'=>'Dia BP','heart_rate'=>'HR','spo2'=>'SpO2','temperature'=>'Temp','gcs'=>'GCS'] as $name => $label)
            <div>
                <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-2">{{ $label }}</label>
                <input name="{{ $name }}" type="number" step="0.1" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-2.5 text-xs font-black text-slate-200 outline-none">
            </div>
            @endforeach
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Commit Hemodynamic Data</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: SOFA Scoring -->
<x-cc-modal id="sofaModal" title="SOFA Strategic Indexing" icon="fa-chart-simple">
    <form method="POST" action="{{ url('/clinical/icu/sofa') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="sofaAdmissionId">
        <div class="grid grid-cols-2 gap-4">
            @foreach(['respiratory'=>'Respiratory','coagulation'=>'Coagulation','liver'=>'Liver','cardiovascular'=>'Cardiovascular','cns'=>'CNS (GCS)','renal'=>'Renal'] as $name => $label)
            <div>
                <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-2">{{ $label }}</label>
                <select name="{{ $name }}" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-2.5 text-xs font-black text-slate-200 outline-none">
                    <option value="0">0 (Normal)</option>
                    <option value="1">1</option><option value="2">2</option>
                    <option value="3">3</option><option value="4">4 (Failure)</option>
                </select>
            </div>
            @endforeach
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Authorize SOFA Log</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Discharge -->
<x-cc-modal id="dischargeModal" title="Discharge Protocol" icon="fa-door-open">
    <form method="POST" id="dischargeForm" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Discharge Destination</label>
            <select name="destination" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none">
                <option value="General Ward">General Ward</option>
                <option value="HDU">High Dependency Unit (HDU)</option>
                <option value="Other Facility">Transfer to Other Facility</option>
                <option value="Home">Discharge Home</option>
                <option value="Morgue">Morgue (Expired)</option>
            </select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Finalize Discharge Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openVitalsModal(id) {
    document.getElementById('vitalsAdmissionId').value = id;
    document.getElementById('vitalsModal').classList.remove('hidden');
}
function openSOFAModal(id) {
    document.getElementById('sofaAdmissionId').value = id;
    document.getElementById('sofaModal').classList.remove('hidden');
}
function openDischargeModal(id) {
    document.getElementById('dischargeForm').action = '/clinical/icu/' + id + '/discharge';
    document.getElementById('dischargeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

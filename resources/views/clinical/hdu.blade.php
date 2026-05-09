<x-cc-shell title='HDU Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">HDU <span class="text-amber-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional HDU Surveillance · Step-Down Intelligence · ICU Escalation Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="amber" variant="ghost" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Admission
            </x-cc-button>
        </div>
    </div>

    <!-- HDU KPIs Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Census" value="{{ $census->count() }}" icon="fa-bed-pulse" trend="Active Cases" color="amber" />
        <x-cc-stat title="Critical Risk" value="{{ $census->filter(fn($c) => ($c->latestVital->spo2 ?? 100) < 90)->count() }}" icon="fa-triangle-exclamation" trend="Hypoxia Signal" color="rose" />
        <x-cc-stat title="Avg Pulse" value="{{ number_format($census->avg(fn($c) => $c->latestVital->heart_rate ?? 0), 0) }} bpm" icon="fa-heart-pulse" trend="Unit Baseline" color="sky" />
        <x-cc-stat title="Step-Down" value="Active" icon="fa-stairs" trend="Operational" color="emerald" />
    </div>

    <!-- HDU Census Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional HDU Census Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-amber-500 uppercase tracking-widest">Live Surveillance Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Bed / Unit', 'Diagnosis Profile', 'Hemodynamics', 'Strategic Actions']">
            @forelse($census as $c)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-amber-500/10 group-hover:text-amber-500 group-hover:border-amber-500/20 transition-all">
                                {{ substr($c->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors">{{ $c->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-black text-amber-500">
                            {{ $c->bed_number }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight truncate max-w-xs leading-relaxed" title="{{ $c->admitting_diagnosis }}">"{{ $c->admitting_diagnosis }}"</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Primary Rationale</div>
                    </td>
                    <td class="px-8 py-6">
                        @php $v = $c->latestVital; @endphp
                        @if($v)
                            <div class="flex gap-6">
                                <div class="text-center">
                                    <div class="text-[11px] font-bold text-white">{{ $v->bp_systolic }}/{{ $v->bp_diastolic }}</div>
                                    <div class="text-[9px] font-black text-white/10 uppercase tracking-widest">BP</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-[11px] font-black {{ $v->spo2 < 90 ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }}">
                                        {{ $v->spo2 }}%
                                    </div>
                                    <div class="text-[9px] font-black text-white/10 uppercase tracking-widest">SpO₂</div>
                                </div>
                            </div>
                        @else
                            <span class="text-[11px] font-bold text-white/10 uppercase tracking-tight">SIGNAL_NA</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-heart-pulse" color="amber" onclick="openVitalsModal('{{ $c->id }}')">Vitals</x-cc-button>
                            <form method="POST" action="{{ route('specialty.critical.hdu.escalate', $c->id) }}" class="inline-block">
                                @csrf
                                <x-cc-button variant="ghost" size="sm" icon="fa-arrow-up" color="rose" type="submit">ICU</x-cc-button>
                            </form>
                            <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald" onclick="openDischargeModal('{{ $c->id }}')">End</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-bed-pulse text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">HDU census matrix is baseline.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Intake Authorization -->
<x-cc-modal id="admitModal" title="High Dependency Intake" icon="fa-hospital-user">
    <form method="POST" action="{{ route('specialty.critical.hdu.admit') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Patient Identity ID" name="patient_id" required placeholder="UUID / Medical ID" icon="fa-id-card-clip" />
            <x-cc-input label="Bed Allocation" name="bed_number" required placeholder="HDU-XX" icon="fa-bed" />
        </div>
        <x-cc-input label="Admitting Diagnosis" name="diagnosis" required placeholder="Disclosure of rationale..." icon="fa-stethoscope" />
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Authorize HDU Admission</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Vitals Logging -->
<x-cc-modal id="vitalsModal" title="Hemodynamic Surveillance Log" icon="fa-heart-pulse">
    <form method="POST" action="{{ route('specialty.critical.hdu.vitals') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="vitalsAdmissionId">
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Systolic BP" name="bp_systolic" type="number" step="0.1" icon="fa-gauge-high" />
            <x-cc-input label="Diastolic BP" name="bp_diastolic" type="number" step="0.1" icon="fa-gauge-low" />
            <x-cc-input label="Heart Rate" name="heart_rate" type="number" step="0.1" icon="fa-heart-pulse" />
            <x-cc-input label="SpO2 (%)" name="spo2" type="number" step="0.1" icon="fa-lungs" />
            <x-cc-input label="Temperature (°C)" name="temperature" type="number" step="0.1" icon="fa-thermometer" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Commit Hemodynamic Data</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Discharge -->
<x-cc-modal id="dischargeModal" title="HDU Discharge Protocol" icon="fa-door-open">
    <form method="POST" id="dischargeForm" class="space-y-6">
        @csrf
        <p class="text-[11px] font-bold text-white/40 leading-relaxed uppercase tracking-tight">
            ⚠ Confirming discharge will finalize the high dependency care protocol. Ensure all clinical indicators are stable.
        </p>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Authorize Final Discharge</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openVitalsModal(id) {
    document.getElementById('vitalsAdmissionId').value = id;
    document.getElementById('vitalsModal').classList.remove('hidden');
}
function openDischargeModal(id) {
    let url = "{{ route('specialty.critical.hdu.discharge', ':id') }}";
    document.getElementById('dischargeForm').action = url.replace(':id', id);
    document.getElementById('dischargeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

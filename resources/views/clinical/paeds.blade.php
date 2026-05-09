<x-cc-shell title='Pediatrics Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Pediatrics <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Inpatient Pediatric Census & Monitoring</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="indigo" variant="ghost" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Intake
            </x-cc-button>
        </div>
    </div>

    <!-- Ward KPIs Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Ward Occupancy" value="{{ $stats['active'] }}" icon="fa-bed" trend="Active Census" color="indigo" />
        <x-cc-stat title="Pending Orders" value="{{ $stats['pending_orders'] }}" icon="fa-clipboard-check" trend="Needs Attention" color="amber" />
        <x-cc-stat title="Stability Index" value="98.5%" icon="fa-heart-pulse" trend="Protocol Standard" color="emerald" />
        <x-cc-stat title="Unit Protocol" value="Level II" icon="fa-shield-halved" trend="Active Monitoring" color="slate" />
    </div>

    <!-- Census Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Pediatric Census Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Monitoring Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Age / Growth', 'Ward / Bed', 'Vital Stability', 'Operations']">
            @forelse($census as $c)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($c->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $c->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight">
                            {{ $c->age_days < 365 ? $c->age_days." Days" : floor($c->age_days/365)." Years" }}
                        </div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Weight: {{ $c->weight_kg }} kg</div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-widest">
                            {{ $c->ward }} · Bed {{ $c->bed_number }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @php $spo2 = optional($c->latest_vitals)->spo2; @endphp
                        <div class="flex items-center gap-4">
                            <span class="text-[11px] font-black {{ $spo2 && $spo2 < 92 ? 'text-rose-500 animate-pulse' : ($spo2 ? 'text-emerald-500' : 'text-white/10') }}">
                                {{ $spo2 ? $spo2.'%' : 'SIGNAL_NA' }}
                            </span>
                            <div class="w-16 h-1.5 bg-white/5 rounded-full overflow-hidden border border-white/5">
                                <div class="h-full {{ $spo2 && $spo2 < 92 ? 'bg-rose-500' : 'bg-emerald-500' }}" style="width: {{ $spo2 ?: 0 }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-chart-line" color="indigo" onclick="openVitals('{{ $c->id }}')">Vitals</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-ruler-vertical" color="sky" onclick="openGrowth('{{ $c->id }}')">Growth</x-cc-button>
                            <form method="POST" action="{{ route('clinical.paeds.discharge', $c->id) }}" class="inline-block">
                                @csrf
                                <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald">Discharge</x-cc-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-child-reaching text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active paediatric admissions in the census.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Intake Authorization -->
<x-cc-modal id="admitModal" title="Intake Authorization" icon="fa-hospital-user">
    <form method="POST" action="{{ route('clinical.paeds.admit') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Patient Forensic ID" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
            <x-cc-input label="Admission Weight (KG)" name="weight" type="number" step="0.1" required icon="fa-weight-scale" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Ward Allocation" name="ward" required placeholder="Pediatric Ward A" icon="fa-building-ngo" />
            <x-cc-input label="Bed Designation" name="bed_number" required placeholder="BED-XX" icon="fa-bed" />
        </div>
        <x-cc-input label="Admission Diagnosis" name="diagnosis" required placeholder="Indicate clinical rationale..." icon="fa-stethoscope" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Pediatric Intake</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Vitals Logging -->
<x-cc-modal id="vitalsModal" title="Clinical Vitals Matrix" icon="fa-chart-line">
    <form method="POST" action="{{ route('clinical.paeds.vitals') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="vitalsId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Temp (°C)" name="temperature" step="0.1" type="number" icon="fa-thermometer" />
            <x-cc-input label="Heart Rate (BPM)" name="heart_rate" type="number" icon="fa-heart-pulse" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Resp Rate" name="resp_rate" type="number" icon="fa-lungs" />
            <x-cc-input label="SpO₂ (%)" name="spo2" type="number" icon="fa-wind" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Record Vitals Matrix</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Growth Monitoring -->
<x-cc-modal id="growthModal" title="Growth Telemetry" icon="fa-ruler-vertical">
    <form method="POST" action="{{ route('clinical.paeds.growth') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="growthId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Weight (KG)" name="weight" step="0.01" type="number" icon="fa-weight-scale" />
            <x-cc-input label="Height (CM)" name="height" step="0.1" type="number" icon="fa-ruler-vertical" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Head Circ (CM)" name="hc" step="0.1" type="number" icon="fa-circle-dot" />
            <x-cc-input label="MUAC (CM)" name="muac" step="0.1" type="number" icon="fa-dna" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Save Growth Telemetry</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openVitals(id){ document.getElementById('vitalsId').value=id; document.getElementById('vitalsModal').classList.remove('hidden'); }
function openGrowth(id){ document.getElementById('growthId').value=id; document.getElementById('growthModal').classList.remove('hidden'); }
</script>
</x-cc-shell>

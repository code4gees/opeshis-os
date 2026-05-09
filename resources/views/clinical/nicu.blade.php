<x-cc-shell title='NICU Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">NICU <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Neonatal Intelligence · Feeding & Phototherapy Surveillance</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="indigo" variant="ghost" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Intake
            </x-cc-button>
        </div>
    </div>

    <!-- Neonatal KPIs Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Neonatal Census" :value="$census->count()" icon="fa-baby" trend="Active Protocols" color="indigo" />
        <x-cc-stat title="Phototherapy" :value="$census->where('phototherapy', true)->count()" icon="fa-lightbulb" trend="Active Units" color="amber" />
        <x-cc-stat title="Avg Weight" :value="number_format($census->avg('birth_weight') ?? 0, 2) . ' kg'" icon="fa-weight-scale" trend="Unit Baseline" color="sky" />
        <x-cc-stat title="Critical Care" value="Active" icon="fa-shield-heart" trend="Surveillance" color="emerald" />
    </div>

    <!-- NICU Census Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Neonatal Census Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Surveillance Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Neonate / Maternal', 'Weight / Age', 'Status Signals', 'Nutritional Log', 'Strategic Actions']">
            @forelse($census as $c)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($c->mother->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">Baby of {{ $c->mother->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="text-[11px] font-black text-white tracking-widest uppercase">{{ $c->birth_weight }} KG</div>
                        <div class="text-[9px] font-bold text-white/10 uppercase tracking-tighter mt-1">{{ $c->gestational_age }} WEEKS GA</div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        @if($c->phototherapy)
                            <div class="flex flex-col items-center gap-2">
                                <span class="px-3 py-1.5 bg-amber-500/10 border border-amber-500/20 text-amber-500 rounded-xl text-[9px] font-black uppercase tracking-widest animate-pulse">PT_ACTIVE</span>
                            </div>
                        @else
                            <span class="px-3 py-1.5 bg-white/5 text-white/20 border border-white/10 rounded-xl text-[9px] font-black uppercase tracking-widest">BASELINE_OFF</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        @php $f = $c->latestFeeding; @endphp
                        @if($f)
                            <div class="text-[11px] font-bold text-white uppercase tracking-tight">{{ $f->feeding_type }} · {{ $f->volume_ml }}ML</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Last Intake Log</div>
                        @else
                            <span class="text-[11px] font-bold text-white/10 uppercase tracking-tight">SIGNAL_NA</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-heart-pulse" color="indigo" onclick="openVitalsModal('{{ $c->id }}')">Vitals</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-utensils" color="sky" onclick="openFeedingModal('{{ $c->id }}')">Feed</x-cc-button>
                            @if(!$c->phototherapy)
                                <form method="POST" action="{{ route('specialty.critical.nicu.phototherapy', $c->id) }}" class="inline-block">
                                    @csrf
                                    <x-cc-button variant="ghost" size="sm" icon="fa-lightbulb" color="amber" type="submit">PT On</x-cc-button>
                                </form>
                            @endif
                            <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="emerald" onclick="openDischargeModal('{{ $c->id }}')">End</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-baby text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Neonatal census matrix is baseline.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Intake Authorization -->
<x-cc-modal id="admitModal" title="Neonatal Intake Authorization" icon="fa-baby">
    <form method="POST" action="{{ route('specialty.critical.nicu.admit') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Neonate Patient ID" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
            <x-cc-input label="Maternal Patient ID" name="mother_id" required placeholder="OP-XXXX-XXXX" icon="fa-person-breastfeeding" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Birth Weight (KG)" name="birth_weight" type="number" step="0.01" required placeholder="0.00" icon="fa-weight-scale" />
            <x-cc-input label="Gestational Age" name="gestational_age" type="number" required placeholder="0" icon="fa-calendar-day" />
        </div>
        <x-cc-input label="Diagnosis Protocol" name="diagnosis" required placeholder="CLINICAL_RATIONALE..." icon="fa-stethoscope" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Neonatal Intake</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Vitals Intelligence -->
<x-cc-modal id="vitalsModal" title="Neonatal Vitals Intelligence" icon="fa-heart-pulse">
    <form method="POST" action="{{ route('specialty.critical.nicu.vitals') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="nicu_admission_id" id="vitalsAdmissionId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="SpO2 (%)" name="spo2" type="number" required placeholder="95" icon="fa-lungs" />
            <x-cc-input label="Heart Rate (BPM)" name="heart_rate" type="number" required placeholder="120" icon="fa-heart" />
            <x-cc-input label="Temperature (°C)" name="temperature" type="number" step="0.1" required placeholder="36.5" icon="fa-temperature-half" />
            <x-cc-input label="Respiratory Rate" name="respiratory_rate" type="number" required placeholder="40" icon="fa-wind" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Vitals Matrix</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Nutritional Intake -->
<x-cc-modal id="feedingModal" title="Neonatal Nutritional Log" icon="fa-utensils">
    <form method="POST" action="{{ route('specialty.critical.nicu.feeding') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="nicu_admission_id" id="feedingAdmissionId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Feeding Protocol" name="feeding_type" icon="fa-bottle-droplet">
                <option value="breast">EBM / BREAST_MATRIX</option>
                <option value="formula">FORMULA_PROTOCOL</option>
                <option value="ivf">IVF_MAINTENANCE</option>
            </x-cc-select>
            <x-cc-input label="Intake Volume (ML)" name="volume_ml" type="number" required placeholder="15" icon="fa-flask" />
        </div>
        <x-cc-input label="Tolerance & Notes" name="notes" placeholder="TOLERANCE_SIGNAL..." icon="fa-clipboard-check" />
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full">Commit Nutritional Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Discharge -->
<x-cc-modal id="dischargeModal" title="Neonatal Discharge Protocol" icon="fa-door-open">
    <form method="POST" id="dischargeForm" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Discharge Weight (KG)" name="discharge_weight" type="number" step="0.01" required placeholder="0.00" icon="fa-weight-scale" />
            <x-cc-select label="Discharge Vector" name="outcome" icon="fa-route">
                <option value="home">HOME_DISCHARGE</option>
                <option value="ward">WARD_TRANSFER</option>
                <option value="referral">EXTERNAL_REFERRAL</option>
                <option value="deceased">MORTALITY_SIGNAL</option>
            </x-cc-select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Authorize End Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openVitalsModal(id) {
    document.getElementById('vitalsAdmissionId').value = id;
    document.getElementById('vitalsModal').classList.remove('hidden');
}
function openFeedingModal(id) {
    document.getElementById('feedingAdmissionId').value = id;
    document.getElementById('feedingModal').classList.remove('hidden');
}
function openDischargeModal(id) {
    let url = "{{ route('specialty.critical.nicu.discharge', ':id') }}";
    document.getElementById('dischargeForm').action = url.replace(':id', id);
    document.getElementById('dischargeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

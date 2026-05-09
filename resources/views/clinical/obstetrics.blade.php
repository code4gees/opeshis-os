<x-cc-shell title='Labour Ward | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Labour Ward <span class="text-rose-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Maternal Monitoring · Partogram Intelligence · Delivery Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="rose" variant="ghost" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Admission
            </x-cc-button>
        </div>
    </div>

    <!-- Maternal Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Labour" value="{{ $census->where('status', 'admitted')->count() }}" icon="fa-person-breastfeeding" trend="Active Matrix" color="rose" />
        <x-cc-stat title="Neonatal Yield" value="Nominal" icon="fa-baby" trend="Institutional Log" color="emerald" />
        <x-cc-stat title="Clinical Intensity" value="High" icon="fa-bolt-lightning" trend="Operational" color="indigo" />
        <x-cc-stat title="Maternal Registry" value="Synced" icon="fa-tower-broadcast" trend="Institutional Log" color="slate" />
    </div>

    <!-- Maternal Census Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Live Maternal Census Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest">Critical Monitoring Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Maternal Principal Profile', 'Gravida / Parity', 'Gestational Age', 'Clinical Pulse Signal', 'Progression Matrix', 'Strategic Action']">
            @forelse($census as $c)
                @php $latest = $c->observations->last(); @endphp
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-rose-500/10 group-hover:text-rose-500 group-hover:border-rose-500/20 transition-all">
                                {{ substr($c->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $c->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[10px] font-black text-white/40 uppercase tracking-widest">G{{ $c->gravida }} · P{{ $c->parity }}</span>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="text-[11px] font-bold text-white uppercase tracking-widest">{{ $c->gestational_age_weeks }} WEEKS</div>
                    </td>
                    <td class="px-8 py-6">
                        @if($latest)
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">FHR:</span>
                                    <span class="text-[11px] font-bold {{ $latest->fetal_heart_rate < 110 || $latest->fetal_heart_rate > 160 ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }} tracking-tight">
                                        {{ $latest->fetal_heart_rate }} BPM
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">NODE:</span>
                                    <span class="text-[11px] font-bold text-white tracking-tight">{{ $latest->cervical_dilation_cm }} CM</span>
                                </div>
                            </div>
                        @else
                            <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">BASELINE_PENDING</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        @php $dil = $latest->cervical_dilation_cm ?? 0; $pct = ($dil / 10) * 100; @endphp
                        <div class="w-32">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-[8px] font-black text-white/20 uppercase tracking-widest">{{ $dil >= 10 ? 'STAGE_II' : 'STAGE_I' }}</span>
                                <span class="text-[10px] font-bold text-white/40 tracking-tighter">{{ $dil }}/10CM</span>
                            </div>
                            <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden border border-white/5 p-[1px]">
                                <div class="h-full bg-rose-500 rounded-full transition-all duration-1000 shadow-[0_0_12px_rgba(244,63,94,0.3)]" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-cc-button variant="ghost" size="sm" icon="fa-eye" color="rose" onclick="openObsModal('{{ $c->id }}')">Obs Log</x-cc-button>
                            @if($c->status !== 'delivered')
                                <x-cc-button variant="ghost" size="sm" icon="fa-baby" color="emerald" onclick="openDeliveryModal('{{ $c->id }}')">Log Delivery</x-cc-button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <i class="fas fa-person-breastfeeding text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active maternal Principals identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Authorize Admission -->
<x-cc-modal id="admitModal" title="Authorize Maternal Admission" icon="fa-plus-circle">
    <form method="POST" action="{{ route('clinical.obstetrics.admit') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-3 gap-6">
            <x-cc-input label="Gravida" name="gravida" type="number" required icon="fa-person-breastfeeding" />
            <x-cc-input label="Parity" name="parity" type="number" required icon="fa-baby-carriage" />
            <x-cc-input label="AOG (Weeks)" name="gest_weeks" type="number" required icon="fa-calendar-week" />
        </div>
        <x-cc-input label="Admission Indication" name="reason" required placeholder="ADMISSION_PROTOCOL_RATIONALE..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Admission Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Observation -->
<x-cc-modal id="obsModal" title="Log Maternal Observation" icon="fa-eye">
    <form method="POST" action="{{ route('clinical.obstetrics.log-observation') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="obsAdmissionId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="FHR Signal (BPM)" name="fhr" type="number" required icon="fa-heart-pulse" />
            <x-cc-input label="Cervical Dilation (CM)" name="dilation" type="number" step="0.5" required icon="fa-ruler-horizontal" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Contractions (10M)" name="contractions" required placeholder="e.g. 3:40" icon="fa-wave-square" />
            <x-cc-input label="Presentation" name="presentation" required placeholder="e.g. CEPHALIC" icon="fa-person-arrow-down" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Observation Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Record Delivery -->
<x-cc-modal id="deliveryModal" title="Finalize Delivery Protocol" icon="fa-baby">
    <form method="POST" action="{{ route('clinical.obstetrics.record-delivery') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="deliveryAdmissionId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Delivery Mode Matrix" name="mode" icon="fa-truck-medical">
                <option value="SVD">SVD (NORMAL)</option>
                <option value="CS">C-SECTION (EMERGENCY)</option>
                <option value="VACUUM">VACUUM EXTRACTION</option>
            </x-cc-select>
            <x-cc-input label="Baby Weight (KG)" name="baby_weight" type="number" step="0.01" required icon="fa-weight-scale" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="APGAR Score (1M)" name="apgar_1" type="number" required icon="fa-gauge-high" />
            <x-cc-input label="APGAR Score (5M)" name="apgar_5" type="number" required icon="fa-gauge-high" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Finalize Delivery Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openObsModal(id) {
    document.getElementById('obsAdmissionId').value = id;
    document.getElementById('obsModal').classList.remove('hidden');
}
function openDeliveryModal(id) {
    document.getElementById('deliveryAdmissionId').value = id;
    document.getElementById('deliveryModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

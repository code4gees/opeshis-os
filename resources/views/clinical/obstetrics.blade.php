<x-cc-shell title='Opeshis OS'>

@section('title', 'Labour Ward & Obstetrics - Opeshis OS')

<div class="space-y-8 pb-20 animate-fade-in">
    
    <!-- Institutional Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Labour Ward <span class="text-rose-500">Command</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Maternal Monitoring · Partogram Intelligence · Delivery Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="rose" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Admission
            </x-cc-button>
        </div>
    </header>

    <!-- Maternal Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Active Labour" 
            value="{{ $census->where('status', 'admitted')->count() }}" 
            icon="fa-person-breastfeeding" 
            trend="Active Matrix" 
            color="rose" 
        />
        <x-cc-stat 
            title="Neonatal Yield" 
            value="Nominal" 
            icon="fa-baby" 
            trend="Institutional Log" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Clinical Intensity" 
            value="High" 
            icon="fa-bolt-lightning" 
            trend="Operational" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Maternal Registry" 
            value="Synced" 
            icon="fa-tower-broadcast" 
            trend="Institutional Log" 
            color="slate" 
        />
    </div>

    <!-- Maternal Census Matrix -->
    <x-clinical-card title="Live Maternal Census Matrix" icon="fa-database" badge="Critical Monitoring Active">
        <x-data-table :headers="['Maternal Principal Profile', 'Gravida / Parity', 'Gestational Age', 'Clinical Pulse Signal', 'Progression Matrix', 'Strategic Action']">
            @forelse($census as $c)
                @php $latest = $c->observations->last(); @endphp
                <tr class="group hover:bg-rose-500/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4">
                        <div class="font-black text-white uppercase text-xs group-hover:text-rose-400 transition-colors italic">{{ $c->patient->full_name }}</div>
                        <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ $c->patient->medical_id }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="text-[11px] font-black text-white bg-slate-900/50 py-1 px-3 rounded-lg border border-white/5 inline-block italic tracking-widest">G{{ $c->gravida }} · P{{ $c->parity }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="text-[11px] font-black text-slate-400 uppercase italic tracking-widest">{{ $c->gestational_age_weeks }} WEEKS</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($latest)
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-[8px] font-black text-slate-600 uppercase italic">FHR:</span>
                                    <span class="text-[10px] font-black {{ $latest->fetal_heart_rate < 110 || $latest->fetal_heart_rate > 160 ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }} italic">
                                        {{ $latest->fetal_heart_rate }} BPM
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-[8px] font-black text-slate-600 uppercase italic">NODE:</span>
                                    <span class="text-[10px] font-black text-white italic">{{ $latest->cervical_dilation_cm }} CM</span>
                                </div>
                            </div>
                        @else
                            <span class="text-[9px] font-black text-slate-700 uppercase italic tracking-widest leading-none">BASELINE_PENDING</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @php $dil = $latest->cervical_dilation_cm ?? 0; $pct = ($dil / 10) * 100; @endphp
                        <div class="w-32">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-[8px] font-black text-slate-600 uppercase italic">{{ $dil >= 10 ? 'STAGE_II' : 'STAGE_I' }}</span>
                                <span class="text-[9px] font-black text-slate-300 italic">{{ $dil }}/10CM</span>
                            </div>
                            <div class="w-full bg-slate-900 h-1.5 rounded-full overflow-hidden border border-white/5">
                                <div class="h-full bg-rose-500 transition-all duration-1000 shadow-[0_0_8px_rgba(244,63,94,0.5)]" style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-eye" color="rose" onclick="openObsModal('{{ $c->id }}')">Obs Log</x-cc-button>
                            @if($c->status !== 'delivered')
                                <x-cc-button variant="ghost" size="sm" icon="fa-baby" color="emerald" onclick="openDeliveryModal('{{ $c->id }}')">Log Delivery</x-cc-button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-24 text-center">
                        <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                            <i class="fas fa-person-breastfeeding text-2xl"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active maternal Principals identified in the labour matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </x-clinical-card>
</div>

<!-- Modal: Authorize Admission -->
<x-cc-modal id="admitModal" title="Authorize Maternal Admission" icon="fa-plus-circle">
    <form method="POST" action="{{ url('/clinical/obstetrics/admit') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Institutional Patient Identity (Medical ID)</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-rose-500/50 transition-all uppercase">
        </div>
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Gravida</label>
                <input name="gravida" type="number" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Parity</label>
                <input name="parity" type="number" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">AOG (Weeks)</label>
                <input name="gest_weeks" type="number" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Admission Indication Disclosure</label>
            <textarea name="reason" required rows="3" placeholder="ADMISSION_PROTOCOL_RATIONALE..." class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-rose-500/50 transition-all uppercase"></textarea>
        </div>
        <x-cc-button type="submit" color="rose" class="w-full py-4">Authorize Admission Protocol</x-cc-button>
    </form>
</x-cc-modal>

<!-- Modal: Log Observation -->
<x-cc-modal id="obsModal" title="Log Maternal Observation" icon="fa-eye">
    <form method="POST" action="{{ url('/clinical/obstetrics/log-observation') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="obsAdmissionId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">FHR Signal (BPM)</label>
                <input name="fhr" type="number" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Cervical Dilation (CM)</label>
                <input name="dilation" type="number" step="0.5" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Contractions (10M)</label>
                <input name="contractions" required placeholder="e.g. 3:40" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Presentation</label>
                <input name="presentation" required placeholder="e.g. CEPHALIC" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none uppercase">
            </div>
        </div>
        <x-cc-button type="submit" color="rose" class="w-full py-4">Authorize Observation Intelligence</x-cc-button>
    </form>
</x-cc-modal>

<!-- Modal: Record Delivery -->
<x-cc-modal id="deliveryModal" title="Finalize Delivery Protocol" icon="fa-baby">
    <form method="POST" action="{{ url('/clinical/obstetrics/record-delivery') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="admission_id" id="deliveryAdmissionId">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Delivery Mode Matrix</label>
                <select name="mode" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none">
                    <option value="SVD">SVD (NORMAL)</option>
                    <option value="CS">C-SECTION (EMERGENCY)</option>
                    <option value="VACUUM">VACUUM EXTRACTION</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Baby Weight (KG)</label>
                <input name="baby_weight" type="number" step="0.01" required placeholder="0.00" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">APGAR Score (1M)</label>
                <input name="apgar_1" type="number" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">APGAR Score (5M)</label>
                <input name="apgar_5" type="number" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
        </div>
        <x-cc-button type="submit" color="emerald" class="w-full py-4">Finalize Delivery Intelligence</x-cc-button>
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

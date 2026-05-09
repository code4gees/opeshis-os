<x-cc-shell title='Psychiatry Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Psychiatry <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Mental Health · Risk Stratification · Behavioral Health Intelligence</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Authorize Enrollment
            </x-cc-button>
        </div>
    </div>

    <!-- Behavioral Health Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Census" value="{{ $patients->count() }}" icon="fa-users-rays" trend="Institutional Log" color="indigo" />
        <x-cc-stat title="High Risk Nodes" value="{{ $patients->where('risk_level', 'high')->count() }}" icon="fa-triangle-exclamation" trend="Critical Surveillance" color="rose" />
        <x-cc-stat title="Inpatient Status" value="{{ $patients->where('status', 'inpatient')->count() }}" icon="fa-bed-pulse" trend="Institutional Care" color="emerald" />
        <x-cc-stat title="Registry Pulse" value="Synced" icon="fa-tower-broadcast" trend="Institutional Log" color="slate" />
    </div>

    <!-- Behavioral Health Registry Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Behavioral Health Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Surveillance Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Clinical Principal Profile', 'Provisional Status', 'Risk Vector', 'MSE Intelligence', 'Strategic Action']">
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
                            $statusMap = [
                                'inpatient' => ['cls' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20', 'label' => 'INPATIENT'],
                                'outpatient' => ['cls' => 'bg-white/5 text-white/40 border-white/10', 'label' => 'OUTPATIENT']
                            ];
                            $s = $statusMap[$p->status] ?? $statusMap['outpatient'];
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $s['cls'] }} text-[9px] font-black uppercase tracking-widest">
                            {{ $s['label'] }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $riskMap = [
                                'high' => ['cls' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse', 'label' => 'CRITICAL_RISK'],
                                'medium' => ['cls' => 'bg-amber-500/10 text-amber-500 border-amber-500/20', 'label' => 'MEDIUM_RISK'],
                                'low' => ['cls' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20', 'label' => 'LOW_RISK']
                            ];
                            $r = $riskMap[$p->risk_level] ?? ['cls' => 'bg-white/5 text-white/10 border-white/10', 'label' => 'NOT_ASSESSED'];
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $r['cls'] }} text-[9px] font-black uppercase tracking-widest">
                            {{ $r['label'] }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight">
                            {{ $p->latest_mse ? \Carbon\Carbon::parse($p->latest_mse->created_at)->diffForHumans() : 'SIGNAL_MISSING' }}
                        </div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Last Evaluation</div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-brain" color="indigo" onclick="openMSEModal('{{ $p->id }}')">MSE Log</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-shield-halved" color="rose" onclick="openRiskModal('{{ $p->id }}')">Risk Matrix</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-brain text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active behavioral health principals identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Authorize Enrollment -->
<x-cc-modal id="regModal" title="Authorize Behavioral Enrollment" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/psych/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Referral Origin Source" name="source" required placeholder="REFERRAL_SOURCE_NODE" icon="fa-building-ngo" />
        <x-cc-input label="Clinical Presentation" name="complaint" required placeholder="PRESENTING_PICTURE_DISCLOSURE..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Enrollment Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openMSEModal(id) {
    document.getElementById('msePatientId').value = id;
    document.getElementById('mseModal').classList.remove('hidden');
}
function openRiskModal(id) {
    document.getElementById('riskPatientId').value = id;
    document.getElementById('riskModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Psychiatry & Behavioral Health - Opeshis OS')

<div class="space-y-8 pb-20 animate-fade-in">
 
 <!-- Institutional Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Psychiatry <span class="text-sage">Command</span></h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Mental Health · Risk Stratification · Behavioral Health Intelligence</p>
 </div>
 <div class="flex gap-4">
 <x-cc-button icon="fa-user-plus" color="indigo" onclick="document.getElementById('regModal').classList.remove('hidden')">
 Authorize Enrollment
 </x-cc-button>
 </div>
 </header>

 <!-- Behavioral Health Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active Census" 
 value="{{ $patients->count() }}" 
 icon="fa-users-rays" 
 trend="Institutional Log" 
 color="indigo" 
 />
 <x-cc-stat 
 title="High Risk Nodes" 
 value="{{ $patients->where('risk_level', 'high')->count() }}" 
 icon="fa-triangle-exclamation" 
 trend="Critical Surveillance" 
 color="rose" 
 />
 <x-cc-stat 
 title="Inpatient Status" 
 value="{{ $patients->where('status', 'inpatient')->count() }}" 
 icon="fa-bed-pulse" 
 trend="Institutional Care" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Registry Pulse" 
 value="Synced" 
 icon="fa-tower-broadcast" 
 trend="Institutional Log" 
 color="slate" 
 />
 </div>

 <!-- Behavioral Health Registry Matrix -->
 <x-clinical-card title="Institutional Behavioral Health Matrix" icon="fa-database" badge="Live Surveillance">
 <x-data-table :headers="['Clinical Principal Profile', 'Provisional Status', 'Risk Vector', 'MSE Intelligence', 'Strategic Action']">
 @forelse($patients as $p)
 <tr class="group hover:bg-sage/[0.02] transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4">
 <div class="font-semibold text-white uppercase text-xs group-hover:text-sage transition-colors">{{ $p->patient->full_name }}</div>
 <div class="text-[12px] text-slate-500 mt-1 uppercase">{{ $p->patient->medical_id }}</div>
 </td>
 <td class="px-6 py-4">
 <x-status-badge :status="$p->status === 'inpatient' ? 'clinical care' : 'completed'" />
 <div class="text-[8px] font-semibold text-slate-500 uppercase mt-1 tracking-wider">{{ strtoupper($p->status ?: 'OUTPATIENT') }}</div>
 </td>
 <td class="px-6 py-4">
 @php
 $risk = match($p->risk_level) {
 'high' => 'critical',
 'medium' => 'pending',
 'low' => 'completed',
 default => 'pending'
 };
 @endphp
 <x-status-badge :status="$risk" />
 <div class="text-[8px] font-semibold text-slate-500 uppercase mt-1 tracking-wider">{{ strtoupper($p->risk_level ?: 'NOT_ASSESSED') }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-[12px] font-semibold text-slate-400 uppercase tracking-wider">{{ $p->latest_mse ? \Carbon\Carbon::parse($p->latest_mse->created_at)->diffForHumans() : 'SIGNAL_MISSING' }}</div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Last Evaluation</div>
 </td>
 <td class="px-6 py-4 text-right">
 <div class="flex justify-end gap-2">
 <x-cc-button variant="ghost" size="sm" icon="fa-brain" color="indigo" onclick="openMSEModal('{{ $p->id }}')">MSE Log</x-cc-button>
 <x-cc-button variant="ghost" size="sm" icon="fa-shield-halved" color="rose" onclick="openRiskModal('{{ $p->id }}')">Risk Matrix</x-cc-button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <i class="fas fa-brain text-2xl"></i>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No active behavioral health principals identified in the matrix.</p>
 </td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>
</div>

<!-- Modal: Authorize Enrollment -->
<x-cc-modal id="regModal" title="Authorize Behavioral Enrollment" icon="fa-user-plus">
 <form method="POST" action="{{ url('/clinical/psych/register') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Institutional Patient Identity (Medical ID)</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Referral Origin Source</label>
 <input name="source" required placeholder="REFERRAL_SOURCE_NODE" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Clinical Presentation Disclosure</label>
 <textarea name="complaint" required rows="3" placeholder="PRESENTING_PICTURE_DISCLOSURE..." class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase"></textarea>
 </div>
 <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Enrollment Protocol</x-cc-button>
 </form>
</x-cc-modal>

<!-- Additional Modals (MSE, Risk) should follow the same pattern -->

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

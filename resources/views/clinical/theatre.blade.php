<x-cc-shell title='Opeshis OS'>

@section('title', 'Theatre Command - Opeshis OS')


<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-indigo-500 uppercase tracking-tighter">Theatre Command Hub</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Institutional Perioperative Control Plane · Surgical Intelligence Matrix · OT Operational Hub</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-calendar-plus" color="indigo" onclick="document.getElementById('scheduleModal').classList.remove('hidden')">
                Schedule Procedure
            </x-cc-button>
        </div>
    </div>

    <!-- Theatre Telemetry KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            label="Today's Cases" 
            value="{{ $stats['today'] }}" 
            icon="fa-hospital-user" 
            trend="Scheduled" 
            color="indigo" 
        />
        <x-cc-stat 
            label="In Progress" 
            value="{{ $stats['in_progress'] }}" 
            icon="fa-scalpel" 
            trend="Active Procedures" 
            color="rose" 
        />
        <x-cc-stat 
            label="Pending Pre-op" 
            value="{{ $stats['pending_preop'] }}" 
            icon="fa-clipboard-check" 
            trend="Clinical Assessment" 
            color="amber" 
        />
        <x-cc-stat 
            label="Theatre Latency" 
            value="Low" 
            icon="fa-clock-rotate-left" 
            trend="Operational" 
            color="emerald" 
        />
    </div>

    <!-- Theatre Intelligence Sidebar Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-slate-900/40 border border-emerald-500/20 rounded-[2rem] flex items-center gap-6 group hover:border-emerald-500/40 transition-all">
            <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 border border-emerald-500/20 shadow-lg shadow-emerald-500/5">
                <i class="fa-solid fa-circle-check text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-black text-slate-500 uppercase tracking-widest italic">CSSD Sterilization</p>
                <p class="text-xl font-black text-white italic leading-none mt-1 uppercase">Ready Active</p>
                <p class="text-[9px] font-bold text-slate-600 uppercase tracking-widest mt-2">Cycle 04 Authorization</p>
            </div>
        </div>

        <div class="p-6 bg-slate-900/40 border border-rose-500/20 rounded-[2rem] flex items-center gap-6 group hover:border-rose-500/40 transition-all">
            <div class="w-14 h-14 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-500 border border-rose-500/20 shadow-lg shadow-rose-500/5 animate-pulse">
                <i class="fa-solid fa-droplet text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-black text-slate-500 uppercase tracking-widest italic">Blood Bank (O+)</p>
                <p class="text-xl font-black text-rose-500 italic leading-none mt-1 uppercase">12 Units</p>
                <p class="text-[9px] font-bold text-slate-600 uppercase tracking-widest mt-2 italic">Stable Supply Matrix</p>
            </div>
        </div>

        <div class="p-6 bg-slate-900/40 border border-indigo-500/20 rounded-[2rem] flex items-center gap-6 group hover:border-indigo-500/40 transition-all">
            <div class="w-14 h-14 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500 border border-indigo-500/20 shadow-lg shadow-indigo-500/5">
                <i class="fa-solid fa-gauge-high text-2xl"></i>
            </div>
            <div>
                <p class="text-xs font-black text-slate-500 uppercase tracking-widest italic">Central Oxygen</p>
                <p class="text-xl font-black text-white italic leading-none mt-1 uppercase">98.4% PSI</p>
                <p class="text-[9px] font-bold text-slate-600 uppercase tracking-widest mt-2 italic">Institutional PSI Nominal</p>
            </div>
        </div>
    </div>

    <!-- Operative Manifest Matrix -->
    <x-cc-card title="Live Operative Manifest Matrix" icon="fa-database">
        <x-slot name="action">
            <span class="px-2 py-0.5 bg-indigo-500/10 text-indigo-500 border border-indigo-500/20 rounded text-[9px] font-black uppercase tracking-widest">Global Manifest Sync</span>
        </x-slot>

        <x-cc-table :headers="['Patient Profile', 'Procedure Nomenclature', 'Surgical Team', 'Temporal Matrix', 'Status Matrix', 'Strategic Action']">
            @forelse($list as $case)
                <tr class="group hover:bg-indigo-500/[0.02] transition-colors">
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="flex items-center">
                            <div class="h-9 w-9 flex-shrink-0 rounded-full bg-indigo-500/10 flex items-center justify-center border border-indigo-500/20 text-indigo-500 font-bold text-xs uppercase">
                                {{ substr($case->patient->full_name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-indigo-400 transition-colors italic">{{ $case->patient->full_name }}</div>
                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $case->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <div class="text-[11px] font-black text-slate-300 uppercase tracking-tight truncate max-w-xs italic leading-tight">"{{ $case->procedure_name }}"</div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-center">
                        <div class="flex justify-center -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-[9px] font-black text-indigo-400 italic shadow-lg" title="Surgeon Matrix">S</div>
                            <div class="w-8 h-8 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-[9px] font-black text-rose-400 italic shadow-lg" title="Anaesthetist Matrix">A</div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="text-[11px] font-black text-slate-200 italic tracking-tight">{{ \Carbon\Carbon::parse($case->scheduled_date)->format('H:i') }}</div>
                        <div class="text-[9px] font-black text-slate-600 uppercase mt-1 italic">{{ \Carbon\Carbon::parse($case->scheduled_date)->format('d M Y') }}</div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-center">
                        @php
                            $statusClasses = [
                                'scheduled' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20',
                                'in_progress' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse shadow-lg shadow-rose-500/10',
                                'recovery' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                'completed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                            ];
                            $cls = $statusClasses[$case->status] ?? 'bg-slate-900/50 text-slate-700 border-slate-700/60';
                        @endphp
                        <span class="px-3 py-1 rounded-lg border {{ $cls }} text-[8px] font-black uppercase tracking-widest italic">
                            {{ str_replace('_', ' ', $case->status) }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            @if($case->status === 'scheduled')
                                <x-cc-button variant="ghost" size="sm" icon="fa-clipboard-list" color="indigo" onclick="openPreopModal('{{ $case->id }}')">Pre-op</x-cc-button>
                                <x-cc-button variant="ghost" size="sm" icon="fa-shield-halved" color="emerald" onclick="openWhoModal('{{ $case->id }}')">WHO</x-cc-button>
                            @elseif($case->status === 'in_progress')
                                <x-cc-button variant="ghost" size="sm" icon="fa-notes-medical" color="rose" onclick="openIntraopModal('{{ $case->id }}')">Intra-op</x-cc-button>
                            @elseif($case->status === 'recovery')
                                <x-cc-button variant="ghost" size="sm" icon="fa-bed-pulse" color="amber" onclick="openRecoveryModal('{{ $case->id }}')">Recovery</x-cc-button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-600 italic text-sm">No surgical cases identified in the scheduled matrix.</td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Surgical Schedule -->
<x-cc-modal id="scheduleModal" title="Authorize Surgical Case" icon="fa-calendar-plus">
    <form action="#" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Patient ID (Medical ID)</label>
                <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
            </div>
            <div class="col-span-2">
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Procedure Nomenclature Matrix</label>
                <input name="procedure_name" required placeholder="Enter Procedure Nomenclature" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Scheduled Date Node</label>
                <input name="date" type="date" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Temporal Node (Time)</label>
                <input name="time" type="time" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Authorize Schedule Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Placeholders for other modals -->
<x-cc-modal id="preopModal" title="Authorize Pre-operative Protocol" icon="fa-clipboard-list">
    <!-- Pre-op Assessment Form -->
</x-cc-modal>

<x-cc-modal id="whoModal" title="WHO Surgical Safety Protocol" icon="fa-shield-halved">
    <!-- WHO Checklist Form -->
</x-cc-modal>

<x-cc-modal id="intraopModal" title="Intra-operative Procedure Matrix" icon="fa-notes-medical">
    <!-- Intra-op Record Form -->
</x-cc-modal>

<x-cc-modal id="recoveryModal" title="Recovery Surveillance Protocol" icon="fa-bed-pulse">
    <!-- Recovery Record Form -->
</x-cc-modal>

<script>
function openPreopModal(id) {
    document.getElementById('preopModal').classList.remove('hidden');
}
function openWhoModal(id) {
    document.getElementById('whoModal').classList.remove('hidden');
}
function openIntraopModal(id) {
    document.getElementById('intraopModal').classList.remove('hidden');
}
function openRecoveryModal(id) {
    document.getElementById('recoveryModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

<x-cc-shell title='Theatre Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Theatre <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Perioperative Control Plane · Surgical Intelligence Matrix · OT Operational Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-calendar-plus" color="indigo" variant="ghost" onclick="document.getElementById('scheduleModal').classList.remove('hidden')">
                Schedule Procedure
            </x-cc-button>
        </div>
    </div>

    <!-- Theatre Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Today's Cases" value="{{ $stats['today'] }}" icon="fa-hospital-user" trend="Scheduled" color="indigo" />
        <x-cc-stat title="In Progress" value="{{ $stats['in_progress'] }}" icon="fa-scalpel" trend="Active Procedures" color="rose" />
        <x-cc-stat title="Pending Pre-op" value="{{ $stats['pending_preop'] }}" icon="fa-clipboard-check" trend="Clinical Assessment" color="amber" />
        <x-cc-stat title="Theatre Latency" value="Low" icon="fa-clock-rotate-left" trend="Operational" color="emerald" />
    </div>

    <!-- Theatre Intelligence Sidebar Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="p-8 bg-white/[0.02] border border-white/[0.04] rounded-[2.5rem] flex items-center gap-6 group hover:border-emerald-500/20 transition-all duration-500">
            <div class="w-16 h-16 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 border border-emerald-500/20 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-circle-check text-2xl"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-white/20 uppercase tracking-widest">CSSD Sterilization</p>
                <p class="text-xl font-bold text-white leading-none mt-1 uppercase tracking-tight">Ready Active</p>
                <p class="text-[9px] font-black text-emerald-500/40 uppercase tracking-widest mt-2">Cycle 04 Authorization</p>
            </div>
        </div>

        <div class="p-8 bg-white/[0.02] border border-white/[0.04] rounded-[2.5rem] flex items-center gap-6 group hover:border-rose-500/20 transition-all duration-500">
            <div class="w-16 h-16 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-500 border border-rose-500/20 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-droplet text-2xl animate-pulse"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-white/20 uppercase tracking-widest">Blood Bank (O+)</p>
                <p class="text-xl font-bold text-rose-500 leading-none mt-1 uppercase tracking-tight">12 Units</p>
                <p class="text-[9px] font-black text-rose-500/40 uppercase tracking-widest mt-2">Stable Supply Matrix</p>
            </div>
        </div>

        <div class="p-8 bg-white/[0.02] border border-white/[0.04] rounded-[2.5rem] flex items-center gap-6 group hover:border-indigo-500/20 transition-all duration-500">
            <div class="w-16 h-16 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 border border-indigo-500/20 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-gauge-high text-2xl"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-white/20 uppercase tracking-widest">Central Oxygen</p>
                <p class="text-xl font-bold text-white leading-none mt-1 uppercase tracking-tight">98.4% PSI</p>
                <p class="text-[9px] font-black text-indigo-500/40 uppercase tracking-widest mt-2">Institutional PSI Nominal</p>
            </div>
        </div>
    </div>

    <!-- Operative Manifest Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Live Operative Manifest Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">Global Manifest Sync Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Profile', 'Procedure Nomenclature', 'Surgical Team', 'Temporal Matrix', 'Status Matrix', 'Strategic Action']">
            @forelse($list as $case)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($case->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $case->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $case->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight truncate max-w-xs leading-tight">"{{ $case->procedure_name }}"</div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex justify-center -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-[9px] font-black text-indigo-400 uppercase" title="Surgeon Matrix">S</div>
                            <div class="w-8 h-8 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-[9px] font-black text-rose-400 uppercase" title="Anaesthetist Matrix">A</div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight">{{ \Carbon\Carbon::parse($case->scheduled_date)->format('H:i') }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($case->scheduled_date)->format('d M Y') }}</div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        @php
                            $statusClasses = [
                                'scheduled' => 'bg-white/5 text-white/40 border-white/10',
                                'in_progress' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse',
                                'recovery' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                'completed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                            ];
                            $cls = $statusClasses[$case->status] ?? 'bg-white/5 text-white/20 border-white/5';
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $cls }} text-[9px] font-black uppercase tracking-widest">
                            {{ str_replace('_', ' ', $case->status) }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
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
                    <td colspan="6" class="px-8 py-20 text-center">
                        <i class="fas fa-scalpel text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No surgical cases in the scheduled matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Surgical Schedule -->
<x-cc-modal id="scheduleModal" title="Authorize Surgical Case" icon="fa-calendar-plus">
    <form action="#" method="POST" class="space-y-6">
        @csrf
        <x-cc-input label="Patient ID" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Procedure Nomenclature Matrix" name="procedure_name" required placeholder="Enter Procedure Nomenclature" icon="fa-file-medical" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Scheduled Date Node" name="date" type="date" required icon="fa-calendar-day" />
            <x-cc-input label="Temporal Node (Time)" name="time" type="time" required icon="fa-clock" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Schedule Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Assessment Modals -->
<x-cc-modal id="preopModal" title="Authorize Pre-operative Protocol" icon="fa-clipboard-list">
    <form class="space-y-6">
        <x-cc-input label="Baseline Physiological Stability" placeholder="ASSESSMENT_DATA_STREAM..." icon="fa-heart-pulse" />
        <x-cc-input label="Pre-operative Medication Node" placeholder="PRE_MEDS_AUTHORIZED..." icon="fa-pills" />
        <x-cc-button type="submit" color="indigo" class="w-full">Commit Pre-op Data</x-cc-button>
    </form>
</x-cc-modal>

<x-cc-modal id="whoModal" title="WHO Surgical Safety Protocol" icon="fa-shield-halved">
    <div class="space-y-6">
        @foreach(['Sign In: Before Induction', 'Time Out: Before Incision', 'Sign Out: Before Leaving'] as $step)
            <div class="p-6 bg-white/[0.02] border border-white/[0.04] rounded-2xl group cursor-pointer hover:border-emerald-500/20 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold text-white uppercase tracking-widest">{{ $step }}</span>
                    <div class="w-5 h-5 rounded-lg border border-white/10 bg-white/5 flex items-center justify-center text-[10px] text-sage">
                        <i class="fas fa-check opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </div>
                </div>
            </div>
        @endforeach
        <x-cc-button color="emerald" class="w-full">Finalize WHO Protocol</x-cc-button>
    </div>
</x-cc-modal>

<script>
function openPreopModal(id) { document.getElementById('preopModal').classList.remove('hidden'); }
function openWhoModal(id) { document.getElementById('whoModal').classList.remove('hidden'); }
function openIntraopModal(id) { document.getElementById('intraopModal').classList.remove('hidden'); }
function openRecoveryModal(id) { document.getElementById('recoveryModal').classList.remove('hidden'); }
</script>
</x-cc-shell>

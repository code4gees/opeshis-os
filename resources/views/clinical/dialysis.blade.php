<x-cc-shell title='Opeshis OS'>

@section('title', 'Dialysis Command - Opeshis OS')

<div class="space-y-8 pb-20 animate-fade-in">
    
    <!-- Institutional Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Renal <span class="text-indigo-500">Command</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Hemodialysis Surveillance · Fleet Monitoring · Renal Care Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" onclick="document.getElementById('registerModal').classList.remove('hidden')">
                Enroll Patient
            </x-cc-button>
            <x-cc-button icon="fa-play-circle" color="emerald" onclick="document.getElementById('sessionModal').classList.remove('hidden')">
                Initiate Session
            </x-cc-button>
        </div>
    </header>

    <!-- Renal Telemetry KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Active Census" 
            value="{{ $patients->count() }}" 
            icon="fa-user-nurse" 
            trend="Enrolled Program" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Sessions Today" 
            value="{{ $todaySessions->count() }}" 
            icon="fa-calendar-check" 
            trend="Throughput" 
            color="emerald" 
        />
        <x-cc-stat 
            title="In Operation" 
            value="{{ $machines->where('status', 'in_use')->count() }}" 
            icon="fa-microchip" 
            trend="Active Fleet" 
            color="rose" 
        />
        <x-cc-stat 
            title="Available" 
            value="{{ $machines->where('status', 'available')->count() }}" 
            icon="fa-check-circle" 
            trend="Idle Units" 
            color="amber" 
        />
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
        <!-- Renal Program Matrix -->
        <div class="xl:col-span-8">
            <x-clinical-card title="Active Renal Surveillance Matrix" icon="fa-dna" badge="Live Surveillance">
                <x-data-table :headers="['Patient Protocol', 'Access / Dry Weight', 'Tx Frequency', 'Status Signal', 'Strategic Actions']">
                    @forelse($patients as $p)
                        <tr class="group hover:bg-indigo-500/[0.02] transition-colors border-b border-white/5 last:border-0">
                            <td class="px-6 py-4">
                                <div class="font-black text-white uppercase text-xs group-hover:text-indigo-400 transition-colors italic">{{ $p->patient->full_name }}</div>
                                <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ $p->patient->medical_id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-[11px] font-black text-indigo-400 uppercase tracking-tight italic">{{ $p->access_type }}</div>
                                <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">Target: {{ $p->dry_weight }} KG</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-[10px] font-black text-slate-400 uppercase italic tracking-tight truncate max-w-[150px]">"{{ $p->diagnosis }}"</div>
                                <div class="text-[8px] font-black text-slate-600 uppercase tracking-widest mt-1">{{ $p->frequency }} / WEEK</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($p->activeSession)
                                    <x-status-badge status="pending" />
                                    <span class="text-[8px] font-black text-rose-500 uppercase ml-2 animate-pulse">IN_SESSION</span>
                                @else
                                    <x-status-badge status="completed" />
                                    <span class="text-[8px] font-black text-slate-600 uppercase ml-2">CLEARED</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($p->activeSession)
                                        <x-cc-button variant="ghost" size="sm" icon="fa-stop-circle" color="rose" onclick="openEndSessionModal('{{ $p->activeSession->id }}')">End</x-cc-button>
                                        <x-cc-button variant="ghost" size="sm" icon="fa-heart-pulse" color="amber" onclick="openVitalsModal('{{ $p->activeSession->id }}')">Vitals</x-cc-button>
                                    @else
                                        <x-cc-button variant="ghost" size="sm" icon="fa-microscope" color="indigo" onclick="openLabModal('{{ $p->id }}')">Labs</x-cc-button>
                                        <x-cc-button variant="ghost" size="sm" icon="fa-droplet" color="blue" onclick="openPdModal('{{ $p->id }}')">PD</x-cc-button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-24 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                    <i class="fas fa-user-nurse text-2xl"></i>
                                </div>
                                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">Renal program census is currently baseline (empty).</p>
                            </td>
                        </tr>
                    @endforelse
                </x-data-table>
            </x-clinical-card>
        </div>

        <!-- Fleet Telemetry Panel -->
        <div class="xl:col-span-4">
            <x-clinical-card title="Machine Fleet Status" icon="fa-microchip" badge="Hardware Status">
                <div class="space-y-4">
                    @forelse($machines as $m)
                        <div class="flex justify-between items-center p-5 bg-slate-900/40 border border-white/5 rounded-2xl hover:border-indigo-500/30 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $m->status === 'in_use' ? 'bg-rose-500/10 text-rose-500' : 'bg-emerald-500/10 text-emerald-500' }} border border-white/5 font-black shadow-lg">
                                    <i class="fas fa-plug text-xs"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-black text-white uppercase group-hover:text-indigo-400 transition-colors italic tracking-tight">{{ $m->name }}</div>
                                    <div class="text-[8px] font-bold text-slate-600 uppercase mt-1 tracking-widest">{{ $m->model }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <x-status-badge :status="$m->status === 'in_use' ? 'critical' : 'completed'" />
                                <div class="text-[8px] font-black uppercase tracking-widest mt-1 {{ $m->status === 'in_use' ? 'text-rose-500' : 'text-slate-500' }}">
                                    {{ str_replace('_', ' ', $m->status) }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-slate-600 italic text-[10px] uppercase tracking-widest">Fleet registry empty.</div>
                    @endforelse
                </div>
            </x-clinical-card>
        </div>
    </div>
</div>

<!-- Modal: Enrollment -->
<x-cc-modal id="registerModal" title="Renal Program Enrollment" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/dialysis/register') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Institutional Patient Identity (Medical ID)</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Access Protocol</label>
                <select name="access_type" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
                    <option value="AV Fistula">AV FISTULA</option>
                    <option value="AV Graft">AV GRAFT</option>
                    <option value="CVC">CVC CATHETER</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Dry Weight (KG)</label>
                <input name="dry_weight" type="number" step="0.1" required placeholder="0.0" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Frequency</label>
                <select name="frequency" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
                    <option value="Twice a week">TWICE A WEEK</option>
                    <option value="Thrice a week">THRICE A WEEK</option>
                    <option value="Daily">DAILY</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Renal Diagnosis Matrix</label>
                <input name="diagnosis" required placeholder="ESRD, AKI..." class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none uppercase">
            </div>
        </div>
        <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Enrollment Protocol</x-cc-button>
    </form>
</x-cc-modal>

<!-- Additional Modals follow the same high-density pattern -->

<script>
function openVitalsModal(id) {
    document.getElementById('vitalsSessionId').value = id;
    document.getElementById('vitalsModal').classList.remove('hidden');
}
function openEndSessionModal(id) {
    document.getElementById('endSessionForm').action = "{{ url('/clinical/dialysis/session/complete') }}/" + id;
    document.getElementById('endSessionModal').classList.remove('hidden');
}
function openLabModal(id) {
    document.getElementById('labPatientId').value = id;
    document.getElementById('labModal').classList.remove('hidden');
}
function openPdModal(id) {
    document.getElementById('pdPatientId').value = id;
    document.getElementById('pdModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

<x-cc-shell title='Dialysis Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Renal <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Hemodialysis Surveillance · Fleet Monitoring · Renal Care Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="indigo" variant="ghost" onclick="document.getElementById('registerModal').classList.remove('hidden')">
                Enroll Patient
            </x-cc-button>
            <x-cc-button icon="fa-play-circle" color="emerald" variant="ghost" onclick="document.getElementById('sessionModal').classList.remove('hidden')">
                Initiate Session
            </x-cc-button>
        </div>
    </div>

    <!-- Renal Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Census" value="{{ $patients->count() }}" icon="fa-user-nurse" trend="Enrolled Program" color="indigo" />
        <x-cc-stat title="Sessions Today" value="{{ $todaySessions->count() }}" icon="fa-calendar-check" trend="Throughput" color="emerald" />
        <x-cc-stat title="In Operation" value="{{ $machines->where('status', 'in_use')->count() }}" icon="fa-microchip" trend="Active Fleet" color="rose" />
        <x-cc-stat title="Available" value="{{ $machines->where('status', 'available')->count() }}" icon="fa-check-circle" trend="Idle Units" color="amber" />
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
        <!-- Renal Program Matrix -->
        <div class="xl:col-span-8">
            <x-cc-card class="overflow-hidden">
                <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Active Renal Surveillance Matrix</h3>
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                        <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Surveillance Active</span>
                    </div>
                </div>

                <x-cc-table :headers="['Patient Protocol', 'Access / Dry Weight', 'Tx Frequency', 'Status Signal', 'Strategic Actions']">
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
                                <div class="text-[11px] font-bold text-sage uppercase tracking-tight">{{ $p->access_type }}</div>
                                <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Target: {{ $p->dry_weight }} KG</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight truncate max-w-[150px]">"{{ $p->diagnosis }}"</div>
                                <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ $p->frequency }} / WEEK</div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if($p->activeSession)
                                    <span class="px-3 py-1.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest animate-pulse">
                                        IN_SESSION
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest">
                                        CLEARED
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3">
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
                            <td colspan="5" class="px-8 py-20 text-center">
                                <i class="fas fa-user-nurse text-white/5 text-2xl mb-4"></i>
                                <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Renal program census is empty.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Fleet Telemetry Panel -->
        <div class="xl:col-span-4">
            <x-cc-card class="overflow-hidden h-full">
                <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Machine Fleet Status</h3>
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                </div>

                <div class="p-6 space-y-4">
                    @forelse($machines as $m)
                        <div class="flex justify-between items-center p-4 bg-white/[0.02] border border-white/[0.04] rounded-2xl hover:border-indigo-500/30 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center {{ $m->status === 'in_use' ? 'bg-rose-500/10 text-rose-500' : 'bg-emerald-500/10 text-emerald-500' }} border border-white/5 font-semibold">
                                    <i class="fas fa-plug text-[10px]"></i>
                                </div>
                                <div>
                                    <div class="text-[12px] font-bold text-white uppercase group-hover:text-indigo-400 transition-colors tracking-tight">{{ $m->name }}</div>
                                    <div class="text-[9px] font-black text-white/10 uppercase mt-1 tracking-widest">{{ $m->model }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="px-2 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest {{ $m->status === 'in_use' ? 'bg-rose-500/10 text-rose-500' : 'bg-emerald-500/10 text-emerald-500' }}">
                                    {{ str_replace('_', ' ', $m->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Fleet registry empty.</p>
                        </div>
                    @endforelse
                </div>
            </x-cc-card>
        </div>
    </div>
</div>

<!-- Modal: Enrollment -->
<x-cc-modal id="registerModal" title="Renal Program Enrollment" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/dialysis/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Access Protocol" name="access_type" icon="fa-link">
                <option value="AV Fistula">AV FISTULA</option>
                <option value="AV Graft">AV GRAFT</option>
                <option value="CVC">CVC CATHETER</option>
            </x-cc-select>
            <x-cc-input label="Dry Weight (KG)" name="dry_weight" type="number" step="0.1" required placeholder="0.0" icon="fa-weight-scale" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Frequency" name="frequency" icon="fa-calendar-days">
                <option value="Twice a week">TWICE A WEEK</option>
                <option value="Thrice a week">THRICE A WEEK</option>
                <option value="Daily">DAILY</option>
            </x-cc-select>
            <x-cc-input label="Renal Diagnosis Matrix" name="diagnosis" required placeholder="ESRD, AKI..." icon="fa-file-medical" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Enrollment Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

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

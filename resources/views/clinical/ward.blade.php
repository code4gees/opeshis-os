<x-cc-shell title='Opeshis OS'>

@section('title', 'Inpatient Ward Management — Opeshis OS')


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Nursing & Ward Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Ward Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Bed Management · Inpatient Admissions · Nursing Census Hub</p>
        </div>
        <div class="flex gap-6">
            <div class="flex items-center gap-8 px-10 py-4 glass-panel rounded-[2rem] border border-white/10 bg-white/[0.02]">
                <div class="text-center">
                    <p class="text-[9px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-2 italic">Occupancy Rate</p>
                    <p class="text-3xl font-black text-white italic tracking-tighter leading-none">{{ $occupancyRate }}%</p>
                </div>
                <div class="w-px h-10 bg-white/10 shadow-sm"></div>
                <div class="text-center">
                    <p class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 italic">Total Admissions</p>
                    <p class="text-3xl font-black text-white italic tracking-tighter leading-none">{{ $admissions->count() }}</p>
                </div>
            </div>
            <button onclick="document.getElementById('admitModal').classList.remove('hidden')" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Authorize Admission
            </button>
        </div>
    </header>

    @if(session('success'))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            Ward protocol synchronized successfully.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Live Ward Status Cards -->
        <div class="lg:col-span-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($wards as $w)
            <div class="glass-panel p-10 rounded-[3rem] border border-white/10 shadow-2xl bg-white/[0.02] group hover:border-indigo-500/50 transition-all duration-500 relative overflow-hidden">
                <div class="flex justify-between items-start mb-8">
                    <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-indigo-400 border border-white/10 shadow-inner group-hover:border-indigo-500/30 transition-all">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12H3m18 0v8m0-8V4a2 2 0 0 0-2 2H5a2 2 0 0 0-2 2v8m0 0v8m18 0H3m18 0h2M3 20H1"/></svg>
                    </div>
                    <span class="px-3 py-1 bg-white/5 text-slate-500 border border-white/10 rounded-lg text-[8px] font-black uppercase tracking-widest italic">
                        {{ $w->type ?: 'GENERAL_PROTOCOL' }}
                    </span>
                </div>
                <h4 class="text-xl font-black text-white uppercase mb-6 italic tracking-tighter">{{ $w->name }}</h4>
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">Available Beds</span>
                        <span class="text-lg font-black text-emerald-500 italic">{{ $w->available }}</span>
                    </div>
                    @php $rate = $w->total > 0 ? ($w->occupied / $w->total) * 100 : 0; @endphp
                    <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden shadow-inner border border-white/5">
                        <div class="h-full bg-indigo-500 rounded-full shadow-lg shadow-indigo-500/20 transition-all duration-1000" style="width: {{ $rate }}%"></div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">Occupancy Matrix</span>
                        <span class="text-xs font-black text-white italic tracking-widest">{{ round($rate) }}%</span>
                    </div>
                </div>
                <!-- Decorative background -->
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            @endforeach
        </div>

        <!-- Inpatient Census Matrix -->
        <div class="lg:col-span-12 glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden bg-white/[0.02]">
            <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
                <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Institutional Inpatient Census Matrix</h3>
                <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic">Inpatient Surveillance: Active</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-10 py-6">Patient Protocol Identity</th>
                            <th class="px-6 py-6">Ward / Bed Matrix</th>
                            <th class="px-6 py-6">Clinical Intelligence Matrix</th>
                            <th class="px-6 py-6 text-center">Admission Matrix</th>
                            <th class="px-10 py-6 text-right">Strategic Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($admissions as $a)
                        <tr class="hover:bg-white/5 transition-all group">
                            <td class="px-10 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center font-black text-indigo-400 text-[11px] border border-white/10 shadow-inner group-hover:border-indigo-500/30 transition-all">
                                        {{ substr($a->full_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-white text-base uppercase group-hover:text-indigo-400 transition-colors italic tracking-tight">{{ $a->full_name }}</div>
                                        <div class="text-[9px] font-bold text-slate-500 uppercase tracking-[0.2em] mt-1 italic">{{ $a->medical_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-[11px] font-black text-white italic tracking-widest uppercase">{{ $a->bed_number }}</div>
                                <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1 italic">W_ID: {{ substr($a->ward_id, 0, 8) }}</div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-[11px] font-black text-slate-300 uppercase italic tracking-tight truncate max-w-xs leading-relaxed">"{{ $a->admitting_diagnosis }}"</div>
                                <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1 italic">CONSULTANT: {{ strtoupper($a->consultant) }}</div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <div class="text-[10px] font-black text-slate-400 uppercase italic tracking-widest">{{ \Carbon\Carbon::parse($a->admitted_at)->diffForHumans() }}</div>
                            </td>
                            <td class="px-10 py-6 text-right">
                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all">
                                    <button class="px-4 py-2 bg-white/5 border border-white/10 text-slate-400 rounded-xl text-[8px] font-black uppercase tracking-widest hover:bg-white/10 transition-all italic">Vitals Log</button>
                                    <button onclick="openDischargeModal('{{ $a->id }}')" class="px-4 py-2 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-xl text-[8px] font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all italic">Discharge Protocol</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($admissions->isEmpty())
                            <tr>
                                <td colspan="5" class="px-10 py-32 text-center">
                                    <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                                    </div>
                                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active inpatient admission nodes identified in the census matrix.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Admission Protocol -->
<div id="admitModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tight">Authorize Inpatient Admission</h3>
        <form method="POST" action="{{ url('/clinical/ward/admit') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Patient Identity (Medical ID)</label>
                <input name="patient_id" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. PID-000000">
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Target Ward Matrix</label>
                    <select name="ward_id" id="wardSelect" onchange="updateBeds()" class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                        <option value="" class="bg-slate-900">SELECT_WARD_NODE</option>
                        @foreach($wards as $w)
                            <option value="{{ $w->id }}" class="bg-slate-900 italic uppercase">{{ $w->name }} ({{ $w->available }} AVAIL)</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Assigned Bed Node</label>
                    <select name="bed_id" id="bedSelect" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                        <option value="" class="bg-slate-900">SELECT_BED_NODE</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Admitting Diagnosis Protocol</label>
                <textarea name="diagnosis" required class="w-full h-24 bg-white/5 border border-white/10 rounded-3xl px-8 py-6 text-sm font-bold text-white outline-none no-scrollbar focus:border-indigo-500/50 transition-all uppercase" placeholder="Disclosure of admission indications..."></textarea>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Admitting Consultant Protocol</label>
                <input name="consultant" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="Consultant Identification...">
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('admitModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Discard Protocol</button>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Authorize Intake</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateBeds() {
        const wardId = document.getElementById('wardSelect').value;
        const bedSelect = document.getElementById('bedSelect');
        bedSelect.innerHTML = '<option value="" class="bg-slate-900">LOADING_MATRIX...</option>';
        
        if (!wardId) {
            bedSelect.innerHTML = '<option value="" class="bg-slate-900">SELECT_WARD_NODE</option>';
            return;
        }

        fetch(`{{ url('/clinical/ward/available-beds') }}?ward_id=${wardId}`)
            .then(res => res.json())
            .then(data => {
                bedSelect.innerHTML = '<option value="" class="bg-slate-900">SELECT_BED_NODE</option>';
                data.forEach(bed => {
                    bedSelect.innerHTML += `<option value="${bed.id}" class="bg-slate-900 italic uppercase">${bed.bed_number}</option>`;
                });
            });
    }

    function openDischargeModal(id) {
        console.log('Authorize discharge protocol for inpatient node: ' + id);
    }
</script>
</x-cc-shell>

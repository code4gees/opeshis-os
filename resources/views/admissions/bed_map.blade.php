<x-cc-shell title='Opeshis OS'>

@section('title', 'Visual Bed Map & Ward Management - Opeshis OS')


<div class="space-y-6 animate-fade-in">
    <div class="flex justify-between items-center mb-8 border-b border-white/10 pb-8">
        <div>
            <h2 class="text-2xl font-black uppercase text-white tracking-tight">Institutional Ward Map</h2>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Real-time Bed Occupancy & Telemetry</p>
        </div>
        <div class="flex gap-4">
            <select onchange="window.location.href='?ward_id=' + this.value" class="glass-panel border border-white/20 rounded-xl px-6 py-3 text-xs font-black uppercase tracking-widest outline-none">
                @foreach($wards as $ward)
                    <option value="{{ $ward->id }}" {{ $selectedWardId == $ward->id ? 'selected' : '' }}>{{ $ward->name }} ({{ $ward->category }})</option>
                @endforeach
            </select>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold mb-6">{{ session('success') }}</div>
    @endif

    @if ($selectedWardId)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
            @foreach($beds as $bed)
                @php $isOccupied = $bed->status === 'occupied'; @endphp
                <div class="relative group">
                    <div class="glass-panel rounded-[2rem] p-8 border-2 {{ $isOccupied ? 'border-rose-500/30 bg-rose-50/10' : 'border-white/5 hover:border-indigo-100' }} transition-all flex flex-col items-center text-center shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                        <div class="w-12 h-12 rounded-2xl {{ $isOccupied ? 'bg-rose-500 shadow-rose-500/20' : 'bg-white/10 shadow-slate-100/20' }} flex items-center justify-center mb-4 shadow-lg">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                                <path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8M4 10V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5M2 17h20M6 17v3M18 17v3" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-black text-white tracking-tight">{{ $bed->bed_number }}</h4>
                        <p class="text-[9px] font-black uppercase tracking-widest {{ $isOccupied ? 'text-rose-500' : 'text-slate-400' }} mt-1">
                            {{ $isOccupied ? 'Occupied' : 'Available' }}
                        </p>

                        @if ($isOccupied)
                            <div class="mt-4 pt-4 border-t border-rose-50 w-full">
                                <div class="text-[11px] font-black text-white uppercase truncate">{{ $bed->full_name }}</div>
                                <div class="text-[9px] text-slate-400 font-bold uppercase mt-1">{{ $bed->medical_id }}</div>
                                <div class="text-[8px] text-slate-300 font-mono mt-2 italic">Adm: {{ \Carbon\Carbon::parse($bed->admitted_at)->format('d M H:i') }}</div>
                                <form method="POST" action="{{ route('admissions.action') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="action" value="discharge">
                                    <input type="hidden" name="bed_id" value="{{ $bed->id }}">
                                    <button type="submit" class="text-[10px] font-black text-rose-500 uppercase hover:text-rose-700 transition">Discharge &rarr;</button>
                                </form>
                            </div>
                        @else
                            <button onclick="openAdmitModal('{{ $bed->id }}', '{{ $bed->bed_number }}')" class="mt-6 text-[10px] font-black text-indigo-600 uppercase hover:text-indigo-800 transition">Admit Patient</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-20 text-center glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
            <p class="text-slate-300 italic">No wards defined in system registry.</p>
        </div>
    @endif
</div>

<!-- Admit Modal -->
<div id="admitModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-md rounded-[2.5rem] p-12 shadow-2xl">
        <h3 id="admitTitle" class="text-2xl font-black text-white mb-8 uppercase">Inpatient Admission</h3>
        <form method="POST" action="{{ route('admissions.action') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="action" value="admit">
            <input type="hidden" name="bed_id" id="modalBedId">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Patient Search (Medical ID/Name)</label>
                <input type="text" name="patient_id" placeholder="Start typing..." required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold outline-none">
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('admitModal').classList.add('hidden')" class="flex-1 py-5 bg-white/10 text-slate-400 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition">Confirm Admission</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAdmitModal(id, num) {
        document.getElementById('modalBedId').value = id;
        document.getElementById('admitTitle').textContent = 'Admit to Bed ' + num;
        document.getElementById('admitModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

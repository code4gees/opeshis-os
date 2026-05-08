<x-cc-shell title='Opeshis OS'>

@section('title', 'Immunization Registry — Opeshis OS')


<div class="space-y-8 animate-fade-in">
    <!-- Header: Immunization Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Immunization Registry</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Vaccine Administration · Cold-Chain Integrity Surveillance</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('administerModal').classList.remove('hidden')" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Register Administration
            </button>
        </div>
    </header>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-10">
        <!-- Cold-Chain Telemetry -->
        <div class="xl:col-span-4 space-y-8">
            <div class="glass-panel rounded-[3rem] p-10 border border-white/10 shadow-xl relative overflow-hidden">
                <h3 class="text-xs font-black text-white uppercase tracking-widest mb-8 border-b border-white/5 pb-4 italic">Cold-Chain Surveillance</h3>
                <div class="space-y-4 relative z-10">
                    @forelse($fridges ?? [] as $f)
                        @php $isOk = $f['temperature'] >= 2.0 && $f['temperature'] <= 8.0; @endphp
                        <div class="flex justify-between items-center p-5 bg-white/5 border border-white/10 rounded-2xl hover:border-{{ $isOk ? 'emerald' : 'rose' }}-500/30 transition-all group">
                            <div>
                                <h4 class="text-[11px] font-black text-white uppercase tracking-widest group-hover:text-indigo-400 transition-colors">{{ $f['fridge_id'] }}</h4>
                                <p class="text-[8px] text-slate-500 font-black uppercase mt-1">Last Sync: {{ date('H:i', strtotime($f['recorded_at'])) }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-black {{ $isOk ? 'text-emerald-500' : 'text-rose-500 animate-pulse' }} italic leading-none">
                                    {{ number_format($f['temperature'], 1) }}°C
                                </div>
                                <span class="text-[7px] font-black {{ $isOk ? 'text-emerald-600' : 'text-rose-600' }} uppercase tracking-widest">{{ $isOk ? 'Optimal' : 'CRITICAL' }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-[10px] font-black text-slate-600 uppercase italic text-center py-6">No Cold-Chain Telemetry</p>
                    @endforelse
                </div>

                <!-- Manual Temperature Matrix -->
                <div class="mt-8 pt-8 border-t border-white/5">
                    <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4 italic">Manual Telemetry Override</p>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <input type="text" id="log_fridge" placeholder="UNIT_ID" class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-[10px] font-black text-white uppercase outline-none focus:border-indigo-500/50 transition-all">
                        <input type="number" id="log_temp" step="0.1" placeholder="TEMP °C" class="bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-[10px] font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                    </div>
                    <button onclick="logTemp()" class="w-full py-3 bg-indigo-600/20 text-indigo-400 border border-indigo-500/30 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all">Commit Log</button>
                </div>

                <!-- Decorative background -->
                <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Administration Registry Matrix -->
        <div class="xl:col-span-8 glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
            <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
                <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Institutional Administration Registry</h3>
                <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-indigo-500/20">Registry Sync: Active</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-10 py-6">Patient Protocol</th>
                            <th class="px-6 py-6">Antigen / Vaccine</th>
                            <th class="px-6 py-6">Batch Logistics</th>
                            <th class="px-10 py-6 text-right">Verification</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <tr class="hover:bg-white/5 transition-all group">
                            <td colspan="4" class="px-10 py-24 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">Select patient to populate immunization history matrix.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Vaccine Administration -->
<div id="administerModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-2xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-8 uppercase tracking-tight">Vaccine Administration Protocol</h3>
        <div class="space-y-6">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Institutional Patient ID</label>
                <input type="text" id="adm_patient_id" placeholder="OP-XXXX-XXXX" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Antigen / Vaccine Type</label>
                    <select id="adm_vaccine_id" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                        @foreach($vaccines ?? [] as $v)
                            <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Strategic Dose Index</label>
                    <input type="number" id="adm_dose" value="1" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Manufacturer Batch ID</label>
                    <input type="text" id="adm_batch" placeholder="BATCH-XX-XX" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Administration Site Protocol</label>
                    <select id="adm_site" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none">
                        <option>Left Deltoid</option>
                        <option>Right Deltoid</option>
                        <option>Left Thigh (Anterolateral)</option>
                        <option>Right Thigh (Anterolateral)</option>
                        <option>Oral</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Follow-up / Next Due Date</label>
                <input type="date" id="adm_next_due" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
            </div>
        </div>
        <div class="flex gap-4 mt-10">
            <button onclick="document.getElementById('administerModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Cancel</button>
            <button onclick="submitAdmin()" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Commit Administration</button>
        </div>
    </div>
</div>

<script>
    function logTemp() {
        const fridge = document.getElementById('log_fridge').value;
        const temp = document.getElementById('log_temp').value;
        if (!fridge || !temp) return;
        alert("API SYNC: Committing telemetry for unit " + fridge);
    }

    function submitAdmin() {
        alert("STRATEGIC PROTOCOL: Committing vaccine administration record.");
    }
</script>
</x-cc-shell>

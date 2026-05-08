<x-cc-shell title='Opeshis OS'>

@section('title', 'HIV/ART Program — Opeshis OS')


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: HIV/ART Intelligence Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">HIV/ART Program</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">UNAIDS 95-95-95 Surveillance · Longitudinal Regimen Tracking · Virological Failures</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('enrollModal').classList.remove('hidden')" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Authorize New Enrollment
            </button>
        </div>
    </header>

    @if(session('success'))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            HIV program protocol synchronized successfully.
        </div>
    @endif

    <!-- UNAIDS 95-95-95 Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        @foreach([
            ['1st 95: Enrolled / Estimated', number_format($metrics['first_95'], 1) . '%', 'indigo', 'Diagnosed PLHIV'],
            ['2nd 95: On ART / Enrolled', number_format($metrics['second_95'], 1) . '%', 'amber', 'Active Treatment'],
            ['3rd 95: Suppressed / On ART', number_format($metrics['third_95'], 1) . '%', 'emerald', 'Virological Suppression']
        ] as [$label, $val, $color, $sub])
        <div class="glass-panel rounded-[2.5rem] border border-white/10 shadow-xl p-10 relative overflow-hidden group bg-white/[0.02]">
            <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                <div class="w-20 h-20 rounded-full border-8 border-{{ $color === 'indigo' ? 'indigo' : ($color === 'amber' ? 'amber' : 'emerald') }}-500"></div>
            </div>
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 italic">{{ $label }}</p>
            <p class="text-5xl font-black text-{{ $color === 'indigo' ? 'indigo-400' : ($color === 'amber' ? 'amber-500' : 'emerald-500') }} italic tracking-tighter leading-none">{{ $val }}</p>
            <p class="text-[10px] font-black text-slate-600 mt-6 uppercase tracking-widest italic">Target Matrix: 95% {{ $sub }}</p>
        </div>
        @endforeach
    </div>

    <!-- Active Program Registry Matrix -->
    <div class="glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden bg-white/[0.02]">
        <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex items-center justify-between">
            <h3 class="text-xs font-black text-white uppercase tracking-widest italic">ART Program Longitudinal Registry</h3>
            <div class="flex gap-4">
                <span class="px-4 py-1.5 bg-white/5 border border-white/10 text-slate-500 rounded-xl text-[9px] font-black uppercase italic">{{ $metrics['counts']['on_art'] }} ACTIVE_ON_ART</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-10 py-6">Patient Identity</th>
                        <th class="py-6">Unique ART Number</th>
                        <th class="py-6">Active Therapeutic Regimen</th>
                        <th class="py-6">WHO Clinical Stage</th>
                        <th class="py-6">Viral Load Signal</th>
                        <th class="px-10 py-6 text-right">Operational Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($enrollments as $e)
                    <tr class="hover:bg-white/5 transition-all group">
                        <td class="px-10 py-6">
                            <div class="font-black text-white text-base uppercase group-hover:text-indigo-400 transition-colors">{{ $e->full_name }}</div>
                            <div class="text-[9px] font-bold text-slate-500 uppercase tracking-[0.2em] mt-1 italic">AGE: {{ $e->age }} · {{ strtoupper($e->gender) }}</div>
                        </td>
                        <td class="py-6 font-mono text-[11px] font-black text-indigo-400 tracking-widest">{{ $e->art_number }}</td>
                        <td class="py-6">
                            <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[9px] font-black text-slate-400 uppercase italic">{{ $e->current_regimen ?: 'TREATMENT_PENDING' }}</span>
                            @if($e->regimen_line)
                                <div class="text-[8px] font-black text-slate-600 mt-2 uppercase tracking-widest italic">{{ $e->regimen_line }} LINE_PROTOCOL</div>
                            @endif
                        </td>
                        <td class="py-6 text-[11px] font-black text-slate-500 uppercase italic">Stage {{ $e->who_stage }}</td>
                        <td class="py-6">
                            @if($e->last_vl !== null)
                                <div class="text-sm font-black {{ $e->last_vl >= 1000 ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }} italic tracking-tighter">
                                    {{ number_format($e->last_vl) }} COPIES/ML
                                </div>
                                <div class="text-[8px] font-black text-slate-600 uppercase mt-1 italic">{{ date('d M Y', strtotime($e->last_vl_date)) }}</div>
                            @else
                                <span class="text-slate-700 text-[10px] font-black uppercase italic">SIGNAL_MISSING</span>
                            @endif
                        </td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex justify-end gap-4 opacity-0 group-hover:opacity-100 transition-all">
                                <button onclick="openVisitModal('{{ $e->id }}')" class="px-4 py-1.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest italic hover:bg-indigo-600 hover:text-white transition-all">Visit</button>
                                <button onclick="openRegimenModal('{{ $e->id }}', '{{ $e->current_regimen }}')" class="px-4 py-1.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest italic hover:bg-amber-600 hover:text-white transition-all">Regimen</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-10 py-24 text-center">
                            <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                            </div>
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active HIV enrollments identified in the program registry.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Enrollment Protocol -->
<div id="enrollModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tight">Authorize Program Enrollment</h3>
        <form method="POST" action="{{ url('/clinical/hiv/enroll') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Patient Identity (Medical ID)</label>
                <input name="patient_id" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. PID-000000">
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Unique ART Matrix Number</label>
                    <input name="art_number" required placeholder="ART-XXX-XXXX" class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Enrollment WHO Stage</label>
                    <select name="who_stage" class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                        <option value="1">STAGE_1_PROTOCOL</option>
                        <option value="2">STAGE_2_PROTOCOL</option>
                        <option value="3">STAGE_3_PROTOCOL</option>
                        <option value="4">STAGE_4_PROTOCOL</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('enrollModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Discard Enrollment</button>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Authorize Enrollment</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Regimen Transition Protocol -->
<div id="regimenModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-2 uppercase tracking-tight">Regimen Transition Matrix</h3>
        <p class="text-[9px] text-amber-500 font-black uppercase tracking-[0.2em] mb-10 italic">⚠ Terminating current regimen node and authorizing new therapeutic line</p>
        <form method="POST" action="{{ url('/clinical/hiv/regimen-change') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="enrollment_id" id="regimenEnrollmentId">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Active Treatment Matrix</label>
                <input id="currentRegimenText" disabled class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-slate-600 outline-none uppercase italic">
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">New Therapeutic Code</label>
                    <input name="regimen_code" required placeholder="e.g. TLD_PROTOCOL" class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Therapeutic Line Matrix</label>
                    <select name="regimen_line" class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                        <option value="1st">1ST_LINE_OPTIMIZATION</option>
                        <option value="2nd">2ND_LINE_FAILURE_RECOVERY</option>
                        <option value="3rd">3RD_LINE_SALVAGE_PROTOCOL</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Transition Rationale Vector</label>
                <select name="reason" class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                    <option value="Routine Switch">ROUTINE_OPTIMIZATION_SWITCH</option>
                    <option value="Treatment Failure">VIROLOGICAL_TREATMENT_FAILURE</option>
                    <option value="Adverse Reaction">ADVERSE_DRUG_REACTION_NODE</option>
                    <option value="Stock Out">PHARMACEUTICAL_STOCK_OUT</option>
                </select>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('regimenModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Discard Transition</button>
                <button type="submit" class="flex-1 py-5 bg-amber-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-amber-600/20 hover:bg-amber-700 transition-all border border-amber-500/50">Authorize Treatment Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRegimenModal(id, current) {
        document.getElementById('regimenEnrollmentId').value = id;
        document.getElementById('currentRegimenText').value = current || 'NO_ACTIVE_REGIMEN';
        document.getElementById('regimenModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

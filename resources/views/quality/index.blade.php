<x-cc-shell title='Opeshis OS'>

@section('title', 'Clinical Risk & Safety — Opeshis OS')


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Quality & Safety Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Safety Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Incident Surveillance · Quality Assurance · Clinical Risk Management</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('reportModal').classList.remove('hidden')" class="px-8 py-4 bg-rose-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-rose-600/20 hover:bg-rose-700 transition-all border border-rose-500/50">
                Authorize Incident Report
            </button>
        </div>
    </header>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-10">
        <!-- Live Incident Surveillance Matrix -->
        <div class="xl:col-span-8 space-y-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Live Incident Surveillance Feed</h3>
                <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic">Ledger Sync: {{ $incidents->count() }} Entries</span>
            </div>
            
            <div class="space-y-6">
                @foreach ($incidents as $i)
                <div class="glass-panel rounded-[3rem] border border-white/10 shadow-xl p-10 hover:border-rose-500/30 transition-all relative group bg-white/[0.02]">
                    <div class="flex justify-between items-start mb-8">
                        <div class="flex flex-col gap-4">
                            @php
                                $sevCls = match($i->severity_level) {
                                    'CATASTROPHIC' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 shadow-lg shadow-rose-500/10 animate-pulse',
                                    'HIGH' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                    default => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20'
                                };
                            @endphp
                            <span class="px-4 py-1.5 rounded-xl text-[8px] font-black uppercase tracking-[0.2em] border {{ $sevCls }} w-max">
                                {{ $i->severity_level }} SEVERITY
                            </span>
                            <h3 class="text-2xl font-black text-white uppercase tracking-tighter group-hover:text-rose-400 transition-colors">{{ $i->incident_type }}</h3>
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic">{{ $i->location ?? 'UNSPECIFIED_INSTITUTIONAL_LOCATION' }} · {{ \Carbon\Carbon::parse($i->incident_date)->format('M j, Y · H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-[8px] font-black text-slate-600 uppercase tracking-[0.2em] mb-2 italic">Tracking Vector</span>
                            <span class="px-3 py-1 bg-white/5 text-indigo-400 rounded-lg text-[9px] font-black uppercase tracking-widest border border-white/10">{{ $i->status }}</span>
                        </div>
                    </div>
                    
                    <div class="p-8 bg-white/5 rounded-[2.5rem] border border-white/5 mb-10">
                        <p class="text-slate-300 text-[13px] font-bold leading-relaxed italic uppercase tracking-tight">"{{ $i->description }}"</p>
                    </div>
                    
                    <div class="flex justify-between items-center pt-8 border-t border-white/5">
                        <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">
                            Source Protocol: <span class="text-white ml-1">{{ $i->is_anonymous ? 'ANONYMOUS_ENTITY_REPORT' : ($i->reporter_name ?? 'SYSTEM_AUTOMATED_FLAG') }}</span>
                        </div>
                        <button class="px-6 py-2.5 bg-white/5 text-indigo-400 border border-white/10 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Execute Investigation &rarr;</button>
                    </div>
                </div>
                @endforeach
                @if($incidents->isEmpty())
                <div class="py-24 text-center glass-panel rounded-[3rem] border-2 border-dashed border-white/5 bg-white/[0.02]">
                    <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">Institutional safety ledger is currently clear of active flags.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- CAPA Strategic Sidebar -->
        <div class="xl:col-span-4 space-y-8">
            <h3 class="text-xs font-black text-white uppercase tracking-widest italic mb-6">Strategic Corrective Actions (CAPA)</h3>
            <div class="space-y-6">
                @foreach ($capas as $c)
                <div class="glass-panel rounded-[3rem] p-10 border border-white/10 shadow-xl relative overflow-hidden bg-slate-900 group hover:border-indigo-500/30 transition-all">
                    <div class="flex justify-between items-start mb-8 relative z-10">
                        <span class="text-[9px] font-black text-rose-500 uppercase tracking-[0.2em] italic">{{ $c->incident_type }}</span>
                        <span class="px-2 py-1 bg-white/10 text-white rounded text-[7px] font-black uppercase tracking-widest border border-white/10">{{ $c->status }}</span>
                    </div>
                    <div class="p-6 bg-white/5 rounded-[2rem] border border-white/5 mb-8 relative z-10">
                        <p class="text-[11px] font-bold text-slate-300 leading-relaxed uppercase tracking-tight italic">{{ $c->corrective_action }}</p>
                    </div>
                    <div class="flex justify-between items-center text-[8px] font-black uppercase tracking-[0.2em] text-slate-500 relative z-10">
                        <span>Authorized: {{ $c->assigned_name ?? 'PENDING_ASSIGNMENT' }}</span>
                        <span class="text-white">Deadline: {{ \Carbon\Carbon::parse($c->deadline)->format('d M Y') }}</span>
                    </div>
                    <!-- Decorative background -->
                    <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl"></div>
                </div>
                @endforeach
                @if($capas->isEmpty())
                <div class="p-16 glass-panel rounded-[3rem] text-center border border-white/5 bg-white/[0.02]">
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No pending corrective actions identified.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal: Incident Authorization -->
<div id="reportModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-2xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tight">Institutional Safety Disclosure</h3>
        <form method="POST" action="{{ route('quality.report') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Incident Classification</label>
                    <select name="incident_type" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-rose-500/50 transition-all">
                        <option>Medication Protocol Variance</option>
                        <option>Patient Stability Event (Fall)</option>
                        <option>Surgical Discrepancy Matrix</option>
                        <option>Strategic Equipment Malfunction</option>
                        <option>Potential Sentinel Event (Near Miss)</option>
                        <option>Institutional Workplace Hazard</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Assessed Severity Protocol</label>
                    <select name="severity_level" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-rose-500/50 transition-all">
                        <option value="LOW">LOW_PRIORITY (Monitor)</option>
                        <option value="MEDIUM">MEDIUM_RISK (Corrective)</option>
                        <option value="HIGH">HIGH_RISK (Critical Harm)</option>
                        <option value="CATASTROPHIC">CATASTROPHIC_FAILURE</option>
                    </select>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Factual Clinical Disclosure</label>
                    <textarea name="description" placeholder="Provide a strategic account of the safety event..." class="w-full h-32 bg-white/5 border border-white/10 rounded-3xl px-6 py-5 text-sm font-bold text-white outline-none no-scrollbar resize-none focus:border-rose-500/50 transition-all"></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Institutional Location Matrix</label>
                    <input type="text" name="location" placeholder="e.g. WARD_A_BAY_04" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-rose-500/50 transition-all uppercase">
                </div>
                <div class="flex items-center gap-4">
                    <input type="checkbox" name="is_anonymous" value="true" class="w-6 h-6 rounded-xl border-white/10 bg-white/5 text-rose-600 focus:ring-rose-500 transition-all">
                    <label class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic">Anonymize Source Protocol</label>
                </div>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Discard Disclosure</button>
                <button type="submit" class="flex-1 py-5 bg-rose-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-rose-600/20 hover:bg-rose-700 transition-all border border-rose-500/50">Transmit Safety Report</button>
            </div>
        </form>
    </div>
</div>
</x-cc-shell>

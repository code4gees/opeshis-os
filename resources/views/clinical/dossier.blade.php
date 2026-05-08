<x-cc-shell title='Opeshis OS'>

@section('title', 'Patient Dossier — ' . $patient->full_name)


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Patient Identity Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div class="flex items-center gap-10">
            <div class="w-24 h-24 bg-indigo-600 rounded-[2.5rem] flex items-center justify-center text-white font-black text-4xl shadow-2xl shadow-indigo-600/30 border border-indigo-500/50 italic">
                {{ substr($patient->full_name, 0, 1) }}
            </div>
            <div>
                <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic leading-none">{{ $patient->full_name }}</h1>
                <div class="flex items-center gap-6 mt-4">
                    <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] bg-indigo-500/10 border border-indigo-500/20 px-4 py-1.5 rounded-xl shadow-lg shadow-indigo-500/5">{{ $patient->medical_id }}</span>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic">{{ $patient->gender }} · {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} Years</span>
                    <span class="text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] bg-rose-500/10 border border-rose-500/20 px-4 py-1.5 rounded-xl shadow-lg shadow-rose-500/5 italic">BLOOD: {{ $patient->blood_group }}</span>
                </div>
            </div>
        </div>
        <div class="flex gap-4">
            <button onclick="window.print()" class="px-8 py-4 bg-white/5 border border-white/10 text-slate-400 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-white/10 transition-all italic">
                Export Strategic Digest
            </button>
            <a href="{{ route('emr', ['queue_id' => $patient->id]) }}" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Authorize Consultation
            </a>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
        <!-- Sidebar: Clinical Constants & Bio-Intelligence -->
        <div class="lg:col-span-1 space-y-10">
            <div class="glass-panel p-10 rounded-[3rem] border border-white/10 shadow-xl bg-white/[0.02]">
                <h3 class="text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-10 border-b border-white/5 pb-6 italic">Permanent Clinical Notes</h3>
                <div class="space-y-8">
                    <div>
                        <p class="text-[9px] font-black text-rose-500 uppercase tracking-[0.2em] mb-3 italic">Known Allergies / Contradictions</p>
                        <p class="text-sm font-black text-rose-400 uppercase leading-relaxed">{{ $patient->allergies ?: 'NO_KNOWN_ALLERGIES_IDENTIFIED' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 italic">Genotype Identification</p>
                        <p class="text-sm font-black text-white uppercase italic">{{ $patient->genotype ?: 'NULL_SPEC' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="glass-panel p-10 rounded-[3rem] border border-white/10 shadow-xl bg-slate-900 relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-[11px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-8 border-b border-white/5 pb-6 italic">Institutional Status</h3>
                    @php $currentAdmission = $admissions->where('status', 'admitted')->first(); @endphp
                    @if($currentAdmission)
                        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl shadow-lg shadow-emerald-500/5 animate-pulse">
                            <p class="text-[9px] font-black text-emerald-500 uppercase tracking-[0.2em] italic">Active Admission</p>
                            <p class="text-sm font-black text-white mt-2 uppercase italic tracking-tighter">NODE: {{ $currentAdmission->room_no ?? 'ICU_CORE_201' }}</p>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 bg-slate-700 rounded-full"></div>
                            <p class="text-[10px] font-black text-slate-500 italic uppercase tracking-[0.2em]">Status: Outpatient</p>
                        </div>
                    @endif
                </div>
                <!-- Decorative background -->
                <div class="absolute -right-20 -bottom-20 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Main Workspace: Longitudinal History Matrix -->
        <div class="lg:col-span-3 space-y-10">
            <div class="glass-panel rounded-[4rem] border border-white/10 shadow-xl overflow-hidden bg-white/[0.02]">
                <div class="px-12 py-10 border-b border-white/5 bg-white/5 flex justify-between items-center">
                    <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Longitudinal Medical Temporal Matrix</h3>
                    <span class="px-4 py-1.5 bg-white/5 text-slate-500 border border-white/10 rounded-xl text-[8px] font-black uppercase tracking-widest italic">Temporal Stream: Active</span>
                </div>
                
                <div class="p-12">
                    <div class="relative space-y-16 before:absolute before:left-[27px] before:top-4 before:bottom-0 before:w-1 before:bg-white/5 before:shadow-inner">
                        @foreach($encounters as $e)
                        <div class="relative pl-24 group">
                            <div class="absolute left-0 top-1 w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center text-indigo-400 z-10 shadow-xl group-hover:border-indigo-500/50 transition-all duration-500">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h4 class="text-lg font-black text-white uppercase tracking-tight italic group-hover:text-indigo-400 transition-colors">Clinical Consultation</h4>
                                    <p class="text-[9px] font-bold text-slate-500 mt-1 uppercase tracking-[0.2em] italic">Physician Node: {{ $e->doctor_name }}</p>
                                </div>
                                <span class="text-[11px] font-black text-slate-500 uppercase tracking-widest italic leading-none">{{ \Carbon\Carbon::parse($e->created_at)->format('d M Y') }}</span>
                            </div>
                            <div class="p-10 bg-white/5 rounded-[2.5rem] border border-white/5 space-y-6 shadow-inner group-hover:bg-white/[0.04] transition-all">
                                <div>
                                    <p class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-3 italic">Clinical Assessment Protocol</p>
                                    <p class="text-sm font-bold text-slate-400 italic leading-relaxed uppercase tracking-tight">"Protocol Authorization: refer to SOAP_LEDGER_{{ substr($e->id, 0, 8) }} for diagnostic rationale and treatment planning."</p>
                                </div>
                                <div class="flex gap-4 pt-4">
                                    <span class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[8px] font-black text-slate-500 uppercase tracking-widest italic">MATRIX_ID: {{ substr($e->id, 0, 12) }}</span>
                                    <span class="px-4 py-1.5 bg-indigo-500/10 border border-indigo-500/20 rounded-xl text-[8px] font-black text-indigo-400 uppercase tracking-widest italic">STATE: {{ strtoupper($e->status) }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-cc-shell>

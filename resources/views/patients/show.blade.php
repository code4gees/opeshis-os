<x-cc-shell title='Opeshis OS'>

@section('title', 'Patient Profile - ' . $patient->full_name)


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
    
    <!-- Profile Header -->
    <div class="bg-slate-800 rounded-xl p-8 border border-slate-700/60 shadow-sm flex flex-col md:flex-row gap-8 items-start relative overflow-hidden">
        <div class="w-32 h-32 rounded-xl bg-blue-600 flex items-center justify-center text-white text-4xl font-bold shadow-xl shadow-blue-600/20 z-10">
            {{ substr($patient->full_name, 0, 1) }}
        </div>
        <div class="flex-1 z-10">
            <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
                <h1 class="text-3xl font-bold text-slate-100 tracking-tight uppercase">{{ $patient->full_name }}</h1>
                <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded text-[10px] font-bold uppercase tracking-wider inline-block w-fit">{{ $patient->verification_status }}</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Medical ID</p>
                    <p class="text-sm font-bold text-slate-200">{{ $patient->medical_id }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Gender</p>
                    <p class="text-sm font-bold text-slate-200 uppercase">{{ $patient->gender }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Date of Birth</p>
                    <p class="text-sm font-bold text-slate-200">{{ $patient->date_of_birth ?? 'Not Recorded' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Phone Number</p>
                    <p class="text-sm font-bold text-slate-200">{{ $patient->phone_number }}</p>
                </div>
            </div>
            <div class="mt-8 flex gap-3">
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-xs font-bold transition-all shadow-lg shadow-blue-600/10">Edit Profile</button>
                <button class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-200 rounded-lg text-xs font-bold transition-all border border-slate-600">Download Summary</button>
            </div>
        </div>
        <!-- Decorative background -->
        <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar: Clinical & Financial -->
        <div class="space-y-8">
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-6 border-b border-slate-700/60 pb-3">Clinical Overview</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400">Blood Group</span>
                        <span class="px-2 py-0.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[10px] font-bold uppercase">{{ $patient->blood_group ?? '--' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400">Genotype</span>
                        <span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded text-[10px] font-bold uppercase">{{ $patient->genotype ?? '--' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400">Allergies</span>
                        <span class="text-xs font-bold text-rose-500 uppercase">{{ $patient->allergies ?? 'None' }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <h3 class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Billing Summary</h3>
                <div class="bg-slate-900/40 p-5 rounded-lg border border-slate-700/60 mb-6">
                    <p class="text-[9px] font-bold text-slate-500 uppercase mb-2">Outstanding Balance</p>
                    <div class="text-3xl font-bold text-slate-100 italic tracking-tight">FCFA {{ number_format(0, 0) }}</div>
                </div>
                <button class="w-full py-3 bg-slate-700 hover:bg-slate-600 text-slate-200 rounded-lg text-[10px] font-bold uppercase tracking-wider transition-colors border border-slate-600">Make Payment</button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Tabs -->
            <div class="flex gap-8 border-b border-slate-700/60 px-4">
                <button class="pb-4 text-[11px] font-bold uppercase tracking-wider text-blue-500 border-b-2 border-blue-500">Visit History</button>
                <button class="pb-4 text-[11px] font-bold uppercase tracking-wider text-slate-500 hover:text-slate-300 transition">Prescriptions</button>
                <button class="pb-4 text-[11px] font-bold uppercase tracking-wider text-slate-500 hover:text-slate-300 transition">Lab Results</button>
                <button class="pb-4 text-[11px] font-bold uppercase tracking-wider text-slate-500 hover:text-slate-300 transition">Medical Files</button>
            </div>

            <!-- Visit Timeline -->
            <div class="space-y-6">
                @forelse($visits as $visit)
                    <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm relative overflow-hidden group hover:border-blue-500/40 transition-all">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-600"></div>
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h4 class="text-sm font-bold text-slate-100 uppercase tracking-tight group-hover:text-blue-400 transition-colors">Hospital Visit: {{ $visit->intent }}</h4>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($visit->created_at)->format('d M, Y • H:i') }}</p>
                            </div>
                            <span class="px-2 py-0.5 bg-slate-900 border border-slate-700 text-slate-400 rounded text-[9px] font-bold uppercase tracking-wider">{{ $visit->status }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            @php $v = json_decode($visit->vitals_data ?? '{}', true); @endphp
                            <div class="bg-slate-900/40 rounded-lg p-3 border border-slate-700/40">
                                <label class="text-[8px] font-bold text-slate-500 uppercase block mb-1">Temp</label>
                                <div class="text-xs font-bold text-slate-200">{{ $v['temp'] ?? '--' }} °C</div>
                            </div>
                            <div class="bg-slate-900/40 rounded-lg p-3 border border-slate-700/40">
                                <label class="text-[8px] font-bold text-slate-500 uppercase block mb-1">BP</label>
                                <div class="text-xs font-bold text-slate-200">{{ $v['bp_sys'] ?? '--' }}/{{ $v['bp_dia'] ?? '--' }}</div>
                            </div>
                            <div class="bg-slate-900/40 rounded-lg p-3 border border-slate-700/40">
                                <label class="text-[8px] font-bold text-slate-500 uppercase block mb-1">SpO2</label>
                                <div class="text-xs font-bold text-slate-200">{{ $v['spo2'] ?? '--' }} %</div>
                            </div>
                        </div>
                        <div class="text-[11px] text-slate-400 italic bg-slate-900/20 p-3 rounded border border-slate-700/20">
                            "{{ json_decode($visit->complaint_data ?? '{}', true)['chief_complaint'] ?? 'No clinical notes recorded.' }}"
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-800/40 rounded-xl p-16 border border-dashed border-slate-700 text-center">
                        <p class="text-sm text-slate-500 uppercase tracking-wider">No hospital visits recorded for this patient.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-cc-shell>

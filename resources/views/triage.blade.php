<x-cc-shell title='Opeshis OS'>

@section('title', 'Triage & Vitals - Opeshis OS')


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center cc-card p-8 mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Triage & Vitals</h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Patient Intake Matrix</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center gap-6">
            <div class="text-right">
                <span class="block text-[10px] font-bold text-white/20 uppercase tracking-widest">Unit Identifier</span>
                <span class="text-sm font-bold text-sage uppercase tracking-tighter">{{ $roomId }}</span>
            </div>
            <div class="w-px h-10 bg-white/[0.04]"></div>
            <div class="w-4 h-4 rounded-full bg-sage animate-pulse shadow-[0_0_15px_rgba(130,192,154,0.4)]"></div>
        </div>
    </header>

    <!-- Triage KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <x-cc-stat label="Awaiting Triage" :value="$activeQueue->where('status', 'waiting')->count()" icon="fa-hourglass-half" trend="Priority Triage" :trendUp="false" />
        <x-cc-stat label="Ready for Doctor" :value="$activeQueue->where('status', 'awaiting_consultation')->count()" icon="fa-user-check" />
        <x-cc-stat label="Avg Processing" value="08 min" icon="fa-bolt" />
        <x-cc-stat label="Queue Load" value="Optimal" icon="fa-gauge-high" />
    </div>

    <!-- Live Queue Table -->
    <div class="cc-card overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] flex justify-between items-center bg-white/[0.02]">
            <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]">Patient Intake Queue</h3>
            <span class="px-3 py-1 bg-sage/10 text-sage border border-sage/20 rounded-full text-[10px] font-bold uppercase tracking-wider">Live Matrix Active</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="border-b border-white/[0.04] bg-white/[0.01]">
                    <tr class="text-white/20">
                        <th class="px-8 py-5 font-bold uppercase text-[10px] tracking-widest">Patient Identity</th>
                        <th class="px-6 py-5 font-bold uppercase text-[10px] tracking-widest">Clinical Intent</th>
                        <th class="px-6 py-5 font-bold uppercase text-[10px] tracking-widest">Vital Status</th>
                        <th class="px-6 py-5 text-center font-bold uppercase text-[10px] tracking-widest">Protocol Status</th>
                        <th class="px-8 py-5 text-right font-bold uppercase text-[10px] tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.04]">
                    @forelse($activeQueue as $q)
                    <tr class="hover:bg-white/[0.01] transition-colors group">
                        <td class="px-8 py-6">
                            <div class="font-bold text-white text-[12px] tracking-tight uppercase group-hover:text-sage transition-colors">{{ $q->patient->full_name }}</div>
                            <div class="text-[11px] text-white/20 font-bold mt-1">ID: {{ $q->patient->medical_id }} • {{ $q->patient->dob ? \Carbon\Carbon::parse($q->patient->dob)->age : '?' }}Y • {{ strtoupper($q->patient->gender) }}</div>
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-[10px] font-bold text-sage uppercase tracking-widest">{{ str_replace('_', ' ', $q->intent ?? 'General Outpatient') }}</div>
                            <div class="text-[11px] text-white/30 truncate max-w-xs mt-1">"{{ $q->complaint_data['chief_complaint'] ?? 'No primary complaint recorded' }}"</div>
                        </td>
                        <td class="px-6 py-6">
                            <div class="flex flex-wrap gap-2">
                                @if(($q->vitals_data['temp'] ?? 0) > 37.5)
                                <span class="px-3 py-1 bg-alert/10 text-alert rounded-lg text-[10px] font-bold uppercase tracking-wider animate-pulse">High Fever</span>
                                @endif
                                @if(empty($q->vitals_data))
                                <span class="px-3 py-1 bg-white/5 text-white/20 rounded-lg text-[10px] font-bold uppercase tracking-wider">No Data</span>
                                @else
                                <span class="px-3 py-1 bg-sage/10 text-sage rounded-lg text-[10px] font-bold uppercase tracking-wider">Synchronized</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            @php $isConsult = $q->status === 'awaiting_consultation'; @endphp
                            <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $isConsult ? 'bg-sage/10 text-sage' : 'bg-white/5 text-white/40 animate-pulse' }}">
                                {{ str_replace('_', ' ', $q->status) }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button onclick="openVitalsModal('{{ $q->id }}', '{{ addslashes($q->patient->full_name) }}')" 
                                class="cc-button-primary !py-2 !px-5 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                Perform Triage
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-24 text-center">
                            <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users-slash text-white/20 text-xl"></i>
                            </div>
                            <p class="text-[12px] font-bold text-white/20 uppercase tracking-[0.2em]">Institutional Queue Empty</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Triage Data Entry -->
<div id="vitalsModal" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] hidden flex items-center justify-center p-6">
    <div class="cc-card w-full max-w-2xl shadow-2xl overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h3 id="modalPatient" class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]">Institutional Triage Entry</h3>
            <button onclick="document.getElementById('vitalsModal').classList.add('hidden')"
                class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                <i class="fas fa-times text-[10px]"></i>
            </button>
        </div>
        <form method="POST" action="{{ route('triage.save') }}" class="p-8 space-y-6">
            @csrf
            <input type="hidden" name="queue_id" id="modalQueueId">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Temperature (°C)</label>
                    <input type="number" step="0.1" name="temp" placeholder="36.8" 
                        class="cc-input w-full">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Blood Pressure</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="bp_sys" placeholder="SYS" class="cc-input w-full !px-3">
                        <span class="text-white/10">/</span>
                        <input type="number" name="bp_dia" placeholder="DIA" class="cc-input w-full !px-3">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">SPO2 (%)</label>
                    <input type="number" name="spo2" placeholder="98" class="cc-input w-full">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Heart Rate (BPM)</label>
                    <input type="number" name="pulse" placeholder="72" class="cc-input w-full">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" placeholder="70.0" class="cc-input w-full">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Chief Presentation Findings</label>
                <textarea name="chief_complaint" required 
                    class="cc-input w-full h-32 resize-none" 
                    placeholder="Document clinical presentation..."></textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="document.getElementById('vitalsModal').classList.add('hidden')" 
                    class="flex-1 py-3 bg-white/5 border border-white/5 text-white/30 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:text-white transition-all">
                    Discard
                </button>
                <button type="submit" class="cc-button-primary flex-1">
                    Synchronize Vitals
                </button>
            </div>
        </form>
    </div>
</div>

<script>
 function openVitalsModal(id, patient) {
 document.getElementById('modalQueueId').value = id;
 document.getElementById('modalPatient').innerText = 'Triage: ' + patient.toUpperCase();
 document.getElementById('vitalsModal').classList.remove('hidden');
 }
</script>
</x-cc-shell>

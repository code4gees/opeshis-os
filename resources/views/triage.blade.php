<x-cc-shell title='Opeshis OS'>

@section('title', 'Triage & Vitals - Opeshis OS')


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
 
 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-card border border-subtle rounded-xl p-6 ">
 <div>
 <h1 class="text-2xl font-bold text-white tracking-tight">Triage & Vitals</h1>
 <p class="text-sm text-slate-400 mt-1">Initial patient intake, vital signs collection, and clinical prioritization.</p>
 </div>
 <div class="mt-4 md:mt-0 flex items-center gap-4">
 <div class="text-right">
 <span class="block text-[12px] font-bold text-sage font-medium">Unit Identifier</span>
 <span class="text-xs font-bold text-slate-300 uppercase">{{ $roomId }}</span>
 </div>
 <div class="w-px h-10 bg-slate-700"></div>
 <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
 </div>
 </header>

 <!-- Triage KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-[12px] font-bold text-amber-500 font-medium mb-2">Awaiting Triage</p>
 <h3 class="text-3xl font-bold text-white">{{ $activeQueue->where('status', 'waiting')->count() }} <span class="text-xs font-medium text-slate-500 ml-1">Patients</span></h3>
 </div>
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-[12px] font-bold text-emerald-500 font-medium mb-2">Ready for Doctor</p>
 <h3 class="text-3xl font-bold text-white">{{ $activeQueue->where('status', 'awaiting_consultation')->count() }}</h3>
 </div>
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-[12px] font-bold text-sage font-medium mb-2">Avg. Processing Time</p>
 <h3 class="text-3xl font-bold text-white">08 <span class="text-xs font-medium text-slate-500 ml-1 uppercase">Mins</span></h3>
 </div>
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle ">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-2">Queue Load</p>
 <h3 class="text-xl font-bold text-white uppercase">Optimal</h3>
 </div>
 </div>

 <!-- Live Queue Table -->
 <div class="bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-5 border-b border-subtle bg-card/40 flex justify-between items-center">
 <h3 class="text-sm font-bold text-slate-200">Patient Intake Queue</h3>
 <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded text-[12px] font-bold font-medium">Live Sync Active</span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm">
 <thead>
 <tr class="text-slate-500 border-b border-subtle">
 <th class="px-8 py-5 font-semibold uppercase text-[12px] tracking-wider">Patient Details</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px] tracking-wider">Reason for Visit</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px] tracking-wider">Vital Status</th>
 <th class="px-6 py-5 text-center font-semibold uppercase text-[12px] tracking-wider">Current Status</th>
 <th class="px-8 py-5 text-right uppercase text-[12px] tracking-wider">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-700/40">
 @forelse($activeQueue as $q)
 <tr class="hover:bg-slate-700/30 transition-colors">
 <td class="px-8 py-6">
 <div class="font-bold text-white uppercase text-xs">{{ $q->full_name }}</div>
 <div class="text-[12px] text-slate-500 font-bold font-medium mt-1">ID: {{ $q->medical_id }} • {{ $q->age }}Y • {{ strtoupper($q->gender) }}</div>
 </td>
 <td class="px-6 py-6">
 <div class="text-xs font-bold text-sage uppercase tracking-tight">{{ str_replace('_', ' ', $q->intent ?? 'General Outpatient') }}</div>
 <div class="text-[12px] text-slate-500 truncate max-w-xs mt-1">"{{ $q->complaint['chief_complaint'] ?? 'No primary complaint recorded' }}"</div>
 </td>
 <td class="px-6 py-6">
 <div class="flex flex-wrap gap-2">
 @if(($q->vitals['temp'] ?? 0) > 37.5)
 <span class="px-2 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[12px] font-bold font-medium animate-pulse">High Fever</span>
 @endif
 @if(empty($q->vitals['temp']))
 <span class="px-2 py-1 bg-card text-slate-500 border border-slate-700 rounded text-[12px] font-bold font-medium">No Vitals</span>
 @endif
 @if(!empty($q->vitals['temp']) && ($q->vitals['temp'] ?? 0) <= 37.5)
 <span class="px-2 py-1 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded text-[12px] font-bold font-medium">Vitals Normal</span>
 @endif
 </div>
 </td>
 <td class="px-6 py-6 text-center">
 @php $isConsult = $q->status === 'awaiting_consultation'; @endphp
 <span class="px-2 py-0.5 rounded text-[12px] font-bold uppercase border {{ $isConsult ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20 animate-pulse' }}">
 {{ str_replace('_', ' ', $q->status) }}
 </span>
 </td>
 <td class="px-8 py-6 text-right">
 <button onclick="openVitalsModal('{{ $q->id }}', '{{ addslashes($q->full_name) }}')" class="px-4 py-2 bg-sage hover:bg-sage text-white text-[12px] font-bold rounded-lg uppercase transition-all /10 border border-blue-500/50">Perform Triage</button>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-8 py-20 text-center">
 <svg class="mx-auto h-12 w-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
 <p class="mt-4 text-sm text-slate-500">No patients in the triage queue.</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
</div>

<!-- Modal: Triage Data Entry -->
<div id="vitalsModal" class="fixed inset-0 bg-card/80 z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-[#2a2e38] w-full max-w-2xl rounded-xl p-8 border border-subtle">
 <h3 id="modalPatient" class="text-xl font-bold text-white mb-8 uppercase flex items-center gap-3">
 <div class="w-2 h-2 bg-sage rounded-full animate-pulse"></div>
 Patient Triage Entry
 </h3>
 <form method="POST" action="{{ route('triage.save') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="queue_id" id="modalQueueId">
 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Temperature (°C)</label>
 <input type="number" step="0.1" name="temp" placeholder="36.8" class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Blood Pressure (SYS/DIA)</label>
 <div class="flex items-center gap-2">
 <input type="number" name="bp_sys" placeholder="SYS" class="w-full bg-card border border-slate-700 rounded-lg px-3 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 <span class="text-slate-500 font-bold">/</span>
 <input type="number" name="bp_dia" placeholder="DIA" class="w-full bg-card border border-slate-700 rounded-lg px-3 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">SPO2 (%)</label>
 <input type="number" name="spo2" placeholder="98" class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Chief Complaint / Presentation</label>
 <textarea name="chief_complaint" required class="w-full h-32 bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 resize-none" placeholder="Enter findings here..."></textarea>
 </div>
 <div class="flex gap-4 mt-8 pt-6 border-t border-subtle">
 <button type="button" onclick="document.getElementById('vitalsModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-3 bg-sage hover:bg-sage text-white rounded-lg text-sm font-bold transition-all /20">Save & Finish</button>
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

<x-cc-shell title='Dashboard | Hospital'>

<div class="max-w-[1600px] mx-auto pb-10">

 <!-- TOP ROW METRICS -->
 <div class="grid grid-cols-5 gap-4 mb-6">
 <!-- Card 1 -->
 <div class="bg-card rounded-xl border border-subtle p-4 relative overflow-hidden flex flex-col justify-between h-28">
 <h3 class="text-[12px] text-slate-300 font-medium">Admissions Today</h3>
 <div class="flex items-baseline gap-2 mt-1 relative z-10">
 <span class="text-2xl font-bold text-white">48</span>
 <span class="text-[12px] text-sage font-medium">(+5%)</span>
 </div>
 <div class="absolute bottom-0 left-0 right-0 h-12 opacity-80">
 <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
 <path d="M0,20 Q10,10 20,20 T40,20 T60,10 T80,25 T100,5 L100,30 L0,30 Z" fill="rgba(130,192,154,0.1)"></path>
 <path d="M0,20 Q10,10 20,20 T40,20 T60,10 T80,25 T100,5" fill="none" stroke="#82c09a" stroke-width="1.5"></path>
 </svg>
 </div>
 </div>

 <!-- Card 2 -->
 <div class="bg-card rounded-xl border border-subtle p-4 relative overflow-hidden flex flex-col justify-between h-28">
 <h3 class="text-[12px] text-slate-300 font-medium">Self-Service Vitals</h3>
 <div class="flex items-baseline gap-2 mt-1 relative z-10">
 <span class="text-2xl font-bold text-white">{{ $stats['kiosk_vitals_today'] }}</span>
 <span class="text-[12px] text-sage font-medium">Kiosk Hub</span>
 </div>
 <div class="absolute bottom-0 left-0 right-0 h-12 opacity-80">
 <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
 <path d="M0,25 Q10,15 20,25 T40,15 T60,5 T80,15 T100,20 L100,30 L0,30 Z" fill="rgba(130,192,154,0.1)"></path>
 <path d="M0,25 Q10,15 20,25 T40,15 T60,5 T80,15 T100,20" fill="none" stroke="#82c09a" stroke-width="1.5"></path>
 </svg>
 </div>
 </div>

 <!-- Card 3 -->
 <div class="bg-card rounded-xl border border-subtle p-4 relative overflow-hidden flex flex-col justify-between h-28">
 <h3 class="text-[12px] text-slate-300 font-medium">Avg. Bed Occupancy</h3>
 <div class="flex items-baseline gap-2 mt-1 relative z-10">
 <span class="text-2xl font-bold text-white">86%</span>
 </div>
 <div class="absolute bottom-0 left-0 right-0 h-12 opacity-80">
 <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
 <path d="M0,25 Q15,25 25,20 T50,20 T75,10 T100,20 L100,30 L0,30 Z" fill="rgba(130,192,154,0.1)"></path>
 <path d="M0,25 Q15,25 25,20 T50,20 T75,10 T100,20" fill="none" stroke="#82c09a" stroke-width="1.5"></path>
 <circle cx="75" cy="10" r="2" fill="#82c09a"></circle>
 </svg>
 </div>
 </div>

 <!-- Card 4 (Alerts) -->
 <div class="bg-card rounded-xl border border-subtle p-4 relative overflow-hidden flex flex-col justify-between h-28">
 <div class="flex justify-between items-start">
 <h3 class="text-[12px] text-slate-300 font-medium">Critical Alerts</h3>
 <i class="fas fa-exclamation-circle text-alert text-[12px]"></i>
 </div>
 <div class="flex items-baseline gap-2 mt-1 relative z-10">
 <span class="text-2xl font-bold text-alert">3</span>
 </div>
 <div class="absolute bottom-0 left-0 right-0 h-12 opacity-80">
 <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
 <path d="M0,25 L30,25 L35,10 L45,28 L50,25 L100,25" fill="none" stroke="#d9776c" stroke-width="1.5"></path>
 </svg>
 </div>
 </div>

 <!-- Card 5 -->
 <div class="bg-card rounded-xl border border-subtle p-4 relative overflow-hidden flex flex-col justify-between h-28">
 @if(auth()->user()->hasPermission('module_billing'))
 <h3 class="text-[12px] text-slate-300 font-medium">Revenue Today</h3>
 <div class="flex items-baseline gap-2 mt-1 relative z-10">
 <span class="text-2xl font-bold text-white">${{ number_format($stats['revenue_today']) }}</span>
 </div>
 @else
 <h3 class="text-[12px] text-slate-300 font-medium">Staff on Duty</h3>
 <div class="flex items-baseline gap-2 mt-1 relative z-10">
 <span class="text-2xl font-bold text-white">112</span>
 </div>
 @endif
 <div class="absolute bottom-0 left-0 right-0 h-12 opacity-80">
 <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
 <path d="M0,20 Q10,15 20,20 T40,10 T60,20 T80,15 T100,20 L100,30 L0,30 Z" fill="rgba(130,192,154,0.1)"></path>
 <path d="M0,20 Q10,15 20,20 T40,10 T60,20 T80,15 T100,20" fill="none" stroke="#82c09a" stroke-width="1.5"></path>
 </svg>
 </div>
 </div>
 </div>

 <!-- MAIN TWO COLUMNS -->
 <div class="grid grid-cols-12 gap-6">
 
 @if(auth()->user()->hasPermission('module_clinical'))
 <!-- LEFT COLUMN: Patient Queue -->
 <div class="col-span-5 bg-card rounded-xl border border-subtle flex flex-col h-[820px]">
 <div class="px-5 py-4 flex justify-between items-center border-b border-subtle">
 <h2 class="text-[15px] font-medium text-white">Patient Queue</h2>
 <a href="{{ route('patients.index') }}" class="px-3 py-1 rounded bg-[#2a2e38] text-xs text-slate-300 hover:text-white border border-subtle flex items-center gap-1.5 transition-colors">
 <i class="fas fa-plus text-[12px]"></i> See All
 </a>
 </div>
 
 <div class="flex-1 overflow-y-auto custom-scrollbar">
 <table class="w-full text-left">
 <thead class="sticky top-0 bg-card z-10 border-b border-subtle">
 <tr>
 <th class="px-5 py-3 text-[12px] font-medium text-slate-400">Name</th>
 <th class="px-5 py-3 text-[12px] font-medium text-slate-400">Status</th>
 <th class="px-5 py-3 text-[12px] font-medium text-slate-400 flex items-center gap-1">Wait Time <i class="fas fa-sort text-[12px]"></i></th>
 <th class="px-5 py-3 text-[12px] font-medium text-slate-400">Assigned Doctor</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-subtle">
 @forelse($active_queue as $index => $q)
 <tr onclick="window.location.href='{{ route('emr.main') }}'" class="{{ $loop->even ? 'bg-[#1a1d24]/30' : 'bg-transparent' }} hover:bg-[#2a2e38] transition-colors group cursor-pointer">
 <td class="px-5 py-3 text-[12px] text-slate-200 font-medium">{{ $q->patient->full_name }}</td>
 <td class="px-5 py-3">
 <span class="px-2.5 py-1 rounded-md text-[12px] font-medium bg-[#313642] text-slate-300">
 {{ $q->status }}
 </span>
 </td>
 <td class="px-5 py-3 text-[12px] text-slate-300">{{ $q->created_at->diffForHumans(null, true) }}</td>
 <td class="px-5 py-3 text-[12px] text-slate-300">{{ $q->doctor->name ?? 'Unassigned' }}</td>
 </tr>
 @empty
 <tr>
  <td colspan="4" class="px-5 py-12 text-center text-slate-500 text-[12px]">No active patients in queue.</td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
 @else
 <div class="col-span-5 bg-card rounded-xl border border-subtle flex flex-col h-[820px] items-center justify-center p-12 text-center">
  <i class="fas fa-user-shield text-slate-700 text-5xl mb-6"></i>
  <h3 class="text-white font-medium mb-2">Restricted Command Node</h3>
  <p class="text-slate-500 text-[12px]">You do not have the required clinical authorization to view the active patient queue.</p>
 </div>
 @endif

 <!-- RIGHT COLUMN -->
 <div class="col-span-7 flex flex-col gap-6 h-[820px]">
 
 <!-- Top Chart -->
 <div class="bg-card rounded-xl border border-subtle p-5 flex flex-col h-[320px] shrink-0">
 <div class="flex justify-between items-center mb-6">
 <h2 class="text-[15px] font-medium text-white">Clinical Charts</h2>
 <button class="px-3 py-1 rounded bg-[#2a2e38] text-[12px] text-slate-300 border border-subtle">Patient Stats</button>
 </div>
 
 <h3 class="text-[12px] text-slate-300 mb-2 flex items-center justify-between">
 Patient Inflow over 24h
 <div class="flex items-center gap-4 text-[12px] text-slate-400">
 <span class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-sage"></div> Patient</span>
 <span class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-slate-500"></div> Series</span>
 </div>
 </h3>
 
 <div class="flex-1 relative">
 <canvas id="mainChart"></canvas>
 </div>
 </div>

 <!-- Middle Row: Bar Charts -->
 <div class="grid grid-cols-2 gap-6 h-[220px] shrink-0">
 
 <!-- Bar Chart 1 -->
 <div class="bg-card rounded-xl border border-subtle p-4 flex flex-col">
 <h3 class="text-[12px] text-white mb-2">Resource Allocation by Department</h3>
 <div class="flex-1 relative flex items-end justify-between px-2 pb-6 pt-4 border-l border-b border-subtle/50">
 <div class="absolute -left-6 top-0 bottom-6 flex flex-col justify-between text-[12px] text-slate-500">
 <span>100</span><span>75</span><span>50</span><span>25</span><span>0</span>
 </div>
 <div class="absolute -bottom-4 left-0 right-0 flex justify-between px-2 text-[12px] text-slate-500">
 <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span>
 </div>
 @foreach([ [40,25],[70,35],[100,60],[40,30],[50,80],[90,40],[40,60],[80,45],[30,90] ] as $bars)
 <div class="flex gap-0.5 items-end h-full w-full justify-center">
 <div class="w-2 bg-[#5d8b76] rounded-t-sm" style="height: {{ $bars[0] }}%"></div>
 <div class="w-2 bg-[#82c09a] rounded-t-sm" style="height: {{ $bars[1] }}%"></div>
 </div>
 @endforeach
 </div>
 </div>

 <!-- Bar Chart 2 -->
 <div class="bg-card rounded-xl border border-subtle p-4 flex flex-col">
 <h3 class="text-[12px] text-white mb-2">Department by Company</h3>
 <div class="flex-1 relative flex items-end justify-between px-2 pb-6 pt-4 border-l border-b border-subtle/50">
 <div class="absolute -left-6 top-0 bottom-6 flex flex-col justify-between text-[12px] text-slate-500">
 <span>200</span><span>150</span><span>100</span><span>50</span><span>0</span>
 </div>
 <div class="absolute -bottom-4 left-0 right-0 flex justify-around px-2 text-[12px] text-slate-500 w-full">
 <span>Mat</span><span>Beb</span><span>Mar</span>
 </div>
 <div class="flex justify-around items-end h-full w-full">
 <div class="w-8 bg-[#82c09a] rounded-t-sm" style="height: 60%"></div>
 <div class="w-8 bg-[#82c09a] rounded-t-sm opacity-60" style="height: 80%"></div>
 <div class="w-8 bg-[#82c09a] rounded-t-sm opacity-40" style="height: 50%"></div>
 </div>
 </div>
 </div>
 </div>

 <!-- Bottom Row: Ward Status -->
 <div class="bg-card rounded-xl border border-subtle p-5 flex flex-col flex-1">
 <div class="flex justify-between items-center mb-4">
 <h3 class="text-[12px] text-white">Ward Status</h3>
 @if(auth()->user()->hasPermission('module_clinical'))
 <a href="{{ route('wards') }}" class="px-3 py-1 rounded bg-[#2a2e38] text-[12px] text-slate-300 border border-subtle">Ward Details</a>
 @endif
 </div>
 
 @if(auth()->user()->hasPermission('module_clinical'))
 <div class="flex gap-4 flex-1">
 <!-- Floor Plan Block 1 -->
 <div class="flex-1 border border-subtle rounded p-2 relative bg-[#1a1d24]/50">
 <div class="absolute left-0 top-0 bottom-0 w-6 border-r border-subtle flex items-center justify-center -rotate-90 text-[12px] text-slate-500 tracking-wider">Floor</div>
 <div class="ml-8 mr-2 grid grid-cols-2 gap-4 h-full py-2">
 <!-- Bed 1 -->
 <div class="border border-subtle rounded flex items-center justify-center relative bg-card">
 <i class="fas fa-bed text-slate-600 text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-sage/20 flex items-center justify-center text-sage"><i class="fas fa-check text-[8px]"></i></div>
 </div>
 <!-- Bed 2 -->
 <div class="border border-subtle rounded flex items-center justify-center relative bg-card">
 <i class="fas fa-bed text-slate-600 text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-sage/20 flex items-center justify-center text-sage"><i class="fas fa-check text-[8px]"></i></div>
 </div>
 <!-- Bed 3 -->
 <div class="border border-subtle rounded flex items-center justify-center relative bg-card">
 <i class="fas fa-bed text-slate-600 text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-sage/20 flex items-center justify-center text-sage"><i class="fas fa-check text-[8px]"></i></div>
 </div>
 <!-- Bed 4 -->
 <div class="border border-subtle rounded flex items-center justify-center relative bg-card">
 <i class="fas fa-bed text-slate-600 text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-sage/20 flex items-center justify-center text-sage"><i class="fas fa-check text-[8px]"></i></div>
 </div>
 </div>
 </div>
 <!-- Floor Plan Block 2 -->
 <div class="flex-1 border border-subtle rounded p-2 relative bg-[#1a1d24]/50">
 <div class="absolute left-0 top-0 bottom-0 w-6 border-r border-subtle flex items-center justify-center -rotate-90 text-[12px] text-slate-500 tracking-wider">Floor</div>
 <div class="ml-8 mr-2 grid grid-cols-2 gap-4 h-full py-2">
 <!-- Bed 1 -->
 <div class="border border-subtle rounded flex items-center justify-center relative bg-card">
 <i class="fas fa-bed text-slate-600 text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-sage/20 flex items-center justify-center text-sage"><i class="fas fa-check text-[8px]"></i></div>
 </div>
 <!-- Bed 2 -->
 <div class="border border-alert/30 rounded flex items-center justify-center relative bg-alert/5">
 <i class="fas fa-bed text-alert text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-alert/20 flex items-center justify-center text-alert"><i class="fas fa-times text-[8px]"></i></div>
 </div>
 <!-- Bed 3 -->
 <div class="border border-subtle rounded flex items-center justify-center relative bg-card">
 <i class="fas fa-bed text-slate-600 text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-sage/20 flex items-center justify-center text-sage"><i class="fas fa-check text-[8px]"></i></div>
 </div>
 <!-- Bed 4 -->
 <div class="border border-alert/30 rounded flex items-center justify-center relative bg-alert/5">
 <i class="fas fa-bed text-alert text-lg absolute left-2"></i>
 <div class="w-4 h-4 rounded-full bg-alert/20 flex items-center justify-center text-alert"><i class="fas fa-exclamation text-[8px]"></i></div>
 </div>
 </div>
 </div>
 </div>
 @else
 <div class="flex-1 flex flex-col items-center justify-center text-slate-600">
 <i class="fas fa-lock text-3xl mb-3"></i>
 <p class="text-[11px] uppercase tracking-widest font-bold">Inpatient Census Encrypted</p>
 </div>
 @endif
 </div>

 </div>

 </div>

</div>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 document.addEventListener("DOMContentLoaded", function() {
 Chart.defaults.color = '#64748b'; 
 Chart.defaults.font.family = 'Inter, sans-serif';
 
 const ctx = document.getElementById('mainChart');
 if(ctx) {
 new Chart(ctx, {
 type: 'line',
 data: {
 labels: ['12h','14h','16h','18h','20h','22h','00h','02h'],
 datasets: [
 {
 label: 'Patient',
 data: [10, 40, 20, 80, 40, 60, 30, 70],
 borderColor: '#82c09a', // Sage
 borderWidth: 2,
 tension: 0.4,
 pointRadius: 0,
 fill: true,
 backgroundColor: (context) => {
 const chartCtx = context.chart.ctx;
 const gradient = chartCtx.createLinearGradient(0, 0, 0, 200);
 gradient.addColorStop(0, 'rgba(130, 192, 154, 0.4)');
 gradient.addColorStop(1, 'rgba(130, 192, 154, 0)');
 return gradient;
 }
 },
 {
 label: 'Series',
 data: [30, 20, 40, 30, 50, 40, 20, 50],
 borderColor: '#4c566a', // Slate
 borderWidth: 2,
 tension: 0.4,
 pointRadius: 0,
 fill: true,
 backgroundColor: (context) => {
 const chartCtx = context.chart.ctx;
 const gradient = chartCtx.createLinearGradient(0, 0, 0, 200);
 gradient.addColorStop(0, 'rgba(76, 86, 106, 0.2)');
 gradient.addColorStop(1, 'rgba(76, 86, 106, 0)');
 return gradient;
 }
 }
 ]
 },
 options: {
 responsive: true, maintainAspectRatio: false,
 plugins: { legend: { display: false }, tooltip: { enabled: false } },
 scales: {
 y: { min: 0, max: 100, border: {display: false}, grid: { color: 'rgba(255,255,255,0.06)' }, ticks: { font: {size: 9} } },
 x: { border: {display: true, color: 'rgba(255,255,255,0.06)'}, grid: { display: false }, ticks: { font: {size: 9} } }
 }
 }
 });
 }
 });
</script>

  <!-- CLINICAL QUICK-LAUNCH GRID -->
  <div class="mt-12 grid grid-cols-6 gap-6">
  @if(auth()->user()->hasPermission('module_emergency'))
  <a href="{{ route('clinical.emergency.index') }}" class="bg-card/50 border border-subtle hover:border-rose-500/50 p-6 rounded-2xl flex flex-col items-center justify-center gap-3 group transition-all shadow-lg hover:shadow-rose-500/5">
  <div class="w-12 h-12 rounded-xl bg-rose-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
  <i class="fas fa-truck-medical text-rose-500 text-xl"></i>
  </div>
  <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-rose-400">Emergency</span>
  </a>
  @endif
  @if(auth()->user()->hasPermission('module_clinical'))
  <a href="{{ route('specialty.critical.icu.index') }}" class="bg-card/50 border border-subtle hover:border-blue-500/50 p-6 rounded-2xl flex flex-col items-center justify-center gap-3 group transition-all shadow-lg hover:shadow-blue-500/5">
  <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
  <i class="fas fa-heart-pulse text-blue-500 text-xl"></i>
  </div>
  <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-blue-400">ICU Command</span>
  </a>
  @endif
  @if(auth()->user()->hasPermission('module_pharmacy'))
  <a href="{{ route('operations.diagnostics.pharmacy') }}" class="bg-card/50 border border-subtle hover:border-emerald-500/50 p-6 rounded-2xl flex flex-col items-center justify-center gap-3 group transition-all shadow-lg hover:shadow-emerald-500/5">
  <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
  <i class="fas fa-pills text-emerald-500 text-xl"></i>
  </div>
  <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-emerald-400">Pharmacy</span>
  </a>
  @endif
  @if(auth()->user()->hasPermission('module_lab'))
  <a href="{{ route('operations.diagnostics.lab') }}" class="bg-card/50 border border-subtle hover:border-amber-500/50 p-6 rounded-2xl flex flex-col items-center justify-center gap-3 group transition-all shadow-lg hover:shadow-amber-500/5">
  <div class="w-12 h-12 rounded-xl bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
  <i class="fas fa-flask text-amber-500 text-xl"></i>
  </div>
  <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-amber-400">Laboratory</span>
  </a>
  @endif
  @if(auth()->user()->hasPermission('module_clinical'))
  <a href="{{ route('specialty.clinics.dental.index') }}" class="bg-card/50 border border-subtle hover:border-white/30 p-6 rounded-2xl flex flex-col items-center justify-center gap-3 group transition-all shadow-lg hover:shadow-white/5">
  <div class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center group-hover:scale-110 transition-transform">
  <i class="fas fa-tooth text-slate-200 text-xl"></i>
  </div>
  <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-white">Dental Clinic</span>
  </a>
  <a href="{{ route('specialty.clinics.eye.index') }}" class="bg-card/50 border border-subtle hover:border-indigo-500/50 p-6 rounded-2xl flex flex-col items-center justify-center gap-3 group transition-all shadow-lg hover:shadow-indigo-500/5">
  <div class="w-12 h-12 rounded-xl bg-indigo-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
  <i class="fas fa-eye text-indigo-500 text-xl"></i>
  </div>
  <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-indigo-400">Eye Clinic</span>
  </a>
  @endif
  </div>
</x-cc-shell>


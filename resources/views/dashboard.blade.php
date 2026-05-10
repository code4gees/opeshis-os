<x-cc-shell title='Dashboard | Hospital Intelligence'>

<div class="max-w-[1600px] mx-auto pb-10">

  <!-- TOP ROW METRICS: Operational KPIs -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
    <x-cc-vital-trend
        label="Admissions Today"
        value="48"
        unit="+5%"
        trend="up"
        :history="[20, 35, 25, 45, 48]"
    />

    <x-cc-vital-trend
        label="Self-Service Vitals"
        value="{{ $stats['kiosk_vitals_today'] }}"
        unit="Kiosk Hub"
        trend="stable"
        :history="[10, 15, 12, 18, $stats['kiosk_vitals_today']]"
    />

    <x-cc-vital-trend
        label="Bed Occupancy"
        value="86%"
        unit="Optimal"
        trend="up"
        :history="[70, 75, 80, 82, 86]"
    />

    <x-cc-vital-trend
        label="Critical Alerts"
        value="3"
        unit="Immediate"
        trend="up"
        status="critical"
        :history="[0, 1, 0, 2, 3]"
    />

    @if(auth()->user()->hasPermission('module_billing'))
      <x-cc-vital-trend
          label="Revenue Today"
          value="${{ number_format($stats['revenue_today']) }}"
          unit="XAF"
          trend="up"
          status="normal"
          :history="[5000, 7000, 6000, 8000, $stats['revenue_today']]"
      />
    @else
      <x-cc-vital-trend
          label="Staff on Duty"
          value="112"
          unit="Synchronized"
          trend="stable"
          :history="[110, 112, 112, 111, 112]"
      />
    @endif
  </div>

  <!-- MAIN TWO COLUMNS: Responsive Grid Architecture -->
  <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
    @if(auth()->user()->hasPermission('module_clinical'))
      <!-- LEFT COLUMN: Patient Queue Survaillance -->
      <div class="xl:col-span-5 xl:h-[820px] min-h-[500px] flex flex-col">
        <x-cc-card class="flex-1 flex flex-col p-0 overflow-hidden" title="Institutional Live Queue" icon="users">
          <x-slot name="action">
            <x-cc-button size="sm" variant="secondary" icon="arrow-right" onclick="window.location.href='{{ route('patients.index') }}'">
                Master Index
            </x-cc-button>
          </x-slot>
          
          <div class="flex-1 overflow-y-auto custom-scrollbar">
            <x-cc-table :headers="['Patient Identity', 'Protocol Status', 'Latency', 'Assigned Node']" compact>
              @forelse($active_queue as $q)
                <tr onclick="window.location.href='{{ route('emr.main', $q->id) }}'" class="group cursor-pointer hover:bg-white/[0.01] transition-colors border-b border-white/[0.02] last:border-0">
                  <td class="px-4 py-4">
                    <div class="text-[12px] font-bold text-slate-200 group-hover:text-cobalt transition-colors">{{ $q->patient->full_name }}</div>
                    <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">{{ $q->patient->medical_id }}</div>
                  </td>
                  <td class="px-4 py-4">
                    <span class="px-2 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-400 text-[9px] font-bold uppercase tracking-widest">
                      {{ $q->status }}
                    </span>
                  </td>
                  <td class="px-4 py-4">
                    <div class="text-[11px] font-bold text-slate-500 uppercase tracking-tighter">{{ $q->created_at->diffForHumans(null, true) }}</div>
                  </td>
                  <td class="px-4 py-4">
                    <div class="text-[11px] font-bold text-cobalt/60 uppercase tracking-widest">{{ $q->doctor->name ?? 'UNASSIGNED' }}</div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-8 py-20 text-center">
                    <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4 border border-white/5">
                      <i class="fas fa-inbox text-white/10 text-lg"></i>
                    </div>
                    <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">Queue Status: Empty</p>
                  </td>
                </tr>
              @endforelse
            </x-cc-table>
          </div>
        </x-cc-card>
      </div>
    @else
      <div class="xl:col-span-5 xl:h-[820px] min-h-[500px]">
        <x-cc-card class="h-full flex flex-col items-center justify-center text-center p-12 bg-alert/[0.02] border-alert/10">
          <div class="w-16 h-16 rounded-2xl bg-alert/10 flex items-center justify-center mb-6">
            <i class="fas fa-shield-slash text-alert text-2xl"></i>
          </div>
          <h3 class="text-white font-bold uppercase tracking-[0.2em] mb-3">Restricted Node</h3>
          <p class="text-white/20 text-[11px] uppercase tracking-widest leading-relaxed">Required: module_clinical authorization<br>Access denied by governance protocol.</p>
        </x-cc-card>
      </div>
    @endif

    <!-- RIGHT COLUMN: Intelligence Matrix -->
    <div class="xl:col-span-7 flex flex-col gap-8 xl:h-[820px]">
      <!-- Clinical Velocity Visualizer -->
      <x-cc-card class="h-[340px] flex flex-col p-8">
        <div class="flex justify-between items-center mb-8">
          <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
            <i class="fas fa-chart-line text-sage text-[14px]"></i>
            Clinical Inflow Intelligence
          </h2>
          <div class="flex gap-2">
            <span class="flex items-center gap-2 text-[9px] font-bold text-white/20 uppercase tracking-widest">
              <div class="w-1.5 h-1.5 rounded-full bg-sage shadow-[0_0_8px_rgba(130,192,154,0.4)]"></div> Primary Inflow
            </span>
          </div>
        </div>
        <div class="flex-1 relative">
          <canvas id="mainChart"></canvas>
        </div>
      </x-cc-card>

      <!-- Departmental Resource Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 h-[240px]">
        <x-cc-card class="p-8 flex flex-col justify-between">
          <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em]">Departmental Saturation</h3>
          <div class="flex items-end justify-between h-24 mt-4 gap-1">
            @foreach([40,70,100,40,50,90,40,80,30] as $h)
              <div class="flex-1 bg-white/5 rounded-t-lg relative group">
                <div class="absolute bottom-0 left-0 right-0 bg-sage/20 group-hover:bg-sage/40 transition-all rounded-t-lg" style="height: {{ $h }}%"></div>
              </div>
            @endforeach
          </div>
          <div class="flex justify-between mt-4 text-[9px] font-bold text-white/10 uppercase tracking-widest font-mono">
            <span>A&E</span><span>ICU</span><span>OPD</span><span>LAB</span><span>RAD</span>
          </div>
        </x-cc-card>

        <x-cc-card class="p-8 flex flex-col justify-center">
          <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] mb-6 text-center">Inpatient Census Matrix</h3>
          <div class="flex justify-around items-end h-24 gap-4 px-6">
            <div class="w-full bg-white/5 rounded-t-xl relative overflow-hidden h-full">
              <div class="absolute bottom-0 left-0 right-0 bg-sage/40 h-[60%]"></div>
            </div>
            <div class="w-full bg-white/5 rounded-t-xl relative overflow-hidden h-full">
              <div class="absolute bottom-0 left-0 right-0 bg-sage/20 h-[85%]"></div>
            </div>
            <div class="w-full bg-white/5 rounded-t-xl relative overflow-hidden h-full">
              <div class="absolute bottom-0 left-0 right-0 bg-sage/10 h-[30%]"></div>
            </div>
          </div>
          <div class="flex justify-around mt-4 text-[9px] font-bold text-white/10 uppercase tracking-widest font-mono">
            <span>GEN</span><span>MAT</span><span>PED</span>
          </div>
        </x-cc-card>
      </div>

      <!-- Ward Status Surveillance -->
      <x-cc-card class="flex-1 flex flex-col p-8">
        <div class="flex justify-between items-center mb-8">
          <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
            <i class="fas fa-bed-pulse text-sage text-[14px]"></i>
            Ward Status Surveillance
          </h3>
          @if(auth()->user()->hasPermission('module_clinical'))
            <a href="{{ route('wards') }}" class="text-[10px] font-bold text-sage uppercase tracking-widest hover:text-white transition-colors">Full Census Protocol</a>
          @endif
        </div>
        
        @if(auth()->user()->hasPermission('module_clinical'))
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1">
            @foreach(['Ground Floor / A-Wing', 'First Floor / B-Wing'] as $floor)
              <div class="bg-white/[0.01] border border-white/[0.04] rounded-2xl p-6 relative flex flex-col">
                <div class="flex items-center gap-3 mb-6">
                  <div class="w-2 h-2 rounded-full bg-sage shadow-[0_0_8px_rgba(130,192,154,0.4)]"></div>
                  <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">{{ $floor }}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 flex-1">
                  @for($i=0; $i<4; $i++)
                    <div class="bg-white/[0.02] border border-white/[0.04] rounded-xl flex items-center justify-center gap-3 group hover:border-sage/20 transition-all">
                      <i class="fas fa-bed text-white/10 group-hover:text-sage transition-colors"></i>
                      <div class="w-2 h-2 rounded-full {{ $i % 3 == 0 ? 'bg-alert shadow-[0_0_8px_rgba(217,119,108,0.4)]' : 'bg-sage/40' }}"></div>
                    </div>
                  @endfor
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="flex-1 flex flex-col items-center justify-center text-center">
            <i class="fas fa-lock text-white/5 text-4xl mb-4"></i>
            <p class="text-[10px] font-bold text-white/10 uppercase tracking-[0.25em]">Census Encryption Protocol: Active</p>
          </div>
        @endif
      </x-cc-card>
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

  <!-- CLINICAL QUICK-LAUNCH MATRIX: Premium Operational Grid -->
  <div class="mt-12 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
    @if(auth()->user()->hasPermission('module_emergency'))
      <a href="{{ route('clinical.emergency.index') }}" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-rose/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-rose/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="truck" class="text-rose w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-rose transition-colors">Emergency</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-rose group-hover:w-full transition-all duration-500"></div>
      </a>
    @endif

    @if(auth()->user()->hasPermission('module_clinical'))
      <a href="{{ route('specialty.critical.icu.index') }}" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-cobalt/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-cobalt/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="activity" class="text-cobalt w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-cobalt transition-colors">ICU Command</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-cobalt group-hover:w-full transition-all duration-500"></div>
      </a>
    @endif

    @if(auth()->user()->hasPermission('module_pharmacy'))
      <a href="{{ route('operations.diagnostics.pharmacy.index') }}" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-sage/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-sage/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="pill" class="text-sage w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-sage transition-colors">Pharmacy</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-sage group-hover:w-full transition-all duration-500"></div>
      </a>
    @endif

    @if(auth()->user()->hasPermission('module_lab'))
      <a href="{{ route('operations.diagnostics.lab.index') }}" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-amber-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="flask-conical" class="text-amber-500 w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-amber-500 transition-colors">Laboratory</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-amber-500 group-hover:w-full transition-all duration-500"></div>
      </a>
    @endif

    @if(auth()->user()->hasPermission('module_clinical'))
      <a href="{{ route('specialty.clinics.dental.index') }}" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-white/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-white/5 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="smile" class="text-slate-400 w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-slate-100 transition-colors">Dental Clinic</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-white/40 group-hover:w-full transition-all duration-500"></div>
      </a>
      <a href="{{ route('specialty.clinics.eye.index') }}" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-indigo-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="eye" class="text-indigo-500 w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-indigo-400 transition-colors">Eye Clinic</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-indigo-500 group-hover:w-full transition-all duration-500"></div>
      </a>
    @endif
  </div>
</div>
</x-cc-shell>

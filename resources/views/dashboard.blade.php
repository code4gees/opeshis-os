<x-cc-shell title='Opeshis OS | Command Center'>

@section('title', 'Institutional Command Center - Opeshis OS')

<!-- Auto-Refresh for live telemetry -->
<meta http-equiv="refresh" content="60">

<div class="max-w-[1400px] mx-auto space-y-8 pb-12">
    
    <!-- Hero Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-white/5 pb-8 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-500/5 to-transparent pointer-events-none rounded-xl blur-3xl"></div>
        <div class="relative">
            <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-teal-600/80 mb-2">
                <i class="fas fa-satellite-dish animate-pulse"></i>
                <span>Institutional Telemetry</span>
                <span class="text-white/10">/</span>
                <span class="text-slate-400">Global Overview</span>
            </div>
            <h1 class="text-5xl font-black text-white tracking-tighter uppercase drop-shadow-md">
                Command <span class="text-teal-500">Center</span>
            </h1>
            <p class="text-xs font-bold text-slate-500 mt-3 flex items-center gap-2 uppercase tracking-widest">
                <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.8)]"></span>
                System Synchronized &bull; {{ now()->format('H:i:s T') }}
            </p>
        </div>
        <div class="mt-6 md:mt-0 flex gap-4 relative z-10">
            <button class="px-5 py-3 rounded-xl bg-slate-900 border border-slate-800 text-xs font-black text-slate-300 uppercase tracking-widest hover:text-white hover:border-slate-600 transition-all shadow-lg">
                <i class="fas fa-file-export mr-2 text-slate-500"></i> Export Report
            </button>
            <button class="px-5 py-3 rounded-xl bg-teal-600 border border-teal-500 text-xs font-black text-white uppercase tracking-widest hover:bg-teal-500 transition-all shadow-[0_0_20px_rgba(13,148,136,0.3)]">
                <i class="fas fa-plus-circle mr-2 text-teal-200"></i> Quick Action
            </button>
        </div>
    </div>

    <!-- Institutional KPI Grid (Live Telemetry) -->
    @livewire('dashboard-stats')

    <!-- Main Operational Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
        
        <!-- Left Column: Clinical Stage -->
        <div class="xl:col-span-8 space-y-8">
            
            <!-- Live Active Queue -->
            <div class="bg-[#0f172a]/60 backdrop-blur-xl border border-slate-800/60 rounded-3xl overflow-hidden shadow-2xl">
                <div class="px-6 py-5 border-b border-slate-800/60 flex justify-between items-center bg-slate-900/40">
                    <h3 class="text-sm font-black text-white uppercase tracking-widest flex items-center gap-3">
                        <i class="fas fa-users-rays text-teal-500"></i> Active Operational Queue
                    </h3>
                    <span class="px-3 py-1 bg-teal-500/10 text-teal-400 text-[10px] font-black uppercase tracking-widest rounded-lg border border-teal-500/20">Live Sync</span>
                </div>
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900/20 text-[10px] uppercase tracking-widest text-slate-500 border-b border-slate-800/60">
                                <th class="px-6 py-4 font-black">Patient Identity</th>
                                <th class="px-6 py-4 font-black">Department</th>
                                <th class="px-6 py-4 font-black">Priority</th>
                                <th class="px-6 py-4 font-black text-right">Time Elapsed</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/40">
                            @forelse($active_queue ?? [] as $queue)
                                <tr class="hover:bg-slate-800/20 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-[10px] font-black text-slate-400">
                                                {{ substr(optional($queue->patient)->full_name ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-slate-200 group-hover:text-white transition-colors">{{ optional($queue->patient)->full_name ?? 'Unknown Patient' }}</p>
                                                <p class="text-[10px] text-slate-500 font-medium">ID: {{ optional($queue->patient)->hospital_number ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-bold text-slate-400">{{ $queue->department ?? 'General' }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $priorityClass = $queue->priority === 'urgent' ? 'text-rose-400 bg-rose-500/10 border-rose-500/20' : 'text-amber-400 bg-amber-500/10 border-amber-500/20';
                                            $priorityClass = $queue->priority === 'normal' ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : $priorityClass;
                                        @endphp
                                        <span class="px-2 py-1 rounded border text-[9px] font-black uppercase tracking-widest {{ $priorityClass }}">
                                            {{ $queue->priority ?? 'Normal' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-xs font-bold text-slate-500">
                                        {{ \Carbon\Carbon::parse($queue->created_at)->diffForHumans(null, true) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <i class="fas fa-check-circle text-3xl text-emerald-500/20 mb-3 block"></i>
                                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Queue is clear</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Registration Flow -->
                <div class="bg-[#0f172a]/60 backdrop-blur-xl border border-slate-800/60 rounded-3xl p-6 shadow-2xl">
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="fas fa-chart-area text-slate-500"></i> Admission Trajectory
                    </h3>
                    <div class="h-48">
                        <canvas id="enrollmentChart"></canvas>
                    </div>
                </div>

                <!-- Morbidity Distribution -->
                <div class="bg-[#0f172a]/60 backdrop-blur-xl border border-slate-800/60 rounded-3xl p-6 shadow-2xl relative overflow-hidden">
                    <div class="absolute -right-12 -top-12 w-40 h-40 bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <i class="fas fa-chart-pie text-slate-500"></i> Morbidity Distribution
                    </h3>
                    <div class="h-48 relative z-10">
                        <canvas id="morbidityChart"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Intelligence & Infrastructure -->
        <div class="xl:col-span-4 space-y-8">
            
            <!-- Ward Occupancy (Infrastructure) -->
            <div class="bg-[#0f172a]/60 backdrop-blur-xl border border-slate-800/60 rounded-3xl p-6 shadow-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-building text-slate-500"></i> Facility Occupancy
                    </h3>
                    <button class="text-[9px] font-black text-teal-500 uppercase tracking-widest hover:text-teal-400">Manage</button>
                </div>
                
                <div class="space-y-6">
                    @forelse($wardOccupancy ?? [] as $ward)
                        @php 
                            $total = $ward->beds_count ?? 0;
                            $occupied = $ward->occupied_beds_count ?? 0;
                            $percentage = $total > 0 ? round(($occupied / $total) * 100) : 0;
                            
                            // Color logic: High > 90% (Rose), Med > 70% (Amber), Low (Teal)
                            if($percentage >= 90) {
                                $barColor = 'from-rose-600 to-rose-400 shadow-[0_0_10px_rgba(225,29,72,0.4)]';
                                $textColor = 'text-rose-400';
                            } elseif($percentage >= 70) {
                                $barColor = 'from-amber-600 to-amber-400 shadow-[0_0_10px_rgba(217,119,6,0.4)]';
                                $textColor = 'text-amber-400';
                            } else {
                                $barColor = 'from-teal-600 to-emerald-400 shadow-[0_0_10px_rgba(13,148,136,0.4)]';
                                $textColor = 'text-teal-400';
                            }
                        @endphp
                        <div class="group relative">
                            <div class="flex justify-between items-end mb-2">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-300 group-hover:text-white transition-colors">{{ $ward->name ?? 'Ward' }}</h4>
                                    <p class="text-[9px] font-bold text-slate-500 mt-0.5 uppercase tracking-widest">{{ $occupied }} of {{ $total }} Units Active</p>
                                </div>
                                <span class="text-sm font-black {{ $textColor }}">{{ $percentage }}%</span>
                            </div>
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-slate-800 ring-1 ring-slate-700/50">
                                <div class="h-full bg-gradient-to-r {{ $barColor }} transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-12 h-12 rounded-full bg-slate-800/50 flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-bed text-slate-600"></i>
                            </div>
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">No Active Wards</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Forensic Audit Logs (System Activity) -->
            <div class="bg-[#0f172a]/60 backdrop-blur-xl border border-slate-800/60 rounded-3xl p-6 shadow-2xl">
                <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <i class="fas fa-shield-halved text-slate-500"></i> Forensic Audit Trail
                </h3>
                
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @forelse($auditLogs ?? [] as $log)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-slate-800/50" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-slate-900 border border-slate-700 flex items-center justify-center ring-4 ring-[#0f172a] shadow-inner">
                                            <i class="fas fa-fingerprint text-[10px] text-slate-500"></i>
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-[11px] text-slate-400">
                                                <span class="font-bold text-slate-200">{{ optional($log->user)->name ?? 'System Override' }}</span> 
                                                {{ strtolower(str_replace('_', ' ', $log->action ?? 'modified record')) }}
                                            </p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-[9px] font-black text-slate-600 uppercase tracking-wider">
                                            {{ \Carbon\Carbon::parse($log->created_at)->diffForHumans(null, true) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="py-6 text-center border border-dashed border-slate-800 rounded-xl">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Zero-Trust Log Empty</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
                
                <div class="mt-8 pt-4 border-t border-slate-800/50 text-center">
                    <button class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-white transition-colors">
                        View Complete Audit History &rarr;
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Custom Scrollbar & Variables -->
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
</style>

<!-- High-Fidelity Charting Engine -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Chart.defaults.color = '#64748b'; // slate-500
        Chart.defaults.font.family = 'Inter, sans-serif';
        Chart.defaults.font.size = 10;
        
        const ptCtx = document.getElementById('enrollmentChart');
        if(ptCtx) {
            new Chart(ptCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(isset($patientTrend) ? $patientTrend->pluck('date') : []) !!},
                    datasets: [{
                        label: 'Registrations',
                        data: {!! json_encode(isset($patientTrend) ? $patientTrend->pluck('count') : []) !!},
                        borderColor: '#0d9488', // teal-600
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#0f172a',
                        pointBorderColor: '#14b8a6', // teal-500
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        backgroundColor: (context) => {
                            const ctx = context.chart.ctx;
                            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
                            gradient.addColorStop(0, 'rgba(20, 184, 166, 0.15)'); // teal-500/15
                            gradient.addColorStop(1, 'rgba(20, 184, 166, 0)');
                            return gradient;
                        }
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false, backgroundColor: '#0f172a', titleColor: '#fff', bodyColor: '#cbd5e1', borderColor: '#334155', borderWidth: 1 } },
                    interaction: { mode: 'nearest', axis: 'x', intersect: false },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(51, 65, 85, 0.2)', drawBorder: false } },
                        x: { grid: { display: false, drawBorder: false } }
                    }
                }
            });
        }

        const mCtx = document.getElementById('morbidityChart');
        if(mCtx) {
            new Chart(mCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode(isset($morbidityPulse) ? $morbidityPulse->pluck('provisional_diagnosis') : []) !!},
                    datasets: [{
                        data: {!! json_encode(isset($morbidityPulse) ? $morbidityPulse->pluck('count') : []) !!},
                        backgroundColor: ['#0d9488', '#10b981', '#3b82f6', '#f59e0b', '#8b5cf6'], // Muted teal, emerald, blue, amber, violet
                        borderWidth: 2,
                        borderColor: '#0f172a', // to match background
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '75%',
                    plugins: { 
                        legend: { position: 'right', labels: { boxWidth: 8, usePointStyle: true, font: {size: 10, weight: 'bold'}, color: '#94a3b8' } },
                        tooltip: { backgroundColor: '#0f172a', titleColor: '#fff', bodyColor: '#cbd5e1', borderColor: '#334155', borderWidth: 1 }
                    },
                }
            });
        }
    });
</script>

</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Institutional Dashboard - Opeshis OS')


<!-- Auto-Refresh for live telemetry -->
<meta http-equiv="refresh" content="60">

<div class="max-w-7xl mx-auto space-y-6 pb-12">
    
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-white/5 pb-8">
        <div>
            <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">
                <i class="fas fa-microchip text-blue-500/50"></i>
                <span>Neural Core</span>
                <span class="text-white/10">/</span>
                <span class="text-slate-300">Command Center</span>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase">
                Clinical <span class="text-blue-500">Dashboard</span>
            </h1>
            <p class="text-xs font-medium text-slate-400 mt-2 flex items-center gap-2">
                <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Live institutional telemetry. Updated: {{ now()->format('H:i A') }}
            </p>
        </div>
        <div class="mt-6 md:mt-0 flex gap-3">
            <x-cc-button variant="secondary" icon="fa-calendar-alt">
                View Schedule
            </x-cc-button>
            <x-cc-button icon="fa-plus-circle" onclick="document.getElementById('enrollModal').classList.remove('hidden')">
                New Admission
            </x-cc-button>
        </div>
    </div>

    @php
        $user = auth()->user();
    @endphp

    <!-- Institutional KPI Grid (Live Telemetry) -->
    @livewire('dashboard-stats')

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main Stage (2 Columns Wide) -->
        <div class="lg:col-span-2 space-y-6">
            
            @if($user->hasPermission('module_clinical'))
            @livewire('operational-queue')

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-cc-card title="Registration Trends" icon="fa-chart-line">
                    <div class="h-48">
                        <canvas id="enrollmentChart"></canvas>
                    </div>
                </x-cc-card>

                <x-cc-card title="Morbidity Distribution" icon="fa-chart-pie">
                    <div class="h-48">
                        <canvas id="morbidityChart"></canvas>
                    </div>
                </x-cc-card>
            </div>
            @endif
        </div>

        <!-- Right Panel: Intelligence (1 Column) -->
        <div class="lg:col-span-1 space-y-6">
            
            <x-cc-card title="Institutional Activity" icon="fa-bolt">
                <div class="flow-root mt-2">
                    <ul role="list" class="-mb-8">
                        @forelse($auditLogs ?? [] as $log)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-white/5" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-blue-500/10 flex items-center justify-center ring-4 ring-slate-800">
                                            <i class="fas fa-history text-[10px] text-blue-400"></i>
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-[11px] text-slate-300">
                                                <span class="font-bold text-slate-100">{{ $log->staff_name ?? 'System' }}</span> 
                                                {{ strtolower(str_replace('_', ' ', $log->action)) }}
                                            </p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-[10px] font-bold text-slate-500 uppercase">
                                            {{ \Carbon\Carbon::parse($log->created_at)->diffForHumans(null, true) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="py-4 text-center">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest">No Recent Activity</p>
                        </li>
                        @endforelse
                    </ul>
                </div>
                <div class="mt-6 flex justify-center">
                    <button class="text-sm font-semibold text-blue-500 hover:text-blue-400">View all logs &rarr;</button>
                </div>
            </x-cc-card>

            @if($user->hasPermission('module_clinical'))
            <x-cc-card title="Ward Occupancy" icon="fa-bed-pulse">
                <div class="space-y-6">
                    @forelse($wardOccupancy ?? [] as $ward)
                        @php 
                            $total = $ward->beds_count;
                            $occupied = $ward->occupied_beds_count;
                            $percentage = $total > 0 ? round(($occupied / $total) * 100) : 0;
                            $barColor = $percentage >= 90 ? 'from-rose-500 to-pink-500 shadow-rose-500/20' : ($percentage >= 75 ? 'from-amber-500 to-orange-500 shadow-amber-500/20' : 'from-emerald-500 to-teal-500 shadow-emerald-500/20');
                        @endphp
                        <div class="group">
                            <div class="flex justify-between items-end mb-2">
                                <div>
                                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-200 transition-colors">{{ $ward->name }}</h4>
                                    <p class="text-[10px] font-bold text-slate-500 mt-0.5">{{ $occupied }} of {{ $total }} Units Allocated</p>
                                </div>
                                <span class="text-xs font-black {{ $percentage >= 90 ? 'text-rose-400' : 'text-slate-400' }}">{{ $percentage }}%</span>
                            </div>
                            <div class="h-1.5 w-full overflow-hidden rounded-full bg-white/5 ring-1 ring-white/5">
                                <div class="h-full bg-gradient-to-r {{ $barColor }} transition-all duration-1000 shadow-lg" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">No Active Wards</p>
                        </div>
                    @endforelse
                </div>
            </x-cc-card>
            @endif

        </div>
    </div>
</div>

<!-- Custom Scrollbar -->
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
    /* Tailwind 'group-hover' utilities for bg-slate-750 are approximated using inline CSS or tailwind config, here we use slate-700/80 */
    .bg-slate-750 { background-color: rgba(51, 65, 85, 0.8); }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Chart.defaults.color = '#94a3b8'; // slate-400
        Chart.defaults.font.family = 'Inter, sans-serif';
        
        const ptCtx = document.getElementById('enrollmentChart');
        if(ptCtx) {
            new Chart(ptCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(isset($patientTrend) ? $patientTrend->pluck('date') : []) !!},
                    datasets: [{
                        label: 'Registrations',
                        data: {!! json_encode(isset($patientTrend) ? $patientTrend->pluck('count') : []) !!},
                        borderColor: '#3b82f6', // blue-500
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#1e293b',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        backgroundColor: (context) => {
                            const ctx = context.chart.ctx;
                            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
                            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
                            gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');
                            return gradient;
                        }
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
                    interaction: { mode: 'nearest', axis: 'x', intersect: false },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(51, 65, 85, 0.5)', drawBorder: false } },
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
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                        borderWidth: 2,
                        borderColor: '#1e293b', // slate-800 to match background
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '75%',
                    plugins: { legend: { position: 'right', labels: { boxWidth: 8, usePointStyle: true, font: {size: 11} } } },
                }
            });
        }
    });
</script>
</x-cc-shell>

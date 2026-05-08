<x-cc-shell title='Overview | Opeshis OS'>

<meta http-equiv="refresh" content="60">

<div class="max-w-[1600px] mx-auto space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-2">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Overview</h1>
            <p class="text-sm text-slate-500 mt-1">Live metrics and institutional telemetry.</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <button class="px-4 py-2 rounded-lg bg-[#131824] border border-subtle text-xs font-medium text-slate-300 hover:text-white hover:bg-[#1e293b] transition-colors shadow-sm">
                <i class="fas fa-download mr-2 text-slate-500"></i> Export
            </button>
            <button class="px-4 py-2 rounded-lg bg-sage border border-sage text-xs font-semibold text-[#0b0f19] hover:opacity-90 transition-opacity shadow-sm">
                <i class="fas fa-plus mr-2"></i> New Record
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    @livewire('dashboard-stats')

    <!-- Main Content -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        <!-- Left: Active Queue -->
        <div class="xl:col-span-2 space-y-6">
            
            <div class="bg-panel border border-subtle rounded-xl overflow-hidden">
                <div class="px-5 py-4 border-b border-subtle flex justify-between items-center bg-[#131824]">
                    <h3 class="text-sm font-semibold text-white">Active Queue</h3>
                    <button class="text-xs text-slate-400 hover:text-white transition-colors">View All</button>
                </div>
                <div>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#0b0f19]/50 text-xs text-slate-500 border-b border-subtle">
                                <th class="px-5 py-3 font-medium">Patient</th>
                                <th class="px-5 py-3 font-medium">Department</th>
                                <th class="px-5 py-3 font-medium">Status</th>
                                <th class="px-5 py-3 font-medium text-right">Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-subtle">
                            @forelse($active_queue ?? [] as $queue)
                                <tr class="hover:bg-white/[0.02] transition-colors">
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded bg-[#0b0f19] border border-subtle flex items-center justify-center text-xs font-semibold text-slate-400">
                                                {{ substr(optional($queue->patient)->full_name ?? 'U', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-slate-200">{{ optional($queue->patient)->full_name ?? 'Unknown' }}</p>
                                                <p class="text-xs text-slate-500">{{ optional($queue->patient)->hospital_number ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 text-sm text-slate-400">{{ $queue->department ?? 'General' }}</td>
                                    <td class="px-5 py-3">
                                        @php
                                            $priorityClass = $queue->priority === 'urgent' ? 'text-rose-400 bg-rose-500/10 border-rose-500/20' : 'text-amber-400 bg-amber-500/10 border-amber-500/20';
                                            $priorityClass = $queue->priority === 'normal' ? 'text-sage bg-[#4ade80]/10 border-[#4ade80]/20' : $priorityClass;
                                        @endphp
                                        <span class="px-2 py-0.5 rounded border text-[10px] font-medium {{ $priorityClass }}">
                                            {{ ucfirst($queue->priority ?? 'Normal') }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-right text-sm text-slate-500">
                                        {{ \Carbon\Carbon::parse($queue->created_at)->diffForHumans(null, true) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center text-sm text-slate-500">
                                        No active patients in queue.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-panel border border-subtle rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-white mb-4">Registration Flow</h3>
                    <div class="h-48">
                        <canvas id="enrollmentChart"></canvas>
                    </div>
                </div>

                <div class="bg-panel border border-subtle rounded-xl p-5">
                    <h3 class="text-sm font-semibold text-white mb-4">Diagnostics</h3>
                    <div class="h-48">
                        <canvas id="morbidityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Infrastructure -->
        <div class="xl:col-span-1 space-y-6">
            
            <div class="bg-panel border border-subtle rounded-xl p-5">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-sm font-semibold text-white">Occupancy</h3>
                </div>
                
                <div class="space-y-4">
                    @forelse($wardOccupancy ?? [] as $ward)
                        @php 
                            $total = $ward->beds_count ?? 0;
                            $occupied = $ward->occupied_beds_count ?? 0;
                            $percentage = $total > 0 ? round(($occupied / $total) * 100) : 0;
                            
                            if($percentage >= 90) { $bg = 'bg-rose-500'; }
                            elseif($percentage >= 70) { $bg = 'bg-amber-500'; }
                            else { $bg = 'bg-sage'; }
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="font-medium text-slate-300">{{ $ward->name ?? 'Ward' }}</span>
                                <span class="text-slate-400">{{ $percentage }}%</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-[#0b0f19] border border-subtle overflow-hidden">
                                <div class="h-full {{ $bg }}" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="mt-1 flex justify-between text-xs text-slate-500">
                                <span>{{ $occupied }} occupied</span>
                                <span>{{ $total }} total</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-sm text-slate-500">No active wards.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-panel border border-subtle rounded-xl p-5">
                <h3 class="text-sm font-semibold text-white mb-5">System Log</h3>
                
                <div class="space-y-4">
                    @forelse($auditLogs ?? [] as $log)
                        <div class="flex gap-3">
                            <div class="mt-0.5">
                                <div class="w-2 h-2 rounded-full bg-slate-600"></div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-slate-300">
                                    <span class="font-medium">{{ optional($log->user)->name ?? 'System' }}</span> 
                                    {{ strtolower(str_replace('_', ' ', $log->action ?? 'action')) }}
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-sm text-slate-500">No recent activity.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Chart.defaults.color = '#64748b'; 
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
                        borderColor: '#4ade80', // sage
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#131824',
                        pointBorderColor: '#4ade80',
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        fill: true,
                        backgroundColor: (context) => {
                            const ctx = context.chart.ctx;
                            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
                            gradient.addColorStop(0, 'rgba(74, 222, 128, 0.15)');
                            gradient.addColorStop(1, 'rgba(74, 222, 128, 0)');
                            return gradient;
                        }
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { backgroundColor: '#131824', titleColor: '#fff', bodyColor: '#cbd5e1', borderColor: 'rgba(255,255,255,0.04)', borderWidth: 1 } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.02)', drawBorder: false } },
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
                        backgroundColor: ['#4ade80', '#2dd4bf', '#3b82f6', '#f59e0b', '#8b5cf6'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '80%',
                    plugins: { legend: { position: 'right', labels: { boxWidth: 8, usePointStyle: true, font: {size: 11}, color: '#94a3b8' } } },
                }
            });
        }
    });
</script>

</x-cc-shell>

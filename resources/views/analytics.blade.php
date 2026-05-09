<x-cc-shell title='Opeshis OS'>

@section('title', 'Hospital Analytics - Opeshis OS')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Intelligence <span class="text-sage">Hub</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Performance Tracking, Clinical Outcomes & Resource Velocity</p>
        </div>
        <div class="flex gap-4">
            <button class="cc-button-secondary py-2 px-6">
                Export DHIS2
            </button>
            <button class="cc-button-primary py-2 px-6">
                Generate Dossier
            </button>
        </div>
    </div>

    <!-- Intelligence Telemetry Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <x-cc-stat 
            title="Billing Efficiency" 
            value="{{ number_format($collectionEfficiency, 1) }}%" 
            icon="fa-file-invoice-dollar" 
            trend="+2.1% Alpha" 
            color="emerald" 
        />
        <x-cc-stat 
            title="OPD Wait Matrix" 
            value="{{ $avgWaitTime }}m" 
            icon="fa-clock" 
            trend="Target: 30m" 
            color="amber" 
        />
        <x-cc-stat 
            title="Gross Revenue" 
            value="{{ number_format($totalCollected, 0) }}" 
            icon="fa-vault" 
            trend="XAF Institutional" 
            color="sage" 
        />
        <x-cc-stat 
            title="Registry Velocity" 
            value="{{ $patientGrowth->last()->count ?? 0 }}" 
            icon="fa-user-plus" 
            trend="Current Month" 
            color="indigo" 
        />
    </div>

    <!-- Intelligence Visualizers -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Patient Growth Matrix -->
        <div class="lg:col-span-2">
            <x-cc-card title="Longitudinal Registration Trends" icon="fa-chart-line">
                <div class="p-10 h-[400px]">
                    <canvas id="growthChart"></canvas>
                </div>
            </x-cc-card>
        </div>

        <!-- Clinical Distribution Matrix -->
        <div class="lg:col-span-1">
            <x-cc-card title="Morbidity Distribution" icon="fa-virus-covid">
                <div class="p-10 flex flex-col h-full">
                    <div class="h-60 mb-10">
                        <canvas id="morbidityChart"></canvas>
                    </div>
                    <div class="space-y-4">
                        @foreach($morbidityPulse as $m)
                            <div class="flex justify-between items-center p-4 bg-white/[0.02] border border-white/[0.04] rounded-2xl">
                                <span class="text-[11px] font-bold text-white/40 uppercase tracking-widest truncate max-w-[140px]">{{ $m->diagnosis ?? 'UNKNOWN' }}</span>
                                <span class="text-[12px] font-bold text-sage">{{ $m->count }} <span class="text-[9px] text-white/20 ml-1">NODES</span></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-cc-card>
        </div>
    </div>

    <!-- Supply Chain Risk Matrix -->
    <x-cc-card>
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                <i class="fas fa-box-taped text-rose-500 text-[14px]"></i>
                Critical Supply Depletion Surveillance
            </h2>
            <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 text-[9px] font-bold rounded-lg uppercase tracking-widest">
                RESTOCK_REQUIRED
            </span>
        </div>

        <x-cc-table :headers="['Material Intelligence', 'Stock Density', 'Reorder Matrix', 'Restock']">
            @forelse($supplyRisk as $item)
                <tr class="hover:bg-white/[0.01] transition-colors">
                    <td class="px-8 py-5">
                        <div class="text-[12px] font-bold text-white uppercase tracking-tight">{{ $item->item_name }}</div>
                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">ID: {{ substr($item->id, 0, 8) }}...</div>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-6">
                            <span class="text-[14px] font-bold text-rose-500">{{ $item->stock_level }}</span>
                            <div class="w-24 bg-white/5 h-1 rounded-full overflow-hidden">
                                <div class="bg-rose-500 h-full" style="width: {{ min(100, ($item->stock_level / ($item->reorder_level ?: 1)) * 100) }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="text-[11px] font-bold text-white/20 uppercase tracking-widest">Limit: {{ $item->reorder_level }}</span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <button class="cc-button-secondary py-1.5 px-4 text-[10px]">
                            Authorize Restock
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">All institutional supplies are currently at stable levels.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    Chart.defaults.color = 'rgba(255,255,255,0.2)';
    Chart.defaults.font.family = 'Inter, sans-serif';
    Chart.defaults.font.weight = '700';

    // Growth Matrix Chart
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($patientGrowth->pluck('month')) !!},
            datasets: [{
                label: 'REGISTRATIONS',
                data: {!! json_encode($patientGrowth->pluck('count')) !!},
                borderColor: '#82c09a',
                backgroundColor: 'rgba(130, 192, 154, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#82c09a',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(255,255,255,0.03)' },
                    border: { display: false },
                    ticks: { font: { size: 9 } } 
                },
                x: { 
                    grid: { display: false },
                    border: { display: false },
                    ticks: { font: { size: 9 } } 
                }
            }
        }
    });

    // Morbidity Matrix Chart
    const morbidityCtx = document.getElementById('morbidityChart').getContext('2d');
    new Chart(morbidityCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($morbidityPulse->pluck('diagnosis')) !!},
            datasets: [{
                data: {!! json_encode($morbidityPulse->pluck('count')) !!},
                backgroundColor: ['#82c09a', '#4f46e5', '#f59e0b', '#ef4444', '#06b6d4'],
                borderWidth: 0,
                hoverOffset: 15,
                cutout: '85%',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
});
</script>
</x-cc-shell>

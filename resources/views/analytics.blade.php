<x-cc-shell title='Opeshis OS'>

@section('title', 'Hospital Analytics - Opeshis OS')


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
    
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-slate-800 border border-slate-700/60 rounded-xl p-6 shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-slate-100 tracking-tight">Analytics & Reports</h1>
            <p class="text-sm text-slate-400 mt-1">Institutional performance tracking, clinical outcomes, and resource management.</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <button class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-200 text-xs font-bold rounded-lg transition-colors border border-slate-600">Export DHIS2 Data</button>
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold rounded-lg shadow-sm shadow-blue-500/10 transition-colors">Download PDF Report</button>
        </div>
    </header>

    <!-- KPI Summary Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Billing Efficiency</p>
            <div class="flex items-end gap-2">
                <h3 class="text-4xl font-bold text-slate-100">{{ number_format($collectionEfficiency, 1) }}%</h3>
                <span class="text-xs font-bold text-emerald-500 mb-1">+2.1%</span>
            </div>
            <div class="w-full bg-slate-900 h-1.5 rounded-full mt-6 overflow-hidden">
                <div class="bg-emerald-500 h-full" style="width: {{ $collectionEfficiency }}%"></div>
            </div>
        </div>
        
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Avg. Patient Wait (OPD)</p>
            <div class="flex items-end gap-2">
                <h3 class="text-4xl font-bold text-blue-400">{{ $avgWaitTime }}m</h3>
                <span class="text-xs font-bold text-slate-600 mb-1">Target: 30m</span>
            </div>
        </div>

        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Total Revenue (FCFA)</p>
            <h3 class="text-3xl font-bold text-slate-100">{{ number_format($totalCollected, 0) }}</h3>
            <p class="text-[10px] text-slate-600 mt-2 font-medium">Billed: {{ number_format($totalBilled, 0) }}</p>
        </div>

        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700/60 shadow-sm relative overflow-hidden">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">System Availability</p>
            <h3 class="text-4xl font-bold text-emerald-500 italic">99.9%</h3>
            <div class="flex gap-1 mt-6">
                @for($i=0; $i<15; $i++) <div class="w-2 h-3 bg-emerald-500/20 rounded-sm"></div> @endfor
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Patient Growth -->
        <div class="lg:col-span-2 bg-slate-800 p-8 rounded-xl border border-slate-700/60 shadow-sm">
            <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-8">Patient Registration Trends</h3>
            <div class="h-80">
                <canvas id="growthChart"></canvas>
            </div>
        </div>

        <!-- Clinical Distribution -->
        <div class="lg:col-span-1 bg-slate-800 p-8 rounded-xl border border-slate-700/60 shadow-sm flex flex-col">
            <h3 class="text-sm font-bold text-slate-200 uppercase tracking-wider mb-8 text-center">Top Clinical Diagnoses</h3>
            <div class="h-60 mb-8">
                <canvas id="morbidityChart"></canvas>
            </div>
            <div class="space-y-3">
                @foreach($morbidityPulse as $m)
                    <div class="flex justify-between items-center p-3 bg-slate-900/40 rounded-lg border border-slate-700/40">
                        <span class="text-xs font-semibold text-slate-400 truncate max-w-[140px]">{{ $m->provisional_diagnosis }}</span>
                        <span class="text-xs font-bold text-blue-500">{{ $m->count }} Cases</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Inventory Alerts -->
    <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-700/60 bg-slate-900/40 flex justify-between items-center">
            <h3 class="text-sm font-bold text-rose-400 uppercase tracking-wider">Critical Supply Depletion Warnings</h3>
            <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[10px] font-bold uppercase">Restock Required</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="text-slate-500 border-b border-slate-700/60">
                        <th class="px-8 py-5 font-semibold">Item Name</th>
                        <th class="px-6 py-5 font-semibold text-center">Current Stock</th>
                        <th class="px-6 py-5 font-semibold text-center">Min. Level</th>
                        <th class="px-6 py-5 font-semibold">Stock Status</th>
                        <th class="px-8 py-5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/40">
                    @foreach($supplyRisk as $item)
                    <tr class="hover:bg-slate-700/30 transition-colors">
                        <td class="px-8 py-5">
                            <div class="text-slate-100 font-bold uppercase text-xs">{{ $item->item_name }}</div>
                            <div class="text-[10px] text-slate-500 font-medium mt-1 uppercase">Asset ID: {{ $item->id }}</div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="text-lg font-bold text-rose-500">{{ $item->stock_level }}</span>
                        </td>
                        <td class="px-6 py-5 text-center text-slate-500 font-bold">{{ $item->reorder_level }}</td>
                        <td class="px-6 py-5">
                            <div class="w-40 bg-slate-900 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-rose-500 h-full" style="width: {{ ($item->stock_level / ($item->reorder_level ?: 1)) * 100 }}%"></div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="px-4 py-2 bg-slate-700 hover:bg-rose-600 text-slate-300 hover:text-white rounded-lg text-[10px] font-bold uppercase transition-all">Order Stock</button>
                        </td>
                    </tr>
                    @endforeach
                    @if($supplyRisk->isEmpty())
                    <tr>
                        <td colspan="5" class="px-8 py-16 text-center text-slate-500 italic">
                            All medical supplies are currently at stable levels.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Growth Chart
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($patientGrowth->pluck('month')) !!},
            datasets: [{
                label: 'Patient Registrations',
                data: {!! json_encode($patientGrowth->pluck('count')) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#3b82f6',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#64748b', font: { size: 10, weight: 'bold' } } },
                x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: 10, weight: 'bold' } } }
            }
        }
    });

    // Morbidity Chart
    const morbidityCtx = document.getElementById('morbidityChart').getContext('2d');
    new Chart(morbidityCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($morbidityPulse->pluck('provisional_diagnosis')) !!},
            datasets: [{
                data: {!! json_encode($morbidityPulse->pluck('count')) !!},
                backgroundColor: ['#3b82f6', '#f43f5e', '#fbbf24', '#10b981', '#8b5cf6'],
                borderWidth: 0,
                cutout: '80%',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });
});
</script>
</x-cc-shell>

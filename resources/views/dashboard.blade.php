<x-cc-shell title='Dashboard | Hospital'>

<div class="max-w-[1600px] mx-auto pb-10">

    <!-- TOP ROW METRICS -->
    <div class="grid grid-cols-5 gap-4 mb-6">
        <!-- Card 1 -->
        <div class="bg-card rounded-xl border border-subtle p-4 relative overflow-hidden flex flex-col justify-between h-28">
            <h3 class="text-[12px] text-slate-300 font-medium">Admissions Today</h3>
            <div class="flex items-baseline gap-2 mt-1 relative z-10">
                <span class="text-2xl font-bold text-white">48</span>
                <span class="text-[11px] text-sage font-medium">(+5%)</span>
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
            <h3 class="text-[12px] text-slate-300 font-medium">Discharges Today</h3>
            <div class="flex items-baseline gap-2 mt-1 relative z-10">
                <span class="text-2xl font-bold text-white">32</span>
                <span class="text-[11px] text-alert font-medium">(-2%)</span>
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
                <i class="fas fa-exclamation-circle text-alert text-[10px]"></i>
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
            <h3 class="text-[12px] text-slate-300 font-medium">Staff on Duty</h3>
            <div class="flex items-baseline gap-2 mt-1 relative z-10">
                <span class="text-2xl font-bold text-white">112</span>
            </div>
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
        
        <!-- LEFT COLUMN: Patient Queue -->
        <div class="col-span-5 bg-card rounded-xl border border-subtle flex flex-col h-[700px]">
            <div class="px-5 py-4 flex justify-between items-center border-b border-subtle">
                <h2 class="text-[15px] font-medium text-white">Patient Queue</h2>
                <button class="px-3 py-1 rounded bg-[#2a2e38] text-xs text-slate-300 hover:text-white border border-subtle flex items-center gap-1.5 transition-colors">
                    <i class="fas fa-plus text-[10px]"></i> See All
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto custom-scrollbar">
                <table class="w-full text-left">
                    <thead class="sticky top-0 bg-card z-10 border-b border-subtle">
                        <tr>
                            <th class="px-5 py-3 text-[11px] font-medium text-slate-400">Name</th>
                            <th class="px-5 py-3 text-[11px] font-medium text-slate-400">Status</th>
                            <th class="px-5 py-3 text-[11px] font-medium text-slate-400 flex items-center gap-1">Wait Time <i class="fas fa-sort text-[9px]"></i></th>
                            <th class="px-5 py-3 text-[11px] font-medium text-slate-400">Assigned Doctor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-subtle">
                        @php
                            // Mocking the data to exactly match the mockup strings
                            $mockQueue = [
                                ['name'=>'Benjamin Chen', 'status'=>'Triage', 'time'=>'13 h', 'doctor'=>'Dr. Shtemith'],
                                ['name'=>'Sarah Jenkins', 'status'=>'Consulting', 'time'=>'18 h', 'doctor'=>'Dr. Slatman'],
                                ['name'=>'Elrin Jorsan', 'status'=>'Consulting', 'time'=>'15 min', 'doctor'=>'Dr. Kaderman'],
                                ['name'=>'Jeary Durmon', 'status'=>'Lab Results', 'time'=>'15 h', 'doctor'=>'Dr. Shtemith'],
                                ['name'=>'Jenjamin Chen', 'status'=>'Lab Results', 'time'=>'25 min', 'doctor'=>'Dr. Winzews'],
                                ['name'=>'Sacy Polating', 'status'=>'Consulting', 'time'=>'13 h', 'doctor'=>'Assigned Doctor'],
                                ['name'=>'John Tuner', 'status'=>'Consulting', 'time'=>'15 h', 'doctor'=>'Dr. Kanemark'],
                                ['name'=>'John Futsk', 'status'=>'Lab Results', 'time'=>'20 min', 'doctor'=>'Dr. Shermith'],
                                ['name'=>'Hernie Jolson', 'status'=>'Lab Results', 'time'=>'30 min', 'doctor'=>'Dr. Shtemith'],
                                ['name'=>'Sarah Jenkins', 'status'=>'Consulting', 'time'=>'19 h', 'doctor'=>'Dr. Sntenith'],
                                ['name'=>'Benjanin Chen', 'status'=>'Lab Results', 'time'=>'20 h', 'doctor'=>'Dr. Winzows'],
                                ['name'=>'Rein Eulara', 'status'=>'Consulting', 'time'=>'5 h', 'doctor'=>'Assigned Doctor'],
                                ['name'=>'John Noxon', 'status'=>'Consulting', 'time'=>'20 min', 'doctor'=>'Dr. Kanemark'],
                            ];
                        @endphp
                        @foreach($mockQueue as $index => $q)
                        <tr class="{{ $index % 2 == 0 ? 'bg-transparent' : 'bg-[#1a1d24]/30' }} hover:bg-[#2a2e38] transition-colors group cursor-pointer">
                            <td class="px-5 py-3.5 text-[12px] text-slate-200 font-medium">{{ $q['name'] }}</td>
                            <td class="px-5 py-3.5">
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-medium bg-[#313642] text-slate-300">
                                    {{ $q['status'] }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-[12px] text-slate-300">{{ $q['time'] }}</td>
                            <td class="px-5 py-3.5 text-[12px] text-slate-300">{{ $q['doctor'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-span-7 flex flex-col gap-6 h-[700px]">
            
            <!-- Charts Card -->
            <div class="bg-card rounded-xl border border-subtle p-5 flex flex-col" style="height: 380px;">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-[15px] font-medium text-white">Clinical Charts</h2>
                    <button class="px-3 py-1 rounded bg-[#2a2e38] text-[11px] text-slate-300 border border-subtle">Patient Stats</button>
                </div>
                
                <h3 class="text-[12px] text-slate-300 mb-2 flex items-center justify-between">
                    Patient Inflow over 24h
                    <div class="flex items-center gap-4 text-[10px] text-slate-400">
                        <span class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-sage"></div> Patient</span>
                        <span class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-slate-500"></div> Series</span>
                    </div>
                </h3>
                
                <div class="flex-1 relative">
                    <canvas id="mainChart"></canvas>
                </div>
            </div>

            <!-- Bottom Row in Right Column -->
            <div class="grid grid-cols-2 gap-6 flex-1">
                
                <!-- Bar Chart (Resource Allocation) -->
                <div class="bg-card rounded-xl border border-subtle p-5">
                    <h3 class="text-[12px] text-white mb-4">Resource Allocation by Department</h3>
                    <div class="h-full relative flex items-end justify-between px-2 pb-6 pt-4 border-l border-b border-subtle/50">
                        <!-- Y-axis labels mock -->
                        <div class="absolute -left-6 top-0 bottom-6 flex flex-col justify-between text-[9px] text-slate-500">
                            <span>100</span><span>75</span><span>50</span><span>25</span><span>0</span>
                        </div>
                        
                        <!-- X-axis labels mock -->
                        <div class="absolute -bottom-4 left-0 right-0 flex justify-between px-2 text-[9px] text-slate-500">
                            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span>
                        </div>

                        <!-- Bar Groups Mock -->
                        @foreach([ [40,25],[70,35],[100,60],[40,30],[50,80],[90,40],[40,60],[80,45],[30,90] ] as $bars)
                        <div class="flex gap-1 items-end h-full w-full justify-center">
                            <div class="w-2 bg-[#5d8b76] rounded-t-sm" style="height: {{ $bars[0] }}%"></div>
                            <div class="w-2 bg-[#82c09a] rounded-t-sm" style="height: {{ $bars[1] }}%"></div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Ward Status (Floor Plan Mock) -->
                <div class="bg-card rounded-xl border border-subtle p-5 overflow-hidden">
                    <h3 class="text-[12px] text-white mb-4">Ward Status</h3>
                    
                    <div class="flex gap-4">
                        <!-- Left Block -->
                        <div class="flex-1 border border-subtle rounded p-2 relative">
                            <div class="absolute left-0 top-0 bottom-0 w-6 border-r border-subtle flex items-center justify-center -rotate-90 text-[10px] text-slate-500 tracking-widest">Floor</div>
                            <div class="ml-6 grid grid-cols-2 gap-2 h-full">
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-sage"><i class="fas fa-check-circle text-[10px]"></i></div>
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-slate-600"><i class="fas fa-bed text-[10px]"></i></div>
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-sage"><i class="fas fa-check-circle text-[10px]"></i></div>
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-sage"><i class="fas fa-check-circle text-[10px]"></i></div>
                            </div>
                        </div>
                        <!-- Right Block -->
                        <div class="flex-1 border border-subtle rounded p-2 relative">
                            <div class="absolute left-0 top-0 bottom-0 w-6 border-r border-subtle flex items-center justify-center -rotate-90 text-[10px] text-slate-500 tracking-widest">Floor</div>
                            <div class="ml-6 grid grid-cols-2 gap-2 h-full">
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-slate-600"><i class="fas fa-bed text-[10px]"></i></div>
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-alert"><i class="fas fa-triangle-exclamation text-[10px]"></i></div>
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-sage"><i class="fas fa-check-circle text-[10px]"></i></div>
                                <div class="border border-subtle rounded bg-[#1a1d24] flex items-center justify-center text-alert"><i class="fas fa-times-circle text-[10px]"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

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

</x-cc-shell>

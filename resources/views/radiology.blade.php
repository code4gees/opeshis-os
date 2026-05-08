<x-cc-shell title='Opeshis OS'>

@section('title', 'Radiology Command - Opeshis OS')


<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-100 uppercase tracking-tighter">Radiology & Imaging</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Diagnostic Imaging Worklist & PACS Integration</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="px-4 py-2 bg-slate-900/40 rounded-xl border border-slate-700/60 flex items-center gap-3">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.4)]"></div>
                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">PACS Link: Active</span>
            </div>
        </div>
    </div>

    <!-- Radiology KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Imaging Queue" 
            value="{{ count($orders) }}" 
            icon="fa-microscope" 
            trend="Active Orders" 
            color="blue" 
        />
        <x-cc-stat 
            title="Total Studies" 
            value="{{ count($orders) + 12 }}" 
            icon="fa-file-waveform" 
            trend="Last 24 Hours" 
            color="indigo" 
        />
        <x-cc-stat 
            title="TAT Average" 
            value="42m" 
            icon="fa-clock" 
            trend="Turnaround Time" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Active PACs" 
            value="01" 
            icon="fa-server" 
            trend="Node Status" 
            color="slate" 
        />
    </div>

    <!-- Sub-Navigation -->
    <div class="flex flex-wrap border-b border-slate-700/60 gap-8 px-2">
        @foreach([
            ['pending', 'Imaging Queue'],
            ['archive', 'Diagnostic History'],
            ['catalog', 'Modality List']
        ] as [$id, $label])
        <a href="{{ route('radiology', ['subtab' => $id]) }}" class="pb-4 text-xs font-black uppercase tracking-widest border-b-2 transition-all {{ $tab === $id ? 'text-blue-500 border-blue-500' : 'text-slate-500 border-transparent hover:text-slate-300' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    @if($tab !== 'catalog')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Column: Worklist -->
        <div class="lg:col-span-2 space-y-8">
            <x-cc-card :title="$tab === 'pending' ? 'Active Imaging Worklist' : 'Diagnostic Archive'" icon="fa-list-ul">
                <x-cc-table :headers="['Patient Identity', 'Investigation', 'Clinical Notes', 'Strategic Actions']">
                    @forelse($orders as $o)
                        <tr class="group hover:bg-blue-500/[0.02] transition-colors">
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="flex items-center">
                                    <div class="h-9 w-9 flex-shrink-0 rounded-full bg-blue-500/10 flex items-center justify-center border border-blue-500/20 text-blue-400 font-bold text-xs">
                                        {{ substr($o->full_name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-blue-400 transition-colors">{{ $o->full_name }}</div>
                                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $o->medical_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded text-[9px] font-black uppercase tracking-widest">{{ $o->test_name }}</span>
                                <div class="text-[10px] font-bold text-slate-500 uppercase mt-1">{{ date('d M, H:i', strtotime($o->ordered_at)) }}</div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="text-[10px] text-slate-400 italic max-w-[180px] truncate">"{{ $o->indications ?? 'Routine assessment' }}"</div>
                                <div class="text-[9px] font-black text-slate-600 uppercase tracking-widest mt-1">Ref: Dr. {{ $o->doctor_name }}</div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                @if($tab === 'pending')
                                    <x-cc-button variant="ghost" size="sm" icon="fa-file-signature" color="blue" onclick="openReportingModal('{{ $o->id }}', '{{ $o->full_name }}', '{{ $o->test_name }}')">
                                        Submit Report
                                    </x-cc-button>
                                @else
                                    <div class="flex justify-end gap-2">
                                        @if($o->image_url)
                                            <x-cc-button variant="ghost" size="sm" icon="fa-image" color="emerald" href="{{ url($o->image_url) }}" target="_blank">
                                                Image
                                            </x-cc-button>
                                        @endif
                                        <x-cc-button variant="ghost" size="sm" icon="fa-file-pdf" color="slate">
                                            Report
                                        </x-cc-button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-600 italic text-sm">Imaging worklist is currently empty.</td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Right Column: Modality Status -->
        <div class="space-y-8">
            <x-cc-card title="Modality Status" icon="fa-plug">
                <div class="space-y-3">
                    @foreach([
                        ['X-Ray Machine', 'Available', 'emerald'],
                        ['CT Scanner', 'Available', 'emerald'],
                        ['MRI Unit', 'Maintenance', 'amber'],
                        ['Ultrasound', 'In Use', 'blue']
                    ] as [$name, $status, $color])
                        <div class="flex justify-between items-center p-3 bg-slate-900/40 border border-slate-700/60 rounded-xl group hover:border-blue-500/30 transition-all">
                            <span class="text-[11px] font-black text-slate-300 uppercase tracking-tight">{{ $name }}</span>
                            <span class="text-[9px] font-black text-{{ $color }}-500 uppercase tracking-widest">{{ $status }}</span>
                        </div>
                    @endforeach
                </div>
            </x-cc-card>

            <x-cc-card title="Unit Intelligence" icon="fa-brain">
                <p class="text-[10px] font-bold text-slate-500 leading-relaxed uppercase tracking-wider">
                    Institutional throughput is currently 85% of rated capacity.TAT for STAT orders is maintained at < 15 minutes.
                </p>
            </x-cc-card>
        </div>
    </div>
    @endif
</div>

<!-- Modal: Reporting -->
<x-cc-modal id="reportingModal" title="Diagnostic Reporting Protocol" icon="fa-file-waveform">
    <div class="mb-6 p-4 bg-blue-500/5 border border-blue-500/10 rounded-xl">
        <h4 id="modalPatient" class="text-xs font-black text-slate-200 uppercase tracking-tight">--</h4>
        <p id="modalTest" class="text-[10px] font-black text-blue-500 uppercase tracking-widest mt-1">--</p>
    </div>
    
    <form method="POST" action="{{ url('/radiology/action') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="action" value="submit_result">
        <input type="hidden" name="order_id" id="modalOrderId">
        
        <div class="space-y-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Radiological Findings</label>
                <textarea name="findings" required class="w-full h-40 bg-slate-900/50 border border-slate-700/60 rounded-xl p-4 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 resize-none no-scrollbar" placeholder="Enter detailed observations..."></textarea>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Diagnostic Impression</label>
                <input name="impression" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600" placeholder="Final interpretation">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Digital Scan (Upload)</label>
                    <input type="file" name="scan_file" class="w-full text-[10px] text-slate-400 bg-slate-900/50 border border-slate-700/60 rounded-xl p-2 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Reporting Clinician</label>
                    <select name="technician_id" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                        @foreach($technicians as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="flex gap-3 pt-4">
            <x-cc-button type="submit" color="blue" class="w-full uppercase tracking-widest">Authorize Diagnostic Report</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
    function openReportingModal(id, patient, test) {
        document.getElementById('modalOrderId').value = id;
        document.getElementById('modalPatient').innerText = patient;
        document.getElementById('modalTest').innerText = test;
        document.getElementById('reportingModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

<script>
    function openReportingModal(id, patient, test) {
        document.getElementById('modalOrderId').value = id;
        document.getElementById('modalPatient').innerText = patient;
        document.getElementById('modalTest').innerText = test;
        document.getElementById('reportingModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

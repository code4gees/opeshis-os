<x-cc-shell title='Radiology Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Radiology & Imaging</h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Diagnostic Imaging Worklist · PACS Integration · Modality Surveillance</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="px-5 py-2.5 bg-white/[0.02] rounded-2xl border border-white/[0.04] flex items-center gap-3">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">PACS Link: Operational</span>
            </div>
        </div>
    </div>

    <!-- Radiology Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Imaging Queue" value="{{ count($orders) }}" icon="fa-microscope" trend="Active Orders" color="blue" />
        <x-cc-stat title="Total Studies" value="{{ count($orders) + 12 }}" icon="fa-file-waveform" trend="Last 24 Hours" color="indigo" />
        <x-cc-stat title="TAT Average" value="42m" icon="fa-clock" trend="Turnaround Time" color="emerald" />
        <x-cc-stat title="Modality Health" value="Stable" icon="fa-server" trend="Node Status" color="slate" />
    </div>

    <!-- Sub-Navigation Matrix -->
    <div class="flex flex-wrap border-b border-white/[0.04] gap-10 px-2 mb-10">
        @foreach([
            ['pending', 'Imaging Queue'],
            ['archive', 'Diagnostic Archive'],
            ['catalog', 'Modality List']
        ] as [$id, $label])
            <a href="{{ route('operations.diagnostics.radiology', ['subtab' => $id]) }}" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all relative {{ $tab === $id ? 'text-sage' : 'text-white/20 hover:text-white/40' }}">
                {{ $label }}
                @if($tab === $id)
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-sage shadow-[0_0_8px_rgba(130,192,154,0.4)]"></div>
                @endif
            </a>
        @endforeach
    </div>

    @if($tab !== 'catalog')
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Main Worklist Column -->
            <div class="lg:col-span-8 space-y-8">
                <x-cc-card class="overflow-hidden">
                    <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                        <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">
                            {{ $tab === 'pending' ? 'Active Imaging Worklist' : 'Diagnostic Archive' }}
                        </h3>
                    </div>

                    <x-cc-table :headers="['Patient Identity', 'Investigation Protocol', 'Clinical Disclosure', 'Strategic Action']">
                        @forelse($orders as $o)
                            <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-5">
                                        <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-sage/10 group-hover:text-sage group-hover:border-sage/20 transition-all">
                                            {{ substr($o->full_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $o->full_name }}</div>
                                            <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $o->medical_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                                        {{ $o->test_name }}
                                    </span>
                                    <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-2">{{ date('d M, H:i', strtotime($o->ordered_at)) }} Z</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-[11px] text-white/40 font-bold uppercase tracking-tight leading-relaxed max-w-[200px] truncate">"{{ $o->indications ?? 'ROUTINE_ASSESSMENT' }}"</div>
                                    <div class="text-[10px] font-bold text-white/10 uppercase tracking-widest mt-1">Ref: DR. {{ strtoupper($o->doctor_name) }}</div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    @if($tab === 'pending')
                                        <x-cc-button variant="ghost" size="sm" icon="fa-file-signature" color="blue" onclick="openReportingModal('{{ $o->id }}', '{{ $o->full_name }}', '{{ $o->test_name }}')">
                                            Authorize Report
                                        </x-cc-button>
                                    @else
                                        <div class="flex justify-end gap-3">
                                            @if($o->image_url)
                                                <x-cc-button variant="ghost" size="sm" icon="fa-image" color="emerald" href="{{ url($o->image_url) }}" target="_blank">
                                                    PACS VIEW
                                                </x-cc-button>
                                            @endif
                                            <x-cc-button variant="ghost" size="sm" icon="fa-file-pdf" color="slate">
                                                Dossier
                                            </x-cc-button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6 border border-white/5">
                                        <i class="fas fa-microscope text-white/10 text-xl"></i>
                                    </div>
                                    <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Imaging worklist is baseline.</p>
                                </td>
                            </tr>
                        @endforelse
                    </x-cc-table>
                </x-cc-card>
            </div>

            <!-- Side Column: Modality Intelligence -->
            <div class="lg:col-span-4 space-y-8">
                <x-cc-card class="p-8">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mb-8 flex items-center gap-3">
                        <i class="fas fa-plug text-blue-500"></i>
                        Modality Matrix
                    </h3>
                    <div class="space-y-4">
                        @foreach([
                            ['X-Ray Machine', 'Available', 'emerald'],
                            ['CT Scanner', 'Available', 'emerald'],
                            ['MRI Unit', 'Maintenance', 'amber'],
                            ['Ultrasound', 'In Use', 'blue']
                        ] as [$name, $status, $color])
                            <div class="flex justify-between items-center p-4 bg-white/[0.01] border border-white/[0.04] rounded-2xl group hover:border-blue-500/20 transition-all">
                                <span class="text-[11px] font-bold text-white/40 uppercase tracking-tighter">{{ $name }}</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500 {{ $status === 'Available' ? 'animate-pulse' : '' }}"></div>
                                    <span class="text-[9px] font-black text-{{ $color }}-500 uppercase tracking-widest">{{ $status }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-cc-card>

                <x-cc-card class="p-8 bg-gradient-to-br from-white/5 to-transparent">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mb-4">Unit Intelligence</h3>
                    <p class="text-[11px] font-bold text-white/40 leading-relaxed uppercase tracking-tight">
                        Institutional throughput is currently 85% of rated capacity. TAT for STAT orders is maintained at < 15 minutes.
                    </p>
                </x-cc-card>
            </div>
        </div>
    @endif
</div>

<!-- Modal: Reporting Protocol -->
<x-cc-modal id="reportingModal" title="Diagnostic Reporting Protocol" icon="fa-file-waveform">
    <div class="mb-8 p-5 bg-white/[0.02] border border-white/[0.04] rounded-2xl">
        <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-1">Subject Principal</p>
        <h4 id="modalPatient" class="text-[14px] font-black text-white uppercase tracking-tight">--</h4>
        <div class="mt-4 flex items-center gap-2">
            <div class="px-2 py-0.5 bg-sage/10 text-sage border border-sage/20 rounded text-[9px] font-black uppercase tracking-widest" id="modalTest">--</div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('operations.diagnostics.radiology.action') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="action" value="submit_result">
        <input type="hidden" name="order_id" id="modalOrderId">
        
        <div class="space-y-2">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Radiological Findings</label>
            <textarea name="findings" required class="w-full h-44 bg-card/50 border border-subtle rounded-xl p-5 text-xs font-bold text-white placeholder-slate-600 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none no-scrollbar" placeholder="ENTER DETAILED OBSERVATIONS..."></textarea>
        </div>

        <x-cc-input label="Diagnostic Impression" name="impression" required placeholder="FINAL INTERPRETATION" icon="fa-stethoscope" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <x-cc-input label="Digital Scan (PACS Upload)" name="scan_file" type="file" icon="fa-cloud-upload" />
            
            <x-cc-select label="Reporting Clinician" name="technician_id" required icon="fa-user-md">
                @foreach($technicians as $t)
                    <option value="{{ $t->id }}">{{ strtoupper($t->name) }}</option>
                @endforeach
            </x-cc-select>
        </div>
        
        <div class="pt-6">
            <x-cc-button type="submit" color="blue" class="w-full">Authorize Diagnostic Report</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
    function openReportingModal(id, patient, test) {
        document.getElementById('modalOrderId').value = id;
        document.getElementById('modalPatient').innerText = patient.toUpperCase();
        document.getElementById('modalTest').innerText = test.toUpperCase();
        document.getElementById('reportingModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

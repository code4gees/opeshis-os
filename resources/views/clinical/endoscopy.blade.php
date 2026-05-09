<x-cc-shell title='Endoscopy Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Endoscopy <span class="text-indigo-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Gastrointestinal Intelligence · Procedural Visualization · Diagnostic Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus" color="indigo" variant="ghost" onclick="document.getElementById('bookingModal').classList.remove('hidden')">
                Authorize Booking
            </x-cc-button>
            <x-cc-button icon="fa-sink" color="slate" variant="ghost" onclick="document.getElementById('reproModal').classList.remove('hidden')">
                Log Reprocessing
            </x-cc-button>
        </div>
    </div>

    <!-- Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Daily Procedures" :value="$dailyList->count()" icon="fa-calendar-day" trend="Active Matrix" color="indigo" />
        <x-cc-stat title="Total Bookings" :value="$allBookings->count()" icon="fa-book-medical" trend="Institutional Log" color="sky" />
        <x-cc-stat title="Scope Status" value="Optimal" icon="fa-microscope" trend="Decontaminated" color="emerald" />
        <x-cc-stat title="Hub Pulse" value="Synced" icon="fa-network-wired" trend="Operational" color="slate" />
    </div>

    <!-- Case Surveillance Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Endoscopy Clinical Surveillance Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">Live Registry Sync</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Procedure & Indication', 'Clinical Status', 'Strategic Actions']">
            @forelse($dailyList as $d)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ substr($d->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $d->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $d->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="p-4 bg-white/[0.02] rounded-xl border border-white/[0.04] max-w-[300px]">
                            <div class="text-[11px] text-indigo-400 font-bold uppercase tracking-widest mb-2">{{ $d->procedure_type }}</div>
                            <p class="text-[11px] text-white/40 font-bold leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $d->indication }}"</p>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusMap = [
                                'booked' => ['cls' => 'bg-sky-500/10 text-sky-500 border-sky-500/20', 'label' => 'SCHEDULED'],
                                'reported' => ['cls' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20', 'label' => 'FINALIZED'],
                                'cancelled' => ['cls' => 'bg-rose-500/10 text-rose-500 border-rose-500/20', 'label' => 'ABORTED']
                            ];
                            $s = $statusMap[$d->status] ?? ['cls' => 'bg-white/5 text-white/20 border-white/10', 'label' => strtoupper($d->status)];
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $s['cls'] }} text-[9px] font-black uppercase tracking-widest">
                            {{ $s['label'] }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3">
                            <x-cc-button variant="ghost" size="sm" icon="fa-file-medical" color="indigo" onclick="openReportModal('{{ $d->id }}')">Report</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-vial" color="sky" onclick="openBiopsyModal('{{ $d->id }}')">Biopsy</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center">
                        <i class="fas fa-microscope text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active endoscopic principals identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Endoscopy Booking -->
<x-cc-modal id="bookingModal" title="Authorize Endoscopy Booking" icon="fa-calendar-plus">
    <form method="POST" action="{{ url('/clinical/endoscopy/booking') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Institutional Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Procedure Type Matrix" name="procedure_type" icon="fa-list-check">
                <option value="OGD">OGD_ESOPHAGOGASTRODUODENOSCOPY</option>
                <option value="Colonoscopy">COLONOSCOPY_FULL</option>
                <option value="Sigmoidoscopy">SIGMOIDOSCOPY_FLEXIBLE</option>
                <option value="ERCP">ERCP_CHOLEDOCHOSCOPY</option>
                <option value="Bronchoscopy">BRONCHOSCOPY_PULMONARY</option>
            </x-cc-select>
            <x-cc-input label="Scope Identifier" name="scope_id" required placeholder="SCOPE-X200" icon="fa-microchip" />
        </div>
        <x-cc-input label="Clinical Indication Matrix" name="indication" required placeholder="INDICATIONS_RATIONALE..." icon="fa-clipboard-question" />
        <x-cc-input label="Scheduled Temporal Vector" name="scheduled_date" type="date" required icon="fa-calendar-day" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Booking Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Save Report -->
<x-cc-modal id="reportModal" title="Commit Procedure Intelligence" icon="fa-file-medical">
    <form method="POST" action="{{ url('/clinical/endoscopy/report') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="booking_id" id="reportBookingId">
        <x-cc-input label="Macroscopic Findings" name="macroscopic" required placeholder="MACROSCOPIC_DATA_DISCLOSURE..." icon="fa-eye" />
        <x-cc-input label="Microscopic Disclosure" name="microscopic" placeholder="MICROSCOPIC_DATA_DISCLOSURE..." icon="fa-microscope" />
        <x-cc-input label="Clinical Impression Matrix" name="impression" required placeholder="IMPRESSION_PROTOCOL..." icon="fa-brain" />
        <x-cc-input label="Therapeutic Recommendations" name="recommendations" required placeholder="MANAGEMENT_VECTOR_STRATEGY..." icon="fa-route" />
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Commit Procedure Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Add Biopsy -->
<x-cc-modal id="biopsyModal" title="Commit Biopsy Intelligence" icon="fa-vial">
    <form method="POST" action="{{ url('/clinical/endoscopy/biopsy') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="booking_id" id="biopsyBookingId">
        <x-cc-input label="Anatomical Biopsy Site" name="site" required placeholder="BIOPSY_SITE_PROTOCOL" icon="fa-location-dot" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Specimen Quantity" name="pieces" type="number" required icon="fa-hashtag" />
            <x-cc-select label="Histology Relay" name="histology" icon="fa-share-nodes">
                <option value="1">HISTOLOGY_AUTHORIZED</option>
                <option value="0">INTERNAL_LOG_ONLY</option>
            </x-cc-select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full">Commit Biopsy Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Reprocessing -->
<x-cc-modal id="reproModal" title="Commit Reprocessing Intelligence" icon="fa-sink">
    <form method="POST" action="{{ url('/clinical/endoscopy/reprocessing') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Scope Identifier" name="scope_id" required placeholder="SCOPE-X200" icon="fa-microchip" />
            <x-cc-select label="Disinfection Cycle" name="cycle_type" icon="fa-rotate">
                <option value="manual">MANUAL_CLEANING_PROTOCOL</option>
                <option value="automated">AER_AUTOMATED_PROTOCOL</option>
            </x-cc-select>
        </div>
        <x-cc-input label="Disinfectant Agent" name="disinfectant" required placeholder="CIDEX_OPA_OR_EQUIV" icon="fa-flask-vial" />
        <x-cc-select label="Sterility Matrix" name="passed" icon="fa-shield-check">
            <option value="1">PASSED_STERILE</option>
            <option value="0">FAILED_RECONTAMINATED</option>
        </x-cc-select>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Commit Decontamination Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openReportModal(id) {
    document.getElementById('reportBookingId').value = id;
    document.getElementById('reportModal').classList.remove('hidden');
}
function openBiopsyModal(id) {
    document.getElementById('biopsyBookingId').value = id;
    document.getElementById('biopsyModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

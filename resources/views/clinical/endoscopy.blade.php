<x-cc-shell title='Opeshis OS'>

@section('title', 'Endoscopy Procedural Hub — Opeshis OS')


<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-200 uppercase tracking-tighter">Endoscopy Command</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Gastrointestinal Intelligence · Procedural Visualization · Diagnostic Matrix Hub</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-plus" color="indigo" variant="ghost" onclick="document.getElementById('bookingModal').classList.remove('hidden')">
                Authorize Booking
            </x-cc-button>
            <x-cc-button icon="fa-sink" color="slate" variant="ghost" onclick="document.getElementById('reproModal').classList.remove('hidden')">
                Log Reprocessing
            </x-cc-button>
        </div>
    </div>

    <!-- Endoscopy Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Daily Procedures" 
            value="{{ $dailyList->count() }}" 
            icon="fa-calendar-day" 
            trend="Active Matrix" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Total Bookings" 
            value="{{ $allBookings->count() }}" 
            icon="fa-book-medical" 
            trend="Institutional Log" 
            color="sky" 
        />
        <x-cc-stat 
            title="Scope Status" 
            value="Optimal" 
            icon="fa-microscope" 
            trend="Decontaminated" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Hub Pulse" 
            value="Synced" 
            icon="fa-network-wired" 
            trend="Institutional Log" 
            color="slate" 
        />
    </div>

    <!-- Endoscopy Clinical Surveillance Matrix -->
    <x-cc-card title="Endoscopy Clinical Surveillance Matrix (Daily)" icon="fa-database">
        <x-cc-table :headers="['Patient Identity', 'Procedure & Indication', 'Clinical Status', 'Strategic Actions']">
            @forelse($dailyList as $d)
                <tr class="group hover:bg-indigo-500/[0.02] transition-colors border-b border-slate-800/50 last:border-0">
                    <td class="px-5 py-6">
                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-indigo-400 transition-colors italic">{{ $d->patient->full_name }}</div>
                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-1">{{ $d->patient->medical_id }}</div>
                    </td>
                    <td class="px-5 py-6">
                        <div class="p-3 bg-slate-900/50 rounded-xl border border-slate-700/60 italic">
                            <div class="text-[10px] text-indigo-400 font-black uppercase tracking-widest mb-1">{{ $d->procedure_type }}</div>
                            <p class="text-[10px] text-slate-400 font-bold leading-relaxed uppercase tracking-tight line-clamp-2">"{{ $d->indication }}"</p>
                        </div>
                    </td>
                    <td class="px-5 py-6">
                        <div class="flex items-center gap-2">
                            @php
                                $statusColors = [
                                    'booked' => 'sky',
                                    'reported' => 'emerald',
                                    'cancelled' => 'rose'
                                ];
                                $color = $statusColors[$d->status] ?? 'slate';
                            @endphp
                            <span class="px-3 py-1 bg-{{ $color }}-500/10 text-{{ $color }}-400 border border-{{ $color }}-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest italic shadow-lg shadow-{{ $color }}-500/5">
                                {{ $d->status }}
                            </span>
                        </div>
                    </td>
                    <td class="px-5 py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-file-medical" color="indigo" onclick="openReportModal('{{ $d->id }}')">Report</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-vial" color="sky" onclick="openBiopsyModal('{{ $d->id }}')">Biopsy</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-600 italic text-sm">No active endoscopic principals identified in the daily matrix.</td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Endoscopy Booking -->
<x-cc-modal id="bookingModal" title="Authorize Endoscopy Booking Protocol" icon="fa-calendar-plus">
    <form method="POST" action="{{ url('/clinical/endoscopy/booking') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Institutional Patient Identity</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Procedure Type</label>
                <select name="procedure_type" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
                    <option value="OGD">OGD_ESOPHAGOGASTRODUODENOSCOPY</option>
                    <option value="Colonoscopy">COLONOSCOPY_FULL</option>
                    <option value="Sigmoidoscopy">SIGMOIDOSCOPY_FLEXIBLE</option>
                    <option value="ERCP">ERCP_CHOLEDOCHOSCOPY</option>
                    <option value="Bronchoscopy">BRONCHOSCOPY_PULMONARY</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Scope Identifier</label>
                <input name="scope_id" required placeholder="SCOPE-X200" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Clinical Indication Matrix</label>
            <textarea name="indication" required rows="2" placeholder="INDICATIONS_RATIONALE..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Scheduled Temporal Vector</label>
            <input name="scheduled_date" type="date" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Authorize Booking Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Save Report -->
<x-cc-modal id="reportModal" title="Commit Endoscopy Procedure Intelligence" icon="fa-file-medical">
    <form method="POST" action="{{ url('/clinical/endoscopy/report') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="booking_id" id="reportBookingId">
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Macroscopic Findings Disclosure</label>
            <textarea name="macroscopic" required rows="3" placeholder="MACROSCOPIC_DATA..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Microscopic / Biopsy Disclosure (Optional)</label>
            <textarea name="microscopic" rows="2" placeholder="MICROSCOPIC_DATA..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Clinical Impression Matrix</label>
            <input name="impression" required placeholder="IMPRESSION_PROTOCOL" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Therapeutic Recommendations</label>
            <textarea name="recommendations" required rows="2" placeholder="MANAGEMENT_VECTOR..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase no-scrollbar"></textarea>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full uppercase tracking-widest">Commit Procedure Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Add Biopsy -->
<x-cc-modal id="biopsyModal" title="Commit Endoscopic Biopsy Intelligence" icon="fa-vial">
    <form method="POST" action="{{ url('/clinical/endoscopy/biopsy') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="booking_id" id="biopsyBookingId">
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Anatomical Biopsy Site</label>
            <input name="site" required placeholder="BIOPSY_SITE_PROTOCOL" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600 uppercase">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Specimen Quantity (Pieces)</label>
                <input name="pieces" type="number" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Sent to Histology</label>
                <select name="histology" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-sky-600">
                    <option value="1">HISTOLOGY_RELAY_AUTHORIZED</option>
                    <option value="0">INTERNAL_ONLY_LOG</option>
                </select>
            </div>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="sky" class="w-full uppercase tracking-widest">Commit Biopsy Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Reprocessing -->
<x-cc-modal id="reproModal" title="Commit Scope Reprocessing Intelligence" icon="fa-sink">
    <form method="POST" action="{{ url('/clinical/endoscopy/reprocessing') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Scope Identifier</label>
                <input name="scope_id" required placeholder="SCOPE-X200" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600 uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Disinfection Cycle</label>
                <select name="cycle_type" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
                    <option value="manual">MANUAL_CLEANING_PROTOCOL</option>
                    <option value="automated">AER_AUTOMATED_PROTOCOL</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Disinfectant Agent</label>
            <input name="disinfectant" required placeholder="CIDEX_OPA_OR_EQUIV" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600 uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Sterility Test Passed</label>
            <select name="passed" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
                <option value="1">PASSED_STERILE</option>
                <option value="0">FAILED_RECONTAMINATED</option>
            </select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full uppercase tracking-widest">Commit Decontamination Intelligence</x-cc-button>
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

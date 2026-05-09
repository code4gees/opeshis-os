<x-cc-shell title='Ward Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Ward <span class="text-sage">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Bed Management & Inpatient Census · Live Occupancy Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-stat title="Occupancy" value="{{ $occupancyRate }}%" icon="fa-bed" trend="Active Beds" color="sage" compact />
            <x-cc-stat title="Census" value="{{ $admissions->count() }}" icon="fa-users" trend="Inpatients" color="indigo" compact />
            <x-cc-button icon="fa-plus" color="indigo" variant="ghost" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Admission
            </x-cc-button>
        </div>
    </div>

    <!-- Ward Operational Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        @forelse($wards as $w)
            @php
                $total = $w->beds->count();
                $occupied = $w->beds->where('status', 'occupied')->count();
                $available = $total - $occupied;
                $rate = $total > 0 ? round(($occupied / $total) * 100) : 0;
            @endphp
            <x-cc-card class="group hover:border-sage/20 transition-all duration-500">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-sage border border-white/5 group-hover:scale-110 transition-transform">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <span class="px-2 py-1 bg-white/5 border border-white/10 rounded-lg text-[8px] font-black text-white/20 uppercase tracking-widest">{{ $w->type ?: 'General' }}</span>
                </div>
                <h4 class="text-[13px] font-bold text-white uppercase tracking-tight mb-4">{{ $w->name }}</h4>
                
                <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden mb-4 border border-white/5 p-[1px]">
                    <div class="h-full rounded-full transition-all duration-1000 
                        {{ $rate >= 90 ? 'bg-rose-500' : ($rate >= 70 ? 'bg-amber-500' : 'bg-sage shadow-[0_0_10px_rgba(130,192,154,0.3)]') }}"
                        style="width: {{ $rate }}%"></div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-black text-white/10 uppercase tracking-widest">
                        <span class="text-white/40">{{ $available }}</span> / {{ $total }} FREE
                    </span>
                    <span class="text-[11px] font-bold {{ $rate >= 90 ? 'text-rose-500' : ($rate >= 70 ? 'text-amber-400' : 'text-sage') }}">
                        {{ $rate }}%
                    </span>
                </div>
            </x-cc-card>
        @empty
            <div class="col-span-full">
                <x-cc-card class="py-12 text-center">
                    <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Institutional Wards Not Configured</p>
                </x-cc-card>
            </div>
        @endforelse
    </div>

    <!-- Inpatient Census Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Inpatient Census Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                <span class="text-[9px] font-black text-sage uppercase tracking-widest">{{ $admissions->count() }} Synchronized</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Identity', 'Inpatient Allocation', 'Primary Diagnosis', 'Admission Depth', 'Protocol Status', 'Forensic Actions']">
            @forelse($admissions as $a)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-indigo-500/10 group-hover:text-indigo-500 group-hover:border-indigo-500/20 transition-all">
                                {{ strtoupper(substr($a->patient->full_name ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $a->patient->full_name ?? 'Unknown Entity' }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $a->patient->medical_id ?? 'IDENTITY_UNDEFINED' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight">{{ $a->bed->ward->name ?? 'Allocation Unknown' }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">BED: {{ $a->bed->bed_number ?? '—' }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] text-white/40 font-bold uppercase tracking-tight truncate max-w-[200px]">"{{ $a->diagnosis_at_admission ?? 'Observation' }}"</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-[11px] font-bold text-white/20 uppercase tracking-widest">{{ \Carbon\Carbon::parse($a->admission_date ?? $a->created_at)->diffForHumans() }}</span>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $status = $a->status ?? 'admitted';
                            $statusCls = $status === 'critical' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-white/5 text-white/40 border-white/10';
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $statusCls }} text-[9px] font-black uppercase tracking-widest">
                            {{ $status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-cc-button variant="ghost" size="sm" icon="fa-heartbeat" color="indigo">Vitals</x-cc-button>
                            <x-cc-button variant="ghost" size="sm" icon="fa-door-open" color="rose" onclick="openDischargeModal('{{ $a->id }}')">Discharge</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <i class="fas fa-hospital-user text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Census Inventory Empty</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Authorize Admission -->
<x-cc-modal id="admitModal" title="Authorize Maternal Admission" icon="fa-plus-circle">
    <form method="POST" action="{{ route('admissions.admit') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Patient Identity" name="patient_id" required placeholder="Enter Patient UUID or Medical ID" icon="fa-id-badge" />
        
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Ward Allocation" name="ward_id" id="wardSelect" onchange="updateBeds()" icon="fa-hospital">
                <option value="">Select Ward</option>
                @foreach($wards as $w)
                    <option value="{{ $w->id }}">{{ $w->name }} ({{ $w->beds->where('status','available')->count() }} avail)</option>
                @endforeach
            </x-cc-select>
            <x-cc-select label="Bed Designation" name="bed_id" id="bedSelect" required icon="fa-bed">
                <option value="">Select Bed</option>
            </x-cc-select>
        </div>

        <x-cc-input label="Primary Admitting Diagnosis" name="diagnosis" required placeholder="Document primary clinical findings..." icon="fa-stethoscope" />

        <div class="pt-4">
            <x-cc-button type="submit" color="indigo" class="w-full">Authorize Admission</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Discharge Protocol -->
<x-cc-modal id="dischargeModal" title="Discharge Protocol" icon="fa-door-open">
    <form id="dischargeForm" method="POST" class="space-y-6">
        @csrf
        <x-cc-input label="Final Clinical Summary" name="summary" required placeholder="Document discharge summary and follow-up..." icon="fa-file-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Finalize Discharge</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function updateBeds() {
    const wardId = document.getElementById('wardSelect').value;
    const bedSelect = document.getElementById('bedSelect');
    bedSelect.innerHTML = '<option value="">Loading...</option>';

    if (!wardId) {
        bedSelect.innerHTML = '<option value="">Select Bed</option>';
        return;
    }

    fetch(`{{ route('admissions.beds.available') }}?ward_id=${wardId}`)
        .then(res => res.json())
        .then(data => {
            bedSelect.innerHTML = '<option value="">Select Bed</option>';
            data.forEach(bed => {
                bedSelect.innerHTML += `<option value="${bed.id}">Bed ${bed.bed_number}</option>`;
            });
        })
        .catch(() => {
            bedSelect.innerHTML = '<option value="">Failed to load beds</option>';
        });
}

function openDischargeModal(admissionId) {
    const form = document.getElementById('dischargeForm');
    form.action = `{{ route('admissions.discharge', ':id') }}`.replace(':id', admissionId);
    document.getElementById('dischargeModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

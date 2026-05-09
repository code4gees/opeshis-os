<x-cc-shell title='Isolation Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Isolation <span class="text-rose-500">& IPC</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Infection Prevention · Biohazard Containment Matrix · IPC Protocol Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-biohazard" color="rose" variant="ghost" onclick="document.getElementById('placeModal').classList.remove('hidden')">
                Activate Isolation Protocol
            </x-cc-button>
        </div>
    </div>

    <!-- Biohazard Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Isolation" value="{{ $isolations->count() }}" icon="fa-door-closed" trend="Institutional Log" color="rose" />
        <x-cc-stat title="IPC Compliance" value="98.2%" icon="fa-shield-virus" trend="Audit Target" color="emerald" />
        <x-cc-stat title="Biohazard Signal" value="Nominal" icon="fa-radiational" trend="Global Surveillance" color="amber" />
        <x-cc-stat title="Registry Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <!-- Containment Registry -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Containment Registry Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest">Global Surveillance Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Protocol', 'Precaution Matrix', 'Isolation Zone', 'Admission Intelligence', 'Containment Action']">
            @forelse($isolations as $i)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-rose-500/10 group-hover:text-rose-500 group-hover:border-rose-500/20 transition-all">
                                {{ substr($i->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $i->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $i->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $typeCls = match($i->isolation_type) {
                                'Airborne' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                'Droplet' => 'bg-sky-500/10 text-sky-500 border-sky-500/20',
                                'Contact' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                default => 'bg-white/5 text-white/40 border-white/10'
                            };
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $typeCls }} text-[9px] font-black uppercase tracking-widest">
                            {{ strtoupper($i->isolation_type) }} PRECAUTIONS
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-widest">{{ $i->room_number }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Containment Node</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight line-clamp-1">"{{ $i->reason }}"</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Placed: {{ \Carbon\Carbon::parse($i->placed_at)->format('d M, H:i') }}</div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <form method="POST" action="{{ url('/clinical/isolation/lift/'.$i->id) }}">
                                @csrf
                                <x-cc-button type="submit" variant="ghost" size="sm" icon="fa-unlock" color="rose">Lift Precautions</x-cc-button>
                            </form>
                            <x-cc-button variant="ghost" size="sm" icon="fa-virus" color="amber" onclick="openHAIModal('{{ $i->patient_id }}')">Log HAI</x-cc-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-door-closed text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active isolation cases identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>

    <!-- Outbreak Declaration Control -->
    <div class="flex justify-center pt-12">
        <x-cc-button icon="fa-triangle-exclamation" color="rose" class="px-16 py-6" onclick="document.getElementById('outbreakModal').classList.remove('hidden')">
            Authorize Institutional Outbreak Declaration
        </x-cc-button>
    </div>
</div>

<!-- Modal: Activate Isolation -->
<x-cc-modal id="placeModal" title="Authorize Bio-Isolation Precautions" icon="fa-biohazard">
    <form method="POST" action="{{ url('/clinical/isolation/place') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Precaution Type" name="type" icon="fa-shield-virus">
                <option value="Contact">CONTACT_PRECAUTIONS</option>
                <option value="Droplet">DROPLET_PRECAUTIONS</option>
                <option value="Airborne">AIRBORNE_PRECAUTIONS</option>
                <option value="Neutropenic">NEUTROPENIC_PRECAUTIONS</option>
            </x-cc-select>
            <x-cc-input label="Containment Room" name="room" required placeholder="ISO-XXXX" icon="fa-door-closed" />
        </div>
        <x-cc-input label="Clinical Rationale" name="reason" required placeholder="CLINICAL_RATIONALE_DISCLOSURE..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Isolation Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log HAI -->
<x-cc-modal id="haiModal" title="Commit Institutional HAI Intelligence" icon="fa-virus">
    <form method="POST" action="{{ url('/clinical/isolation/record-hai') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="patient_id" id="haiPatientId">
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Infection Type" name="infection_type" required placeholder="INFECTION_NODE" icon="fa-vial-virus" />
            <x-cc-input label="Causative Organism" name="organism" required placeholder="MICROBIAL_SIGNAL" icon="fa-microscope" />
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Commit HAI Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Declare Outbreak -->
<x-cc-modal id="outbreakModal" title="Authorize Institutional Outbreak Declaration" icon="fa-triangle-exclamation">
    <form method="POST" action="{{ url('/clinical/isolation/outbreak') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Target Disease Signal" name="disease" required placeholder="OUTBREAK_DISEASE_NODE" icon="fa-radiation" />
        <div class="p-6 bg-rose-500/10 border border-rose-500/20 rounded-2xl">
            <p class="text-[11px] font-bold text-rose-500 uppercase tracking-widest leading-relaxed text-center">
                WARNING: This action will activate institutional outbreak response protocols and notify all surveillance units. Proceed only with executive clinical authorization.
            </p>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Finalize Outbreak Declaration</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openHAIModal(id) {
    document.getElementById('haiPatientId').value = id;
    document.getElementById('haiModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

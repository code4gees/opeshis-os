<x-cc-shell title='Wound Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Wound <span class="text-amber-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Tissue Viability & Complex Dressing Management · Wound Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="amber" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Register Wound Case
            </x-cc-button>
        </div>
    </div>

    <!-- Tissue Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Wounds" value="{{ $wounds->count() }}" icon="fa-bandage" trend="Active Registry" color="amber" />
        <x-cc-stat title="Healed (30d)" value="14" icon="fa-heart-pulse" trend="Recovery Protocol" color="emerald" />
        <x-cc-stat title="Complex Dressings" value="08" icon="fa-layer-group" trend="High Intensity" color="indigo" />
        <x-cc-stat title="Tissue Integrity" value="Nominal" icon="fa-shield-heart" trend="Operational" color="slate" />
    </div>

    <!-- Tissue Viability Registry Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Tissue Viability Registry Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-amber-500 uppercase tracking-widest">Protocol: Active Dressing</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Profile Identity', 'Wound Classification', 'Anatomical Location', 'Latest Intelligence', 'Clinical Action']">
            @forelse($wounds as $w)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-amber-500/10 group-hover:text-amber-500 group-hover:border-amber-500/20 transition-all">
                                {{ substr($w->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors">{{ $w->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $w->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-widest">{{ $w->wound_type }}</div>
                        <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Stage: {{ $w->stage }} · Size: {{ $w->size_cm }}CM</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[10px] font-black text-white/40 uppercase tracking-widest">
                            {{ $w->location }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        @php $latest = $w->dressings->first(); @endphp
                        @if($latest)
                            <div class="text-[11px] font-bold text-white/40 uppercase tracking-tight line-clamp-1">"{{ $latest->wound_bed }}"</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Synced: {{ \Carbon\Carbon::parse($latest->created_at)->diffForHumans() }}</div>
                        @else
                            <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">Baseline Pending</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <x-cc-button variant="ghost" size="sm" icon="fa-pen-to-square" color="amber" onclick="openDressingModal('{{ $w->id }}')">Log Dressing</x-cc-button>
                            <form method="POST" action="{{ url('/clinical/wound/'.$w->id.'/close') }}">
                                @csrf
                                <x-cc-button type="submit" variant="ghost" size="sm" icon="fa-heart-pulse" color="emerald">Mark Healed</x-cc-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <i class="fas fa-bandage text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active wound cases identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Register Wound Case -->
<x-cc-modal id="regModal" title="Tissue Case Registration Protocol" icon="fa-plus-circle">
    <form method="POST" action="{{ url('/clinical/wound/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Wound Classification" name="type" required placeholder="e.g. SURGICAL INCISION" icon="fa-bandage" />
            <x-cc-input label="Anatomical Location" name="location" required placeholder="e.g. LEFT LATERAL MALLEOLUS" icon="fa-map-location-dot" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Size Dimension (CM)" name="size" type="number" step="0.1" required placeholder="0.0" icon="fa-ruler-combined" />
            <x-cc-select label="Wound Staging Protocol" name="stage" icon="fa-layer-group">
                <option value="Stage I">Stage I</option>
                <option value="Stage II">Stage II</option>
                <option value="Stage III">Stage III</option>
                <option value="Stage IV">Stage IV</option>
                <option value="Unstageable">Unstageable</option>
            </x-cc-select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Dressing Record -->
<x-cc-modal id="dressingModal" title="Commit Dressing Assessment Intelligence" icon="fa-pen-to-square">
    <form method="POST" action="{{ url('/clinical/wound/dressing') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="wound_id" id="dressingWoundId">
        <x-cc-input label="Dressing Protocol Matrix" name="dressing_type" required placeholder="e.g. SILVER_ALGINATE" icon="fa-kit-medical" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Wound Bed Assessment" name="wound_bed" icon="fa-microscope">
                <option value="Granulating">GRANULATING_TISSUE</option>
                <option value="Epithelializing">EPITHELIALIZING</option>
                <option value="Slough">SLOUGH_PRESENT</option>
                <option value="Necrotic">NECROTIC_ESCHAR</option>
            </x-cc-select>
            <x-cc-select label="Exudate Level Matrix" name="exudate" icon="fa-droplet">
                <option value="None">ZERO_FLUX</option>
                <option value="Low">LOW_EXUDATE</option>
                <option value="Moderate">MODERATE_EXUDATE</option>
                <option value="High">HIGH_EXUDATE</option>
            </x-cc-select>
        </div>
        <x-cc-input label="Clinical Progress Intelligence" name="notes" placeholder="ENTER_CLINICAL_PROGRESS_INTELLIGENCE..." icon="fa-comment-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Commit Dressing Intelligence</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
function openDressingModal(id) {
    document.getElementById('dressingWoundId').value = id;
    document.getElementById('dressingModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

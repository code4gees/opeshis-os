<x-cc-shell title='Opeshis OS'>

@section('title', 'Wound Management Hub - Opeshis OS')


<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-200 uppercase tracking-tighter">Wound Command Hub</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Institutional Tissue Viability & Complex Dressing Management</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-plus-circle" color="slate" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Register Wound Case
            </x-cc-button>
        </div>
    </div>

    <!-- Tissue Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            label="Active Wounds" 
            value="{{ $wounds->count() }}" 
            icon="fa-bandage" 
            trend="Active Registry" 
            color="amber" 
        />
        <x-cc-stat 
            label="Healed (30d)" 
            value="14" 
            icon="fa-heart-pulse" 
            trend="Recovery Protocol" 
            color="emerald" 
        />
        <x-cc-stat 
            label="Complex Dressings" 
            value="08" 
            icon="fa-layer-group" 
            trend="High Intensity" 
            color="indigo" 
        />
        <x-cc-stat 
            label="Tissue Integrity" 
            value="Nominal" 
            icon="fa-shield-heart" 
            trend="Operational" 
            color="slate" 
        />
    </div>

    <!-- Tissue Viability Registry Matrix -->
    <x-cc-card title="Tissue Viability Registry Matrix" icon="fa-database">
        <x-slot name="action">
            <span class="px-2 py-0.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded text-[9px] font-black uppercase tracking-widest italic">Protocol: Active Dressing</span>
        </x-slot>

        <x-cc-table :headers="['Patient Profile Identity', 'Wound Classification', 'Anatomical Location', 'Latest Intelligence', 'Clinical Action']">
            @forelse($wounds as $w)
                <tr class="group hover:bg-amber-500/[0.02] transition-colors">
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="flex items-center">
                            <div class="h-9 w-9 flex-shrink-0 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-slate-400 font-bold text-xs uppercase">
                                {{ substr($w->patient->full_name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-amber-400 transition-colors italic">{{ $w->patient->full_name }}</div>
                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $w->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <div class="text-xs font-black text-slate-200 uppercase tracking-tight">{{ $w->wound_type }}</div>
                        <div class="text-[8px] font-black text-slate-500 uppercase tracking-widest mt-1">Stage: {{ $w->stage }} · Size: {{ $w->size_cm }}cm</div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <span class="px-3 py-1 bg-slate-900/50 text-slate-400 border border-slate-700/60 rounded-lg text-[9px] font-black uppercase tracking-widest">
                            {{ $w->location }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        @php $latest = $w->dressings->first(); @endphp
                        @if($latest)
                            <div class="text-[10px] font-black text-slate-300 uppercase italic line-clamp-1">"{{ $latest->wound_bed }}"</div>
                            <div class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-1">Synced: {{ \Carbon\Carbon::parse($latest->created_at)->diffForHumans() }}</div>
                        @else
                            <span class="text-[9px] font-black text-slate-600 italic uppercase">Pending Baseline Intelligence</span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <x-cc-button variant="ghost" size="sm" icon="fa-pen-to-square" color="slate" onclick="openDressingModal('{{ $w->id }}')">Log Dressing</x-cc-button>
                            <form method="POST" action="{{ url('/clinical/wound/'.$w->id.'/close') }}">
                                @csrf
                                <x-cc-button type="submit" variant="ghost" size="sm" icon="fa-heart-pulse" color="emerald">Mark Healed</x-cc-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-600 italic text-sm">No active wound cases identified in the tissue registry matrix.</td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Register Wound Case -->
<x-cc-modal id="regModal" title="Tissue Case Registration Protocol" icon="fa-plus-circle">
    <form method="POST" action="{{ url('/clinical/wound/register') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Institutional Patient Identity</label>
            <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 transition-all uppercase">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Wound Classification</label>
                <input name="type" required placeholder="e.g. SURGICAL INCISION" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Anatomical Location Matrix</label>
                <input name="location" required placeholder="e.g. LEFT LATERAL MALLEOLUS" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Approx. Size Dimension (cm)</label>
                <input name="size" type="number" step="0.1" required placeholder="0.0" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Wound Staging Protocol</label>
                <select name="stage" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
                    <option value="Stage I">Stage I</option>
                    <option value="Stage II">Stage II</option>
                    <option value="Stage III">Stage III</option>
                    <option value="Stage IV">Stage IV</option>
                    <option value="Unstageable">Unstageable</option>
                </select>
            </div>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full uppercase tracking-widest">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Log Dressing Record -->
<x-cc-modal id="dressingModal" title="Commit Dressing Assessment Intelligence" icon="fa-pen-to-square">
    <form method="POST" action="{{ url('/clinical/wound/dressing') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="wound_id" id="dressingWoundId">
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Dressing Protocol Matrix</label>
            <input name="dressing_type" required placeholder="e.g. SILVER_ALGINATE" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Wound Bed Assessment</label>
                <select name="wound_bed" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
                    <option value="Granulating">GRANULATING_TISSUE</option>
                    <option value="Epithelializing">EPITHELIALIZING</option>
                    <option value="Slough">SLOUGH_PRESENT</option>
                    <option value="Necrotic">NECROTIC_ESCHAR</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Exudate Level Matrix</label>
                <select name="exudate" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
                    <option value="None">ZERO_FLUX</option>
                    <option value="Low">LOW_EXUDATE</option>
                    <option value="Moderate">MODERATE_EXUDATE</option>
                    <option value="High">HIGH_EXUDATE</option>
                </select>
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Clinical Progress Intelligence</label>
            <textarea name="notes" rows="3" placeholder="ENTER_CLINICAL_PROGRESS_INTELLIGENCE..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600 uppercase no-scrollbar"></textarea>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full uppercase tracking-widest">Commit Dressing Intelligence</x-cc-button>
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

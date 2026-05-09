<x-cc-shell title='Mortuary Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Mortuary Command Hub</h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Post-Mortem Custody · Slot Logistics · Release Verification Matrix</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="rose" variant="ghost" onclick="document.getElementById('admitModal').classList.remove('hidden')">
                Authorize Intake Protocol
            </x-cc-button>
        </div>
    </div>

    <!-- Slot Visualization Matrix: High-Fidelity Surveillance -->
    <div class="grid grid-cols-2 sm:grid-cols-5 xl:grid-cols-10 gap-4 mb-12">
        @foreach($slots as $slot)
            @php $isOccupied = $slot->status === 'Occupied'; @endphp
            <div class="p-5 bg-white/[0.01] border {{ $isOccupied ? 'border-rose-500/30 bg-rose-500/[0.02]' : 'border-white/[0.04]' }} rounded-[1.5rem] flex flex-col items-center justify-center gap-3 group transition-all duration-500 hover:scale-105 hover:bg-white/[0.03]">
                <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">{{ $slot->slot_number }}</span>
                <div class="w-2.5 h-2.5 rounded-full {{ $isOccupied ? 'bg-rose-500 shadow-[0_0_10px_rgba(244,63,94,0.6)] animate-pulse' : 'bg-white/10' }}"></div>
                <span class="text-[9px] font-black uppercase tracking-tighter {{ $isOccupied ? 'text-rose-500' : 'text-white/20' }}">{{ $slot->status }}</span>
            </div>
        @endforeach
    </div>

    <!-- Active Custody Registry -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] flex items-center gap-3">
                <i class="fas fa-box-archive text-rose-500 text-[14px]"></i>
                Institutional Custody Log
            </h3>
            <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-lg text-[9px] font-black uppercase tracking-widest">Active Surveillance</span>
        </div>

        <x-cc-table :headers="['Deceased Identity Protocol', 'Slot Allocation', 'Intake Matrix', 'Status signal', 'Strategic Action']">
            @forelse($admissions as $a)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-11 w-11 rounded-2xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] uppercase group-hover:bg-rose-500/10 group-hover:text-rose-500 group-hover:border-rose-500/20 transition-all">
                                {{ substr($a->deceased_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $a->deceased_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $a->patient->medical_id ?? 'EXTERNAL_ADMISSION' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                            SLOT-{{ $a->slot->slot_number ?? 'NA' }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($a->date_of_admission)->format('d M Y') }}</div>
                        <div class="text-[10px] font-bold text-white/10 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($a->date_of_admission)->format('H:i') }} Z</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                            <span class="text-[9px] font-black text-rose-500 uppercase tracking-[0.2em]">In Custody</span>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <x-cc-button variant="ghost" size="sm" icon="fa-file-export" color="rose" onclick="openReleaseModal('{{ $a->id }}', '{{ $a->deceased_name }}')">
                            Release Protocol
                        </x-cc-button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6 border border-white/5">
                            <i class="fas fa-inbox text-white/10 text-xl"></i>
                        </div>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active custody records identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Intake Protocol -->
<x-cc-modal id="admitModal" title="Institutional Intake Protocol" icon="fa-user-plus">
    <form method="POST" action="{{ url('/mortuary/admit') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Legal Name of Deceased" name="deceased_name" required placeholder="FULL LEGAL IDENTITY" icon="fa-user" />
        
        <div class="grid grid-cols-2 gap-4">
            <x-cc-select label="Slot Allocation" name="slot_id" required icon="fa-box">
                <option value="">-- VACANT SLOTS --</option>
                @foreach($slots->where('status', 'Vacant') as $s)
                    <option value="{{ $s->id }}">{{ $s->slot_number }}</option>
                @endforeach
            </x-cc-select>
            
            <x-cc-input label="Date of Death" name="date_of_death" type="date" required icon="fa-calendar-day" />
        </div>

        <div class="space-y-2">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">Certified Cause of Death</label>
            <textarea name="cause_of_death" placeholder="PRELIMINARY FINDINGS..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-4 text-xs font-bold text-white placeholder-slate-600 outline-none focus:border-rose-500/50 focus:ring-4 focus:ring-rose-500/10 transition-all h-28 no-scrollbar resize-none"></textarea>
        </div>

        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Intake Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Release Authorization -->
<x-cc-modal id="releaseModal" title="Custody Release Authorization" icon="fa-file-export">
    <div class="mb-8 p-4 bg-rose-500/5 border border-rose-500/10 rounded-2xl">
        <p class="text-[10px] font-bold text-rose-500/40 uppercase tracking-widest mb-1">Target Identity</p>
        <p id="deceasedDisplay" class="text-[13px] font-black text-white uppercase tracking-tight"></p>
    </div>

    <form id="releaseForm" method="POST" action="" class="space-y-6">
        @csrf
        <x-cc-input label="Receiver Legal Identity" name="released_to_name" required placeholder="FULL LEGAL NAME" icon="fa-user-shield" />
        <x-cc-input label="Government ID Number" name="released_to_id_number" placeholder="PASSPORT / NATIONAL ID" icon="fa-id-card" />
        
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Release Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
    function openReleaseModal(id, name) {
        document.getElementById('deceasedDisplay').innerText = name.toUpperCase();
        document.getElementById('releaseForm').action = "/mortuary/release/" + id;
        document.getElementById('releaseModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Mortuary Command - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">Mortuary Command Hub</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Post-Mortem Custody · Slot Logistics · Release Verification Matrix</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-user-plus" color="slate" variant="ghost" onclick="document.getElementById('admitModal').classList.remove('hidden')">
 Authorize Intake
 </x-cc-button>
 </div>
 </div>

 <!-- Slot Visualization Matrix -->
 <div class="grid grid-cols-2 md:grid-cols-5 xl:grid-cols-10 gap-4">
 @foreach($slots as $slot)
 @php $isOccupied = $slot->status === 'Occupied'; @endphp
 <div class="p-4 bg-card/40 border {{ $isOccupied ? 'border-rose-500/30' : 'border-subtle' }} rounded-2xl flex flex-col items-center justify-center gap-2 group transition-all hover:scale-105">
 <span class="text-[12px] font-semibold text-slate-500 font-medium">{{ $slot->slot_number }}</span>
 <div class="w-2 h-2 rounded-full {{ $isOccupied ? 'bg-rose-500 shadow-[0_0_10px_rgba(244,63,94,0.4)] animate-pulse' : 'bg-emerald-500/50' }}"></div>
 <span class="text-[8px] font-semibold uppercase {{ $isOccupied ? 'text-rose-500' : 'text-slate-600' }}">{{ strtoupper($slot->status) }}</span>
 </div>
 @endforeach
 </div>

 <!-- Active Custody Registry -->
 <x-cc-card title="Institutional Custody Log" icon="fa-box-archive">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[12px] font-semibold font-medium">Active Custody</span>
 </x-slot>

 <x-cc-table :headers="['Deceased Identity Protocol', 'Slot Allocation', 'Admission Timestamp', 'Current Status', 'Strategic Action']">
 @forelse($admissions as $a)
 <tr class="group hover:bg-rose-500/[0.02] transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-[#2a2e38] flex items-center justify-center border border-slate-700 text-slate-400 font-bold text-xs uppercase">
 {{ substr($a->deceased_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $a->deceased_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $a->patient->medical_id ?? 'EXTERNAL_ADMISSION' }}</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 <span class="px-2 py-0.5 bg-card border border-slate-700 rounded text-[12px] font-semibold text-slate-400 font-medium">{{ $a->slot->slot_number ?? 'UNASSIGNED' }}</span>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center text-xs font-semibold text-slate-400 font-medium">
 {{ \Carbon\Carbon::parse($a->date_of_admission)->format('d M Y') }}
 <span class="block text-[12px] text-slate-600 mt-1">{{ \Carbon\Carbon::parse($a->date_of_admission)->format('H:i') }}</span>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 <span class="px-2 py-0.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[8px] font-semibold font-medium animate-pulse">In Custody</span>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <x-cc-button variant="ghost" size="sm" icon="fa-file-export" color="rose" onclick="openReleaseModal('{{ $a->id }}', '{{ $a->deceased_name }}')">Release</x-cc-button>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active custody records identified in the matrix.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
</div>

<!-- Modal: Intake Protocol -->
<x-cc-modal id="admitModal" title="Institutional Intake Protocol" icon="fa-user-plus">
 <form method="POST" action="{{ url('/mortuary/admit') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Legal Name of Deceased</label>
 <input name="deceased_name" required placeholder="Full Legal Name" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Slot Allocation</label>
 <select name="slot_id" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none">
 <option value="">-- SELECT VACANT SLOT --</option>
 @foreach($slots->where('status', 'Vacant') as $s)
 <option value="{{ $s->id }}">{{ $s->slot_number }}</option>
 @endforeach
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Date of Death</label>
 <input name="date_of_death" type="date" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Certified Cause of Death</label>
 <textarea name="cause_of_death" placeholder="Preliminary findings..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none h-24 no-scrollbar resize-none"></textarea>
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="rose" class="w-full font-medium">Authorize Intake</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Release Authorization -->
<x-cc-modal id="releaseModal" title="Custody Release Authorization" icon="fa-file-export">
 <p class="text-[12px] font-semibold text-rose-500 font-medium mb-6 ">Protocol Deceased: <span id="deceasedDisplay"></span></p>
 <form id="releaseForm" method="POST" action="" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Receiver Legal Identity</label>
 <input name="released_to_name" required placeholder="Full Legal Name" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Government ID Number</label>
 <input name="released_to_id_number" placeholder="Passport / National ID" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none uppercase">
 </div>
 <div class="pt-4">
 <x-cc-button type="submit" color="rose" class="w-full font-medium">Authorize Release Protocol</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<script>
function openReleaseModal(id, name) {
 document.getElementById('deceasedDisplay').innerText = name.toUpperCase();
 document.getElementById('releaseForm').action = "{{ url('/mortuary/release') }}/" + id;
 document.getElementById('releaseModal').classList.remove('hidden');
}
</script>
</x-cc-shell>

<script>
 function openReleaseModal(id, name) {
 document.getElementById('deceasedDisplay').innerText = name.toUpperCase();
 document.getElementById('releaseForm').action = "/mortuary/release/" + id;
 document.getElementById('releaseModal').classList.remove('hidden');
 }
</script>
</x-cc-shell>

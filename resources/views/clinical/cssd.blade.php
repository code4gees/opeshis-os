<x-cc-shell title='Opeshis OS'>
@section('title', 'CSSD Ops — Opeshis OS')

<div class="space-y-8 animate-fade-in">

 {{-- Header --}}
 <div class="flex justify-between items-start border-b border-subtle pb-8">
 <div>
 <h2 class="text-2xl font-semibold uppercase text-white tracking-tight">CSSD & Sterile Logistics</h2>
 <p class="text-[12px] font-bold text-slate-400 font-medium mt-1">Sterilization Load Tracking · Biological Indicators · Sterile Storage</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('loadModal').classList.remove('hidden')" class="px-6 py-3 bg-sage text-white rounded-xl font-bold text-xs hover:bg-indigo-700 transition-all">
 + Start Sterilization Load
 </button>
 </div>
 </div>

 {{-- Stats Row --}}
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 @foreach([
 ['Today\'s Loads', $loadStats->total ?? 0, 'indigo'],
 ['Passed Cycles', $loadStats->passed ?? 0, 'emerald'],
 ['Failed / Quarantined', $loadStats->failed ?? 0, 'rose'],
 ['Expiring Sterile Stock', $expiringCount, 'amber']
 ] as [$label, $val, $color])
 <div class="bg-card rounded-3xl border border-subtle shadow-lg px-8 py-6">
 <p class="text-[12px] font-semibold text-slate-400 font-medium mb-2">{{ $label }}</p>
 <p class="text-3xl font-semibold text-{{ $color }}-600">{{ $val }}</p>
 </div>
 @endforeach
 </div>

 {{-- Active Loads Table --}}
 <div class="bg-card rounded-[2.5rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-6 border-b border-subtle bg-slate-50/30">
 <h3 class="text-xs font-semibold text-white font-medium">Active Sterilization Cycles</h3>
 </div>
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-4">Load Number</th>
 <th class="py-4">Sterilizer / Modality</th>
 <th class="py-4">Method</th>
 <th class="py-4">Status</th>
 <th class="py-4">Expiry Date</th>
 <th class="py-4 text-right px-10">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-50">
 @forelse($todayLoads as $l)
 <tr class="hover:bg-slate-50/60 transition group">
 <td class="px-10 py-5">
 <p class="text-sm font-semibold text-white">{{ $l->load_number }}</p>
 <p class="text-[12px] text-slate-400 font-bold font-medium">{{ date('H:i', strtotime($l->created_at)) }} HRS</p>
 </td>
 <td class="py-5">
 <p class="text-xs font-semibold text-slate-700 uppercase">{{ $l->sterilizer_name }}</p>
 </td>
 <td class="py-5">
 <span class="px-2 py-1 bg-white/10 rounded-lg text-[12px] font-semibold text-slate-500 uppercase">{{ $l->sterilization_method }}</span>
 </td>
 <td class="py-5">
 <span class="px-2 py-1 rounded-full text-[12px] font-semibold font-medium
 {{ $l->load_status === 'passed' ? 'bg-emerald-100 text-emerald-700' : ($l->load_status === 'in_progress' ? 'bg-indigo-100 text-indigo-700 animate-pulse' : 'bg-rose-100 text-rose-700') }}">
 {{ str_replace('_',' ',$l->load_status) }}
 </span>
 </td>
 <td class="py-5 text-xs font-bold text-slate-400">{{ $l->expiry_date ?: 'TBD' }}</td>
 <td class="px-10 py-5 text-right">
 @if($l->load_status === 'in_progress')
 <button class="text-[12px] font-semibold text-sage hover:underline uppercase">Verify Load</button>
 @else
 <button class="text-[12px] font-semibold text-slate-300 uppercase cursor-not-allowed">Archived</button>
 @endif
 </td>
 </tr>
 @empty
 <tr><td colspan="6" class="p-20 text-center text-slate-300 text-sm">No sterilization loads recorded today.</td></tr>
 @endforelse
 </tbody>
 </table>
 </div>

</div>

{{-- Load Modal --}}
<div id="loadModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[2.5rem] p-12 ">
 <h3 class="text-xl font-semibold text-white mb-8 uppercase">Initiate Sterilization Cycle</h3>
 <form method="POST" action="{{ url('/clinical/cssd/start') }}" class="space-y-5">
 @csrf
 <div><label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Select Sterilizer</label>
 <select name="sterilizer_id" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-5 py-4 text-sm font-bold outline-none">
 @foreach($sterilizers as $s)
 <option value="{{ $s->id }}">{{ $s->sterilizer_name }}</option>
 @endforeach
 </select>
 </div>
 <div><label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Sterilization Method</label>
 <select name="method" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-5 py-4 text-sm font-bold outline-none">
 <option value="Steam Autoclave (134°C)">Steam Autoclave (134°C)</option>
 <option value="Hydrogen Peroxide Plasma">Hydrogen Peroxide Plasma</option>
 <option value="Ethylene Oxide (ETO)">Ethylene Oxide (ETO)</option>
 <option value="Dry Heat">Dry Heat</option>
 </select>
 </div>
 <div class="flex gap-4 mt-8">
 <button type="button" onclick="document.getElementById('loadModal').classList.add('hidden')" class="flex-1 py-4 bg-white/10 text-slate-400 rounded-2xl text-xs font-semibold uppercase">Cancel</button>
 <button type="submit" class="flex-1 py-4 bg-sage text-white rounded-2xl text-xs font-semibold uppercase ">Start Cycle</button>
 </div>
 </form>
 </div>
</div>

</x-cc-shell>

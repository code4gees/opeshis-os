<x-cc-shell title='Opeshis OS'>

@section('title', 'Admission Census & Ward Management - Opeshis OS')


<div class="space-y-8 animate-fade-in">
 <div class="flex justify-between items-center mb-8">
 <div>
 <h2 class="text-2xl font-semibold uppercase text-white tracking-tight">Institutional Inpatient Census</h2>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Real-time Ward & Bed Occupancy</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('admitModal').classList.remove('hidden')" class="px-6 py-3 bg-sage text-white rounded-xl font-bold text-xs /20 hover:bg-indigo-700 transition-all">New Admission</button>
 </div>
 </div>

 <!-- Ward Grid -->
 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 @foreach($wards as $ward)
 <div class="bg-card rounded-[2.5rem] shadow-lg border border-subtle overflow-hidden">
 <div class="px-8 py-6 border-b border-subtle flex justify-between items-center bg-slate-50/30">
 <h3 class="text-[12px] font-semibold text-white font-medium">{{ $ward->name }} <span class="text-slate-300 ml-2">({{ $ward->type }})</span></h3>
 <span class="px-3 py-1 bg-card border border-subtle rounded-lg text-[8px] font-semibold uppercase text-slate-400">{{ $ward->beds->where('status', 'Occupied')->count() }}/{{ $ward->beds->count() }} Beds</span>
 </div>
 <div class="p-6 grid grid-cols-4 gap-4">
 @foreach($ward->beds as $bed)
 <div class="aspect-square rounded-2xl border {{ $bed->status === 'Occupied' ? 'bg-sage border-indigo-600 text-white /20' : 'bg-[#2a2e38] border-subtle text-slate-300' }} flex flex-col items-center justify-center cursor-pointer group relative">
 <span class="text-[12px] font-semibold">{{ $bed->bed_number }}</span>
 @if($bed->status === 'Occupied')
 <div class="absolute inset-0 bg-card/90 rounded-2xl opacity-0 group-hover:opacity-100 transition-all flex flex-col items-center justify-center p-2 text-center">
 <p class="text-[7px] font-semibold uppercase text-white truncate w-full">{{ $bed->full_name }}</p>
 <p class="text-[6px] font-semibold uppercase text-sage mt-1">{{ $bed->medical_id }}</p>
 </div>
 @endif
 </div>
 @endforeach
 </div>
 </div>
 @endforeach
 </div>

 <!-- Active Admissions Table -->
 <div class="bg-card rounded-[2.5rem] shadow-lg border border-subtle overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle">
 <h3 class="text-sm font-semibold text-white font-medium">Active Inpatients</h3>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] text-slate-400 uppercase font-semibold tracking-wider">
 <tr>
 <th class="px-10 py-5">Patient identity</th>
 <th class="px-10 py-5">Location</th>
 <th class="px-10 py-5">Admission Context</th>
 <th class="px-10 py-5 text-right">Flow</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-50">
 @foreach($activeAdmissions as $a)
 <tr class="hover:bg-slate-50/50 transition">
 <td class="px-10 py-6">
 <div class="font-semibold text-white text-sm">{{ $a->full_name }}</div>
 <div class="text-[12px] text-slate-400 font-bold font-medium mt-1">{{ $a->medical_id }}</div>
 </td>
 <td class="px-10 py-6">
 <div class="text-[12px] font-semibold text-sage font-medium">{{ $a->ward_name }}</div>
 <div class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Bed: {{ $a->bed_number }}</div>
 </td>
 <td class="px-10 py-6">
 <div class="text-[12px] text-slate-700 font-bold max-w-xs truncate">{{ $a->diagnosis_at_admission }}</div>
 <div class="text-[12px] text-slate-400 font-semibold uppercase mt-1">{{ \Carbon\Carbon::parse($a->admission_date)->diffForHumans() }}</div>
 </td>
 <td class="px-10 py-6 text-right">
 <form method="POST" action="{{ route('admissions.discharge', $a->id) }}" onsubmit="return confirm('Authorize discharge of this patient?')">
 @csrf
 <button type="submit" class="text-[12px] font-semibold text-rose-500 uppercase hover:underline">Discharge &rarr;</button>
 </form>
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
 </div>
 </div>
</div>

<!-- Admission Modal -->
<div id="admitModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-2xl rounded-[2.5rem] p-12 ">
 <h3 class="text-2xl font-semibold text-white mb-8 uppercase tracking-tight">Authorize Admission</h3>
 <form method="POST" action="{{ route('admissions.admit') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2">Patient Registry ID</label>
 <input type="text" name="patient_id" required placeholder="Enter UUID or Medical ID" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold outline-none">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2">Bed Assignment</label>
 <select name="bed_id" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold outline-none">
 @foreach($wards as $ward)
 <optgroup label="{{ $ward->name }}">
 @foreach($ward->beds->where('status', 'Vacant') as $bed)
 <option value="{{ $bed->id }}">{{ $bed->bed_number }} ({{ $ward->name }})</option>
 @endforeach
 </optgroup>
 @endforeach
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2">Primary Diagnosis / Indication</label>
 <textarea name="diagnosis" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold outline-none h-24 resize-none"></textarea>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('admitModal').classList.add('hidden')" class="flex-1 py-5 bg-white/10 text-slate-400 rounded-2xl text-xs font-semibold font-medium hover:bg-slate-200 transition">Cancel</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-xs font-semibold font-medium /20 hover:bg-indigo-700 transition">Commit Admission</button>
 </div>
 </form>
 </div>
</div>
</x-cc-shell>

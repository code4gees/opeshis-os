<x-cc-shell title='Clinical Engine — EMR | Opeshis OS'>

<div class="max-w-[1400px] mx-auto pb-10">

 {{-- Page Header --}}
 <div class="flex items-center justify-between mb-6">
 <div>
 <h1 class="text-xl font-semibold text-white">Clinical Engine</h1>
 <p class="text-[12px] text-slate-400 mt-0.5">Select a patient from the active queue to begin a consultation</p>
 </div>
 <a href="{{ route('clinical.opd.index') }}" class="flex items-center gap-2 px-4 py-2 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 <i class="fas fa-plus text-[12px]"></i>
 Register Walk-In
 </a>
 </div>

 @if(session('info'))
 <div class="mb-4 px-4 py-3 bg-[#2a2e38] border border-subtle rounded-lg text-[12px] text-slate-300 flex items-center gap-2">
 <i class="fas fa-info-circle text-sage text-[12px]"></i>
 {{ session('info') }}
 </div>
 @endif

 {{-- Active Queue --}}
 <div class="bg-card rounded-xl border border-subtle">
 <div class="px-6 py-4 border-b border-subtle flex items-center justify-between">
 <h2 class="text-[14px] font-medium text-white flex items-center gap-2">
 <i class="fas fa-users text-sage text-[12px]"></i>
 Active Patient Queue
 </h2>
 <span class="px-2.5 py-1 rounded-md bg-sage/10 text-sage text-[12px] font-medium">
 {{ $queue->count() }} patients
 </span>
 </div>

 @if($queue->isEmpty())
 <div class="px-6 py-16 flex flex-col items-center justify-center text-center">
 <div class="w-16 h-16 rounded-full bg-[#2a2e38] flex items-center justify-center mb-4">
 <i class="fas fa-user-check text-slate-500 text-xl"></i>
 </div>
 <p class="text-[13px] font-medium text-slate-300">No patients in queue</p>
 <p class="text-[12px] text-slate-500 mt-1">Register a walk-in patient or check back later</p>
 <a href="{{ route('clinical.opd.index') }}" class="mt-4 px-4 py-2 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 Register Patient
 </a>
 </div>
 @else
 <table class="w-full text-left">
 <thead class="border-b border-subtle">
 <tr>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Patient</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Medical ID</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Status</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Wait Time</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Complaint</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400"></th>
 </tr>
 </thead>
 <tbody class="divide-y divide-subtle">
 @foreach($queue as $index => $item)
 <tr class="{{ $loop->even ? 'bg-[#1a1d24]/30' : 'bg-transparent' }} hover:bg-[#2a2e38] transition-colors">
 <td class="px-6 py-3.5">
 <div class="flex items-center gap-3">
 <div class="w-8 h-8 rounded-full bg-sage/10 border border-sage/20 flex items-center justify-center text-sage text-[12px] font-bold">
 {{ strtoupper(substr($item->patient->full_name ?? 'P', 0, 1)) }}
 </div>
 <span class="text-[12px] font-medium text-slate-200">{{ $item->patient->full_name ?? 'Unknown Patient' }}</span>
 </div>
 </td>
 <td class="px-6 py-3.5 text-[12px] text-sage font-mono">{{ $item->patient->medical_id ?? 'N/A' }}</td>
 <td class="px-6 py-3.5">
 <span class="px-2.5 py-1 rounded-md text-[12px] font-medium
 {{ ($item->status ?? '') === 'urgent' ? 'bg-alert/10 text-alert border border-alert/20' : 'bg-[#313642] text-slate-300' }}">
 {{ ucfirst($item->status ?? 'Waiting') }}
 </span>
 </td>
 <td class="px-6 py-3.5 text-[12px] text-slate-300">
 {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
 </td>
 <td class="px-6 py-3.5 text-[12px] text-slate-400 max-w-[200px] truncate">
 {{ $item->chief_complaint ?? '—' }}
 </td>
 <td class="px-6 py-3.5 text-right">
 <a href="{{ route('emr.main', $item->id) }}"
 class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sage text-[#16191f] rounded-md text-[12px] font-semibold hover:opacity-90 transition-opacity">
 <i class="fas fa-stethoscope text-[12px]"></i>
 Begin Consultation
 </a>
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
 @endif
 </div>

 {{-- Quick Stats Row --}}
 <div class="grid grid-cols-3 gap-4 mt-6">
 <div class="bg-card rounded-xl border border-subtle p-4">
 <p class="text-[12px] text-slate-400 mb-1">Patients in Queue</p>
 <p class="text-2xl font-bold text-white">{{ $queue->count() }}</p>
 </div>
 <div class="bg-card rounded-xl border border-subtle p-4">
 <p class="text-[12px] text-slate-400 mb-1">Urgent Cases</p>
 <p class="text-2xl font-bold text-alert">{{ $queue->where('status', 'urgent')->count() }}</p>
 </div>
 <div class="bg-card rounded-xl border border-subtle p-4">
 <p class="text-[12px] text-slate-400 mb-1">Avg. Wait Time</p>
 <p class="text-2xl font-bold text-white">
 @if($queue->count() > 0)
 {{ round($queue->avg(fn($q) => \Carbon\Carbon::parse($q->created_at)->diffInMinutes())) }} min
 @else
 —
 @endif
 </p>
 </div>
 </div>

</div>

</x-cc-shell>

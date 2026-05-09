<x-cc-shell title='Opeshis OS'>

@section('title', 'Patient Dossier — ' . $patient->full_name)


<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: Patient Identity Command -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div class="flex items-center gap-10">
 <div class="w-24 h-24 bg-sage rounded-[2.5rem] flex items-center justify-center text-white font-semibold text-4xl /30 border border-indigo-500/50 ">
 {{ substr($patient->full_name, 0, 1) }}
 </div>
 <div>
 <h1 class="text-4xl font-semibold text-white tracking-tighter uppercase leading-none">{{ $patient->full_name }}</h1>
 <div class="flex items-center gap-6 mt-4">
 <span class="text-[12px] font-semibold text-sage font-medium bg-sage/10 border border-indigo-500/20 px-4 py-1.5 rounded-xl /5">{{ $patient->medical_id }}</span>
 <span class="text-[12px] font-semibold text-slate-500 font-medium ">{{ $patient->gender }} · {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} Years</span>
 <span class="text-[12px] font-semibold text-rose-500 font-medium bg-rose-500/10 border border-rose-500/20 px-4 py-1.5 rounded-xl /5 ">BLOOD: {{ $patient->blood_group }}</span>
 </div>
 </div>
 </div>
 <div class="flex gap-4">
 <button onclick="window.print()" class="px-8 py-4 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl font-semibold text-[12px] font-medium hover:bg-white/10 transition-all ">
 Export Strategic Digest
 </button>
 <a href="{{ route('emr.main', ['id' => $patient->id]) }}" class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Authorize Consultation
 </a>
 </div>
 </header>

 <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
 <!-- Sidebar: Clinical Constants & Bio-Intelligence -->
 <div class="lg:col-span-1 space-y-10">
 <div class="bg-card p-10 rounded-[3rem] border border-subtle bg-card">
 <h3 class="text-[12px] font-semibold text-slate-500 font-medium mb-10 border-b border-subtle pb-6 ">Permanent Clinical Notes</h3>
 <div class="space-y-8">
 <div>
 <p class="text-[12px] font-semibold text-rose-500 font-medium mb-3 ">Known Allergies / Contradictions</p>
 <p class="text-sm font-semibold text-rose-400 uppercase leading-relaxed">{{ $patient->allergies ?: 'NO_KNOWN_ALLERGIES_IDENTIFIED' }}</p>
 </div>
 <div>
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Genotype Identification</p>
 <p class="text-sm font-semibold text-white uppercase ">{{ $patient->genotype ?: 'NULL_SPEC' }}</p>
 </div>
 </div>
 </div>
 
 <div class="bg-card p-10 rounded-[3rem] border border-subtle bg-card relative overflow-hidden">
 <div class="relative z-10">
 <h3 class="text-[12px] font-semibold text-sage font-medium mb-8 border-b border-subtle pb-6 ">Institutional Status</h3>
 @php $currentAdmission = $admissions->where('status', 'admitted')->first(); @endphp
 @if($currentAdmission)
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl /5 animate-pulse">
 <p class="text-[12px] font-semibold text-emerald-500 font-medium ">Active Admission</p>
 <p class="text-sm font-semibold text-white mt-2 uppercase tracking-tighter">NODE: {{ $currentAdmission->room_no ?? 'ICU_CORE_201' }}</p>
 </div>
 @else
 <div class="flex items-center gap-3">
 <div class="w-2 h-2 bg-slate-700 rounded-full"></div>
 <p class="text-[12px] font-semibold text-slate-500 font-medium">Status: Outpatient</p>
 </div>
 @endif
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-32 h-32 bg-sage/5 rounded-full blur-3xl"></div>
 </div>
 </div>

 <!-- Main Workspace: Longitudinal History Matrix -->
 <div class="lg:col-span-3 space-y-10">
 <div class="bg-card rounded-[4rem] border border-subtle overflow-hidden bg-card">
 <div class="px-12 py-10 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Longitudinal Medical Temporal Matrix</h3>
 <span class="px-4 py-1.5 bg-[#2a2e38] text-slate-500 border border-subtle rounded-xl text-[8px] font-semibold font-medium ">Temporal Stream: Active</span>
 </div>
 
 <div class="p-12">
 <div class="relative space-y-16 before:absolute before:left-[27px] before:top-4 before:bottom-0 before:w-1 before:bg-[#2a2e38] before:">
 @foreach($encounters as $e)
 <div class="relative pl-24 group">
 <div class="absolute left-0 top-1 w-14 h-14 bg-[#2a2e38] border border-subtle rounded-2xl flex items-center justify-center text-sage z-10 group-hover:border-indigo-500/50 transition-all duration-500">
 <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
 </div>
 <div class="flex justify-between items-center mb-6">
 <div>
 <h4 class="text-lg font-semibold text-white uppercase tracking-tight group-hover:text-sage transition-colors">Clinical Consultation</h4>
 <p class="text-[12px] font-bold text-slate-500 mt-1 font-medium ">Physician Node: {{ $e->doctor_name }}</p>
 </div>
 <span class="text-[12px] font-semibold text-slate-500 font-medium leading-none">{{ \Carbon\Carbon::parse($e->created_at)->format('d M Y') }}</span>
 </div>
 <div class="p-10 bg-[#2a2e38] rounded-[2.5rem] border border-subtle space-y-6 group-hover:bg-white/[0.04] transition-all">
 <div>
 <p class="text-[12px] font-semibold text-sage font-medium mb-3 ">Clinical Assessment Protocol</p>
 <p class="text-sm font-bold text-slate-400 leading-relaxed uppercase tracking-tight">"Protocol Authorization: refer to SOAP_LEDGER_{{ substr($e->id, 0, 8) }} for diagnostic rationale and treatment planning."</p>
 </div>
 <div class="flex gap-4 pt-4">
 <span class="px-4 py-1.5 bg-[#2a2e38] border border-subtle rounded-xl text-[8px] font-semibold text-slate-500 font-medium ">MATRIX_ID: {{ substr($e->id, 0, 12) }}</span>
 <span class="px-4 py-1.5 bg-sage/10 border border-indigo-500/20 rounded-xl text-[8px] font-semibold text-sage font-medium ">STATE: {{ strtoupper($e->status) }}</span>
 </div>
 </div>
 </div>
 @endforeach
 </div>
 </div>
 </div>
 </div>
 </div>
</div>
</x-cc-shell>

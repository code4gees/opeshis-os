<x-cc-shell title='Opeshis OS'>
@section('title', 'CREDENTIALING - Opeshis OS')

<div class="space-y-6 animate-fade-in">
 <div class="flex justify-between items-start border-b border-subtle pb-8">
 <div>
 <h2 class="text-2xl font-semibold uppercase text-white tracking-tight">CREDENTIALING</h2>
 <p class="text-[12px] font-bold text-slate-400 font-medium mt-1">Operational Module · Universal Core</p>
 </div>
 <div class="flex gap-3">
 <button class="px-6 py-3 bg-sage text-white rounded-xl font-bold text-xs hover:bg-indigo-700 transition-all">
 Primary Action
 </button>
 </div>
 </div>

 @if(session('success'))
 <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-sm font-bold">
 {{ session('success') }}
 </div>
 @endif

 <div class="bg-card rounded-[2.5rem] border border-subtle shadow-lg overflow-hidden p-20 text-center">
 <div class="w-20 h-20 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6">
 <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
 </div>
 <h3 class="text-lg font-semibold text-white uppercase mb-2">CREDENTIALING Active</h3>
 <p class="text-slate-400 text-sm max-w-sm mx-auto font-medium">This module has been successfully migrated to the Laravel core. Real-time data will populate as records are created.</p>
 </div>
</div>
</x-cc-shell>

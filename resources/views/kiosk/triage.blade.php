<x-cc-shell title='Opeshis OS' :noSidebar='true'>

@section('title', 'Self-Service Triage Kiosk - Opeshis OS')


<div class="min-h-screen flex flex-col items-center justify-center p-8 bg-[#1a1d24] bg-[radial-gradient(circle_at_center,rgba(79,70,229,0.1)_0%,transparent_70%)] w-full">
 <div class="w-full max-w-4xl bg-card rounded-[4rem] p-20 overflow-hidden relative border border-subtle">
 <div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
 
 <div class="mb-20 text-center">
 <h1 class="text-6xl font-semibold text-white uppercase tracking-tighter mb-4 ">Institutional Kiosk</h1>
 <p class="text-xs font-semibold text-sage uppercase tracking-[0.4em]">Rapid Vital Integration Matrix</p>
 </div>

 @if(session('success'))
 <div class="mb-16 p-10 bg-emerald-500/10 border-2 border-emerald-500/20 text-emerald-400 rounded-[3rem] text-2xl font-semibold text-center animate-pulse /20">
 <i class="fas fa-check-circle mr-4"></i> {{ session('success') }}
 </div>
 @endif

 @if(session('error'))
 <div class="mb-16 p-10 bg-rose-500/10 border-2 border-rose-500/20 text-rose-400 rounded-[3rem] text-2xl font-semibold text-center animate-shake /20">
 <i class="fas fa-triangle-exclamation mr-4"></i> {{ session('error') }}
 </div>
 @endif

 <form method="POST" action="{{ route('kiosk.submit') }}" class="grid grid-cols-2 gap-12">
 @csrf
 <div class="col-span-2 relative group">
 <label class="block text-[12px] font-semibold text-slate-500 uppercase tracking-[0.3em] mb-6 text-center">Scan Institutional Medical ID</label>
 <input type="text" name="patient_id" placeholder="OP-XXXX-XXXX" required autofocus
 class="w-full bg-[#2a2e38] border-4 border-subtle rounded-[2.5rem] px-12 py-10 text-4xl font-semibold text-center text-white outline-none focus:border-indigo-500 focus:ring-8 focus:ring-indigo-500/10 transition-all uppercase placeholder-slate-800">
 <div class="absolute inset-0 rounded-[2.5rem] border-2 border-indigo-500/0 group-focus-within:border-indigo-500/20 pointer-events-none transition-all"></div>
 </div>

 <div class="space-y-6">
 <label class="block text-[12px] font-semibold text-slate-400 font-medium text-center">Systolic BP (mmHg)</label>
 <input type="number" name="bp_systolic" required 
 class="w-full bg-[#2a2e38] border-2 border-subtle rounded-3xl px-8 py-8 text-3xl font-semibold text-center text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>

 <div class="space-y-6">
 <label class="block text-[12px] font-semibold text-slate-400 font-medium text-center">Diastolic BP (mmHg)</label>
 <input type="number" name="bp_diastolic" required 
 class="w-full bg-[#2a2e38] border-2 border-subtle rounded-3xl px-8 py-8 text-3xl font-semibold text-center text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>

 <div class="space-y-6">
 <label class="block text-[12px] font-semibold text-slate-400 font-medium text-center">Temperature (°C)</label>
 <input type="number" step="0.1" name="temperature" required 
 class="w-full bg-[#2a2e38] border-2 border-subtle rounded-3xl px-8 py-8 text-3xl font-semibold text-center text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>

 <div class="space-y-6">
 <label class="block text-[12px] font-semibold text-slate-400 font-medium text-center">Pulse Rate (BPM)</label>
 <input type="number" name="pulse" required 
 class="w-full bg-[#2a2e38] border-2 border-subtle rounded-3xl px-8 py-8 text-3xl font-semibold text-center text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>

 <div class="col-span-2 mt-16">
 <button type="submit" class="group relative w-full py-12 bg-sage text-white rounded-[3rem] text-3xl font-semibold font-medium /40 hover:bg-sage transition-all hover:scale-[1.02] active:scale-[0.98] border border-indigo-400/30 overflow-hidden">
 <span class="relative z-10 flex items-center justify-center gap-4">
 Initialize Case Flow
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="animate-bounce-x"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
 </span>
 <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
 </button>
 </div>
 </form>

 <div class="mt-24 text-center">
 <p class="text-[12px] font-semibold text-slate-600 uppercase tracking-[0.5em] ">Confidential Institutional Perimeter · Secured Core</p>
 </div>
 </div>
</div>

<style>
 @keyframes bounce-x {
 0%, 100% { transform: translateX(0); }
 50% { transform: translateX(5px); }
 }
 .animate-bounce-x { animation: bounce-x 1s infinite; }

 @keyframes shake {
 0%, 100% { transform: translateX(0); }
 25% { transform: translateX(-10px); }
 75% { transform: translateX(10px); }
 }
 .animate-shake { animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both; }
</style>
</x-cc-shell>

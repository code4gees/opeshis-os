<x-cc-shell title='Opeshis OS'>

@section('title', 'Institutional Identity Verification - Opeshis OS')


<div class="min-h-[80vh] flex items-center justify-center p-8">
    <div class="bg-white/5 backdrop-blur-xl border border-white/10 w-full max-w-md rounded-[2.5rem] p-12 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-emerald-500 to-indigo-500"></div>
        
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-black text-white uppercase tracking-tight mb-2">Verification</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em]">Institutional Access Protocol</p>
        </div>

        @if(session('error'))
            <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-500 rounded-2xl text-[10px] font-black uppercase tracking-widest text-center">
                {{ session('error') }}
            </div>
        @endif

        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-8 text-center leading-relaxed">
            A secure authorization code has been dispatched to your institutional terminal. Enter it below to proceed.
        </p>

        @if(session('last_otp_debug'))
            <div class="mb-8 p-4 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 rounded-2xl text-[10px] font-black uppercase tracking-widest text-center">
                DEBUG_HINT: {{ session('last_otp_debug') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login/otp') }}" class="space-y-6">
            @csrf
            <div>
                <input type="text" name="otp" placeholder="••••••" required maxlength="6"
                    class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-2xl font-black text-center text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all tracking-[0.5em]">
            </div>

            <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-indigo-600/30 hover:bg-indigo-700 transition-all hover:scale-[1.02] active:scale-[0.98]">
                Authorize Session
            </button>
        </form>

        <div class="mt-10 text-center border-t border-white/5 pt-8">
            <a href="/login" class="text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-white transition">Return to Personnel Portal</a>
        </div>
    </div>
</div>
</x-cc-shell>

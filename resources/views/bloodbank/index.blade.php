<x-cc-shell title='Opeshis OS'>

@section('title', 'Blood Bank Command — Opeshis OS')


<div class="space-y-8 animate-fade-in">
    <!-- Header: Blood Bank Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Blood Bank Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Serology & Transfusion Surveillance · Strategic Reserve Monitoring</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('bloodbank.donors') }}" class="px-8 py-4 bg-white/5 border border-white/10 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-white/10 transition-all">
                Donor Registry
            </a>
            <a href="{{ route('bloodbank.inventory') }}" class="px-8 py-4 bg-rose-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-rose-600/20 hover:bg-rose-700 transition-all border border-rose-500/50">
                Unit Inventory Matrix
            </a>
        </div>
    </header>

    <!-- Stock Metrics Matrix -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mb-12">
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-white/5 to-transparent flex flex-col justify-center">
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4">Total Unit Reserves</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter">{{ $stats['total_units'] }} <span class="text-[10px] font-black text-slate-600 ml-1 uppercase">Units</span></h3>
        </div>
        @foreach(['A+', 'B+', 'O+', 'AB+'] as $group)
            @php $count = $stock->where('blood_group', $group)->first()->total ?? 0; @endphp
            <div class="glass-panel p-8 rounded-[2rem] border border-white/10 shadow-xl relative overflow-hidden group hover:border-rose-500/30 transition-all">
                <div class="absolute -right-2 -top-2 opacity-5 font-black text-6xl italic group-hover:opacity-10 transition-opacity">{{ $group }}</div>
                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4 italic">Group {{ $group }}</p>
                <div class="flex items-end gap-3">
                    <h3 class="text-3xl font-black {{ $count > 5 ? 'text-white' : 'text-rose-500 animate-pulse' }} tracking-tighter italic">{{ $count }}</h3>
                    <p class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mb-1">Stock</p>
                </div>
                <div class="w-full h-1 bg-white/5 rounded-full mt-6 overflow-hidden">
                    <div class="h-full bg-rose-600 shadow-[0_0_8px_rgba(225,29,72,0.5)]" style="width: {{ min(100, $count * 10) }}%"></div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Strategic Alerts -->
        <div class="lg:col-span-4 space-y-8">
            <div class="glass-panel p-10 rounded-[3rem] border border-rose-500/20 bg-gradient-to-br from-rose-600/10 to-transparent shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></div>
                        <h3 class="text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] italic">Critical Reserve Alert</h3>
                    </div>
                    <p class="text-xs text-slate-300 font-bold leading-relaxed mb-8">Stock levels for <span class="text-rose-500">O-</span> and <span class="text-rose-500">B-</span> have descended below institutional safety thresholds. Strategic mobilization required.</p>
                    <button class="w-full py-4 bg-rose-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-rose-600/20 hover:bg-rose-700 transition-all border border-rose-500/50">Execute Donor Campaign</button>
                </div>
                <!-- Decorative background -->
                <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-rose-500/10 rounded-full blur-3xl"></div>
            </div>

            <div class="glass-panel p-10 rounded-[3rem] border border-white/10 shadow-xl flex flex-col justify-center">
                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4">Compatibility Sync</p>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Universal Donor (O-)</span>
                    <span class="text-[8px] font-black text-rose-500 uppercase tracking-widest">Critical</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Universal Recipient (AB+)</span>
                    <span class="text-[8px] font-black text-emerald-500 uppercase tracking-widest">Stable</span>
                </div>
            </div>
        </div>

        <!-- Transfusion Matrix -->
        <div class="lg:col-span-8 glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden flex flex-col">
            <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
                <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Live Transfusion Chain</h3>
                <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic">Chain Sync: Operational</span>
            </div>
            <div class="flex-1 flex flex-col items-center justify-center p-20 text-center">
                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mb-8 border border-white/10 text-slate-600">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic max-w-xs">No active transfusion records identified in the current 24-hour window.</p>
            </div>
        </div>
    </div>
</div>
</x-cc-shell>

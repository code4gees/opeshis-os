<div wire:poll.5s="refreshVitals" class="space-y-4">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] italic">Institutional Telemetry Stream</h3>
        <div class="flex items-center gap-2 px-2 py-1 bg-rose-500/10 border border-rose-500/20 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
            <span class="text-[8px] font-black text-rose-500 uppercase tracking-widest leading-none">Live Signal</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @php $latest = $vitals->first(); @endphp
        
        <div class="p-5 bg-slate-900/40 border border-white/5 rounded-2xl hover:border-indigo-500/30 transition-all group">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-heart-pulse text-rose-500 text-xs"></i>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest">Pulse Rate</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-white italic tracking-tighter">{{ $latest->heart_rate ?? '--' }}</span>
                <span class="text-[8px] font-black text-slate-600 uppercase">BPM</span>
            </div>
        </div>

        <div class="p-5 bg-slate-900/40 border border-white/5 rounded-2xl hover:border-indigo-500/30 transition-all group">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-droplet text-blue-500 text-xs"></i>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest">SpO2 Level</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-white italic tracking-tighter">{{ $latest->spo2 ?? '--' }}</span>
                <span class="text-[8px] font-black text-slate-600 uppercase">%</span>
            </div>
        </div>

        <div class="p-5 bg-slate-900/40 border border-white/5 rounded-2xl hover:border-indigo-500/30 transition-all group">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-temperature-high text-amber-500 text-xs"></i>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest">Core Temp</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-white italic tracking-tighter">{{ $latest->temperature ?? '--' }}</span>
                <span class="text-[8px] font-black text-slate-600 uppercase">°C</span>
            </div>
        </div>

        <div class="p-5 bg-slate-900/40 border border-white/5 rounded-2xl hover:border-indigo-500/30 transition-all group">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas fa-lungs text-emerald-500 text-xs"></i>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest">Resp Rate</span>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl font-black text-white italic tracking-tighter">{{ $latest->respiratory_rate ?? '--' }}</span>
                <span class="text-[8px] font-black text-slate-600 uppercase">BPM</span>
            </div>
        </div>
    </div>
</div>

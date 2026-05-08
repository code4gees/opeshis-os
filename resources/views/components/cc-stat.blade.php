@props(['label', 'value', 'icon', 'trend' => null, 'trendUp' => true, 'color' => 'blue'])

@php
    $colors = [
        'blue'    => 'from-slate-700/40 to-slate-800/10 text-slate-300 border-slate-600/30', // Replaced blue with sophisticated slate
        'emerald' => 'from-emerald-600/20 to-teal-800/5 text-emerald-400 border-emerald-500/20',
        'rose'    => 'from-rose-900/40 to-rose-950/10 text-rose-400 border-rose-800/40',
        'amber'   => 'from-amber-700/20 to-orange-900/5 text-amber-500 border-amber-700/30',
        'violet'  => 'from-zinc-700/40 to-zinc-800/10 text-zinc-300 border-zinc-600/30', // Replaced violet with minimalist zinc
    ];
    $currentColor = $colors[$color] ?? $colors['emerald'];
@endphp

<div {{ $attributes->merge(['class' => 'cc-stat group relative overflow-hidden rounded-2xl border border-white/5 bg-slate-900/40 p-6 backdrop-blur-xl transition-all duration-300 hover:scale-[1.02] hover:border-white/10']) }}>
    <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-500 transition-colors group-hover:text-slate-400">
                {{ $label }}
            </p>
            <h4 class="mt-2 text-3xl font-black tracking-tight text-white">
                {{ $value }}
            </h4>
            
            @if($trend)
            <div class="mt-2 flex items-center space-x-1 {{ $trendUp ? 'text-emerald-400' : 'text-rose-400' }}">
                <i class="fas {{ $trendUp ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }} text-[10px]"></i>
                <span class="text-[10px] font-bold">{{ $trend }}</span>
            </div>
            @endif
        </div>

        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $currentColor }} shadow-lg shadow-black/20 ring-1">
            <i class="fas {{ $icon }} text-xl"></i>
        </div>
    </div>
    
    <!-- Micro-Chart placeholder effect -->
    <div class="mt-4 h-1 w-full overflow-hidden rounded-full bg-white/5">
        <div class="h-full bg-gradient-to-r {{ $currentColor }} opacity-50" style="width: 70%"></div>
    </div>
</div>

@props(['label', 'value', 'icon', 'trend' => null, 'trendUp' => true, 'color' => 'blue'])

@php
    $colors = [
        'blue' => 'from-blue-500/20 to-indigo-500/5 text-blue-400 border-blue-500/20',
        'emerald' => 'from-emerald-500/20 to-teal-500/5 text-emerald-400 border-emerald-500/20',
        'rose' => 'from-rose-500/20 to-pink-500/5 text-rose-400 border-rose-500/20',
        'amber' => 'from-amber-500/20 to-orange-500/5 text-amber-400 border-amber-500/20',
        'violet' => 'from-violet-500/20 to-purple-500/5 text-violet-400 border-violet-500/20',
    ];
    $currentColor = $colors[$color] ?? $colors['blue'];
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

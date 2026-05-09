@props(['label' => null, 'title' => null, 'value' => '', 'icon' => 'fa-circle-info', 'trend' => null, 'trendUp' => true, 'color' => null])

@php
    // Fallback support for both 'title' and 'label' across legacy and new templates
    $displayLabel = $label ?? $title ?? 'Metric';
@endphp

<div {{ $attributes->merge(['class' => 'cc-card p-6 relative overflow-hidden group hover:brightness-110 transition-all duration-300']) }}>
    <div class="flex items-start justify-between relative z-10">
        <div>
            <p class="text-[10px] font-bold text-white/20 uppercase tracking-[0.2em] mb-3">
                {{ $displayLabel }}
            </p>
            <h4 class="text-3xl font-extrabold text-white tracking-tighter">
                {{ $value }}
            </h4>
            
            @if($trend)
            <div class="mt-4 flex items-center gap-2 {{ $trendUp ? 'text-sage' : 'text-alert' }}">
                <div class="w-5 h-5 rounded-full {{ $trendUp ? 'bg-sage/10' : 'bg-alert/10' }} flex items-center justify-center">
                    <i class="fas {{ $trendUp ? 'fa-arrow-up' : 'fa-arrow-down' }} text-[8px]"></i>
                </div>
                <span class="text-[11px] font-bold tracking-tight">{{ $trend }}</span>
            </div>
            @endif
        </div>

        <div class="h-12 w-12 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-center text-white/20 group-hover:text-sage group-hover:bg-sage/10 transition-all duration-500">
            <i class="fas {{ $icon }} text-lg"></i>
        </div>
    </div>
    
    {{-- Subtle Background Glow --}}
    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-sage/5 blur-3xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
</div>

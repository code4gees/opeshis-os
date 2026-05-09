@props(['label' => null, 'title' => null, 'value' => '', 'icon' => 'fa-circle-info', 'trend' => null, 'trendUp' => true, 'color' => null])

@php
    // Fallback support for both 'title' and 'label' across legacy and new templates
    $displayLabel = $label ?? $title ?? 'Metric';
@endphp

<div {{ $attributes->merge(['class' => 'bg-card border border-subtle rounded-xl p-5 relative overflow-hidden group hover:bg-[#2a2e38] transition-colors']) }}>
    <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-medium text-slate-400 mb-1">
                {{ $displayLabel }}
            </p>
            <h4 class="text-2xl font-bold text-white tracking-tight">
                {{ $value }}
            </h4>
            
            @if($trend)
            <div class="mt-2 flex items-center space-x-1.5 {{ $trendUp ? 'text-sage' : 'text-alert' }}">
                <i class="fas {{ $trendUp ? 'fa-arrow-up' : 'fa-arrow-down' }} text-[10px]"></i>
                <span class="text-xs font-medium">{{ $trend }}</span>
            </div>
            @endif
        </div>

        <div class="h-10 w-10 rounded-lg bg-[#16191f] border border-subtle flex items-center justify-center text-slate-400 group-hover:text-sage transition-colors">
            <i class="fas {{ $icon }}"></i>
        </div>
    </div>
</div>

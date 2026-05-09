@props([
    'label',
    'value',
    'unit' => '',
    'trend' => null, // 'up', 'down', 'stable'
    'status' => 'normal', // 'normal', 'warning', 'critical'
    'history' => [] // array of numbers for a sparkline
])

@php
    $statusClasses = [
        'normal' => 'text-sage bg-sage/5 border-sage/10',
        'warning' => 'text-alert bg-alert/5 border-alert/10',
        'critical' => 'text-rose bg-rose/5 border-rose/10',
    ];
    $statusColor = [
        'normal' => '#82C09A',
        'warning' => '#D9776C',
        'critical' => '#E11D48',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'p-5 rounded-2xl bg-surface-elevated border border-white/5 group hover:border-cobalt/30 transition-all']) }}>
    <div class="flex justify-between items-start mb-4">
        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 group-hover:text-slate-400">{{ $label }}</span>
        @if($trend)
            <i data-lucide="trending-{{ $trend == 'up' ? 'up' : ($trend == 'down' ? 'down' : 'minus') }}"
               class="w-4 h-4 {{ $trend == 'up' ? 'text-rose' : ($trend == 'down' ? 'text-cobalt' : 'text-slate-500') }}"></i>
        @endif
    </div>

    <div class="flex items-baseline gap-1 mb-4">
        <span class="text-3xl font-extrabold tracking-tighter text-slate-100">{{ $value }}</span>
        <span class="text-xs font-bold text-slate-500">{{ $unit }}</span>
    </div>

    @if(!empty($history))
    <div class="h-10 w-full opacity-50 group-hover:opacity-100 transition-opacity">
        <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
            @php
                $max = max($history);
                $min = min($history);
                $range = $max - $min > 0 ? $max - $min : 1;
                $points = "";
                foreach($history as $i => $v) {
                    $x = ($i / (count($history) - 1)) * 100;
                    $y = 30 - (($v - $min) / $range) * 25;
                    $points .= "$x,$y ";
                }
            @endphp
            <polyline points="{{ $points }}" fill="none" stroke="{{ $statusColor[$status] }}" stroke-width="2" vector-effect="non-scaling-stroke" />
        </svg>
    </div>
    @endif
</div>

@props(['variant' => 'primary', 'size' => 'md', 'icon' => null])

@php
    $variants = [
        'primary' => 'bg-cobalt hover:bg-cobalt/90 text-white shadow-[0_0_15px_rgba(27,95,168,0.2)]',
        'secondary' => 'bg-surface-elevated hover:bg-surface-overlay text-slate-200 border border-white/5',
        'danger' => 'bg-rose hover:bg-rose/90 text-white shadow-[0_0_15px_rgba(225,29,72,0.2)]',
        'ghost' => 'bg-transparent hover:bg-white/5 text-slate-400 hover:text-slate-200',
    ];
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    $classes = "inline-flex items-center justify-center font-semibold rounded-xl transition-all duration-200 active:scale-95 disabled:opacity-50 disabled:pointer-events-none " . ($variants[$variant] ?? $variants['primary']) . " " . ($sizes[$size] ?? $sizes['md']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <i data-lucide="{{ $icon }}" class="{{ $slot->isEmpty() ? '' : 'mr-2' }} w-4 h-4"></i>
    @endif
    {{ $slot }}
</button>

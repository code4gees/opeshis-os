@props(['variant' => 'primary', 'size' => 'md', 'icon' => null])

@php
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-500 text-white shadow-lg shadow-blue-500/20 ring-1 ring-blue-400/20',
        'secondary' => 'bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700/60 shadow-sm',
        'danger' => 'bg-rose-600 hover:bg-rose-500 text-white shadow-lg shadow-rose-500/20 ring-1 ring-rose-400/20',
        'ghost' => 'bg-transparent hover:bg-white/5 text-slate-400 hover:text-slate-200',
    ];
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    $classes = "inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 active:scale-95 disabled:opacity-50 disabled:pointer-events-none " . ($variants[$variant] ?? $variants['primary']) . " " . ($sizes[$size] ?? $sizes['md']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <i class="fas {{ $icon }} {{ $slot->isEmpty() ? '' : 'mr-2' }}"></i>
    @endif
    {{ $slot }}
</button>

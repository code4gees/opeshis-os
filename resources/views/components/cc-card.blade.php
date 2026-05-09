@props(['title' => null, 'icon' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'cc-card group relative overflow-hidden rounded-2xl border border-white/5 bg-surface-elevated p-6 transition-all duration-300 hover:bg-surface-overlay hover:border-cobalt/30']) }}>
    
    @if($title || $icon)
    <div class="mb-6 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            @if($icon)
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-cobalt/10 text-cobalt border border-cobalt/20">
                <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
            </div>
            @endif
            
            @if($title)
            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-100 transition-colors">
                {{ $title }}
            </h3>
            @endif
        </div>
        
        @if(isset($action))
            {{ $action }}
        @endif
    </div>
    @endif

    <div class="relative z-10">
        {{ $slot }}
    </div>

    @if($footer)
    <div class="mt-4 border-t border-subtle pt-4 text-xs text-slate-500">
        {{ $footer }}
    </div>
    @endif
</div>

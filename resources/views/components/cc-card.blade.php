@props(['title' => null, 'icon' => null, 'footer' => null])

<div {{ $attributes->merge(['class' => 'cc-card group relative overflow-hidden rounded-xl border border-subtle bg-card/50 p-5  transition-all duration-300 hover:border-blue-500/30 hover: hover:/10']) }}>
    <!-- Decorative Glow -->
    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-sage/5 blur-3xl transition-all duration-500 group-hover:bg-sage/10"></div>
    
    @if($title || $icon)
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            @if($icon)
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-sage/10 text-sage ring-1 ring-blue-500/20">
                <i class="fas {{ $icon }} text-lg"></i>
            </div>
            @endif
            
            @if($title)
            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-400 group-hover:text-slate-200 transition-colors">
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

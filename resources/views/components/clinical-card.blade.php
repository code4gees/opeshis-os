@props(['title' => null, 'icon' => null, 'subtitle' => null, 'badge' => null, 'badgeType' => 'pending'])

<div {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-2xl border border-white/5 bg-slate-900/40 p-6 backdrop-blur-xl transition-all hover:border-indigo-500/30 hover:bg-slate-900/60']) }}>
    <!-- Ambient Glow -->
    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-indigo-500/5 blur-[100px] transition-all group-hover:bg-indigo-500/10"></div>
    
    <div class="relative flex flex-col gap-4">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-3">
                @if($icon)
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/10 text-indigo-400 ring-1 ring-inset ring-indigo-500/20">
                    <i class="fas {{ $icon }} text-lg"></i>
                </div>
                @endif
                <div>
                    @if($title)
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-200">
                        {{ $title }}
                    </h3>
                    @endif
                    @if($subtitle)
                    <p class="text-[10px] font-medium text-slate-500">
                        {{ $subtitle }}
                    </p>
                    @endif
                </div>
            </div>
            @if($badge)
            <x-cc-status-badge :status="$badge" />
            @endif
        </div>

        <div class="mt-2">
            {{ $slot }}
        </div>
    </div>
</div>

@props(['events' => []])

<div class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-white/5 before:to-transparent">
    @foreach($events as $event)
    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
        <!-- Icon -->
        <div class="flex items-center justify-center w-10 h-10 rounded-full border border-white/10 bg-surface-base text-slate-500 group-hover:border-cobalt/50 group-hover:text-cobalt shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-all">
            <i data-lucide="{{ $event['icon'] ?? 'circle' }}" class="w-5 h-5"></i>
        </div>
        <!-- Content -->
        <div class="w-[calc(100%-4rem)] md:w-[45%] p-5 rounded-2xl border border-white/5 bg-surface-elevated group-hover:border-cobalt/30 transition-all">
            <div class="flex items-center justify-between space-x-2 mb-1">
                <div class="font-bold text-slate-100 uppercase tracking-tight text-sm">{{ $event['title'] }}</div>
                <time class="font-bold text-[10px] text-slate-500 uppercase tracking-widest">{{ $event['time'] }}</time>
            </div>
            <div class="text-slate-400 text-xs leading-relaxed">{{ $event['description'] }}</div>
            @if(isset($event['meta']))
                <div class="mt-3 pt-3 border-t border-white/5 text-[10px] font-bold text-slate-500 uppercase tracking-widest flex gap-4">
                    @foreach($event['meta'] as $key => $val)
                        <span>{{ $key }}: <span class="text-slate-300">{{ $val }}</span></span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

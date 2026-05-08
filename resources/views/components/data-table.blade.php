@props(['headers' => [], 'title' => null, 'icon' => null])

<div class="flex flex-col gap-4">
    @if($title)
    <div class="flex items-center justify-between px-2">
        <div class="flex items-center gap-2">
            @if($icon)
            <i class="fas {{ $icon }} text-indigo-500/50"></i>
            @endif
            <h2 class="text-xs font-black uppercase tracking-[0.25em] text-slate-400">{{ $title }}</h2>
        </div>
        <div class="h-px flex-1 bg-gradient-to-r from-white/5 to-transparent ml-4"></div>
    </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-white/5 bg-slate-900/20 backdrop-blur-md">
        <div class="overflow-x-auto">
            <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-white/5']) }}>
                <thead class="bg-white/[0.02]">
                    <tr>
                        @foreach($headers as $header)
                        <th scope="col" class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
                            {{ $header }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 bg-transparent">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>

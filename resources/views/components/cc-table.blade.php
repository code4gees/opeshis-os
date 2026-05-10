@props(['headers' => [], 'compact' => false])

<div class="overflow-x-auto custom-scrollbar">
    <table {{ $attributes->merge(['class' => 'w-full text-left border-collapse']) }}>
        <thead class="border-b border-white/[0.05] bg-surface-elevated/50 sticky top-0 z-10 backdrop-blur-md">
            <tr>
                @foreach($headers as $header)
                <th class="{{ $compact ? 'px-4 py-3' : 'px-8 py-5' }} text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] whitespace-nowrap">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.02]">
            {{ $slot }}
        </tbody>
    </table>
</div>

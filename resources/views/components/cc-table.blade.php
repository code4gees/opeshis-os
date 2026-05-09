@props(['headers' => []])

<div class="overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'w-full text-left border-collapse']) }}>
        <thead class="border-b border-white/[0.04] bg-white/[0.01]">
            <tr>
                @foreach($headers as $header)
                <th class="px-8 py-5 text-[10px] font-bold text-white/20 uppercase tracking-widest whitespace-nowrap">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.04]">
            {{ $slot }}
        </tbody>
    </table>
</div>

@props(['headers' => []])

<div class="overflow-hidden rounded-xl border border-subtle bg-card/20 ">
    <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-white/5']) }}>
        <thead class="bg-white/[0.02]">
            <tr>
                @foreach($headers as $header)
                <th scope="col" class="px-5 py-4 text-left text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
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

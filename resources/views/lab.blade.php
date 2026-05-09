<x-cc-shell title='Laboratory Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Diagnostic <span class="text-sage">Laboratory</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Assay Surveillance · Result Validation · Sample Logistics</p>
        </div>
        <div class="flex items-center gap-4">
            <x-cc-stat title="To Collect" :value="$stats['collect']" icon="fa-vial" color="blue" />
            <x-cc-stat title="Critical" :value="$stats['critical']" icon="fa-biohazard" color="rose" />
        </div>
    </div>

    <!-- Navigation Matrix -->
    <div class="flex flex-wrap border-b border-white/[0.04] gap-10 px-2 mb-10">
        @foreach([
            ['analytics', 'Overview'],
            ['orders', 'Test Queue'],
            ['history', 'Recent Results'],
            ['catalog', 'Price List']
        ] as [$id, $label])
            <a href="{{ route('operations.diagnostics.lab', ['subtab' => $id]) }}" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all relative {{ $tab === $id ? 'text-sage' : 'text-white/20 hover:text-white/40' }}">
                {{ $label }}
                @if($tab === $id)
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-sage shadow-[0_0_8px_rgba(130,192,154,0.4)]"></div>
                @endif
            </a>
        @endforeach
    </div>

    @if(session('success'))
        <div class="mb-8 p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-2xl text-[10px] font-black uppercase tracking-widest animate-pulse">
            Institutional Diagnostic Protocol Synchronized Successfully.
        </div>
    @endif

    @if ($tab === 'analytics')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <x-cc-card class="p-10 flex flex-col items-center justify-center text-center bg-gradient-to-br from-white/5 to-transparent">
                <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-6">Throughput Volume</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-6xl font-extrabold text-white tracking-tighter">{{ $dailyStats->sum('total') }}</span>
                    <span class="text-[10px] font-bold text-white/10 uppercase tracking-widest">Studies</span>
                </div>
            </x-cc-card>
            
            <x-cc-card class="p-10 flex flex-col items-center justify-center text-center">
                <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-6">System Integrity</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-6xl font-extrabold text-emerald-500 tracking-tighter">99.9</span>
                    <span class="text-[12px] font-black text-emerald-500/40">%</span>
                </div>
                <p class="text-[9px] font-black text-emerald-500/20 uppercase tracking-widest mt-4">Operational Uptime</p>
            </x-cc-card>

            <x-cc-card class="p-10 flex flex-col items-center justify-center text-center">
                <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-6">Active Flag Rate</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-6xl font-extrabold text-rose-500 tracking-tighter">
                        {{ $stats['today'] > 0 ? round(($stats['critical'] / $stats['today']) * 100, 1) : 0 }}
                    </span>
                    <span class="text-[12px] font-black text-rose-500/40">%</span>
                </div>
                <p class="text-[9px] font-black text-rose-500/20 uppercase tracking-widest mt-4">Critical Threshold</p>
            </x-cc-card>
        </div>

    @elseif ($tab === 'orders')
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Active Test Worklist</h3>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                    <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Matrix Sync</span>
                </div>
            </div>

            <x-cc-table :headers="['Patient Identity', 'Assay Designation', 'Request Temporal', 'Status Signal', 'Strategic Action']">
                @forelse($pendingOrders as $order)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-blue-500/10 group-hover:text-blue-500 group-hover:border-blue-500/20 transition-all">
                                    {{ substr($order->patient->full_name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-blue-400 transition-colors">{{ $order->patient->full_name ?? 'UNKNOWN' }}</div>
                                    <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $order->patient->medical_id ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                                {{ $order->test_name ?? 'DIAGNOSTIC_ASSAY' }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="text-[11px] font-bold text-white/40 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }} Z</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full {{ $order->status === 'pending' ? 'bg-amber-500' : 'bg-blue-500 animate-pulse' }}"></div>
                                <span class="text-[9px] font-black {{ $order->status === 'pending' ? 'text-amber-500' : 'text-blue-500' }} uppercase tracking-widest">{{ $order->status }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            @if($order->status === 'pending')
                                <form method="POST" action="{{ route('operations.diagnostics.lab.action') }}">
                                    @csrf
                                    <input type="hidden" name="action" value="collect_sample">
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <x-cc-button type="submit" size="sm" color="blue" icon="fa-vial">Authorize Collection</x-cc-button>
                                </form>
                            @else
                                <x-cc-button size="sm" color="emerald" icon="fa-pen-to-square" onclick="openResultModal('{{ $order->id }}', '{{ $order->test_name }}')">
                                    Enter Results
                                </x-cc-button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <i class="fas fa-microscope text-white/5 text-2xl mb-4"></i>
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Diagnostic worklist is baseline.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>

    @elseif ($tab === 'history')
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02]">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Validated Results Archive</h3>
            </div>

            <x-cc-table :headers="['Validation Temporal', 'Patient Identity', 'Diagnostic Matrix', 'Result Value', 'Verification Signal']">
                @forelse($history as $h)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6 text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                            {{ \Carbon\Carbon::parse($h->updated_at)->format('d M, H:i') }} Z
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-bold text-white uppercase tracking-tight">{{ $h->patient->full_name ?? 'UNKNOWN' }}</div>
                            <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $h->patient->medical_id ?? 'N/A' }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-[11px] font-bold text-white/40 uppercase tracking-tighter">{{ $h->test_name ?? 'DIAGNOSTIC_RELEASE' }}</span>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-[13px] font-black text-white uppercase">{{ $h->results }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">Verified</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No validated results in archive.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>

    @elseif ($tab === 'catalog')
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02]">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Test Catalog</h3>
            </div>

            <x-cc-table :headers="['Category Protocol', 'Assay Designation', 'Institutional Fee', 'Protocol Standard']">
                @foreach($catalog as $item)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-white/40 uppercase tracking-widest">{{ $item->category }}</span>
                        </td>
                        <td class="px-8 py-6 font-bold text-white text-[13px] uppercase tracking-tight">{{ $item->name }}</td>
                        <td class="px-8 py-6 font-black text-emerald-500 text-[13px]">XAF {{ number_format($item->price ?? 0, 0) }}</td>
                        <td class="px-8 py-6 text-[10px] font-black text-white/10 uppercase tracking-[0.2em]">STANDARD_SOP</td>
                    </tr>
                @endforeach
            </x-cc-table>
        </x-cc-card>
    @endif
</div>

<!-- Modal: Result Entry Authorization -->
<x-cc-modal id="resultModal" title="Authorize Result Release" icon="fa-file-signature">
    <div class="mb-8 p-5 bg-white/[0.02] border border-white/[0.04] rounded-2xl">
        <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-1">Target Protocol</p>
        <h4 id="modalTestName" class="text-[14px] font-black text-white uppercase tracking-tight">--</h4>
    </div>

    <form method="POST" action="{{ route('operations.diagnostics.lab.action') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="action" value="submit_results">
        <input type="hidden" name="order_id" id="resOrderId">
        
        <x-cc-input label="Measured Result Value" name="results" required placeholder="ENTER PRIMARY ASSAY VALUE" icon="fa-vial-circle-check" />
        
        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Authorize & Verify Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<script>
    function openResultModal(id, name) {
        document.getElementById('resOrderId').value = id;
        document.getElementById('modalTestName').innerText = name.toUpperCase();
        document.getElementById('resultModal').classList.remove('hidden');
    }
</script>
</x-cc-shell>

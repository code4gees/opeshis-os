<x-cc-shell title='Pharmacy Hub | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Pharmacy <span class="text-sage">Hub</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Dispensing Control · Global Inventory Intelligence · Formulary Governance</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-truck-loading" color="blue" variant="ghost" onclick="document.getElementById('requestModal').classList.remove('hidden')">
                Authorize Restock Protocol
            </x-cc-button>
        </div>
    </div>

    <!-- Pharmacy Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Pending RX" value="{{ $pending->count() }}" icon="fa-prescription" trend="Needs Dispensing" color="indigo" />
        <x-cc-stat title="Low Stock" value="{{ $lowStockCount }}" icon="fa-box-open" trend="Critical Level" color="rose" />
        <x-cc-stat title="Inventory Value" value="XAF {{ number_format($totalValuation / 1000, 1) }}K" icon="fa-vault" trend="Total Valuation" color="emerald" />
        <x-cc-stat title="Formulary" value="{{ $inventory->count() }}" icon="fa-pills" trend="Active Items" color="slate" />
    </div>

    <!-- Navigation Matrix -->
    <div class="flex flex-wrap border-b border-white/[0.04] gap-10 px-2 mb-10">
        @foreach([
            ['dispensing', 'Dispensing Queue'],
            ['inventory', 'Global Stock'],
            ['history', 'History Log'],
            ['orders', 'Requisitions']
        ] as [$id, $label])
            <a href="{{ route('operations.diagnostics.pharmacy', ['subtab' => $id]) }}" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all relative {{ $tab === $id ? 'text-sage' : 'text-white/20 hover:text-white/40' }}">
                {{ $label }}
                @if($tab === $id)
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-sage shadow-[0_0_8px_rgba(130,192,154,0.4)]"></div>
                @endif
            </a>
        @endforeach
    </div>

    @if ($tab === 'dispensing')
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Active Prescription Worklist</h3>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-sage animate-pulse"></div>
                    <span class="text-[9px] font-black text-sage uppercase tracking-widest">Live Dispensing Queue</span>
                </div>
            </div>

            <x-cc-table :headers="['Patient Identity', 'Medication Protocol', 'Dosage / Instructions', 'Duration Matrix', 'Strategic Action']">
                @forelse($pending as $rx)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-sage/10 group-hover:text-sage group-hover:border-sage/20 transition-all">
                                    {{ substr($rx->patient->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $rx->patient->full_name }}</div>
                                    <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $rx->patient->medical_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                                {{ $rx->inventory->item_name ?? 'UNKNOWN_DRUG' }}
                            </span>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-2">{{ $rx->dosage ?? 'STANDARD_STRENGTH' }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[11px] text-white/40 font-bold uppercase tracking-tight leading-relaxed max-w-[200px] truncate">"{{ $rx->instructions }}"</div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-[13px] font-black text-white uppercase">{{ $rx->duration }} <span class="text-[10px] text-white/20 ml-1">Days</span></span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <form method="POST" action="{{ route('operations.diagnostics.pharmacy.action') }}">
                                @csrf
                                <input type="hidden" name="action" value="dispense">
                                <input type="hidden" name="prescription_id" value="{{ $rx->id }}">
                                <x-cc-button type="submit" size="sm" variant="ghost" icon="fa-hand-holding-medical" color="emerald">
                                    Authorize Dispense
                                </x-cc-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <i class="fas fa-pills text-white/5 text-2xl mb-4"></i>
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Prescription worklist is baseline.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>

    @elseif ($tab === 'inventory')
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02]">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Pharmacy Stock</h3>
            </div>

            <x-cc-table :headers="['Item / Strength', 'Classification', 'Institutional Price', 'Stock Level', 'Status Signal']">
                @forelse($inventory as $item)
                    @php $lowStock = ($item->stock_level ?? 0) <= ($item->reorder_level ?? 0); @endphp
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $item->item_name }}</div>
                            <div class="text-[10px] font-bold text-sage uppercase tracking-widest mt-1">{{ $item->formulary->strength ?? 'STANDARD_STRENGTH' }}</div>
                        </td>
                        <td class="px-8 py-6 text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                            {{ $item->category }}
                        </td>
                        <td class="px-8 py-6 font-black text-emerald-500 text-[13px]">
                            XAF {{ number_format($item->formulary->base_price ?? 0, 0) }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            <span class="text-[13px] font-black {{ $lowStock ? 'text-rose-500' : 'text-white' }}">{{ $item->stock_level ?? 0 }}</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full {{ $lowStock ? 'bg-rose-500 animate-pulse' : 'bg-emerald-500' }}"></div>
                                <span class="text-[9px] font-black {{ $lowStock ? 'text-rose-500' : 'text-emerald-500' }} uppercase tracking-widest">{{ $lowStock ? 'CRITICAL' : 'OPTIMAL' }}</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Inventory matrix is vacuum.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>

    @elseif ($tab === 'history')
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02]">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Dispensing Audit Ledger</h3>
            </div>

            <x-cc-table :headers="['Dispensed Temporal', 'Patient Identity', 'Medication Protocol', 'Validation Signal']">
                @forelse($history as $h)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6 text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                            {{ \Carbon\Carbon::parse($h->dispensed_at)->format('d M, H:i') }} Z
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-bold text-white uppercase tracking-tight">{{ $h->patient->full_name }}</div>
                        </td>
                        <td class="px-8 py-6 font-bold text-sage text-[11px] uppercase tracking-tighter">
                            {{ $h->inventory->item_name ?? 'UNKNOWN_MEDICATION' }}
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full bg-white/20"></div>
                                <span class="text-[9px] font-black text-white/20 uppercase tracking-widest">VERIFIED_DISPENSE</span>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">Audit ledger is baseline.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>

    @elseif ($tab === 'orders')
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02]">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Tactical Stock Requisitions</h3>
            </div>

            <x-cc-table :headers="['Item Identity', 'Quantity', 'Requisition Temporal', 'Status Protocol', 'Strategic Action']">
                @forelse($orders as $o)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6 font-bold text-white text-[13px] uppercase tracking-tight">{{ $o->item->item_name }}</td>
                        <td class="px-8 py-6 text-center text-[13px] font-black text-white ">{{ $o->requested_qty }}</td>
                        <td class="px-8 py-6 text-[11px] font-bold text-white/40 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($o->created_at)->format('d M, H:i') }} Z</td>
                        <td class="px-8 py-6">
                            @php
                                $statusColor = match($o->status) {
                                    'completed' => 'emerald',
                                    'dispatched' => 'blue',
                                    default => 'amber'
                                };
                            @endphp
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full bg-{{ $statusColor }}-500 {{ $o->status === 'dispatched' ? 'animate-pulse' : '' }}"></div>
                                <span class="text-[9px] font-black text-{{ $statusColor }}-500 uppercase tracking-widest">{{ $o->status }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            @if($o->status === 'dispatched')
                                <form method="POST" action="{{ route('operations.diagnostics.pharmacy.action') }}">
                                    @csrf
                                    <input type="hidden" name="action" value="acknowledge_receipt">
                                    <input type="hidden" name="req_id" value="{{ $o->id }}">
                                    <x-cc-button type="submit" size="sm" variant="ghost" color="blue">Authorize Receipt</x-cc-button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active requisitions.</p>
                        </td>
                    </tr>
                @endforelse
            </x-cc-table>
        </x-cc-card>
    @endif
</div>

<!-- Modal: Stock Requisition Authorization -->
<x-cc-modal id="requestModal" title="Institutional Restock Protocol" icon="fa-truck-loading">
    <form method="POST" action="{{ route('operations.diagnostics.pharmacy.action') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="action" value="request_stock">
        
        <x-cc-select label="Strategic Item Selector" name="inventory_id" required icon="fa-box-archive">
            @foreach($inventory as $i)
                <option value="{{ $i->id }}">{{ strtoupper($i->item_name) }} (LEVEL: {{ $i->stock_level }})</option>
            @endforeach
        </x-cc-select>

        <x-cc-input label="Requisition Quantity" name="qty" type="number" required placeholder="ENTER UNITS..." icon="fa-input-numeric" />

        <div class="pt-4">
            <x-cc-button type="submit" color="blue" class="w-full">Authorize Requisition Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Pharmacy Hub - Opeshis OS')

<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-100 uppercase tracking-tighter">Pharmacy <span class="text-blue-500">Hub</span></h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Dispensing Control & Global Inventory Management</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-truck-loading" color="blue" variant="ghost" onclick="document.getElementById('requestModal').classList.remove('hidden')">
                Stock Requisition
            </x-cc-button>
        </div>
    </div>

    <!-- Pharmacy KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="Pending RX" 
            value="{{ $pending->count() }}" 
            icon="fa-prescription" 
            trend="Needs Dispensing" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Low Stock" 
            value="{{ $lowStockCount }}" 
            icon="fa-box-open" 
            trend="Critical Level" 
            color="rose" 
        />
        <x-cc-stat 
            title="Inventory Value" 
            value="XAF {{ number_format($totalValuation / 1000, 1) }}K" 
            icon="fa-vault" 
            trend="Total Valuation" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Formulary" 
            value="{{ $inventory->count() }}" 
            icon="fa-pills" 
            trend="Active Items" 
            color="slate" 
        />
    </div>

    <!-- Tabbed Navigation -->
    <div class="flex flex-wrap border-b border-white/5 gap-8 px-2">
        @foreach([
            ['dispensing', 'Dispensing Queue'],
            ['inventory', 'Global Stock'],
            ['history', 'History'],
            ['orders', 'Requisitions']
        ] as [$id, $label])
        <a href="{{ route('pharmacy', ['subtab' => $id]) }}" class="pb-4 text-xs font-black uppercase tracking-widest border-b-2 transition-all {{ $tab === $id ? 'text-blue-500 border-blue-500' : 'text-slate-500 border-transparent hover:text-slate-300' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    @if ($tab === 'dispensing')
        <x-clinical-card title="Patient Prescription Queue" icon="fa-list-check" badge="Live Queue">
            <x-data-table :headers="['Patient Identity', 'Medication Details', 'Dosage / SIG', 'Quantity', 'Action']">
                @forelse($pending as $rx)
                <tr class="group hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-blue-400 transition-colors">{{ $rx->patient->full_name }}</div>
                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-1">{{ $rx->patient->medical_id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs font-black text-blue-400 uppercase italic">{{ $rx->inventory->item_name ?? 'UNKNOWN_DRUG' }}</div>
                        <div class="text-[10px] font-bold text-slate-500 uppercase mt-1">{{ $rx->dosage ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs font-medium text-slate-400 italic">"{{ $rx->instructions }}"</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-sm font-black text-white italic">{{ $rx->duration }} <span class="text-[9px] text-slate-600 uppercase italic ml-1">Days</span></span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form method="POST" action="{{ route('pharmacy.action') }}">
                            @csrf
                            <input type="hidden" name="action" value="dispense">
                            <input type="hidden" name="prescription_id" value="{{ $rx->id }}">
                            <x-cc-button type="submit" size="sm" variant="ghost" icon="fa-hand-holding-medical" color="emerald">
                                Dispense
                            </x-cc-button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-24 text-center text-slate-600 italic text-sm">No pending prescriptions in the queue.</td>
                </tr>
                @endforelse
            </x-data-table>
        </x-clinical-card>

    @elseif ($tab === 'inventory')
        <x-clinical-card title="Institutional Pharmacy Stock" icon="fa-boxes-stacked" badge="Verified Registry">
            <x-data-table :headers="['Item / Strength', 'Classification', 'Unit Price', 'Stock Level', 'Status']">
                @forelse($inventory as $item)
                    @php $lowStock = ($item->stock_level ?? 0) <= ($item->reorder_level ?? 0); @endphp
                    <tr class="group hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-blue-400 transition-colors">{{ $item->item_name }}</div>
                            <div class="text-[10px] font-black text-blue-500 uppercase mt-1">{{ $item->formulary->strength ?? 'STANDARD_STRENGTH' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $item->category }}</div>
                        </td>
                        <td class="px-6 py-4 text-right text-emerald-500 font-black text-xs italic">
                            XAF {{ number_format($item->formulary->base_price ?? 0, 0) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-sm font-black {{ $lowStock ? 'text-rose-500' : 'text-slate-200' }}">{{ $item->stock_level ?? 0 }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <x-status-badge :status="$lowStock ? 'critical' : 'completed'" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-24 text-center text-slate-600 italic text-sm">Inventory matrix is currently empty.</td>
                    </tr>
                @endforelse
            </x-data-table>
        </x-clinical-card>

    @elseif ($tab === 'history')
        <x-clinical-card title="Dispensing Log (Last 100)" icon="fa-history" badge="Forensic Ledger">
            <x-data-table :headers="['Dispensed To', 'Medication', 'Dispensed At', 'Clinician']">
                @forelse($history as $h)
                <tr class="hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4 font-bold text-slate-200 text-xs uppercase">{{ $h->patient->full_name }}</td>
                    <td class="px-6 py-4 font-black text-blue-400 text-xs uppercase italic">{{ $h->inventory->item_name ?? 'UNKNOWN' }}</td>
                    <td class="px-6 py-4 text-xs text-slate-400 uppercase italic">{{ \Carbon\Carbon::parse($h->dispensed_at)->format('d M H:i') }}</td>
                    <td class="px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest">PHARMACY_UNIT</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-24 text-center text-slate-600 italic text-sm">No historical records found.</td>
                </tr>
                @endforelse
            </x-data-table>
        </x-clinical-card>

    @elseif ($tab === 'orders')
        <x-clinical-card title="Warehouse Stock Requisitions" icon="fa-truck-ramp-box" badge="Tactical Logistics">
            <x-data-table :headers="['Item Name', 'Qty', 'Requested At', 'Status', 'Operation']">
                @forelse($orders as $o)
                <tr class="hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4 font-bold text-slate-200 text-xs uppercase">{{ $o->item->item_name }}</td>
                    <td class="px-6 py-4 text-center text-sm font-black text-white italic">{{ $o->requested_qty }}</td>
                    <td class="px-6 py-4 text-xs text-slate-400 uppercase italic">{{ \Carbon\Carbon::parse($o->created_at)->format('d M H:i') }}</td>
                    <td class="px-6 py-4 text-center">
                        @php
                            $status = match($o->status) {
                                'completed' => 'completed',
                                'dispatched' => 'clinical care',
                                default => 'pending'
                            };
                        @endphp
                        <x-status-badge :status="$status" />
                        <div class="text-[8px] font-black text-slate-500 uppercase mt-1 tracking-widest">{{ strtoupper($o->status) }}</div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($o->status === 'dispatched')
                        <form method="POST" action="{{ route('pharmacy.action') }}">
                            @csrf
                            <input type="hidden" name="action" value="acknowledge_receipt">
                            <input type="hidden" name="req_id" value="{{ $o->id }}">
                            <x-cc-button type="submit" size="sm" variant="ghost" color="blue">Confirm Receipt</x-cc-button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-24 text-center text-slate-600 italic text-sm">No active restock requisitions.</td>
                </tr>
                @endforelse
            </x-data-table>
        </x-clinical-card>
    @endif
</div>

<!-- Modal: Stock Requisition -->
<x-cc-modal id="requestModal" title="Institutional Restock Protocol" icon="fa-truck-loading">
    <form method="POST" action="{{ route('pharmacy.action') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="action" value="request_stock">
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Strategic Item Selector</label>
            <select name="inventory_id" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-blue-500/50 transition-all">
                @foreach($inventory as $i)
                    <option value="{{ $i->id }}">{{ $i->item_name }} (Current Stock: {{ $i->stock_level }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Requisition Quantity Flux</label>
            <input type="number" name="qty" required placeholder="Enter units..." class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-blue-500/50 transition-all">
        </div>
        <x-cc-button type="submit" color="blue" class="w-full py-4">Authorize Requisition Protocol</x-cc-button>
    </form>
</x-cc-modal>
</x-cc-shell>

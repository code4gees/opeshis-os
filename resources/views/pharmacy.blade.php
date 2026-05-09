<x-cc-shell title='Opeshis OS'>

@section('title', 'Pharmacy Hub - Opeshis OS')

<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-white uppercase tracking-tighter">Pharmacy <span class="text-sage">Hub</span></h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Dispensing Control & Global Inventory Management</p>
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
 <div class="flex flex-wrap border-b border-subtle gap-8 px-2">
 @foreach([
 ['dispensing', 'Dispensing Queue'],
 ['inventory', 'Global Stock'],
 ['history', 'History'],
 ['orders', 'Requisitions']
 ] as [$id, $label])
 <a href="{{ route('operations.diagnostics.pharmacy', ['subtab' => $id]) }}" class="pb-4 text-xs font-semibold font-medium border-b-2 transition-all {{ $tab === $id ? 'text-sage border-blue-500' : 'text-slate-500 border-transparent hover:text-slate-300' }}">
 {{ $label }}
 </a>
 @endforeach
 </div>

 @if ($tab === 'dispensing')
 <x-clinical-card title="Patient Prescription Queue" icon="fa-list-check" badge="Live Queue">
 <x-data-table :headers="['Patient Identity', 'Medication Details', 'Dosage / SIG', 'Quantity', 'Action']">
 @forelse($pending as $rx)
 <tr class="group hover:bg-card transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors">{{ $rx->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium mt-1">{{ $rx->patient->medical_id }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-xs font-semibold text-sage uppercase ">{{ $rx->inventory->item_name ?? 'UNKNOWN_DRUG' }}</div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-1">{{ $rx->dosage ?? 'N/A' }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-xs font-medium text-slate-400 ">"{{ $rx->instructions }}"</div>
 </td>
 <td class="px-6 py-4 text-center">
 <span class="text-sm font-semibold text-white ">{{ $rx->duration }} <span class="text-[12px] text-slate-600 uppercase ml-1">Days</span></span>
 </td>
 <td class="px-6 py-4 text-right">
 <form method="POST" action="{{ route('operations.diagnostics.pharmacy.action') }}">
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
 <td colspan="5" class="px-6 py-24 text-center text-slate-600 text-sm">No pending prescriptions in the queue.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>

 @elseif ($tab === 'inventory')
 <x-clinical-card title="Institutional Pharmacy Stock" icon="fa-boxes-stacked" badge="Verified Registry">
 <x-data-table :headers="['Item / Strength', 'Classification', 'Unit Price', 'Stock Level', 'Status']">
 @forelse($inventory as $item)
 @php $lowStock = ($item->stock_level ?? 0) <= ($item->reorder_level ?? 0); @endphp
 <tr class="group hover:bg-card transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors">{{ $item->item_name }}</div>
 <div class="text-[12px] font-semibold text-sage uppercase mt-1">{{ $item->formulary->strength ?? 'STANDARD_STRENGTH' }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $item->category }}</div>
 </td>
 <td class="px-6 py-4 text-right text-emerald-500 font-semibold text-xs ">
 XAF {{ number_format($item->formulary->base_price ?? 0, 0) }}
 </td>
 <td class="px-6 py-4 text-center">
 <span class="text-sm font-semibold {{ $lowStock ? 'text-rose-500' : 'text-slate-200' }}">{{ $item->stock_level ?? 0 }}</span>
 </td>
 <td class="px-6 py-4 text-right">
 <x-status-badge :status="$lowStock ? 'critical' : 'completed'" />
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-24 text-center text-slate-600 text-sm">Inventory matrix is currently empty.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>

 @elseif ($tab === 'history')
 <x-clinical-card title="Dispensing Log (Last 100)" icon="fa-history" badge="Forensic Ledger">
 <x-data-table :headers="['Dispensed To', 'Medication', 'Dispensed At', 'Clinician']">
 @forelse($history as $h)
 <tr class="hover:bg-card transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4 font-bold text-slate-200 text-xs uppercase">{{ $h->patient->full_name }}</td>
 <td class="px-6 py-4 font-semibold text-sage text-xs uppercase ">{{ $h->inventory->item_name ?? 'UNKNOWN' }}</td>
 <td class="px-6 py-4 text-xs text-slate-400 uppercase ">{{ \Carbon\Carbon::parse($h->dispensed_at)->format('d M H:i') }}</td>
 <td class="px-6 py-4 text-[12px] font-semibold text-slate-500 font-medium">PHARMACY_UNIT</td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-24 text-center text-slate-600 text-sm">No historical records found.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>

 @elseif ($tab === 'orders')
 <x-clinical-card title="Warehouse Stock Requisitions" icon="fa-truck-ramp-box" badge="Tactical Logistics">
 <x-data-table :headers="['Item Name', 'Qty', 'Requested At', 'Status', 'Operation']">
 @forelse($orders as $o)
 <tr class="hover:bg-card transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4 font-bold text-slate-200 text-xs uppercase">{{ $o->item->item_name }}</td>
 <td class="px-6 py-4 text-center text-sm font-semibold text-white ">{{ $o->requested_qty }}</td>
 <td class="px-6 py-4 text-xs text-slate-400 uppercase ">{{ \Carbon\Carbon::parse($o->created_at)->format('d M H:i') }}</td>
 <td class="px-6 py-4 text-center">
 @php
 $status = match($o->status) {
 'completed' => 'completed',
 'dispatched' => 'clinical care',
 default => 'pending'
 };
 @endphp
 <x-status-badge :status="$status" />
 <div class="text-[8px] font-semibold text-slate-500 uppercase mt-1 tracking-wider">{{ strtoupper($o->status) }}</div>
 </td>
 <td class="px-6 py-4 text-right">
 @if($o->status === 'dispatched')
 <form method="POST" action="{{ route('operations.diagnostics.pharmacy.action') }}">
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
 <td colspan="5" class="px-6 py-24 text-center text-slate-600 text-sm">No active restock requisitions.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>
 @endif
</div>

<!-- Modal: Stock Requisition -->
<x-cc-modal id="requestModal" title="Institutional Restock Protocol" icon="fa-truck-loading">
 <form method="POST" action="{{ route('operations.diagnostics.pharmacy.action') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="action" value="request_stock">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Strategic Item Selector</label>
 <select name="inventory_id" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-blue-500/50 transition-all">
 @foreach($inventory as $i)
 <option value="{{ $i->id }}">{{ $i->item_name }} (Current Stock: {{ $i->stock_level }})</option>
 @endforeach
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Requisition Quantity Flux</label>
 <input type="number" name="qty" required placeholder="Enter units..." class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-blue-500/50 transition-all">
 </div>
 <x-cc-button type="submit" color="blue" class="w-full py-4">Authorize Requisition Protocol</x-cc-button>
 </form>
</x-cc-modal>
</x-cc-shell>

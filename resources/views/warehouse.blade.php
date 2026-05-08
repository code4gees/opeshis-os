<x-cc-shell title='Opeshis OS'>

@section('title', 'Inventory & Supply Chain - Opeshis OS')


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
    
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-slate-800 border border-slate-700/60 rounded-xl p-6 shadow-sm">
        <div>
            <h1 class="text-2xl font-bold text-slate-100 tracking-tight">Inventory Management</h1>
            <p class="text-sm text-slate-400 mt-1">Manage hospital stock, medical supplies, and vendor relations.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="document.getElementById('addStockModal').classList.remove('hidden')" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-lg shadow-sm shadow-blue-500/10 transition-colors">
                Receive New Stock
            </button>
        </div>
    </header>

    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Secondary Navigation -->
    <div class="flex flex-wrap border-b border-slate-700/60 gap-8 px-2">
        @php
            $subnav = function($sub, $label) use ($tab) {
                $active = $tab === $sub;
                $cls = $active ? 'text-blue-500 border-blue-500' : 'text-slate-500 border-transparent hover:text-slate-300';
                return "<a href=\"".route('warehouse', ['subtab' => $sub])."\" class=\"pb-4 text-sm font-bold border-b-2 transition-all {$cls}\">{$label}</a>";
            };
        @endphp
        {!! $subnav('dashboard', 'Overview') !!}
        {!! $subnav('stock', 'Inventory List') !!}
        {!! $subnav('requisitions', 'Stock Requests') !!}
        {!! $subnav('vendors', 'Suppliers') !!}
    </div>

    @if ($tab === 'dashboard')
        <!-- Inventory KPIs -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Total SKUs</p>
                <h3 class="text-3xl font-bold text-slate-100">{{ number_format($stats['total_items']) }}</h3>
            </div>
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Inventory Value</p>
                <h3 class="text-3xl font-bold text-emerald-500">XAF {{ number_format($stats['total_value']) }}</h3>
            </div>
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pending Requests</p>
                <h3 class="text-3xl font-bold text-blue-500">{{ $stats['pending_reqs'] }}</h3>
            </div>
            <div class="bg-slate-800 rounded-xl p-6 border border-slate-700/60 shadow-sm">
                <p class="text-xs font-bold text-rose-500 uppercase tracking-wider mb-2">Low Stock Alerts</p>
                <h3 class="text-3xl font-bold text-rose-500">{{ $stats['expiring_soon'] }}</h3>
            </div>
        </div>

        <!-- Blood Bank Snapshot -->
        <div class="space-y-4">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider px-2">Blood Bank Reserves</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @if(isset($bloodBank))
                    @foreach($bloodBank as $b)
                        <div class="bg-slate-800 p-4 rounded-xl border border-slate-700/60 text-center">
                            <span class="text-xs font-bold text-slate-500 block mb-1">{{ $b->blood_group }}</span>
                            <div class="text-xl font-bold {{ $b->units_available < 10 ? 'text-rose-500' : 'text-slate-100' }}">{{ $b->units_available }}</div>
                            <span class="text-[10px] text-slate-600 font-medium uppercase">Units</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                <h3 class="text-sm font-bold text-slate-200">Recent Movements</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-700/60">
                            <th class="px-6 py-4 font-semibold">Type</th>
                            <th class="px-6 py-4 font-semibold">Item</th>
                            <th class="px-6 py-4 font-semibold">User</th>
                            <th class="px-6 py-4 font-semibold">Date</th>
                            <th class="px-6 py-4 font-semibold text-right">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        @foreach($recent_activity as $a)
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold {{ $a->movement_type === 'IN' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500' }}">
                                        {{ $a->movement_type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-200 font-medium">{{ $a->item_name }}</td>
                                <td class="px-6 py-4 text-slate-400">{{ $a->user_name ?? 'System' }}</td>
                                <td class="px-6 py-4 text-slate-400">{{ \Carbon\Carbon::parse($a->created_at)->format('d M, H:i') }}</td>
                                <td class="px-6 py-4 text-right font-bold {{ $a->movement_type === 'IN' ? 'text-emerald-500' : 'text-rose-500' }}">
                                    {{ $a->movement_type === 'IN' ? '+' : '-' }}{{ $a->quantity }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @elseif ($tab === 'stock')
        <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                <h3 class="text-sm font-bold text-slate-200">Current Stock Registry</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-700/60">
                            <th class="px-6 py-4 font-semibold">Item Name</th>
                            <th class="px-6 py-4 font-semibold">Category</th>
                            <th class="px-6 py-4 font-semibold">Supplier</th>
                            <th class="px-6 py-4 font-semibold text-center">Available</th>
                            <th class="px-6 py-4 font-semibold text-right">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        @foreach($stock as $s)
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-slate-100 font-bold">{{ $s->item_name }}</div>
                                    <div class="text-[10px] text-slate-500 font-medium mt-0.5 uppercase">Batch: {{ $s->batch_number ?: 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $s->category }}</td>
                                <td class="px-6 py-4 text-slate-400">{{ $s->vendor_name ?? 'Direct Purchase' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-base font-bold {{ $s->bulk_quantity <= $s->min_quantity ? 'text-rose-500' : 'text-slate-200' }}">
                                        {{ number_format($s->bulk_quantity) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-emerald-500 font-bold">{{ number_format($s->unit_cost) }} XAF</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @elseif ($tab === 'requisitions')
        <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                <h3 class="text-sm font-bold text-slate-200">Departmental Requests</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-700/60">
                            <th class="px-6 py-4 font-semibold">Requested Item</th>
                            <th class="px-6 py-4 font-semibold">Requester</th>
                            <th class="px-6 py-4 font-semibold text-center">Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        @foreach($requisitions as $r)
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="text-slate-100 font-bold uppercase text-xs">{{ $r->pharmacy_item_name }}</div>
                                    <div class="text-[10px] text-slate-500 font-medium mt-0.5">QTY: {{ $r->requested_qty }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $r->requester_name }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase
                                        @if($r->status === 'completed') bg-emerald-500/10 text-emerald-500
                                        @elseif($r->status === 'dispatched') bg-blue-500/10 text-blue-500
                                        @else bg-slate-700 text-slate-400 @endif">
                                        {{ $r->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($r->status === 'pending')
                                        <button onclick="openDispatchModal('{{ $r->id }}', '{{ $r->pharmacy_item_name }}', {{ $r->requested_qty }})" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-bold rounded-lg transition-all">Approve Dispatch</button>
                                    @else
                                        <span class="text-xs text-slate-500 italic">Fulfilled</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @elseif ($tab === 'vendors')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-900/40">
                    <h3 class="text-sm font-bold text-slate-200">Supplier List</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-slate-500 border-b border-slate-700/60">
                                <th class="px-6 py-4 font-semibold">Supplier Name</th>
                                <th class="px-6 py-4 font-semibold text-center">Items Provided</th>
                                <th class="px-6 py-4 font-semibold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/40">
                            @foreach($vendors ?? [] as $v)
                                <tr class="hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-200 uppercase text-xs">{{ $v->name }}</div>
                                        <div class="text-[10px] text-slate-500 font-medium mt-0.5">Contact: {{ $v->contact_person ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-300 font-bold">{{ $v->item_count ?? 0 }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ ($v->status ?? 'active') === 'active' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-rose-500/10 text-rose-500' }}">
                                            {{ $v->status ?? 'active' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Vendor -->
            <div class="bg-slate-800 rounded-xl border border-slate-700/60 shadow-sm p-6 h-fit">
                <h3 class="text-sm font-bold text-slate-200 mb-6">Register New Supplier</h3>
                <form method="POST" action="{{ route('warehouse.action') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="action" value="register_vendor">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Company Name</label>
                        <input type="text" name="name" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600" placeholder="e.g. PharmaCorp Ltd">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Contact Person</label>
                        <input type="text" name="contact_person" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Email / Phone</label>
                        <input type="text" name="email" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                    <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-sm font-bold transition-all">Register Supplier</button>
                </form>
            </div>
        </div>
    @endif
</div>

<!-- Modal: Add Stock -->
<div id="addStockModal" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-6">
    <div class="bg-slate-800 w-full max-w-lg rounded-xl p-8 shadow-2xl border border-slate-700/60">
        <h3 class="text-xl font-bold text-slate-100 mb-6">Stock Intake Entry</h3>
        <form method="POST" action="{{ route('warehouse.action') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="action" value="add_stock">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Item Name</label>
                <input type="text" name="item_name" required placeholder="e.g. Paracetamol 500mg" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Category</label>
                    <input type="text" name="category" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Quantity</label>
                    <input type="number" name="bulk_quantity" required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>
            <div class="flex gap-3 mt-8">
                <button type="button" onclick="document.getElementById('addStockModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-sm font-bold transition-all shadow-lg shadow-blue-600/20">Save Stock Entry</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDispatchModal(id, name, qty) {
        // Simple logic for demonstration - can be expanded to a real dispatch modal
        if(confirm("Confirm dispatch of " + qty + " units of " + name + "?")) {
            // Submit form logic here
        }
    }
</script>
</x-cc-shell>

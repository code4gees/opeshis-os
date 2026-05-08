<x-cc-shell title='Central Inventory - Opeshis OS'>
@section('title', 'Central Inventory | Operations')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-white/5 pb-8">
        <div>
            <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">
                <i class="fas fa-boxes text-emerald-500/50"></i>
                <span>Operations</span>
                <span class="text-white/10">/</span>
                <span class="text-slate-300">Central Inventory</span>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase">
                Inventory <span class="text-emerald-500">Control</span>
            </h1>
        </div>
        <div class="mt-6 md:mt-0">
            <x-cc-button icon="fa-plus-circle" onclick="document.getElementById('inventoryModal').classList.remove('hidden')">
                Record Stock
            </x-cc-button>
        </div>
    </div>

    <!-- Error/Success Banners -->
    @if(session('success'))
    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl text-sm font-bold flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-4 rounded-xl text-sm font-bold flex items-center gap-3">
        <i class="fas fa-exclamation-triangle"></i>
        {{ session('error') }}
    </div>
    @endif

    <x-cc-card title="Stock Overview" icon="fa-clipboard-list">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 text-[10px] uppercase tracking-widest text-slate-500">
                        <th class="p-3 font-bold">Item Name</th>
                        <th class="p-3 font-bold">Category</th>
                        <th class="p-3 font-bold">Location</th>
                        <th class="p-3 font-bold text-center">Stock Level</th>
                        <th class="p-3 font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($items as $item)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="p-3 text-sm text-slate-200 font-bold">{{ $item->item_name }}</td>
                            <td class="p-3 text-xs text-slate-400">{{ $item->category }}</td>
                            <td class="p-3 text-xs text-slate-400">{{ $item->location }}</td>
                            <td class="p-3 text-center">
                                <span class="px-2 py-1 rounded-md text-[10px] font-black uppercase tracking-wider {{ $item->stock_level < 10 ? 'bg-rose-500/20 text-rose-400' : 'bg-emerald-500/20 text-emerald-400' }}">
                                    {{ $item->stock_level }} Units
                                </span>
                            </td>
                            <td class="p-3">
                                <button class="text-xs text-blue-400 hover:text-blue-300 font-bold uppercase tracking-wider" onclick="openActionModal({{ $item->id }}, '{{ $item->item_name }}', {{ $item->stock_level }})">
                                    Update
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-500 text-xs font-bold uppercase tracking-widest">
                                No Inventory Items Recorded
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </x-cc-card>
</div>

<!-- Quick Action Modal -->
<div id="actionModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="bg-slate-900 border border-white/10 rounded-2xl w-full max-w-md shadow-2xl p-6">
        <h3 class="text-xl font-black text-white mb-4 uppercase tracking-tight">Stock Update</h3>
        <p class="text-xs text-slate-400 mb-6 font-medium">Item: <span id="modalItemName" class="text-blue-400 font-bold"></span></p>
        
        <form method="POST" action="{{ route('inventory.action') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="item_id" id="modalItemId">
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Action</label>
                <select name="action_type" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white">
                    <option value="restock">Restock (+)</option>
                    <option value="dispatch">Dispatch (-)</option>
                </select>
            </div>
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Quantity</label>
                <input type="number" name="quantity" min="1" required class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white" placeholder="Enter amount">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Reason / Reference</label>
                <input type="text" name="reason" class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-sm text-white" placeholder="Optional reference note">
            </div>

            <div class="flex gap-3 mt-6">
                <button type="button" onclick="document.getElementById('actionModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-800 hover:bg-slate-700 rounded-xl text-xs font-bold text-white uppercase tracking-widest transition-colors">
                    Cancel
                </button>
                <button type="submit" class="flex-1 py-3 bg-blue-600 hover:bg-blue-500 rounded-xl text-xs font-bold text-white uppercase tracking-widest transition-colors">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openActionModal(id, name, currentStock) {
        document.getElementById('modalItemId').value = id;
        document.getElementById('modalItemName').innerText = name + ' (Current: ' + currentStock + ')';
        document.getElementById('actionModal').classList.remove('hidden');
    }
</script>

</x-cc-shell>

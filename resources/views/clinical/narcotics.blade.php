<x-cc-shell title='Opeshis OS'>

@section('title', 'Narcotics & Controlled Drugs — Opeshis OS')

<div class="space-y-8 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-200 uppercase tracking-tighter">Narcotics <span class="text-rose-500">Command</span></h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Institutional Controlled Substance Tracking · Dual-Witness Accountability · Security Protocol</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-file-shield" color="rose" variant="ghost" onclick="document.getElementById('moveModal').classList.remove('hidden')">
                Log Movement Protocol
            </x-cc-button>
            <form action="{{ url('/clinical/narcotics/report') }}" method="GET">
                <x-cc-button type="submit" icon="fa-print" color="slate" variant="ghost">Security Report</x-cc-button>
            </form>
        </div>
    </div>

    <!-- Security Intelligence KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            title="High-Alert Items" 
            value="{{ $register->count() }}" 
            icon="fa-pills" 
            trend="Institutional Log" 
            color="rose" 
        />
        <x-cc-stat 
            title="Movements (24h)" 
            value="{{ $movements->where('created_at', '>=', now()->startOfDay())->count() }}" 
            icon="fa-exchange-alt" 
            trend="Active Matrix" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Security Audit" 
            value="Pass" 
            icon="fa-shield-check" 
            trend="Audit Target" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Registry Pulse" 
            value="Synced" 
            icon="fa-network-wired" 
            trend="Institutional Log" 
            color="slate" 
        />
    </div>

    <!-- Controlled Drug Inventory Matrix -->
    <x-clinical-card title="Controlled Drug Inventory Matrix" icon="fa-database" badge="Audit: Verified">
        <x-data-table :headers="['Controlled Item', 'Institutional Strength', 'Batch Protocol', 'Current Balance', 'Last Audit']">
            @foreach($register as $n)
                <tr class="group hover:bg-rose-500/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors italic">{{ $n->item_name }}</div>
                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-1">S_ID: {{ substr($n->id, 0, 8) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs font-black text-slate-300 uppercase italic">{{ $n->strength ?: 'STANDARD_PROTOCOL' }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">Formulation Matrix</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-white/5 text-slate-400 border border-white/10 rounded-lg text-[8px] font-black uppercase tracking-widest italic shadow-lg shadow-white/5">
                            {{ $n->batch_no ?: 'GEN_BATCH' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-black text-white italic leading-none">{{ $n->current_balance }} <span class="text-[9px] text-slate-500 ml-1 uppercase">Units</span></div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">Verified stock node</div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ \Carbon\Carbon::parse($n->updated_at)->format('d M, H:i') }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1">Institutional Audit</div>
                    </td>
                </tr>
            @endforeach
        </x-data-table>
    </x-clinical-card>

    <!-- Dual-Witness Transaction Log -->
    <x-clinical-card title="Dual-Witness Transaction Intelligence Log" icon="fa-history" badge="Surveillance Active">
        <x-data-table :headers="['Transaction Meta', 'Flux Signal', 'Balance Node', 'Clinical Trace', 'Institutional Witness']">
            @foreach($movements as $m)
                <tr class="group hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                    <td class="px-6 py-4">
                        <x-status-badge :status="$m->movement_type === 'IN' ? 'completed' : ($m->movement_type === 'OUT' ? 'clinical care' : 'discharged')" />
                        <div class="text-[8px] font-black text-slate-500 uppercase mt-1 tracking-widest">Protocol Type</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="{{ $m->movement_type === 'IN' ? 'text-emerald-500' : 'text-rose-500' }} font-black text-sm italic">
                            {{ $m->movement_type === 'IN' ? '+' : '-' }}{{ $m->quantity }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center text-white font-black italic">{{ $m->balance_after }}</td>
                    <td class="px-6 py-4 uppercase tracking-tight text-[9px] font-bold text-slate-400 italic">
                        {{ $m->patient ? 'PATIENT: '.substr($m->patient->medical_id, 0, 12) : 'INVENTORY_SYNC_PROTOCOL' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="text-[9px] font-black text-slate-300 uppercase tracking-widest italic">W: {{ $m->witnessed_by }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase mt-1">{{ \Carbon\Carbon::parse($m->created_at)->format('d M, H:i') }}</div>
                    </td>
                </tr>
            @endforeach
        </x-data-table>
    </x-clinical-card>
</div>

<!-- Modal: Log Movement -->
<x-cc-modal id="moveModal" title="Authorize Controlled Substance Transaction" icon="fa-file-shield">
    <form method="POST" action="{{ url('/clinical/narcotics/movement') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Target Controlled Item</label>
                <select name="stock_id" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
                    @foreach($register as $n)
                        <option value="{{ $n->id }}">{{ strtoupper($n->item_name) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Transaction Flux Signal</label>
                <select name="type" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
                    <option value="OUT">DISPENSE_PROTOCOL (OUT)</option>
                    <option value="IN">INTAKE_PROTOCOL (IN)</option>
                    <option value="DESTROYED">DESTRUCTION_PROTOCOL</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Quantity Flux Node</label>
                <input name="quantity" type="number" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Balance Reconciliation</label>
                <input name="balance_after" type="number" required placeholder="POST_TRANSACTION_BALANCE" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Patient Identity Trace (If OUT)</label>
            <input name="patient_id" placeholder="OP-XXXX-XXXX" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Institutional Witness Authentication</label>
            <input name="witness" required placeholder="ENTER_BIO_ID_OR_NAME" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase transition-all">
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full uppercase tracking-widest">Authorize Transaction Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

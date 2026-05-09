<x-cc-shell title='Narcotics | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Narcotics <span class="text-rose-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Controlled Substance Tracking · Dual-Witness Accountability · Security Protocol</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-file-shield" color="rose" variant="ghost" onclick="document.getElementById('moveModal').classList.remove('hidden')">
                Log Movement Protocol
            </x-cc-button>
            <form action="{{ url('/clinical/narcotics/report') }}" method="GET">
                <x-cc-button type="submit" icon="fa-print" color="slate" variant="ghost">Security Report</x-cc-button>
            </form>
        </div>
    </div>

    <!-- Security Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="High-Alert Items" :value="$register->count()" icon="fa-pills" trend="Institutional Log" color="rose" />
        <x-cc-stat title="Movements (24h)" :value="$movements->where('created_at', '>=', now()->startOfDay())->count()" icon="fa-exchange-alt" trend="Active Matrix" color="indigo" />
        <x-cc-stat title="Security Audit" value="Pass" icon="fa-shield-check" trend="Audit Target" color="emerald" />
        <x-cc-stat title="Registry Pulse" value="Synced" icon="fa-network-wired" trend="Institutional Log" color="slate" />
    </div>

    <div class="space-y-12">
        <!-- Controlled Drug Inventory Matrix -->
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Controlled Drug Inventory Matrix</h3>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                    <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest">Audit: Verified</span>
                </div>
            </div>

            <x-cc-table :headers="['Controlled Item', 'Institutional Strength', 'Batch Protocol', 'Current Balance', 'Last Audit']">
                @foreach($register as $n)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-rose-400 transition-colors">{{ $n->item_name }}</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">S_ID: {{ substr($n->id, 0, 8) }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">{{ $n->strength ?: 'STANDARD_PROTOCOL' }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[9px] font-black text-white/40 uppercase tracking-widest">
                                {{ $n->batch_no ?: 'GEN_BATCH' }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[13px] font-bold text-white tracking-tighter">{{ $n->current_balance }} <span class="text-[9px] text-white/20 uppercase ml-1">Units</span></div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="text-[11px] font-bold text-white uppercase tracking-tighter">{{ \Carbon\Carbon::parse($n->updated_at)->format('d M, H:i') }} Z</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Institutional Audit</div>
                        </td>
                    </tr>
                @endforeach
            </x-cc-table>
        </x-cc-card>

        <!-- Dual-Witness Transaction Log -->
        <x-cc-card class="overflow-hidden">
            <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Dual-Witness Transaction Intelligence Log</h3>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                    <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">Surveillance Active</span>
                </div>
            </div>

            <x-cc-table :headers="['Transaction Meta', 'Flux Signal', 'Balance Node', 'Clinical Trace', 'Institutional Witness']">
                @foreach($movements as $m)
                    <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                        <td class="px-8 py-6">
                            @php
                                $typeCls = match($m->movement_type) {
                                    'IN' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    'OUT' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                    default => 'bg-white/5 text-white/20 border-white/10'
                                };
                            @endphp
                            <span class="px-3 py-1.5 rounded-xl border {{ typeCls }} text-[9px] font-black uppercase tracking-widest">
                                {{ $m->movement_type }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="{{ $m->movement_type === 'IN' ? 'text-emerald-500' : 'text-rose-500' }} text-[13px] font-extrabold tracking-tighter">
                                {{ $m->movement_type === 'IN' ? '+' : '-' }}{{ $m->quantity }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-[13px] font-bold text-white tracking-tighter">
                            {{ $m->balance_after }}
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">
                                {{ $m->patient ? 'PATIENT: '.substr($m->patient->medical_id, 0, 12) : 'INVENTORY_SYNC_PROTOCOL' }}
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="text-[11px] font-bold text-white/40 uppercase tracking-tighter">W: {{ $m->witnessed_by }}</div>
                            <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($m->created_at)->format('d M, H:i') }} Z</div>
                        </td>
                    </tr>
                @endforeach
            </x-cc-table>
        </x-cc-card>
    </div>
</div>

<!-- Modal: Log Movement -->
<x-cc-modal id="moveModal" title="Authorize Controlled Substance Transaction" icon="fa-file-shield">
    <form method="POST" action="{{ url('/clinical/narcotics/movement') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Target Controlled Item" name="stock_id" icon="fa-pills">
                @foreach($register as $n)
                    <option value="{{ $n->id }}">{{ strtoupper($n->item_name) }}</option>
                @endforeach
            </x-cc-select>
            <x-cc-select label="Transaction Flux Signal" name="type" icon="fa-rotate">
                <option value="OUT">DISPENSE_PROTOCOL (OUT)</option>
                <option value="IN">INTAKE_PROTOCOL (IN)</option>
                <option value="DESTROYED">DESTRUCTION_PROTOCOL</option>
            </x-cc-select>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <x-cc-input label="Quantity Flux Node" name="quantity" type="number" required icon="fa-hashtag" />
            <x-cc-input label="Balance Reconciliation" name="balance_after" type="number" required placeholder="POST_TRANSACTION_BALANCE" icon="fa-calculator" />
        </div>
        <x-cc-input label="Patient Identity Trace (If OUT)" name="patient_id" placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <x-cc-input label="Institutional Witness Authentication" name="witness" required placeholder="ENTER_BIO_ID_OR_NAME" icon="fa-shield-check" />
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Authorize Transaction Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

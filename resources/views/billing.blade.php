<x-cc-shell title='Opeshis OS'>

@section('title', 'Billing & Finance - Opeshis OS')

<div class="space-y-8 animate-fade-in pb-20">
    
    <!-- Header -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Institutional <span class="text-emerald-500">Finance</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Hospital Revenue Management · Insurance Claims · Network Settlement Matrix</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex flex-col items-end">
                <span class="text-[9px] font-black uppercase text-emerald-400 tracking-[0.2em] italic">Fiscal Perimeter: Secure</span>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest mt-1 italic">Quarter: Q2-2026</span>
            </div>
            <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
        </div>
    </header>

    <!-- Financial KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-cc-stat title="Patient Receivables" :value="number_format($kpis['patient_unpaid'], 0)" icon="fa-wallet" color="amber" trend="XAF Unpaid" />
        <x-cc-stat title="Insurance Claims" :value="number_format($kpis['insurance_unpaid'], 0)" icon="fa-file-invoice-dollar" color="blue" trend="XAF Pending" />
        <x-cc-stat title="Daily Revenue" :value="number_format($kpis['revenue_today'], 0)" icon="fa-chart-line" color="emerald" trend="XAF Total" />
    </div>

    <!-- Sub-Navigation -->
    <div class="flex flex-wrap border-b border-white/5 gap-8 px-2">
        @php
            $subnav = function($sub, $label) use ($tab) {
                $active = $tab === $sub;
                $cls = $active ? 'text-emerald-500 border-emerald-500' : 'text-slate-500 border-transparent hover:text-slate-300';
                return "<a href=\"".route('billing', ['subtab' => $sub])."\" class=\"pb-4 text-xs font-black uppercase tracking-widest border-b-2 transition-all {$cls}\">{$label}</a>";
            };
        @endphp
        {!! $subnav('pending', 'Unpaid Invoices') !!}
        {!! $subnav('insurance', 'Insurance Claims') !!}
        {!! $subnav('providers', 'Network Providers') !!}
        {!! $subnav('ledger', 'Revenue Ledger') !!}
    </div>

    @if(session('success'))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            Financial protocol transmission successful.
        </div>
    @endif

    @if ($tab === 'providers')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2">
                <x-clinical-card title="Registered HMO Providers" icon="fa-network-wired" badge="Network: Active">
                    <x-data-table :headers="['Provider Name', 'Default Co-Pay', 'Institutional Status']">
                        @foreach($allProviders as $p)
                            <tr class="hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                                <td class="px-6 py-4">
                                    <div class="font-black text-white uppercase text-xs">{{ $p->name }}</div>
                                    <div class="text-[10px] text-slate-500 mt-1 uppercase">ID: {{ substr($p->id, 0, 8) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs font-bold text-slate-300">{{ $p->default_co_pay_rate ?? 0 }}% Standard</div>
                                    <div class="text-[8px] text-slate-600 uppercase mt-1">Contracted Rate</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <x-status-badge status="completed" />
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                </x-clinical-card>
            </div>

            <div>
                <x-clinical-card title="Enroll Provider" icon="fa-plus-circle">
                    <form method="POST" action="{{ route('billing.action') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="action" value="add_provider">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Provider Name</label>
                            <input type="text" name="name" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-emerald-500/50 transition-all uppercase" placeholder="e.g. AXA_MANSARD">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Default Co-Pay Rate (%)</label>
                            <input type="number" name="co_pay" min="0" max="100" value="0" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-emerald-500/50 transition-all">
                        </div>
                        <x-cc-button type="submit" color="emerald" class="w-full py-4">Authorize Enrollment</x-cc-button>
                    </form>
                </x-clinical-card>
            </div>
        </div>
    @else
        <x-clinical-card title="Financial Settlement Matrix" icon="fa-file-invoice" badge="Live Ledger">
            <x-data-table :headers="['Patient Identity', 'Invoice Protocol', 'Strategic Amount', 'Fiscal Status', 'Strategic Action']">
                @foreach($invoices as $inv)
                    <tr class="hover:bg-white/[0.02] transition-colors border-b border-white/5 last:border-0">
                        <td class="px-6 py-4">
                            <div class="font-black text-white uppercase text-xs group-hover:text-emerald-400 transition-colors">{{ $inv->patient->full_name ?? 'UNKNOWN_PATIENT' }}</div>
                            <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ $inv->patient->medical_id ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-slate-300">INV-{{ substr($inv->id, 0, 8) }}</div>
                            <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ \Carbon\Carbon::parse($inv->created_at)->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-black text-white tracking-tighter italic">XAF {{ number_format($inv->total_amount ?? 0, 0) }}</div>
                            <div class="text-[8px] text-slate-600 uppercase mt-1">Gross Payload</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <x-status-badge :status="$inv->status === 'paid' ? 'completed' : 'pending'" />
                            <div class="text-[8px] font-black text-slate-500 uppercase mt-1 tracking-widest">{{ strtoupper($inv->status) }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($tab === 'pending')
                                <form method="POST" action="{{ route('billing.action') }}" class="flex gap-2 justify-end">
                                    @csrf
                                    <input type="hidden" name="action" value="pay_invoice">
                                    <input type="hidden" name="invoice_id" value="{{ $inv->id }}">
                                    <select name="payment_method" class="text-[10px] font-black uppercase bg-slate-900/50 text-slate-300 rounded-xl border border-white/10 px-4 outline-none focus:border-emerald-500/50">
                                        <option value="Cash">CASH</option>
                                        <option value="Mobile Money">MOBILE_MONEY</option>
                                        <option value="Insurance">INSURANCE_CLAIM</option>
                                    </select>
                                    <x-cc-button type="submit" size="sm" color="emerald" icon="fa-check">Settle</x-cc-button>
                                </form>
                            @else
                                <div class="flex justify-end gap-2">
                                    <x-cc-button variant="ghost" size="sm" icon="fa-print" color="slate">Receipt</x-cc-button>
                                    @if($inv->status !== 'refunded')
                                        <form method="POST" action="{{ url('/billing/'.$inv->id.'/refund') }}">
                                            @csrf
                                            <x-cc-button type="submit" variant="ghost" size="sm" icon="fa-rotate-left" color="rose">Refund</x-cc-button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </x-data-table>
        </x-clinical-card>
    @endif
</div>
</x-cc-shell>

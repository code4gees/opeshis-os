<x-cc-shell title='Opeshis OS'>

@section('title', 'Laboratory Services - Opeshis OS')

<div class="space-y-8 animate-fade-in pb-20">
 
 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Diagnostic <span class="text-sage">Laboratory</span></h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Manage diagnostic testing, sample collection, and result validation.</p>
 </div>
 <div class="flex items-center gap-6">
 <x-cc-stat title="To Collect" :value="$stats['collect']" icon="fa-vial" color="blue" />
 <x-cc-stat title="Critical" :value="$stats['critical']" icon="fa-biohazard" color="rose" />
 </div>
 </header>

 <!-- Navigation -->
 <div class="flex flex-wrap border-b border-subtle gap-8 px-2">
 @php
 $subnav = function($sub, $label) use ($tab) {
 $active = $tab === $sub;
 $cls = $active ? 'text-sage border-blue-500' : 'text-slate-500 border-transparent hover:text-slate-300';
 return "<a href=\"".route('operations.diagnostics.lab', ['subtab' => $sub])."\" class=\"pb-4 text-xs font-semibold font-medium border-b-2 transition-all {$cls}\">{$label}</a>";
 };
 @endphp
 {!! $subnav('analytics', 'Overview') !!}
 {!! $subnav('orders', 'Test Queue') !!}
 {!! $subnav('history', 'Recent Results') !!}
 {!! $subnav('catalog', 'Price List') !!}
 </div>

 @if(session('success'))
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[12px] font-semibold font-medium mb-8 animate-pulse ">
 Diagnostic protocol synchronized successfully.
 </div>
 @endif

 @if ($tab === 'analytics')
 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
 <x-clinical-card title="Throughput Analytics" icon="fa-chart-bar" badge="Last 7 Days">
 <div class="space-y-6 py-4">
 <div class="text-center">
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-2">Total Studies</p>
 <h3 class="text-5xl font-semibold text-white tracking-tighter ">{{ $dailyStats->sum('total') }}</h3>
 </div>
 </div>
 </x-clinical-card>
 
 <x-clinical-card title="System Integrity" icon="fa-shield-heart" badge="Operational">
 <div class="space-y-6 py-4 text-center">
 <p class="text-[12px] font-semibold text-emerald-500 font-medium mb-2 ">Uptime Benchmark</p>
 <h3 class="text-5xl font-semibold text-white tracking-tighter ">99.9%</h3>
 </div>
 </x-clinical-card>

 <x-clinical-card title="Alert Matrix" icon="fa-bell" badge="Critical surveillance">
 <div class="space-y-6 py-4 text-center">
 <p class="text-[12px] font-semibold text-rose-500 font-medium mb-2 ">Active Flag Rate</p>
 <h3 class="text-5xl font-semibold text-white tracking-tighter ">
 {{ $stats['today'] > 0 ? round(($stats['critical'] / $stats['today']) * 100, 1) : 0 }}%
 </h3>
 </div>
 </x-clinical-card>
 </div>

 @elseif ($tab === 'orders')
 <x-clinical-card title="Active Test Worklist" icon="fa-microscope" badge="Live Matrix">
 <x-data-table :headers="['Patient Identity', 'Test Description', 'Requested At', 'Status Flow', 'Strategic Action']">
 @forelse($pendingOrders as $order)
 <tr class="hover:bg-card transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4">
 <div class="text-white font-bold uppercase text-xs">{{ $order->patient->full_name ?? 'UNKNOWN' }}</div>
 <div class="text-[12px] text-slate-500 font-semibold uppercase mt-1 tracking-wider">{{ $order->patient->medical_id ?? 'N/A' }}</div>
 </td>
 <td class="px-6 py-4">
 <div class="text-slate-200 font-semibold uppercase text-xs ">{{ $order->id }}</div>
 <div class="text-[8px] text-sage font-semibold uppercase mt-1 tracking-wider">Diagnostic Order</div>
 </td>
 <td class="px-6 py-4 text-center text-slate-500 font-bold ">
 {{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}
 </td>
 <td class="px-6 py-4">
 <x-status-badge :status="$order->status === 'pending' ? 'pending' : 'clinical care'" />
 <div class="text-[8px] font-semibold text-slate-500 uppercase mt-1 tracking-wider">{{ strtoupper($order->status) }}</div>
 </td>
 <td class="px-6 py-4 text-right">
 @if($order->status === 'pending')
 <form method="POST" action="{{ route('operations.diagnostics.lab.action') }}">
 @csrf
 <input type="hidden" name="action" value="collect_sample">
 <input type="hidden" name="order_id" value="{{ $order->id }}">
 <x-cc-button type="submit" size="sm" color="blue" icon="fa-vial">Collect</x-cc-button>
 </form>
 @else
 <x-cc-button size="sm" color="emerald" icon="fa-pen-to-square" onclick="openResultModal('{{ $order->id }}', 'Diagnostic Assay')">Enter Results</x-cc-button>
 @endif
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-24 text-center text-slate-600 text-[12px] uppercase font-semibold tracking-wider">No pending orders in the diagnostic queue.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>

 @elseif ($tab === 'history')
 <x-clinical-card title="Recently Validated Results" icon="fa-check-double" badge="Forensic Proof">
 <x-data-table :headers="['Validated On', 'Patient Identity', 'Diagnostic Matrix', 'Result Value', 'Verification']">
 @forelse($history as $h)
 <tr class="hover:bg-card transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4 text-slate-500 text-[12px] font-semibold uppercase ">
 {{ \Carbon\Carbon::parse($h->updated_at)->format('d M, H:i') }}
 </td>
 <td class="px-6 py-4">
 <div class="text-white font-bold uppercase text-xs">{{ $h->patient->full_name ?? 'UNKNOWN' }}</div>
 <div class="text-[12px] text-slate-500 font-semibold uppercase mt-1">{{ $h->patient->medical_id ?? 'N/A' }}</div>
 </td>
 <td class="px-6 py-4 text-slate-300 font-semibold text-xs uppercase ">DIAGNOSTIC_RELEASE</td>
 <td class="px-6 py-4 text-center">
 <span class="text-sm font-semibold text-white ">
 {{ $h->results }}
 </span>
 </td>
 <td class="px-6 py-4 text-right">
 <x-status-badge status="completed" />
 <div class="text-[8px] text-emerald-500 font-semibold uppercase mt-1 tracking-wider">Verified</div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-24 text-center text-slate-600 text-[12px] uppercase font-semibold tracking-wider">No validated results in the current matrix.</td>
 </tr>
 @endforelse
 </x-data-table>
 </x-clinical-card>

 @elseif ($tab === 'catalog')
 <x-clinical-card title="Institutional Test Catalog" icon="fa-book-medical" badge="Pricing V2.1">
 <x-data-table :headers="['Category', 'Test Designation', 'Institutional Fee', 'Protocol']">
 @foreach($catalog as $item)
 <tr class="hover:bg-card transition-colors border-b border-subtle last:border-0">
 <td class="px-6 py-4">
 <span class="px-3 py-1 bg-sage/10 text-sage border border-blue-500/20 rounded-lg text-[8px] font-semibold font-medium ">{{ $item->category }}</span>
 </td>
 <td class="px-6 py-4 font-semibold text-white text-xs uppercase">{{ $item->name }}</td>
 <td class="px-6 py-4 font-semibold text-emerald-500 text-xs ">XAF {{ number_format($item->price ?? 0, 0) }}</td>
 <td class="px-6 py-4 text-[12px] text-slate-500 font-bold font-medium">STANDARD_SOP</td>
 </tr>
 @endforeach
 </x-data-table>
 </x-clinical-card>
 @endif
</div>

<!-- Modal: Result Entry -->
<x-cc-modal id="resultModal" title="Authorize Result Release" icon="fa-file-signature">
 <form method="POST" action="{{ route('operations.diagnostics.lab.action') }}" class="space-y-6">
 @csrf
 <input type="hidden" name="action" value="submit_results">
 <input type="hidden" name="order_id" id="resOrderId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Measured Result Value</label>
 <input type="text" name="results" required placeholder="Enter primary result value" class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-blue-500/50 transition-all uppercase">
 </div>
 <x-cc-button type="submit" color="emerald" class="w-full py-4">Verify & Release Protocol</x-cc-button>
 </form>
</x-cc-modal>

<script>
 function openResultModal(id, name) {
 document.getElementById('resOrderId').value = id;
 document.getElementById('resultModal').classList.remove('hidden');
 }
</script>
</x-cc-shell>

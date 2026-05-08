<x-cc-shell title='Opeshis OS'>

@section('title', 'Asset Register & Maintenance Telemetry - Opeshis OS')


<div class="space-y-6 animate-fade-in">
    <div class="flex justify-between items-center mb-8 border-b border-white/10 pb-8">
        <div>
            <h2 class="text-2xl font-black uppercase text-white tracking-tight">Institutional Asset Register</h2>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Lifecycle Tracking & Service Alerts</p>
        </div>
        <div class="flex items-center gap-8">
            <div class="text-right">
                <label class="text-[9px] font-black text-rose-500 uppercase tracking-widest block mb-1">Service Required</label>
                <span class="text-2xl font-black text-rose-600">{{ $maintenanceAlerts }} Assets</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold mb-6">{{ session('success') }}</div>
    @endif

    <div class="glass-panel rounded-[2.5rem] shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-white/10 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-white/5 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                <tr>
                    <th class="px-10 py-6">Asset / ID</th>
                    <th>Category</th>
                    <th>Purchase Date</th>
                    <th>Last Service</th>
                    <th>Next Service</th>
                    <th class="text-right px-10">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($assets as $a)
                    @php 
                        $isDue = !empty($a->next_maintenance_date) && strtotime($a->next_maintenance_date) <= strtotime('+14 days');
                    @endphp
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-10 py-6">
                            <div class="text-sm font-black text-white">{{ $a->name }}</div>
                            <div class="text-[10px] text-slate-400 font-mono uppercase mt-1">S/N: {{ $a->serial_number }}</div>
                        </td>
                        <td class="text-[10px] font-black text-indigo-600 uppercase">{{ $a->category }}</td>
                        <td class="text-[11px] font-mono text-slate-400">{{ $a->purchase_date ?: '—' }}</td>
                        <td class="text-[11px] font-mono text-slate-400">{{ $a->last_maintenance_date ?: '—' }}</td>
                        <td class="text-[11px] font-black {{ $isDue ? 'text-rose-500 animate-pulse' : 'text-white' }}">
                            {{ $a->next_maintenance_date ?: '—' }}
                        </td>
                        <td class="px-10 py-6 text-right">
                            @if ($isDue)
                                <form method="POST" action="{{ route('assets.maintenance') }}">
                                    @csrf
                                    <input type="hidden" name="asset_id" value="{{ $a->id }}">
                                    <button type="submit" class="px-4 py-2 bg-rose-500 text-white rounded-xl text-[9px] font-black uppercase hover:bg-rose-600 transition shadow-lg shadow-rose-500/20">Acknowledge Service</button>
                                </form>
                            @else
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[9px] font-black uppercase">{{ $a->status }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-cc-shell>

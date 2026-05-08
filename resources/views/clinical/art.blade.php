<x-cc-shell title='Opeshis OS'>

@section('title', 'HIV/ART Clinical Hub — Opeshis OS')

<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: ART Intelligence Command -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">ART <span class="text-indigo-500">Command Hub</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Specialized HIV Care · Longitudinal CD4/Viral Surveillance · Regimen Management</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex flex-col items-end">
                <span class="text-[9px] font-black uppercase text-indigo-400 tracking-[0.2em] italic">Protocol: HIV_CARE_ACTIVE</span>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-widest mt-1 italic">Surveillance: Real-time</span>
            </div>
            <div class="w-3 h-3 rounded-full bg-indigo-500 animate-pulse shadow-[0_0_10px_rgba(99,102,241,0.5)]"></div>
        </div>
    </header>

    @if(session('success'))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            ART consultation payload synchronized successfully.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Longitudinal Clinical Ledger -->
        <div class="lg:col-span-8">
            <x-clinical-card title="Longitudinal ART Clinical Matrix" icon="fa-database" badge="Registry Sync: Active">
                <x-data-table :headers="['Patient Identity', 'CD4 Matrix', 'Viral Load Pulse', 'Current Regimen', 'Temporal Matrix']">
                    @foreach($records as $r)
                        <tr class="hover:bg-white/[0.02] transition-all group">
                            <td class="px-6 py-4">
                                <div class="text-sm font-black text-white uppercase group-hover:text-indigo-400 transition-colors">{{ $r->full_name }}</div>
                                <div class="text-[9px] font-bold text-slate-500 uppercase tracking-[0.2em] mt-1 italic">{{ $r->medical_id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-black {{ ($r->cd4_count < 200) ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }} italic tracking-tighter">{{ $r->cd4_count ?? 'NULL' }}</div>
                                <div class="text-[8px] font-black text-slate-600 uppercase mt-0.5 italic">Cells/mm³</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-[11px] font-black text-indigo-400 uppercase italic tracking-widest">{{ $r->viral_load ?? 'PENDING_SIGNAL' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <x-status-badge status="active" />
                                <div class="text-[8px] font-black text-slate-400 uppercase mt-1 tracking-widest">{{ $r->regimen ?? 'STANDARD_FIRST_LINE' }}</div>
                            </td>
                            <td class="px-6 py-4 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest italic">
                                {{ \Carbon\Carbon::parse($r->created_at)->format('d M Y') }}
                            </td>
                        </tr>
                    @endforeach
                </x-data-table>
            </x-clinical-card>
        </div>

        <!-- Consultation Input Sidebar -->
        <div class="lg:col-span-4">
            <x-clinical-card title="Authorize ART Record" icon="fa-plus-circle">
                <form method="POST" action="{{ route('clinical.art') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Patient Identifier (Medical ID)</label>
                        <input type="text" name="patient_id" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. PID-000000">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">CD4 Count Matrix</label>
                            <input type="number" name="cd4_count" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all" placeholder="0">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Viral Load Signal</label>
                            <input type="text" name="viral_load" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="NOT_DETECTED">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Active Therapeutic Regimen</label>
                        <input type="text" name="regimen" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. TLD_PROTOCOL_A">
                    </div>
                    <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize ART Relay</x-cc-button>
                </form>
            </x-clinical-card>
        </div>
    </div>
</div>
</x-cc-shell>

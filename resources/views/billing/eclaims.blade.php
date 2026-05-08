<x-cc-shell title='Opeshis OS'>

@section("title", "Insurance eClaims — Opeshis OS")

<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: eClaims Command -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-white/5">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Insurance <span class="text-indigo-500">eClaims</span></h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Claim Submission · Electronic Verification · Reimbursement Surveillance</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus-circle" color="indigo" onclick="document.getElementById('claimModal').classList.remove('hidden')">
                Authorize New Claim
            </x-cc-button>
        </div>
    </header>

    @if(session("success"))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            Claim protocol synchronized successfully.
        </div>
    @endif

    <!-- Claims Surveillance Matrix -->
    <x-clinical-card title="Institutional Claim Submission Matrix" icon="fa-database" badge="Hub Sync: Operational">
        <x-data-table :headers="['Claim Identity / Protocol', 'Patient Principal', 'Insurer Matrix', 'Claim Amount', 'Stream Status', 'Operational Action']">
            @forelse($claims as $c)
                <tr class="hover:bg-white/[0.02] transition-all group border-b border-white/5 last:border-0">
                    <td class="px-6 py-4">
                        <div class="font-black text-white text-sm uppercase group-hover:text-indigo-400 transition-colors">{{ $c->claim_number }}</div>
                        <div class="text-[8px] font-bold text-slate-600 uppercase tracking-widest mt-1 italic">Submission Protocol</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-black text-white text-sm uppercase group-hover:text-indigo-400 transition-colors">{{ $c->patient->full_name ?? 'UNKNOWN' }}</div>
                        <div class="text-[10px] text-slate-500 mt-1 uppercase">{{ $c->patient->medical_id ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ $c->provider->name ?? 'UNKNOWN_PROVIDER' }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="text-sm font-black text-white italic tracking-tighter">XAF {{ number_format($c->total_claimed, 0) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $status = match($c->status) {
                                'approved' => 'completed',
                                'rejected' => 'critical',
                                default => 'pending'
                            };
                        @endphp
                        <x-status-badge :status="$status" />
                        <div class="text-[8px] font-black text-slate-500 uppercase mt-1 tracking-widest">{{ strtoupper($c->status) }}</div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <x-cc-button variant="ghost" size="sm" icon="fa-eye" color="indigo">View Payload</x-cc-button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-10 py-24 text-center">
                        <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                            <i class="fas fa-file-shield text-2xl"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No insurance claims identified in the current matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-data-table>
    </x-clinical-card>
</div>

<!-- Modal: Claim Submission Protocol -->
<x-cc-modal id="claimModal" title="Authorize Electronic Claim" icon="fa-file-shield">
    <form method="POST" action="{{ url("/billing/eclaims") }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Patient Identity (Medical ID)</label>
            <input name="patient_id" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. PID-000000">
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Insurance Matrix Provider</label>
            <select name="provider_id" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                @foreach($providers as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Encounter Date</label>
                <input name="encounter_date" type="date" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Diagnosis Codes</label>
                <input name="diagnosis_codes" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. B20, J18.9">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Strategic Claim Amount</label>
            <input name="total" type="number" step="0.01" required class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all" placeholder="0.00">
        </div>
        <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Transmission</x-cc-button>
    </form>
</x-cc-modal>
</x-cc-shell>

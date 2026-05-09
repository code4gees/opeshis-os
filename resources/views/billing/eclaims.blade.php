<x-cc-shell title='Opeshis OS'>

@section("title", "Insurance eClaims — Opeshis OS")

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Insurance <span class="text-sage">eClaims</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Claim Submission · Electronic Verification · Reimbursement Surveillance</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('claimModal').classList.remove('hidden')"
                class="cc-button-primary flex items-center gap-2">
                <i class="fas fa-plus-circle text-[10px]"></i>
                Authorize New Claim
            </button>
        </div>
    </div>

    @if(session("success"))
        <div class="cc-card p-6 bg-emerald-500/5 border-emerald-500/20 text-emerald-400 text-[11px] font-bold uppercase tracking-widest mb-10 animate-pulse">
            <i class="fas fa-check-circle mr-2"></i>
            Claim protocol synchronized successfully.
        </div>
    @endif

    <!-- Claims Matrix -->
    <x-cc-card>
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                <i class="fas fa-database text-sage text-[14px]"></i>
                Institutional Claim Submission Matrix
            </h2>
            <span class="px-3 py-1 rounded-full bg-sage/10 text-sage text-[10px] font-bold uppercase tracking-wider">
                Hub Sync: Operational
            </span>
        </div>

        <x-cc-table :headers="['Claim Identity', 'Patient Principal', 'Insurer Matrix', 'Claim Amount', 'Stream Status', 'Operations']">
            @forelse($claims as $c)
                <tr class="group hover:bg-white/[0.01] transition-colors">
                    <td class="px-8 py-5">
                        <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $c->claim_number }}</div>
                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">Submission Protocol</div>
                    </td>
                    <td class="px-8 py-5">
                        <div class="text-[12px] font-bold text-white uppercase tracking-tight">{{ $c->patient->full_name ?? 'UNKNOWN' }}</div>
                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id ?? 'N/A' }}</div>
                    </td>
                    <td class="px-8 py-5">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">{{ $c->provider->name ?? 'UNKNOWN_PROVIDER' }}</div>
                    </td>
                    <td class="px-8 py-5">
                        <div class="text-[12px] font-bold text-white tracking-tighter">XAF {{ number_format($c->total_claimed, 0) }}</div>
                    </td>
                    <td class="px-8 py-5">
                        @php
                            $statusColor = match($c->status) {
                                'approved' => 'text-sage bg-sage/10',
                                'rejected' => 'text-rose-500 bg-rose-500/10',
                                'queried' => 'text-amber-500 bg-amber-500/10',
                                default => 'text-white/40 bg-white/5'
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-lg {{ $statusColor }} text-[9px] font-bold uppercase tracking-widest">
                            {{ $c->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <button class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                            <i class="fas fa-eye text-[10px]"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-white/10">
                            <i class="fas fa-file-shield text-2xl"></i>
                        </div>
                        <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No insurance claims identified in the current matrix.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Claim Submission Protocol -->
<x-cc-modal id="claimModal" title="Authorize Electronic Claim" icon="fa-file-shield">
    <form method="POST" action="{{ route('finance.eclaims.store') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Patient Identity (Medical ID)</label>
            <input name="patient_id" required class="cc-input w-full" placeholder="e.g. PID-000000">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Insurance Matrix Provider</label>
            <select name="provider_id" class="cc-input w-full">
                @foreach($providers as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Encounter Date</label>
                <input name="encounter_date" type="date" required class="cc-input w-full">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Diagnosis Codes</label>
                <input name="diagnosis_codes" required class="cc-input w-full" placeholder="e.g. B20, J18.9">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Strategic Claim Amount</label>
            <input name="total" type="number" step="0.01" required class="cc-input w-full" placeholder="0.00">
        </div>
        <div class="pt-4">
            <button type="submit" class="cc-button-primary w-full">Authorize Transmission</button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

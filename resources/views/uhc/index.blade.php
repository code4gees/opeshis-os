<x-cc-shell title='Opeshis OS'>

@section("title", "UHC & Social Health Monitor — Opeshis OS")

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Social <span class="text-sage">Health</span> Monitor</h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Universal Health Coverage · National Linkage Protocol · Social Health Surveillance</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('enrollModal').classList.remove('hidden')"
                class="cc-button-primary flex items-center gap-2">
                <i class="fas fa-plus-circle text-[10px]"></i>
                Authorize New Linkage
            </button>
        </div>
    </div>

    @if(session("success"))
        <div class="cc-card p-6 bg-emerald-500/5 border-emerald-500/20 text-emerald-400 text-[11px] font-bold uppercase tracking-widest mb-10 animate-pulse">
            <i class="fas fa-check-circle mr-2"></i>
            Operational protocol synchronized successfully.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Enrollment Matrix -->
        <div class="lg:col-span-8">
            <x-cc-card>
                <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                    <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                        <i class="fas fa-users-viewfinder text-sage text-[14px]"></i>
                        Institutional-National Linkage Matrix
                    </h2>
                    <span class="px-3 py-1 rounded-full bg-sage/10 text-sage text-[10px] font-bold uppercase tracking-wider">
                        Linkage: Active
                    </span>
                </div>

                <x-cc-table :headers="['Principal Identity', 'UHC Identifier', 'Linkage Scheme', 'Temporal Log']">
                    @forelse($enrollments as $e)
                        <tr class="group hover:bg-white/[0.01] transition-colors">
                            <td class="px-8 py-5">
                                <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $e->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $e->medical_id }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-[11px] font-bold text-white tracking-tighter uppercase">{{ $e->uhc_id }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-[10px] font-bold text-white/40 uppercase tracking-widest">{{ $e->scheme_name }}</div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Protocol: Established</div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-white/10">
                                    <i class="fas fa-network-wired text-2xl"></i>
                                </div>
                                <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No national linkage records identified.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Claims Surveillance -->
        <div class="lg:col-span-4">
            <x-cc-card title="Social Health Surveillance" icon="fa-shield-halved">
                <div class="p-8 space-y-6">
                    @foreach($recentClaims as $c)
                        <div class="p-4 bg-white/[0.02] border border-white/[0.04] rounded-2xl flex items-center justify-between hover:border-sage/20 transition-colors group">
                            <div>
                                <div class="text-[11px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $c->full_name }}</div>
                                <div class="text-[9px] font-bold text-white/20 uppercase tracking-widest mt-1">Claim #{{ $c->insurance_claim_id }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-[11px] font-bold text-white tracking-tighter">XAF {{ number_format($c->total_amount, 0) }}</div>
                                <div class="text-[9px] font-bold {{ $c->claim_status === 'approved' ? 'text-sage' : 'text-amber-500' }} uppercase tracking-widest mt-1">{{ $c->claim_status }}</div>
                            </div>
                        </div>
                    @endforeach
                    @if($recentClaims->isEmpty())
                         <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest text-center py-10">No active claims identified.</p>
                    @endif
                </div>
            </x-cc-card>
        </div>
    </div>
</div>

<!-- Modal: National Linkage Protocol -->
<x-cc-modal id="enrollModal" title="Establish National Health Linkage" icon="fa-link">
    <form method="POST" action="{{ route('finance.uhc.enroll') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Institutional Principal ID</label>
            <input name="patient_id" required class="cc-input w-full" placeholder="e.g. PID-000000">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">National UHC Identifier</label>
            <input name="uhc_id" required class="cc-input w-full" placeholder="UHC-XXXXX-XXXXX">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">National Scheme Matrix</label>
            <select name="scheme" class="cc-input w-full">
                <option value="National Universal Coverage">National Universal Coverage</option>
                <option value="Social Health Security Fund">Social Health Security Fund</option>
                <option value="Community-Based Health Matrix">Community-Based Health Matrix</option>
            </select>
        </div>
        <div class="pt-4">
            <button type="submit" class="cc-button-primary w-full">Authorize Linkage Transmission</button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

<x-cc-shell title='Malaria Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Malaria <span class="text-amber-500">Command</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Case Registration · Epidemiological Surveillance · Parasite Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-user-plus" color="amber" variant="ghost" onclick="document.getElementById('regModal').classList.remove('hidden')">
                Register New Case
            </x-cc-button>
        </div>
    </div>

    <!-- Malaria Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Surveillance" value="{{ $cases->count() }}" icon="fa-microscope" trend="Active Registry" color="amber" />
        <x-cc-stat title="Positivity Yield" value="{{ $cases->where('result', 'POSITIVE_SIGNAL')->count() }}" icon="fa-virus-covid" trend="Signal Detection" color="rose" />
        <x-cc-stat title="Testing Velocity" value="High" icon="fa-bolt-lightning" trend="Operational" color="indigo" />
        <x-cc-stat title="Epidemiology" value="Nominal" icon="fa-tower-broadcast" trend="Institutional Log" color="slate" />
    </div>

    <!-- Case Surveillance Matrix -->
    <x-cc-card class="overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
            <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Malaria Surveillance Matrix</h3>
            <div class="flex items-center gap-2">
                <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></div>
                <span class="text-[9px] font-black text-amber-500 uppercase tracking-widest">Registry Sync: Active</span>
            </div>
        </div>

        <x-cc-table :headers="['Patient Profile Identity', 'Species Matrix', 'Diagnostic Vector', 'Result Outcome', 'Therapeutic Action', 'Temporal Log']">
            @forelse($cases as $c)
                <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-amber-500/10 group-hover:text-amber-500 group-hover:border-amber-500/20 transition-all">
                                {{ substr($c->patient->full_name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors">{{ $c->patient->full_name }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $c->patient->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-amber-500 tracking-widest uppercase">{{ $c->species }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">{{ $c->test_type }}</div>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusCls = str_contains($c->result, 'POSITIVE') ? 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20';
                        @endphp
                        <span class="px-3 py-1.5 rounded-xl border {{ $statusCls }} text-[9px] font-black uppercase tracking-widest">
                            {{ strtoupper($c->result) }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[11px] font-bold text-white uppercase tracking-tight line-clamp-1" title="{{ $c->treatment_given }}">{{ $c->treatment_given }}</div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="text-[11px] font-bold text-white/20 uppercase tracking-widest">
                            {{ \Carbon\Carbon::parse($c->created_at)->format('d M Y') }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <i class="fas fa-microscope text-white/5 text-2xl mb-4"></i>
                        <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active malaria cases identified.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Register Malaria Case -->
<x-cc-modal id="regModal" title="Authorize Malaria Case Registration" icon="fa-user-plus">
    <form method="POST" action="{{ url('/clinical/malaria/register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Patient Identity" name="patient_id" required placeholder="OP-XXXX-XXXX" icon="fa-id-card-clip" />
        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Parasite Species Matrix" name="species" icon="fa-dna">
                <option value="P. falciparum">P. falciparum</option>
                <option value="P. vivax">P. vivax</option>
                <option value="P. malariae">P. malariae</option>
                <option value="UNKNOWN_SIGNAL">UNKNOWN_SIGNAL</option>
            </x-cc-select>
            <x-cc-select label="Diagnostic Vector" name="test_type" icon="fa-microscope">
                <option value="RDT_KIT_SURVEILLANCE">RDT_KIT_SURVEILLANCE</option>
                <option value="MICROSCOPY_LAB_PROTOCOL">MICROSCOPY_LAB_PROTOCOL</option>
                <option value="PCR_GENOMIC_ANALYSIS">PCR_GENOMIC_ANALYSIS</option>
            </x-cc-select>
        </div>
        <x-cc-select label="Diagnostic Outcome Result" name="result" icon="fa-flag-checkered">
            <option value="POSITIVE_SIGNAL">POSITIVE_SIGNAL</option>
            <option value="NEGATIVE_SIGNAL">NEGATIVE_SIGNAL</option>
        </x-cc-select>
        <x-cc-input label="Therapeutic Action" name="treatment" placeholder="e.g. ARTEMETHER_LUMEFANTRINE" icon="fa-kit-medical" />
        <div class="pt-4">
            <x-cc-button type="submit" color="amber" class="w-full">Authorize Registration Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

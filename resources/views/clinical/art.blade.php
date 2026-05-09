<x-cc-shell title='HIV/ART Clinical Hub | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">ART <span class="text-sage">Command Hub</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Specialized HIV Care · Longitudinal Viral Surveillance · Regimen Governance</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="px-5 py-2.5 bg-white/[0.02] rounded-2xl border border-white/[0.04] flex items-center gap-3">
                <div class="w-2 h-2 bg-sage rounded-full animate-pulse shadow-[0_0_10px_rgba(130,192,154,0.5)]"></div>
                <span class="text-[10px] font-black text-sage uppercase tracking-widest">Protocol: HIV_CARE_ACTIVE</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest animate-pulse">
            ART Consultation Payload Synchronized Successfully.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Longitudinal Clinical Matrix -->
        <div class="lg:col-span-8 space-y-8">
            <x-cc-card class="overflow-hidden">
                <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Longitudinal ART Clinical Matrix</h3>
                    <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[9px] font-black text-white/20 uppercase tracking-widest">Registry Sync: Active</span>
                </div>

                <x-cc-table :headers="['Patient Identity', 'CD4 Matrix', 'Viral Pulse', 'Therapeutic Regimen', 'Temporal Signal']">
                    @foreach($records as $r)
                        <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-sage/10 group-hover:text-sage group-hover:border-sage/20 transition-all">
                                        {{ substr($r->full_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $r->full_name }}</div>
                                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $r->medical_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-[13px] font-black {{ ($r->cd4_count < 200) ? 'text-rose-500 animate-pulse' : 'text-emerald-500' }} tracking-tighter">{{ $r->cd4_count ?? 'NULL' }}</div>
                                <div class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Cells/mm³</div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[11px] font-bold text-white/40 uppercase tracking-tighter">
                                    {{ $r->viral_load ?? 'PENDING_SIGNAL' }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-1.5 h-1.5 rounded-full bg-sage"></div>
                                    <span class="text-[9px] font-black text-sage uppercase tracking-widest">Active</span>
                                </div>
                                <div class="text-[10px] font-bold text-white/40 uppercase tracking-widest">{{ $r->regimen ?? 'STANDARD_FIRST_LINE' }}</div>
                            </td>
                            <td class="px-8 py-6 text-right text-[11px] font-bold text-white/20 uppercase tracking-tighter">
                                {{ \Carbon\Carbon::parse($r->created_at)->format('d M Y') }}
                            </td>
                        </tr>
                    @endforeach
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Authorized Entry Sidebar -->
        <div class="lg:col-span-4">
            <x-cc-card class="p-8">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mb-8 flex items-center gap-3">
                    <i class="fas fa-plus-circle text-sage"></i>
                    Authorize ART Record
                </h3>

                <form method="POST" action="{{ route('clinical.art') }}" class="space-y-6">
                    @csrf
                    <x-cc-input label="Patient Medical Identity" name="patient_id" required placeholder="PID-000000" icon="fa-id-card-clip" />
                    
                    <div class="grid grid-cols-2 gap-4">
                        <x-cc-input label="CD4 Matrix" name="cd4_count" type="number" placeholder="0" icon="fa-chart-simple" />
                        <x-cc-input label="Viral Signal" name="viral_load" placeholder="NOT_DETECTED" icon="fa-wave-square" />
                    </div>

                    <x-cc-input label="Therapeutic Regimen" name="regimen" placeholder="TLD_PROTOCOL_A" icon="fa-pills" />

                    <div class="pt-4">
                        <x-cc-button type="submit" color="sage" class="w-full">Authorize ART Relay</x-cc-button>
                    </div>
                </form>
            </x-cc-card>

            <x-cc-card class="mt-8 p-8 bg-gradient-to-br from-white/5 to-transparent">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mb-4">Unit Intelligence</h3>
                <p class="text-[11px] font-bold text-white/40 leading-relaxed uppercase tracking-tight">
                    Longitudinal surveillance suggests a 94% viral suppression rate across current registry subjects. Maintain strict adherence monitoring.
                </p>
            </x-cc-card>
        </div>
    </div>
</div>
</x-cc-shell>

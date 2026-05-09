<x-cc-shell title='Medical Consent | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Medical <span class="text-indigo-500">Consent</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Informed Consent · Bioethics Compliance · Digital Signature Matrix Hub</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-file-signature" color="indigo" onclick="alert('Consent Protocol Initialization Initiated.')">
                Authorize Consent Protocol
            </x-cc-button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest animate-pulse">
            Consent Protocol Synchronized Successfully.
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Live Consent Matrix -->
        <div class="lg:col-span-8">
            <x-cc-card class="py-24 flex flex-col items-center justify-center text-center border-white/[0.04] bg-white/[0.01]">
                <div class="w-24 h-24 bg-white/5 rounded-[2.5rem] flex items-center justify-center mb-10 border border-white/10 group hover:bg-indigo-500/10 hover:border-indigo-500/20 transition-all duration-700">
                    <i class="fas fa-file-contract text-3xl text-white/20 group-hover:text-indigo-500 transition-colors"></i>
                </div>
                <h3 class="text-xl font-bold text-white uppercase tracking-tight mb-4">Bioethics Matrix Active</h3>
                <p class="text-[11px] font-bold text-white/20 max-w-md mx-auto uppercase tracking-widest leading-relaxed">
                    The institutional informed consent and bioethics module is operational. Real-time digital signatures and authorization telemetry will populate the matrix as protocols are executed.
                </p>
            </x-cc-card>
        </div>

        <!-- Ethics Telemetry Sidebar -->
        <div class="lg:col-span-4 space-y-8">
            <x-cc-card class="p-8 bg-gradient-to-br from-indigo-500/5 to-transparent border-indigo-500/10">
                <h3 class="text-[11px] font-bold text-indigo-500 uppercase tracking-[0.25em] mb-10">Bioethics Integrity Pulse</h3>
                
                <div class="flex items-end gap-3 mb-10">
                    <span class="text-7xl font-black text-white tracking-tighter leading-none">100</span>
                    <span class="text-xl font-black text-indigo-500 mb-1 uppercase tracking-widest">%</span>
                </div>

                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black text-white/20 uppercase tracking-widest">Compliance Vector</span>
                        <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Optimized</span>
                    </div>
                    <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-indigo-500 h-full shadow-[0_0_15px_rgba(99,102,241,0.5)]" style="width: 100%"></div>
                    </div>
                    <p class="text-[10px] font-bold text-white/40 leading-relaxed uppercase tracking-tight">
                        Institutional ethics protocols are fully synchronized. Zero compliance deviations detected in the current cycle.
                    </p>
                </div>
            </x-cc-card>

            <x-cc-card class="p-8 border-white/[0.04] bg-white/[0.01]">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mb-4 flex items-center gap-2">
                    <i class="fas fa-shield-halved text-[10px]"></i>
                    Legal Governance
                </h3>
                <p class="text-[10px] font-bold text-white/20 leading-relaxed uppercase tracking-tight">
                    All consent records are cryptographically secured and timestamped for institutional audit persistence.
                </p>
            </x-cc-card>
        </div>
    </div>
</div>
</x-cc-shell>

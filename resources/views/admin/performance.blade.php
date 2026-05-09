<x-cc-shell title='Opeshis OS'>

@section('title', 'Institutional Performance - Opeshis OS')

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Performance <span class="text-sage">& Talent</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Review Cycles, Staff Assessments & Merit Matrices</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('cycleModal').classList.remove('hidden')"
                class="cc-button-primary flex items-center gap-2">
                <i class="fas fa-plus-circle text-[10px]"></i>
                Initialize Review Cycle
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="cc-card p-6 bg-emerald-500/5 border-emerald-500/20 text-emerald-400 text-[11px] font-bold uppercase tracking-widest mb-10 animate-pulse">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Performance Telemetry Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <x-cc-stat 
            title="Active Cycles" 
            value="{{ $stats->active }}" 
            icon="fa-rotate" 
            trend="Live Appraisal" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Compliance" 
            value="88%" 
            icon="fa-shield-check" 
            trend="Staff Signed" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Merit Yield" 
            value="4.2" 
            icon="fa-star" 
            trend="Avg Rating" 
            color="amber" 
        />
        <x-cc-stat 
            title="Total Cycles" 
            value="{{ $stats->total }}" 
            icon="fa-database" 
            trend="Historical" 
            color="slate" 
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Review Frameworks Matrix -->
        <div class="lg:col-span-4">
            <x-cc-card title="Review Frameworks" icon="fa-network-wired">
                <div class="divide-y divide-white/[0.04]">
                    @forelse($cycles as $cycle)
                        <div class="p-8 group hover:bg-white/[0.01] transition-all">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $cycle->name }}</h4>
                                <span class="px-2 py-0.5 {{ $cycle->status === 'active' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-white/5 text-white/20 border-white/10' }} rounded text-[8px] font-bold uppercase border tracking-widest">
                                    {{ $cycle->status }}
                                </span>
                            </div>
                            <div class="flex items-center gap-3 text-[10px] font-bold text-white/20 uppercase tracking-widest">
                                <i class="fas fa-calendar-day text-[9px]"></i>
                                {{ \Carbon\Carbon::parse($cycle->start_date)->format('M Y') }} — {{ \Carbon\Carbon::parse($cycle->end_date)->format('M Y') }}
                            </div>
                        </div>
                    @empty
                        <div class="p-20 text-center">
                            <i class="fas fa-ghost text-2xl text-white/10 mb-4 block"></i>
                            <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No review frameworks initialized.</p>
                        </div>
                    @endforelse
                </div>
            </x-cc-card>
        </div>

        <!-- Live Review Matrix -->
        <div class="lg:col-span-8">
            <x-cc-card>
                <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                    <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                        <i class="fas fa-users-viewfinder text-sage text-[14px]"></i>
                        Institutional Personnel Review Matrix
                    </h2>
                </div>

                <x-cc-table :headers="['Staff Member', 'Merit Rating', 'Status Protocol', 'Dossier']">
                    @forelse($reviews as $r)
                        <tr class="group hover:bg-white/[0.01] transition-colors">
                            <td class="px-8 py-5">
                                <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $r->staff->name ?? 'UNKNOWN_ACTOR' }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $r->staff->role ?? 'N/A' }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="inline-flex items-center gap-2 px-3 py-1 bg-sage/10 text-sage rounded-lg border border-sage/20">
                                    <span class="text-[11px] font-bold">{{ $r->overall_rating }}</span>
                                    <i class="fas fa-star text-[9px]"></i>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="text-[10px] font-bold {{ $r->status === 'signed' ? 'text-emerald-500' : 'text-amber-500' }} uppercase tracking-widest">
                                    {{ str_replace('_',' ', $r->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <button class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                                    <i class="fas fa-folder-open text-[10px]"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-white/10">
                                    <i class="fas fa-user-clock text-2xl"></i>
                                </div>
                                <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No reviews recorded in the active cycle.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>
    </div>
</div>

<!-- Modal: New Cycle -->
<x-cc-modal id="cycleModal" title="Initialize Review Framework" icon="fa-network-wired">
    <form method="POST" action="{{ route('admin.hr.performance.cycle.store') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Cycle Nomenclature</label>
            <input name="name" required class="cc-input w-full" placeholder="e.g. FY2026 Q1 APPRAISAL">
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Start Matrix Date</label>
                <input name="start_date" type="date" required class="cc-input w-full">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">End Matrix Date</label>
                <input name="end_date" type="date" required class="cc-input w-full">
            </div>
        </div>
        <div class="pt-4">
            <button type="submit" class="cc-button-primary w-full">Authorize Framework Transmission</button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

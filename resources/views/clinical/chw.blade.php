<x-cc-shell title='Community Health | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Community <span class="text-sage">Health</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Field Operations · Household Surveillance · Community Health Worker Matrix Hub</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="px-5 py-2.5 bg-white/[0.02] rounded-2xl border border-white/[0.04] flex items-center gap-3">
                <div class="w-2 h-2 bg-sage rounded-full animate-pulse shadow-[0_0_10px_rgba(130,192,154,0.5)]"></div>
                <span class="text-[10px] font-black text-sage uppercase tracking-widest">Global Field Sync: Active</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest animate-pulse">
            Household Surveillance Payload Synchronized Successfully.
        </div>
    @endif

    <!-- Intelligence Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active Households" :value="$households->count()" icon="fa-house" trend="Institutional Log" color="slate" />
        <x-cc-stat title="Total Population" :value="$households->sum('member_count')" icon="fa-users" trend="Census Yield" color="indigo" />
        <x-cc-stat title="Coverage Yield" value="94.2%" icon="fa-map-location-dot" trend="Strategic Target" color="emerald" />
        <x-cc-stat title="Surveillance Pulse" value="Synced" icon="fa-tower-broadcast" trend="Operational" color="amber" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Household Surveillance Registry Matrix -->
        <div class="lg:col-span-8">
            <x-cc-card class="overflow-hidden">
                <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em]">Institutional Household Surveillance Matrix</h3>
                    <span class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-[9px] font-black text-white/20 uppercase tracking-widest">Field Sync Active</span>
                </div>

                <x-cc-table :headers="['Household Principal', 'Geographic Catchment', 'Census Payload', 'Temporal Matrix']">
                    @forelse($households as $h)
                        <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-sage/10 group-hover:text-sage group-hover:border-sage/20 transition-all">
                                        {{ substr($h->household_head, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $h->household_head }}</div>
                                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">Head of Household</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-[11px] font-bold text-white/40 uppercase tracking-widest">{{ $h->location }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-xl text-[10px] font-black text-white/40 uppercase tracking-widest">
                                    {{ $h->member_count }} Members
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="text-[11px] font-bold text-white/20 uppercase tracking-widest">
                                    {{ \Carbon\Carbon::parse($h->created_at)->format('d M Y') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <i class="fas fa-house text-white/5 text-2xl mb-4"></i>
                                <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No households identified in the field surveillance matrix.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Enrollment Sidebar -->
        <div class="lg:col-span-4 space-y-8">
            <x-cc-card class="p-8">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mb-8 flex items-center gap-3">
                    <i class="fas fa-plus-circle text-indigo-500"></i>
                    Authorize Enrollment
                </h3>

                <form method="POST" action="{{ url('/clinical/chw/household') }}" class="space-y-6">
                    @csrf
                    <x-cc-input label="Legal Head of Household" name="head_name" required placeholder="e.g. JOHN_DOE_SENIOR" icon="fa-user-tie" />
                    <x-cc-input label="Operational Catchment Area" name="location" required placeholder="e.g. NORTH_SECTOR_04" icon="fa-location-crosshairs" />
                    <x-cc-input label="Total Member Census" name="members" type="number" value="1" required placeholder="1" icon="fa-users" />
                    
                    <div class="pt-4">
                        <x-cc-button type="submit" color="indigo" class="w-full">Authorize Enrollment Relay</x-cc-button>
                    </div>
                </form>
            </x-cc-card>

            <!-- Field Intelligence Surveillance -->
            <x-cc-card class="p-8 bg-gradient-to-br from-indigo-500/5 to-transparent border-indigo-500/10">
                <div class="flex items-center gap-5 mb-8">
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500 border border-indigo-500/20">
                        <i class="fas fa-location-dot text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-bold text-white uppercase tracking-widest">Catchment Intelligence</h4>
                        <p class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">Data Integrity: 98.4%</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black text-white/20 uppercase tracking-widest">Coverage Spectrum</span>
                        <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Authorized</span>
                    </div>
                    <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-indigo-500 h-full shadow-[0_0_15px_rgba(99,102,241,0.5)]" style="width: 85%"></div>
                    </div>
                    <p class="text-[10px] font-bold text-white/40 leading-relaxed uppercase tracking-tight">
                        Surveillance reach expanded by 12% in the last operational cycle. Maintain field vigilance.
                    </p>
                </div>
            </x-cc-card>
        </div>
    </div>
</div>
</x-cc-shell>

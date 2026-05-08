<x-cc-shell title='Opeshis OS'>
@section("title","Incident Reports - Opeshis OS")

<div class="space-y-8 animate-fade-in pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-200 uppercase tracking-tighter">Incident Command Hub</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Quality Assurance · Adverse Event Matrix · Root Cause Intelligence</p>
        </div>
        <div class="flex gap-3">
            <x-cc-button icon="fa-triangle-exclamation" color="rose" onclick="document.getElementById('incModal').classList.remove('hidden')">
                Report New Incident
            </x-cc-button>
        </div>
    </div>

    <!-- Institutional KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <x-cc-stat 
            label="Total Incidents" 
            value="{{ $incidents->count() }}" 
            icon="fa-list-check" 
            trend="Institutional Log" 
            color="slate" 
        />
        <x-cc-stat 
            label="Critical Events" 
            value="{{ $incidents->where('severity', 'critical')->count() }}" 
            icon="fa-fire-extinguisher" 
            trend="Priority Alpha" 
            color="rose" 
        />
        <x-cc-stat 
            label="Pending Investigation" 
            value="{{ $incidents->where('status', 'reported')->count() }}" 
            icon="fa-magnifying-glass-chart" 
            trend="Active Queue" 
            color="amber" 
        />
        <x-cc-stat 
            label="Resolution Rate" 
            value="Nominal" 
            icon="fa-shield-check" 
            trend="Operational" 
            color="emerald" 
        />
    </div>

    <!-- Incident Surveillance Matrix -->
    <x-cc-card title="Institutional Quality & Incident Matrix" icon="fa-database">
        <x-slot name="action">
            <span class="px-2 py-0.5 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded text-[9px] font-black uppercase tracking-widest italic">Live Surveillance Active</span>
        </x-slot>

        <x-cc-table :headers="['Incident Profile Identity', 'Location Matrix', 'Severity Node', 'Status Matrix', 'Reporting Node', 'Temporal Log']">
            @forelse($incidents as $i)
                <tr class="group hover:bg-rose-500/[0.02] transition-colors">
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors italic">{{ $i->incident_type }}</div>
                        <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1 truncate max-w-[200px]">{{ $i->description }}</div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest italic">
                        {{ $i->location }}
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        @php
                            $sevCls = match($i->severity) {
                                'critical' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 shadow-lg shadow-rose-500/10 animate-pulse',
                                'high' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                'medium' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20',
                                default => 'bg-slate-500/10 text-slate-500 border-slate-500/20',
                            };
                        @endphp
                        <span class="px-3 py-1.5 rounded-lg border {{ $sevCls }} text-[8px] font-black uppercase tracking-widest italic">
                            {{ strtoupper($i->severity) }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <span class="px-3 py-1.5 bg-slate-900/50 text-slate-500 border border-slate-700/60 rounded-lg text-[8px] font-black uppercase tracking-widest italic">
                            {{ strtoupper($i->status) }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="text-[11px] font-black text-slate-300 uppercase tracking-tight italic">{{ $i->reporter->name ?? 'SYSTEM_USER' }}</div>
                        <div class="text-[9px] font-black text-slate-600 uppercase tracking-widest">{{ $i->reporter->staff_code ?? 'INSTITUTIONAL' }}</div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-right">
                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic">
                            {{ \Carbon\Carbon::parse($i->incident_date)->format('d M Y') }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-600 italic text-sm">No institutional incidents identified in the quality surveillance matrix.</td>
                </tr>
            @endforelse
        </x-cc-table>
    </x-cc-card>
</div>

<!-- Modal: Report Incident -->
<x-cc-modal id="incModal" title="Authorize Incident Reporting Protocol" icon="fa-triangle-exclamation">
    <form method="POST" action="{{ url('/ops/incidents') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Institutional Incident Type</label>
            <select name="type" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
                <option>Near Miss</option>
                <option>Adverse Event</option>
                <option>Sentinel Event</option>
                <option>Medication Error</option>
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Temporal Node (Date)</label>
                <input name="incident_date" type="date" required class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Location Node</label>
                <input name="location" required placeholder="e.g. PHARMACY_ALPHA" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase">
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Incident Intelligence Narrative</label>
            <textarea name="description" rows="3" required placeholder="ENTER_INCIDENT_NARRATIVE..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase resize-none no-scrollbar"></textarea>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Immediate Containment Action</label>
            <textarea name="immediate_action" rows="2" required placeholder="ENTER_CONTAINMENT_PROTOCOL..." class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 uppercase resize-none no-scrollbar"></textarea>
        </div>
        <div>
            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2 italic">Severity Matrix Assignment</label>
            <select name="severity" class="w-full bg-slate-900/50 border border-slate-700/60 rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
                <option value="low">LOW_IMPACT</option>
                <option value="medium">MEDIUM_IMPACT</option>
                <option value="high">HIGH_IMPACT</option>
                <option value="critical">CRITICAL_EVENT</option>
            </select>
        </div>
        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full uppercase tracking-widest">Authorize Reporting Protocol</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>


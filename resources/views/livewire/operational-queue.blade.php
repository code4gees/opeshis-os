<div wire:poll.15s="refreshQueue">
    <x-cc-card title="Operational Queue" icon="fa-hospital-user">
        <x-slot name="action">
            <div class="flex items-center gap-2 px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 rounded-full">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[8px] font-black text-emerald-500 uppercase tracking-widest">Neural Link Active</span>
            </div>
        </x-slot>

        <x-cc-table :headers="['Patient Identity', 'Status', 'Wait Time', 'Operations']">
            @forelse($queue as $q)
                <tr class="group hover:bg-white/[0.02] transition-colors">
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="flex items-center">
                            <div class="h-9 w-9 flex-shrink-0 rounded-xl bg-blue-500/10 flex items-center justify-center border border-blue-500/20 text-blue-400 font-black text-xs">
                                {{ substr($q->patient->full_name ?? 'P', 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-blue-400 transition-colors">
                                    {{ $q->patient->full_name ?? 'Unknown Patient' }}
                                </div>
                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                    {{ $q->patient->medical_id ?? 'ID: ERR-000' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <x-cc-status-badge :status="$q->status" />
                    </td>
                    <td class="whitespace-nowrap px-5 py-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-slate-600 text-[10px]"></i>
                            <span class="text-xs font-bold text-slate-400">
                                {{ \Carbon\Carbon::parse($q->created_at)->diffForHumans(null, true) }}
                            </span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-4 text-right">
                        <x-cc-button variant="ghost" size="sm" icon="fa-stethoscope" 
                            href="{{ route('emr', ['id' => $q->id]) }}"
                            class="text-blue-400 hover:bg-blue-500/10">
                            Assess
                        </x-cc-button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center">
                        <i class="fas fa-inbox text-4xl text-slate-800 mb-4"></i>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Queue Vacuum</h3>
                        <p class="text-xs text-slate-600 mt-1">No active patients in the institutional pipeline.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>

        <x-slot name="footer">
            <div class="flex justify-between items-center text-[9px] font-black text-slate-500 uppercase tracking-widest">
                <span>Displaying Top {{ count($queue) }} Active Signal{{ count($queue) != 1 ? 's' : '' }}</span>
                <span>Last Updated: {{ now()->format('H:i:s') }}</span>
            </div>
        </x-slot>
    </x-cc-card>
</div>

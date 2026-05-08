<x-cc-shell title='Opeshis OS'>

@section('title', 'Patient Registry - Opeshis OS')


<div class="max-w-7xl mx-auto space-y-6 pb-20">
    
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-white/5 pb-8">
        <div>
            <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-2">
                <i class="fas fa-users-medical text-blue-500/50"></i>
                <span>Institutional Archive</span>
                <span class="text-white/10">/</span>
                <span class="text-slate-300">Master Patient Index</span>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tighter uppercase">
                Patient <span class="text-blue-500">Registry</span>
            </h1>
            <p class="text-xs font-medium text-slate-400 mt-2">Manage and search for institutional medical records.</p>
        </div>
        <div class="mt-6 md:mt-0">
            <x-cc-button icon="fa-user-plus" onclick="document.getElementById('enrollModal').classList.remove('hidden')">
                Register New Patient
            </x-cc-button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-[10px] font-black uppercase tracking-widest animate-pulse">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Search Engine -->
    <x-cc-card>
        <form method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1">
                <x-cc-input 
                    label="Patient Search" 
                    name="q" 
                    :value="$search" 
                    placeholder="Enter Name, Medical ID, or Phone..." 
                    icon="fa-search" 
                />
            </div>
            <x-cc-button type="submit" variant="secondary" icon="fa-filter">
                Search Registry
            </x-cc-button>
        </form>
    </x-cc-card>

    <!-- Master Index Table -->
    <x-cc-card title="Institutional Master Index" icon="fa-database">
        <x-cc-table :headers="['Patient Identity', 'Contact Channel', 'Gender', 'Operations']">
            @forelse($patients as $p)
                <tr class="group hover:bg-white/[0.02] transition-colors">
                    <td class="whitespace-nowrap px-5 py-5">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0 rounded-xl bg-blue-500/10 flex items-center justify-center border border-blue-500/20 text-blue-400 font-black text-xs">
                                {{ substr($p->full_name, 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-blue-400 transition-colors">{{ $p->full_name }}</div>
                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $p->medical_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-5">
                        <div class="text-xs font-bold text-slate-300">{{ $p->phone_number ?: 'UNSPECIFIED' }}</div>
                        <div class="text-[9px] font-black text-slate-600 uppercase tracking-widest mt-1">{{ $p->email ?? 'no-email-recorded' }}</div>
                    </td>
                    <td class="whitespace-nowrap px-5 py-5">
                        <x-cc-status-badge :status="$p->gender" />
                    </td>
                    <td class="whitespace-nowrap px-5 py-5 text-right">
                        <x-cc-button variant="ghost" size="sm" icon="fa-id-card" 
                            href="{{ route('patients.show', $p->id) }}"
                            class="text-blue-400 hover:bg-blue-500/10">
                            Profile
                        </x-cc-button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center">
                        <i class="fas fa-search-minus text-4xl text-slate-800 mb-4"></i>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Registry Vacuum</h3>
                        <p class="text-xs text-slate-600 mt-1">No institutional records match the current search criteria.</p>
                    </td>
                </tr>
            @endforelse
        </x-cc-table>

        @if($patients->hasPages())
        <div class="mt-6 px-4">
            {{ $patients->links() }}
        </div>
        @endif
    </x-cc-card>
</div>

<!-- Modal: New Patient Registration -->
<x-cc-modal id="enrollModal" title="Register Institutional Patient" icon="fa-user-plus">
    <form method="POST" action="{{ route('patients.register') }}" class="space-y-6">
        @csrf
        <x-cc-input 
            label="Full Legal Identity" 
            name="full_name" 
            required 
            placeholder="Surname, First Name" 
            icon="fa-id-badge" 
        />

        <div class="grid grid-cols-2 gap-6">
            <x-cc-select label="Biological Gender" name="gender" icon="fa-venus-mars">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </x-cc-select>

            <x-cc-input 
                label="Primary Contact" 
                name="phone_number" 
                placeholder="+237 ..." 
                icon="fa-phone" 
            />
        </div>

        <div class="flex gap-4 mt-8 pt-6 border-t border-white/5">
            <x-cc-button type="button" variant="secondary" class="flex-1" onclick="document.getElementById('enrollModal').classList.add('hidden')">
                Discard
            </x-cc-button>
            <x-cc-button type="submit" class="flex-1">
                Authorize Registration
            </x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

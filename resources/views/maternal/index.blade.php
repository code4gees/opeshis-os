<x-cc-shell title='Maternal Health Command | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Maternal & Obstetrics</h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mt-2">Institutional Reproductive Health Command · Antenatal Surveillance</p>
        </div>
        <div class="flex gap-4">
            <x-cc-button icon="fa-plus" color="rose" variant="ghost" onclick="document.getElementById('ancModal').classList.remove('hidden')">
                ANC Enrollment
            </x-cc-button>
            <x-cc-button icon="fa-baby" color="emerald" onclick="document.getElementById('birthModal').classList.remove('hidden')">
                Record Delivery
            </x-cc-button>
        </div>
    </div>

    <!-- Specialty Telemetry Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <x-cc-stat title="Active ANC Tracking" value="{{ $ancPatients->count() }}" icon="fa-person-pregnant" trend="Prenatal Queue" color="blue" />
        <x-cc-stat title="Recent Births" value="{{ $recentBirths->count() }}" icon="fa-baby-carriage" trend="Last 30 Days" color="emerald" />
        <x-cc-stat title="Ward Admissions" value="{{ $activeAdmissions->count() }}" icon="fa-bed-pulse" trend="Obstetric Unit" color="rose" />
        <x-cc-stat title="Safety Protocol" value="99.9%" icon="fa-shield-heart" trend="Institutional Index" color="amber" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Main Column: ANC Registry -->
        <div class="lg:col-span-8 space-y-8">
            <x-cc-card class="overflow-hidden">
                <div class="px-8 py-6 border-b border-white/[0.04] bg-white/[0.02] flex justify-between items-center">
                    <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] flex items-center gap-3">
                        <i class="fas fa-clipboard-list text-sage text-[14px]"></i>
                        Antenatal Care Surveillance Matrix
                    </h3>
                    <span class="px-3 py-1 bg-sage/10 text-sage border border-sage/20 rounded-lg text-[9px] font-black uppercase tracking-widest">Active Monitoring</span>
                </div>

                <x-cc-table :headers="['Patient Identity Protocol', 'Gestation Profile', 'EDD Prediction Matrix', 'Strategic Actions']">
                    @forelse($ancPatients as $anc)
                        <tr class="group hover:bg-white/[0.01] transition-all duration-300 border-b border-white/[0.02] last:border-0">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="h-11 w-11 rounded-2xl bg-white/5 flex items-center justify-center border border-white/5 text-white/20 font-black text-[12px] group-hover:bg-sage/10 group-hover:text-sage group-hover:border-sage/20 transition-all">
                                        {{ substr($anc->patient->full_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $anc->patient->full_name }}</div>
                                        <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">{{ $anc->patient->medical_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-[11px] font-bold text-white/40 uppercase tracking-tighter">G{{ $anc->gravida }} • P{{ $anc->parity }}</div>
                                <div class="text-[10px] font-bold text-white/10 uppercase tracking-widest mt-1">LMP: {{ \Carbon\Carbon::parse($anc->lmp_date)->format('d M, Y') }}</div>
                            </td>
                            <td class="px-8 py-6">
                                @php $isPast = \Carbon\Carbon::parse($anc->edd_date)->isPast(); @endphp
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $isPast ? 'bg-rose-500 animate-pulse' : 'bg-sage' }}"></div>
                                    <span class="text-[11px] font-bold {{ $isPast ? 'text-rose-500' : 'text-sage' }} uppercase tracking-tighter">
                                        {{ \Carbon\Carbon::parse($anc->edd_date)->format('d M, Y') }}
                                    </span>
                                </div>
                                <div class="text-[10px] font-bold text-white/10 uppercase tracking-widest mt-1">
                                    {{ $isPast ? 'OVERDUE_PROTOCOL' : \Carbon\Carbon::parse($anc->edd_date)->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <x-cc-button variant="ghost" size="sm" icon="fa-file-medical" color="slate" href="{{ route('emr', $anc->patient_id) }}">
                                    Open Dossier
                                </x-cc-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-6 border border-white/5">
                                    <i class="fas fa-person-pregnant text-white/10 text-xl"></i>
                                </div>
                                <p class="text-[11px] font-bold text-white/10 uppercase tracking-widest">No active ANC tracking identified.</p>
                            </td>
                        </tr>
                    @endforelse
                </x-cc-table>
            </x-cc-card>
        </div>

        <!-- Right Column: Recent Deliveries -->
        <div class="lg:col-span-4 space-y-8">
            <x-cc-card class="p-8">
                <h3 class="text-[11px] font-bold text-white/20 uppercase tracking-[0.25em] mb-8 flex items-center gap-3">
                    <i class="fas fa-baby text-emerald-500"></i>
                    Birth Registry Matrix
                </h3>
                <div class="space-y-4">
                    @forelse($recentBirths as $birth)
                        <div class="p-5 bg-white/[0.01] border border-white/[0.04] rounded-2xl group hover:border-emerald-500/20 transition-all duration-500">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex gap-4">
                                    <div class="w-10 h-10 rounded-xl {{ $birth->gender === 'Female' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' }} flex items-center justify-center font-black text-[12px] border">
                                        {{ substr($birth->gender, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-emerald-400 transition-colors">{{ $birth->baby_name ?: 'NEONATAL_SUBJECT' }}</h4>
                                        <p class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-1">MOTHER: {{ $birth->mother->full_name }}</p>
                                    </div>
                                </div>
                                <span class="text-[9px] font-black text-white/10 uppercase tracking-widest">{{ \Carbon\Carbon::parse($birth->birth_datetime)->diffForHumans(null, true) }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/[0.02]">
                                <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">{{ $birth->weight_kg }} KG</span>
                                <span class="text-[9px] font-black text-white/20 uppercase tracking-widest">{{ $birth->delivery_type }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center">
                            <i class="fas fa-baby-carriage text-white/5 text-2xl mb-4"></i>
                            <p class="text-[10px] font-bold text-white/10 uppercase tracking-widest">Registry Baseline</p>
                        </div>
                    @endforelse
                </div>
            </x-cc-card>
        </div>
    </div>
</div>

<!-- Modal: ANC Enrollment -->
<x-cc-modal id="ancModal" title="Antenatal Enrollment Protocol" icon="fa-person-pregnant">
    <form method="POST" action="{{ route('maternal.anc.register') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Mother's Medical Identity" name="patient_id" required placeholder="SEARCH PATIENT UUID..." icon="fa-search" />
        
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="LMP Date" name="lmp_date" type="date" required icon="fa-calendar-day" />
            
            <div class="grid grid-cols-2 gap-3">
                <x-cc-input label="Gravida" name="gravida" type="number" value="1" min="1" icon="fa-circle-plus" />
                <x-cc-input label="Parity" name="parity" type="number" value="0" min="0" icon="fa-circle-check" />
            </div>
        </div>

        <div class="pt-4">
            <x-cc-button type="submit" color="rose" class="w-full">Initialize ANC Profile</x-cc-button>
        </div>
    </form>
</x-cc-modal>

<!-- Modal: Birth Record -->
<x-cc-modal id="birthModal" title="Neonatal Registry Protocol" icon="fa-baby">
    <form method="POST" action="{{ route('maternal.birth.record') }}" class="space-y-6">
        @csrf
        <x-cc-input label="Mother's Medical Identity" name="mother_id" required placeholder="MOTHER'S UUID..." icon="fa-hospital-user" />
        
        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Neonatal Name" name="baby_name" placeholder="BABY OF..." icon="fa-child" />
            
            <x-cc-select label="Gender Identity" name="gender" required icon="fa-venus-mars">
                <option value="Male">MALE</option>
                <option value="Female">FEMALE</option>
                <option value="Indeterminate">INDETERMINATE</option>
            </x-cc-select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <x-cc-input label="Time of Delivery" name="birth_datetime" type="datetime-local" required icon="fa-clock" />
            <x-cc-input label="Birth Weight (KG)" name="weight" type="number" step="0.01" required icon="fa-weight-scale" />
        </div>

        <div class="pt-4">
            <x-cc-button type="submit" color="emerald" class="w-full">Authorize Birth Record</x-cc-button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>
>
</x-cc-shell>

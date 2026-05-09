<x-cc-shell title='Opeshis OS'>

@section('title', 'Maternal Health Command - Opeshis OS')


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-white uppercase tracking-tighter">Maternal & Obstetrics</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Reproductive Health Command</p>
 </div>
 <div class="flex gap-3">
 <x-cc-button icon="fa-plus" onclick="document.getElementById('ancModal').classList.remove('hidden')">
 ANC Enrollment
 </x-cc-button>
 <x-cc-button variant="ghost" icon="fa-baby" onclick="document.getElementById('birthModal').classList.remove('hidden')">
 Record Delivery
 </x-cc-button>
 </div>
 </div>

 <!-- Specialty KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <x-cc-stat 
 title="Active ANC Tracking" 
 value="{{ $ancPatients->count() }}" 
 icon="fa-person-pregnant" 
 trend="Prenatal Queue" 
 color="blue" 
 />
 <x-cc-stat 
 title="Recent Births" 
 value="{{ $recentBirths->count() }}" 
 icon="fa-baby-carriage" 
 trend="Last 30 Days" 
 color="emerald" 
 />
 <x-cc-stat 
 title="Ward Admissions" 
 value="{{ $activeAdmissions->count() }}" 
 icon="fa-bed-pulse" 
 trend="Postnatal/Obstetric" 
 color="rose" 
 />
 <x-cc-stat 
 title="Safety Protocol" 
 value="99.9%" 
 icon="fa-shield-heart" 
 trend="Institutional Standard" 
 color="amber" 
 />
 </div>

 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 <!-- Main Column: ANC Registry -->
 <div class="lg:col-span-2 space-y-8">
 <x-cc-card title="Antenatal Care Waitlist" icon="fa-clipboard-list">
 <x-slot name="action">
 <span class="px-2 py-0.5 bg-sage/10 text-sage border border-blue-500/20 rounded text-[12px] font-semibold font-medium">Active Monitoring</span>
 </x-slot>

 <x-cc-table :headers="['Patient Identity', 'Gestation Status', 'EDD Prediction', 'Operations']">
 @forelse($ancPatients as $anc)
 <tr class="group hover:bg-card transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-sage/10 flex items-center justify-center border border-blue-500/20 text-sage font-bold text-xs">
 {{ substr($anc->patient->full_name, 0, 1) }}
 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors">{{ $anc->patient->full_name }}</div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium">{{ $anc->patient->medical_id }}</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <div class="text-xs font-semibold text-slate-300 uppercase tracking-tight">G{{ $anc->gravida }} • P{{ $anc->parity }}</div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">LMP: {{ \Carbon\Carbon::parse($anc->lmp_date)->format('d M, Y') }}</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 @php $isPast = \Carbon\Carbon::parse($anc->edd_date)->isPast(); @endphp
 <div class="text-xs font-semibold {{ $isPast ? 'text-rose-500' : 'text-sage' }} uppercase">
 {{ \Carbon\Carbon::parse($anc->edd_date)->format('d M, Y') }}
 </div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">
 {{ $isPast ? 'Overdue' : \Carbon\Carbon::parse($anc->edd_date)->diffForHumans() }}
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <x-cc-button variant="ghost" size="sm" icon="fa-file-medical" href="{{ route('emr', $anc->patient_id) }}">
 Open Chart
 </x-cc-button>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-sm">No active ANC tracking records found.</td>
 </tr>
 @endforelse
 </x-cc-table>
 </x-cc-card>
 </div>

 <!-- Right Column: Recent Deliveries & Admissions -->
 <div class="space-y-8">
 <x-cc-card title="Institutional Birth Registry" icon="fa-baby">
 <div class="space-y-4">
 @forelse($recentBirths as $birth)
 <div class="p-4 rounded-xl bg-card border border-subtle hover:border-blue-500/30 transition-all group">
 <div class="flex justify-between items-start">
 <div class="flex gap-3">
 <div class="w-10 h-10 rounded-lg {{ $birth->gender === 'Female' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-sage/10 text-sage border-blue-500/20' }} flex items-center justify-center font-bold text-sm border">
 {{ substr($birth->gender, 0, 1) }}
 </div>
 <div>
 <h4 class="text-xs font-semibold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors">{{ $birth->baby_name ?: 'Neonatal Subject' }}</h4>
 <p class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">Mother: {{ $birth->mother->full_name }}</p>
 </div>
 </div>
 <span class="text-[12px] font-semibold text-slate-600 uppercase">{{ \Carbon\Carbon::parse($birth->birth_datetime)->diffForHumans(null, true) }}</span>
 </div>
 <div class="mt-4 flex items-center justify-between pt-3 border-t border-subtle">
 <span class="text-[12px] font-semibold text-sage font-medium">{{ $birth->weight_kg }} KG</span>
 <span class="text-[12px] font-bold text-slate-500 uppercase ">{{ $birth->delivery_type }}</span>
 </div>
 </div>
 @empty
 <div class="py-12 text-center">
 <p class="text-xs font-bold text-slate-600 font-medium">Registry Vacuum</p>
 </div>
 @endforelse
 </div>
 </x-cc-card>
 </div>
 </div>
</div>

<!-- Modal: ANC Registration -->
<x-cc-modal id="ancModal" title="ANC Enrollment" icon="fa-person-pregnant">
 <form method="POST" action="{{ route('maternal.anc.register') }}" class="space-y-6">
 @csrf
 <div class="space-y-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Mother's Medical Identity</label>
 <input type="text" name="patient_id" required placeholder="Search Patient UUID..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">LMP Date</label>
 <input type="date" name="lmp_date" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 <div class="grid grid-cols-2 gap-3">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Gravida</label>
 <input type="number" name="gravida" value="1" min="1" class="w-full bg-card/50 border border-subtle rounded-xl px-3 py-3 text-sm font-bold text-slate-200 outline-none">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Parity</label>
 <input type="number" name="parity" value="0" min="0" class="w-full bg-card/50 border border-subtle rounded-xl px-3 py-3 text-sm font-bold text-slate-200 outline-none">
 </div>
 </div>
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <x-cc-button type="submit" class="w-full">Initialize ANC Profile</x-cc-button>
 </div>
 </form>
</x-cc-modal>

<!-- Modal: Birth Record -->
<x-cc-modal id="birthModal" title="Neonatal Registry" icon="fa-baby">
 <form method="POST" action="{{ route('maternal.birth.record') }}" class="space-y-6">
 @csrf
 <div class="space-y-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Mother's Medical Identity</label>
 <input type="text" name="mother_id" required placeholder="Mother's UUID..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Neonatal Name</label>
 <input type="text" name="baby_name" placeholder="Baby of..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Gender</label>
 <select name="gender" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 <option value="Male">Male</option>
 <option value="Female">Female</option>
 <option value="Indeterminate">Indeterminate</option>
 </select>
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Time of Delivery</label>
 <input type="datetime-local" name="birth_datetime" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Weight (KG)</label>
 <input type="number" step="0.01" name="weight" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <x-cc-button type="submit" class="w-full">Finalize Birth Record</x-cc-button>
 </div>
 </form>
</x-cc-modal>
</x-cc-shell>
>
</x-cc-shell>

<x-cc-shell title='Opeshis OS'>

@section('title', 'Community Health Portal — Opeshis OS')

<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: Community Health Command -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Community <span class="text-sage">Health</span></h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Field Operations · Household Surveillance · Community Health Worker Matrix</p>
 </div>
 <div class="flex items-center gap-4">
 <x-cc-stat title="Active Households" :value="$households->count()" icon="fa-house" color="slate" />
 <x-cc-stat title="Total Population" :value="$households->sum('member_count')" icon="fa-users" color="indigo" />
 </div>
 </header>

 @if(session('success'))
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[12px] font-semibold font-medium mb-8 animate-pulse ">
 Household surveillance payload synchronized successfully.
 </div>
 @endif

 <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
 <!-- Household Surveillance Registry Matrix -->
 <div class="lg:col-span-8">
 <x-clinical-card title="Institutional Household Surveillance Matrix" icon="fa-database" badge="Field Sync: Active">
 <x-data-table :headers="['Household Principal', 'Geographic Catchment', 'Census Payload', 'Temporal Matrix']">
 @foreach($households as $h)
 <tr class="hover:bg-card transition-all group">
 <td class="px-6 py-4">
 <div class="flex items-center gap-5">
 <div class="w-10 h-10 bg-sage/10 rounded-xl flex items-center justify-center font-semibold text-sage text-[12px] border border-indigo-500/20 group-hover:border-indigo-500/30 transition-all">
 {{ substr($h->household_head, 0, 1) }}
 </div>
 <div>
 <div class="font-semibold text-white text-sm uppercase group-hover:text-sage transition-colors">{{ $h->household_head }}</div>
 <div class="text-[8px] font-semibold text-slate-600 uppercase mt-0.5 ">Head of Household</div>
 </div>
 </div>
 </td>
 <td class="px-6 py-4">
 <div class="text-[12px] font-bold text-slate-400 uppercase tracking-tight ">{{ $h->location }}</div>
 </td>
 <td class="px-6 py-4 text-center">
 <span class="px-4 py-1.5 bg-sage/10 text-sage rounded-xl text-[12px] font-semibold border border-indigo-500/20 /5 ">
 {{ $h->member_count }} Members
 </span>
 </td>
 <td class="px-6 py-4 text-right text-[12px] font-semibold text-slate-500 font-medium ">
 {{ \Carbon\Carbon::parse($h->created_at)->format('d M Y') }}
 </td>
 </tr>
 @endforeach
 @if($households->isEmpty())
 <tr>
 <td colspan="4" class="px-6 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <i class="fas fa-house text-2xl"></i>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No households identified in the field surveillance matrix.</p>
 </td>
 </tr>
 @endif
 </x-data-table>
 </x-clinical-card>
 </div>

 <!-- Enrollment Sidebar -->
 <div class="lg:col-span-4 space-y-8">
 <x-clinical-card title="Authorize Enrollment" icon="fa-plus-circle">
 <form method="POST" action="{{ url('/clinical/chw/household') }}" class="space-y-6">
 @csrf
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Legal Head of Household</label>
 <input type="text" name="head_name" required class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. JOHN_DOE_SENIOR">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Operational Catchment Area</label>
 <input type="text" name="location" required class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. NORTH_SECTOR_04">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Total Member Census</label>
 <input type="number" name="members" value="1" required class="w-full bg-card/50 border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all" placeholder="1">
 </div>
 <x-cc-button type="submit" color="indigo" class="w-full py-4">Authorize Enrollment Relay</x-cc-button>
 </form>
 </x-clinical-card>

 <!-- Field Intelligence Surveillance -->
 <div class="bg-card rounded-3xl p-8 border border-subtle bg-card/40 relative overflow-hidden">
 <div class="relative z-10">
 <div class="flex items-center gap-5 mb-8">
 <div class="w-12 h-12 bg-sage/10 rounded-2xl flex items-center justify-center text-sage border border-indigo-500/20 /5">
 <i class="fas fa-location-dot text-lg"></i>
 </div>
 <div>
 <h4 class="text-[12px] font-semibold text-white font-medium ">Catchment Intelligence</h4>
 <p class="text-[8px] font-semibold text-slate-500 font-medium mt-1 ">Data Integrity: 98.4%</p>
 </div>
 </div>
 <div class="space-y-6">
 <div class="flex justify-between items-center">
 <span class="text-[12px] font-semibold text-slate-500 font-medium ">Coverage Spectrum:</span>
 <span class="text-[12px] font-semibold text-emerald-500 font-medium">Authorized</span>
 </div>
 <div class="w-full bg-[#2a2e38] h-2 rounded-full overflow-hidden ">
 <div class="bg-gradient-to-r from-indigo-600 to-indigo-400 h-full shadow-[0_0_10px_rgba(99,102,241,0.5)]" style="width: 85%"></div>
 </div>
 </div>
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-sage/5 rounded-full blur-3xl"></div>
 </div>
 </div>
 </div>
</div>
</x-cc-shell>

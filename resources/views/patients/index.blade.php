<x-cc-shell title='Patient Registry | Opeshis OS'>

<div class="max-w-[1600px] mx-auto pb-10">

 {{-- ── PAGE HEADER ─────────────────────────────── --}}
 <div class="flex items-center justify-between mb-10">
 <div>
 <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Patient Registry</h1>
 <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Master Patient Index</p>
 </div>
 <button onclick="document.getElementById('enrollModal').classList.remove('hidden')"
 class="cc-button-primary flex items-center gap-2">
 <i class="fas fa-user-plus text-[10px]"></i>
 Authorize New Entry
 </button>
 </div>

 @if(session('success'))
 <div class="mb-5 px-4 py-3 bg-sage/10 border border-sage/20 text-sage rounded-lg text-[12px] flex items-center gap-2">
 <i class="fas fa-check-circle text-[12px]"></i> {{ session('success') }}
 </div>
 @endif

 {{-- ── SEARCH BAR ──────────────────────────────── --}}
 <div class="cc-card p-6 mb-10">
 <form method="GET" class="flex items-end gap-6">
 <div class="flex-1">
 <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Archive Forensic Search</label>
 <div class="relative">
 <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-white/20 text-[12px]"></i>
 <input type="text" name="q" value="{{ $search }}"
 class="cc-input w-full pl-12"
 placeholder="Search Identity, Medical ID, or Forensic Signature...">
 </div>
 </div>
 <button type="submit" class="cc-button-primary !bg-white/5 !text-white/60 hover:!text-white border border-white/5">
 Execute Query
 </button>
 </form>
 </div>

 {{-- ── MASTER INDEX TABLE ──────────────────────── --}}
 <div class="cc-card overflow-hidden">
 <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
 <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
 <i class="fas fa-database text-sage text-[14px]"></i>
 Master Patient Index
 </h2>
 <span class="px-3 py-1 rounded-full bg-sage/10 text-sage text-[11px] font-bold uppercase tracking-wider">
 {{ $patients->total() }} Records Synchronized
 </span>
 </div>

 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="border-b border-white/[0.04] bg-white/[0.01]">
 <tr>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Patient Identity</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Contact Channel</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Biological Status</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Registration</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest text-right">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/[0.04]">
 @forelse($patients as $index => $p)
 <tr class="hover:bg-white/[0.02] transition-colors group">
 {{-- Patient Identity --}}
 <td class="px-8 py-5">
 <div class="flex items-center gap-4">
 <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center text-sage text-[13px] font-bold group-hover:scale-110 transition-transform">
 {{ strtoupper(substr($p->full_name ?? 'P', 0, 1)) }}
 </div>
 <div>
 <div class="text-[12px] font-bold text-white tracking-tight group-hover:text-sage transition-colors">
 {{ $p->full_name }}
 </div>
 <div class="text-[11px] text-white/20 font-mono tracking-wider">
 {{ $p->medical_id }}
 </div>
 </div>
 </div>
 </td>
 {{-- Contact Channel --}}
 <td class="px-8 py-5">
 <div class="text-[11px] font-bold text-white/40 tracking-tight">
 {{ $p->phone ?: 'Unspecified' }}
 </div>
 <div class="text-[10px] text-white/20 font-medium">
 {{ $p->email ?: 'No Communication' }}
 </div>
 </td>
 {{-- Gender --}}
 <td class="px-8 py-5">
 <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
 {{ strtolower($p->gender) === 'male' ? 'bg-blue-500/10 text-blue-400' 
 : (strtolower($p->gender) === 'female' ? 'bg-pink-500/10 text-pink-400' 
 : 'bg-white/5 text-white/40') }}">
 {{ $p->gender }}
 </span>
 </td>
 {{-- Registered --}}
 <td class="px-8 py-5">
 <div class="text-[11px] font-bold text-white/20 tracking-tighter">
 {{ $p->created_at->format('M d, Y') }}
 </div>
 </td>
 {{-- Actions --}}
 <td class="px-8 py-5 text-right">
 <a href="{{ route('patients.show', $p->id) }}"
 class="cc-button-primary !py-2 !px-5 inline-flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
 <i class="fas fa-id-card text-[10px]"></i> Forensic Profile
 </a>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-16 text-center">
 <div class="w-14 h-14 rounded-full bg-[#2a2e38] flex items-center justify-center mx-auto mb-3">
 <i class="fas fa-search text-slate-600 text-lg"></i>
 </div>
 <p class="text-[13px] font-medium text-slate-400">No patients found</p>
 <p class="text-[12px] text-slate-600 mt-1">Adjust search criteria or register a new patient</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>

 @if($patients->hasPages())
 <div class="px-6 py-4 border-t border-subtle bg-[#1a1d24]/50">
 {{ $patients->links() }}
 </div>
 @endif
 </div>
</div>

{{-- ── ENROLL MODAL ──────────────────────────────── --}}
<div id="enrollModal" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] hidden flex items-center justify-center p-6">
    <div class="cc-card w-full max-w-lg shadow-2xl overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]">Institutional Enrollment</h3>
            <button onclick="document.getElementById('enrollModal').classList.add('hidden')"
                class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                <i class="fas fa-times text-[10px]"></i>
            </button>
        </div>
        <form method="POST" action="{{ route('patients.register') }}" class="p-8 space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Legal Identity</label>
                <div class="relative">
                    <i class="fas fa-id-badge absolute left-4 top-1/2 -translate-y-1/2 text-white/10 text-[12px]"></i>
                    <input name="full_name" required
                        class="cc-input w-full pl-12"
                        placeholder="Surname, First Name">
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Biological Gender</label>
                    <div class="relative">
                        <i class="fas fa-venus-mars absolute left-4 top-1/2 -translate-y-1/2 text-white/10 text-[12px]"></i>
                        <select name="gender" required
                            class="cc-input w-full pl-12 appearance-none">
                            <option value="Male" class="bg-[#1a1d24]">Male</option>
                            <option value="Female" class="bg-[#1a1d24]">Female</option>
                            <option value="Other" class="bg-[#1a1d24]">Other</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Primary Contact</label>
                    <div class="relative">
                        <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-white/10 text-[12px]"></i>
                        <input name="phone"
                            class="cc-input w-full pl-12"
                            placeholder="+237 ...">
                    </div>
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="document.getElementById('enrollModal').classList.add('hidden')"
                    class="flex-1 py-3 bg-white/5 border border-white/5 text-white/30 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:text-white transition-all">
                    Discard
                </button>
                <button type="submit" class="cc-button-primary flex-1">
                    Authorize Entry
                </button>
            </div>
        </form>
    </div>
</div>

</x-cc-shell>

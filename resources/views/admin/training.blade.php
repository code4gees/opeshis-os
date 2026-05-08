<x-cc-shell title='Opeshis OS'>

@section('title', 'Staff Training & Compliance - Opeshis OS')


<div class="space-y-8 animate-fade-in">
    <!-- Header: Institutional Excellence -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Training & Development</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Courses, Sessions & Compliance Matrices</p>
        </div>
        <div class="flex gap-4">
            <div class="flex items-center gap-6 px-8 py-3 glass-panel rounded-2xl border border-white/5">
                <div class="text-center">
                    <p class="text-[8px] font-black text-emerald-500 uppercase tracking-widest mb-1">Active Courses</p>
                    <p class="text-xl font-black text-emerald-500 leading-none">{{ $courses->count() }}</p>
                </div>
                <div class="w-px h-8 bg-white/10"></div>
                <div class="text-center">
                    <p class="text-[8px] font-black text-indigo-500 uppercase tracking-widest mb-1">Scheduled Sessions</p>
                    <p class="text-xl font-black text-indigo-500 leading-none">{{ $sessions->count() }}</p>
                </div>
            </div>
            <button onclick="document.getElementById('courseModal').classList.remove('hidden')" class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all border border-emerald-500/50">
                Initialize Course
            </button>
        </div>
    </header>

    @if(session('success'))
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-xs font-black uppercase tracking-widest mb-8 animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Courses Matrix -->
        <div class="glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
            <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
                <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Educational Catalog</h3>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-[0.2em]">Institutional Core</span>
            </div>
            <div class="divide-y divide-white/5">
                @foreach($courses as $c)
                <div class="px-10 py-6 flex justify-between items-center group hover:bg-white/5 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-500 border border-emerald-500/20">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <div>
                            <div class="text-sm font-black text-white uppercase group-hover:text-emerald-400 transition-colors">{{ $c->title }}</div>
                            <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">Target: {{ $c->target_role }}</div>
                        </div>
                    </div>
                    @if($c->mandatory)
                        <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 text-[8px] font-black rounded-lg uppercase tracking-widest">Mandatory</span>
                    @endif
                </div>
                @endforeach
                @if($courses->isEmpty())
                    <div class="px-10 py-20 text-center text-slate-600 italic text-[10px] font-black uppercase tracking-widest">No active courses in the catalog.</div>
                @endif
            </div>
        </div>

        <!-- Sessions Timeline -->
        <div class="glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
            <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
                <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Upcoming Sessions</h3>
                <span class="text-[8px] font-black text-slate-500 uppercase tracking-[0.2em]">Live Timeline</span>
            </div>
            <div class="divide-y divide-white/5">
                @foreach($sessions as $s)
                <div class="px-10 py-6 flex items-center gap-6 group hover:bg-white/5 transition-all">
                    <div class="text-center min-w-[60px]">
                        <p class="text-lg font-black text-white leading-none">{{ \Carbon\Carbon::parse($s->session_date)->format('d') }}</p>
                        <p class="text-[8px] font-black text-indigo-500 uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($s->session_date)->format('M') }}</p>
                    </div>
                    <div class="w-px h-10 bg-white/10"></div>
                    <div>
                        <div class="text-sm font-black text-white uppercase">{{ $s->course_title }}</div>
                        <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">{{ $s->venue }} · {{ \Carbon\Carbon::parse($s->session_date)->format('H:i') }}</div>
                    </div>
                </div>
                @endforeach
                @if($sessions->isEmpty())
                    <div class="px-10 py-20 text-center text-slate-600 italic text-[10px] font-black uppercase tracking-widest">No training sessions scheduled.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal: Create Course -->
<div id="courseModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-8 uppercase tracking-tight">Institutional Course Creation</h3>
        <form method="POST" action="{{ url('/admin/training/course') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest">Course Title</label>
                <input name="title" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-emerald-500/50 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest">Target Staff Role</label>
                <input name="target_role" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-emerald-500/50 transition-all" placeholder="e.g. Clinical Staff, Admin, All">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 tracking-widest">Compliance Status</label>
                <select name="mandatory" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
                    <option value="yes">Mandatory Compliance</option>
                    <option value="no">Optional Development</option>
                </select>
            </div>
            <div class="flex gap-4 mt-8">
                <button type="button" onclick="document.getElementById('courseModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-emerald-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-emerald-600/20">Authorize Course</button>
            </div>
        </form>
    </div>
</div>
</x-cc-shell>

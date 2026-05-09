<x-cc-shell title='Opeshis OS'>

@section('title', 'Staff Training & Compliance - Opeshis OS')

<div class="space-y-10 pb-20">
    <!-- Institutional Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Training <span class="text-sage">& Development</span></h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Courses, Sessions & Compliance Matrices</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('courseModal').classList.remove('hidden')"
                class="cc-button-primary flex items-center gap-2">
                <i class="fas fa-plus-circle text-[10px]"></i>
                Initialize Course
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="cc-card p-6 bg-emerald-500/5 border-emerald-500/20 text-emerald-400 text-[11px] font-bold uppercase tracking-widest mb-10 animate-pulse">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Training Telemetry Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <x-cc-stat 
            title="Active Courses" 
            value="{{ $courses->count() }}" 
            icon="fa-book-medical" 
            trend="Live Catalog" 
            color="emerald" 
        />
        <x-cc-stat 
            title="Scheduled" 
            value="{{ $sessions->count() }}" 
            icon="fa-calendar-check" 
            trend="Upcoming" 
            color="indigo" 
        />
        <x-cc-stat 
            title="Compliance" 
            value="92%" 
            icon="fa-award" 
            trend="Staff Certified" 
            color="amber" 
        />
        <x-cc-stat 
            title="Training Hours" 
            value="1.2k" 
            icon="fa-clock-rotate-left" 
            trend="Institutional Log" 
            color="slate" 
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Educational Catalog Matrix -->
        <div class="lg:col-span-6">
            <x-cc-card title="Educational Catalog" icon="fa-database">
                <div class="divide-y divide-white/[0.04]">
                    @forelse($courses as $c)
                        <div class="p-8 group hover:bg-white/[0.01] transition-all flex items-center justify-between">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center text-white/20 border border-white/10 group-hover:border-sage/20 group-hover:text-sage transition-all">
                                    <i class="fas fa-book-open-reader text-lg"></i>
                                </div>
                                <div>
                                    <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $c->title }}</div>
                                    <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">Target: {{ $c->target_role }}</div>
                                </div>
                            </div>
                            @if($c->mandatory)
                                <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 text-[9px] font-bold rounded-lg uppercase tracking-widest">
                                    MANDATORY
                                </span>
                            @endif
                        </div>
                    @empty
                        <div class="p-20 text-center">
                            <i class="fas fa-ghost text-2xl text-white/10 mb-4 block"></i>
                            <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No active courses in the catalog.</p>
                        </div>
                    @endforelse
                </div>
            </x-cc-card>
        </div>

        <!-- Upcoming Sessions Timeline -->
        <div class="lg:col-span-6">
            <x-cc-card title="Upcoming Sessions" icon="fa-calendar-lines-pen">
                <div class="divide-y divide-white/[0.04]">
                    @forelse($sessions as $s)
                        <div class="p-8 group hover:bg-white/[0.01] transition-all flex items-center gap-8">
                            <div class="text-center min-w-[50px]">
                                <p class="text-xl font-extrabold text-white leading-none tracking-tighter">{{ \Carbon\Carbon::parse($s->session_date)->format('d') }}</p>
                                <p class="text-[9px] font-bold text-sage uppercase tracking-widest mt-1">{{ \Carbon\Carbon::parse($s->session_date)->format('M') }}</p>
                            </div>
                            <div class="w-px h-10 bg-white/[0.04]"></div>
                            <div>
                                <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors">{{ $s->course->title ?? 'UNKNOWN_COURSE' }}</div>
                                <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1">
                                    <i class="fas fa-location-dot text-[8px] mr-2"></i>
                                    {{ $s->venue }} · {{ \Carbon\Carbon::parse($s->session_date)->format('H:i') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-20 text-center">
                            <i class="fas fa-clock text-2xl text-white/10 mb-4 block"></i>
                            <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">No training sessions scheduled.</p>
                        </div>
                    @endforelse
                </div>
            </x-cc-card>
        </div>
    </div>
</div>

<!-- Modal: Create Course -->
<x-cc-modal id="courseModal" title="Institutional Course Creation" icon="fa-book-medical">
    <form method="POST" action="{{ route('admin.hr.training.course.store') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Course Title</label>
            <input name="title" required class="cc-input w-full" placeholder="e.g. CLINICAL_PROTOCOL_V2.1">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Target Staff Role</label>
            <input name="target_role" required class="cc-input w-full" placeholder="e.g. CLINICAL_STAFF, ADMIN, ALL">
        </div>
        <div>
            <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Compliance Status</label>
            <select name="mandatory" class="cc-input w-full">
                <option value="yes">MANDATORY COMPLIANCE</option>
                <option value="no">OPTIONAL DEVELOPMENT</option>
            </select>
        </div>
        <div class="pt-4">
            <button type="submit" class="cc-button-primary w-full">Authorize Course Transmission</button>
        </div>
    </form>
</x-cc-modal>
</x-cc-shell>

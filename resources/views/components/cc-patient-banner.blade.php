@props([
    'name',
    'age',
    'gender',
    'medicalId',
    'allergies' => [],
    'status' => 'Stable',
    'vitals' => []
])

<div class="w-full bg-surface-elevated border-b border-white/5 px-8 py-4 flex items-center justify-between sticky top-0 z-40 backdrop-blur-md">
    <!-- Patient Identity -->
    <div class="flex items-center gap-6">
        <div class="h-12 w-12 rounded-full bg-cobalt/20 flex items-center justify-center text-cobalt border border-cobalt/30">
            <i data-lucide="user" class="w-6 h-6"></i>
        </div>
        <div>
            <h2 class="text-lg font-bold text-slate-100 tracking-tight">{{ $name }}</h2>
            <div class="flex items-center gap-3 text-[11px] font-medium uppercase tracking-wider text-slate-500">
                <span>{{ $age }}Y / {{ $gender }}</span>
                <span class="w-1 h-1 rounded-full bg-slate-700"></span>
                <span>ID: {{ $medicalId }}</span>
            </div>
        </div>
    </div>

    <!-- Quick Vitals -->
    <div class="flex items-center gap-8">
        @foreach($vitals as $label => $value)
        <div class="text-center">
            <div class="text-[9px] font-bold uppercase tracking-widest text-slate-500 mb-0.5">{{ $label }}</div>
            <div class="text-sm font-bold text-slate-200">{{ $value }}</div>
        </div>
        @endforeach
    </div>

    <!-- Clinical Status & Allergies -->
    <div class="flex items-center gap-6">
        @if(!empty($allergies))
        <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-rose/10 border border-rose/20 text-rose">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>
            <span class="text-[10px] font-bold uppercase tracking-widest">Allergies: {{ implode(', ', $allergies) }}</span>
        </div>
        @endif

        <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-sage/10 border border-sage/20 text-sage">
            <div class="w-2 h-2 rounded-full bg-sage animate-pulse"></div>
            <span class="text-[10px] font-bold uppercase tracking-widest">{{ $status }}</span>
        </div>
    </div>
</div>

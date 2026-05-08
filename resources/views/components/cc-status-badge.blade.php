@props(['status' => 'pending'])

@php
    $status = strtolower($status);
    $config = [
        'pending' => ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-500', 'ring' => 'ring-amber-500/20', 'icon' => 'fa-clock'],
        'waiting' => ['bg' => 'bg-amber-500/10', 'text' => 'text-amber-500', 'ring' => 'ring-amber-500/20', 'icon' => 'fa-user-clock'],
        'admitted' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-500', 'ring' => 'ring-emerald-500/20', 'icon' => 'fa-bed-pulse'],
        'discharged' => ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-500', 'ring' => 'ring-slate-500/20', 'icon' => 'fa-door-open'],
        'active' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-500', 'ring' => 'ring-blue-500/20', 'icon' => 'fa-activity'],
        'clinical care' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-500', 'ring' => 'ring-blue-500/20', 'icon' => 'fa-stethoscope'],
        'completed' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-500', 'ring' => 'ring-emerald-500/20', 'icon' => 'fa-check-circle'],
        'critical' => ['bg' => 'bg-rose-500/10', 'text' => 'text-rose-500', 'ring' => 'ring-rose-500/20', 'icon' => 'fa-biohazard'],
        'male' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'ring' => 'ring-blue-500/20', 'icon' => 'fa-mars'],
        'female' => ['bg' => 'bg-pink-500/10', 'text' => 'text-pink-400', 'ring' => 'ring-pink-500/20', 'icon' => 'fa-venus'],
    ];

    $style = $config[$status] ?? ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-500', 'ring' => 'ring-slate-500/20', 'icon' => 'fa-info-circle'];
@endphp

<span class="inline-flex items-center gap-1.5 rounded-full {{ $style['bg'] }} px-2.5 py-0.5 text-[9px] font-black {{ $style['text'] }} ring-1 ring-inset {{ $style['ring'] }} uppercase tracking-widest whitespace-nowrap">
    <i class="fas {{ $style['icon'] }} text-[8px]"></i>
    {{ $status }}
</span>

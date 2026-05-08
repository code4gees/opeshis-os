<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['status' => 'pending']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['status' => 'pending']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<span class="inline-flex items-center gap-1.5 rounded-full <?php echo e($style['bg']); ?> px-2.5 py-0.5 text-[9px] font-black <?php echo e($style['text']); ?> ring-1 ring-inset <?php echo e($style['ring']); ?> uppercase tracking-widest whitespace-nowrap">
    <i class="fas <?php echo e($style['icon']); ?> text-[8px]"></i>
    <?php echo e($status); ?>

</span>
<?php /**PATH C:\laragon\www\opeshis\resources\views\components\cc-status-badge.blade.php ENDPATH**/ ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label' => null, 'title' => null, 'value' => '', 'icon' => 'fa-circle-info', 'trend' => null, 'trendUp' => true, 'color' => null]));

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

foreach (array_filter((['label' => null, 'title' => null, 'value' => '', 'icon' => 'fa-circle-info', 'trend' => null, 'trendUp' => true, 'color' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Fallback support for both 'title' and 'label' across legacy and new templates
    $displayLabel = $label ?? $title ?? 'Metric';
?>

<div <?php echo e($attributes->merge(['class' => 'cc-card p-6 relative overflow-hidden group hover:brightness-110 transition-all duration-300'])); ?>>
    <div class="flex items-start justify-between relative z-10">
        <div>
            <p class="text-[10px] font-bold text-white/20 uppercase tracking-[0.2em] mb-3">
                <?php echo e($displayLabel); ?>

            </p>
            <h4 class="text-3xl font-extrabold text-white tracking-tighter">
                <?php echo e($value); ?>

            </h4>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trend): ?>
            <div class="mt-4 flex items-center gap-2 <?php echo e($trendUp ? 'text-sage' : 'text-alert'); ?>">
                <div class="w-5 h-5 rounded-full <?php echo e($trendUp ? 'bg-sage/10' : 'bg-alert/10'); ?> flex items-center justify-center">
                    <i class="fas <?php echo e($trendUp ? 'fa-arrow-up' : 'fa-arrow-down'); ?> text-[8px]"></i>
                </div>
                <span class="text-[11px] font-bold tracking-tight"><?php echo e($trend); ?></span>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="h-12 w-12 rounded-2xl bg-white/5 border border-white/5 flex items-center justify-center text-white/20 group-hover:text-sage group-hover:bg-sage/10 transition-all duration-500">
            <i class="fas <?php echo e($icon); ?> text-lg"></i>
        </div>
    </div>


    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-sage/5 blur-3xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
</div>
<?php /**PATH C:\laragon\www\opeshis\resources\views/components/cc-stat.blade.php ENDPATH**/ ?>
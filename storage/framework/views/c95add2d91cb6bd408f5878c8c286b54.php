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

<div <?php echo e($attributes->merge(['class' => 'bg-card border border-subtle rounded-xl p-5 relative overflow-hidden group hover:bg-[#2a2e38] transition-colors'])); ?>>
    <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-medium text-slate-400 mb-1">
                <?php echo e($displayLabel); ?>

            </p>
            <h4 class="text-2xl font-bold text-white tracking-tight">
                <?php echo e($value); ?>

            </h4>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trend): ?>
            <div class="mt-2 flex items-center space-x-1.5 <?php echo e($trendUp ? 'text-sage' : 'text-alert'); ?>">
                <i class="fas <?php echo e($trendUp ? 'fa-arrow-up' : 'fa-arrow-down'); ?> text-[10px]"></i>
                <span class="text-xs font-medium"><?php echo e($trend); ?></span>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="h-10 w-10 rounded-lg bg-[#16191f] border border-subtle flex items-center justify-center text-slate-400 group-hover:text-sage transition-colors">
            <i class="fas <?php echo e($icon); ?>"></i>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\opeshis\resources\views\components\cc-stat.blade.php ENDPATH**/ ?>
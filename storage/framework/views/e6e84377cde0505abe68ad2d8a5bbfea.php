<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['variant' => 'primary', 'size' => 'md', 'icon' => null]));

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

foreach (array_filter((['variant' => 'primary', 'size' => 'md', 'icon' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $variants = [
        'primary' => 'bg-blue-600 hover:bg-blue-500 text-white shadow-lg shadow-blue-500/20 ring-1 ring-blue-400/20',
        'secondary' => 'bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700/60 shadow-sm',
        'danger' => 'bg-rose-600 hover:bg-rose-500 text-white shadow-lg shadow-rose-500/20 ring-1 ring-rose-400/20',
        'ghost' => 'bg-transparent hover:bg-white/5 text-slate-400 hover:text-slate-200',
    ];
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    $classes = "inline-flex items-center justify-center font-semibold rounded-lg transition-all duration-200 active:scale-95 disabled:opacity-50 disabled:pointer-events-none " . ($variants[$variant] ?? $variants['primary']) . " " . ($sizes[$size] ?? $sizes['md']);
?>

<button <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
        <i class="fas <?php echo e($icon); ?> <?php echo e($slot->isEmpty() ? '' : 'mr-2'); ?>"></i>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo e($slot); ?>

</button>
<?php /**PATH C:\laragon\www\opeshis\resources\views/components/cc-button.blade.php ENDPATH**/ ?>
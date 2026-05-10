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
        'primary' => 'bg-cobalt hover:bg-cobalt/90 text-white shadow-[0_0_15px_rgba(27,95,168,0.2)]',
        'secondary' => 'bg-surface-elevated hover:bg-surface-overlay text-slate-200 border border-white/5',
        'danger' => 'bg-rose hover:bg-rose/90 text-white shadow-[0_0_15px_rgba(225,29,72,0.2)]',
        'ghost' => 'bg-transparent hover:bg-white/5 text-slate-400 hover:text-slate-200',
    ];
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    $classes = "inline-flex items-center justify-center font-semibold rounded-xl transition-all duration-200 active:scale-95 disabled:opacity-50 disabled:pointer-events-none " . ($variants[$variant] ?? $variants['primary']) . " " . ($sizes[$size] ?? $sizes['md']);
?>

<button <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
        <i data-lucide="<?php echo e($icon); ?>" class="<?php echo e($slot->isEmpty() ? '' : 'mr-2'); ?> w-4 h-4"></i>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo e($slot); ?>

</button>
<?php /**PATH /app/resources/views/components/cc-button.blade.php ENDPATH**/ ?>
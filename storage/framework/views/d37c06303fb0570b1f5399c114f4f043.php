<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label' => null, 'name' => null, 'type' => 'text', 'placeholder' => '', 'value' => '', 'icon' => null]));

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

foreach (array_filter((['label' => null, 'name' => null, 'type' => 'text', 'placeholder' => '', 'value' => '', 'icon' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="space-y-2">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label): ?>
    <label for="<?php echo e($name); ?>" class="block text-[10px] font-black uppercase tracking-widest text-slate-500 ml-1">
        <?php echo e($label); ?>

    </label>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <div class="relative group">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-sage transition-colors">
            <i class="fas <?php echo e($icon); ?> text-xs"></i>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
        <input 
            type="<?php echo e($type); ?>" 
            name="<?php echo e($name); ?>" 
            id="<?php echo e($name); ?>" 
            placeholder="<?php echo e($placeholder); ?>" 
            value="<?php echo e($value); ?>"
            <?php echo e($attributes->merge(['class' => ($icon ? 'pl-11' : 'px-4') . ' w-full bg-card/50 border border-subtle rounded-xl py-3 text-xs font-bold text-white placeholder-slate-600 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all '])); ?>

        >
    </div>
</div>
<?php /**PATH C:\laragon\www\opeshis\resources\views\components\cc-input.blade.php ENDPATH**/ ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['id', 'title', 'icon' => null, 'maxWidth' => 'xl']));

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

foreach (array_filter((['id', 'title', 'icon' => null, 'maxWidth' => 'xl']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div id="<?php echo e($id); ?>" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-md transition-opacity"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden cc-card shadow-2xl text-left transition-all sm:my-8 sm:w-full
            <?php echo e($maxWidth === 'sm' ? 'sm:max-w-sm' : ($maxWidth === 'md' ? 'sm:max-w-md' : ($maxWidth === 'lg' ? 'sm:max-w-lg' : 'sm:max-w-xl'))); ?>">

            <!-- Header -->
            <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
                <div class="flex items-center gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
                        <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center text-sage">
                            <i class="fas <?php echo e($icon); ?> text-[14px]"></i>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]" id="modal-title"><?php echo e($title); ?></h3>
                </div>
                <button type="button" onclick="document.getElementById('<?php echo e($id); ?>').classList.add('hidden')"
                    class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                    <i class="fas fa-times text-[10px]"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-8">
                <?php echo e($slot); ?>

            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($footer)): ?>
                <!-- Footer -->
                <div class="px-8 py-6 border-t border-white/[0.04] flex flex-row-reverse gap-4 bg-white/[0.01]">
                    <?php echo e($footer); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /app/resources/views/components/cc-modal.blade.php ENDPATH**/ ?>
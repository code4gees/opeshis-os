<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title' => null, 'icon' => null, 'subtitle' => null, 'badge' => null, 'badgeType' => 'pending']));

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

foreach (array_filter((['title' => null, 'icon' => null, 'subtitle' => null, 'badge' => null, 'badgeType' => 'pending']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'group relative overflow-hidden rounded-2xl border border-subtle bg-card/40 p-6  transition-all hover:border-indigo-500/30 hover:bg-card'])); ?>>
    <!-- Ambient Glow -->
    <div class="absolute -right-20 -top-20 h-40 w-40 rounded-full bg-sage/5 blur-[100px] transition-all group-hover:bg-sage/10"></div>
    
    <div class="relative flex flex-col gap-4">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sage/10 text-sage ring-1 ring-inset ring-indigo-500/20">
                    <i class="fas <?php echo e($icon); ?> text-lg"></i>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($title): ?>
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-200">
                        <?php echo e($title); ?>

                    </h3>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($subtitle): ?>
                    <p class="text-[10px] font-medium text-slate-500">
                        <?php echo e($subtitle); ?>

                    </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($badge): ?>
            <?php if (isset($component)) { $__componentOriginalf7ec67cd6d241131934443aa31c73ca0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf7ec67cd6d241131934443aa31c73ca0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-status-badge','data' => ['status' => $badge]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($badge)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf7ec67cd6d241131934443aa31c73ca0)): ?>
<?php $attributes = $__attributesOriginalf7ec67cd6d241131934443aa31c73ca0; ?>
<?php unset($__attributesOriginalf7ec67cd6d241131934443aa31c73ca0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf7ec67cd6d241131934443aa31c73ca0)): ?>
<?php $component = $__componentOriginalf7ec67cd6d241131934443aa31c73ca0; ?>
<?php unset($__componentOriginalf7ec67cd6d241131934443aa31c73ca0); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mt-2">
            <?php echo e($slot); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\opeshis\resources\views\components\clinical-card.blade.php ENDPATH**/ ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'value', 'icon', 'trend' => null, 'trendUp' => true, 'color' => 'blue']));

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

foreach (array_filter((['label', 'value', 'icon', 'trend' => null, 'trendUp' => true, 'color' => 'blue']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $colors = [
        'blue' => 'from-blue-500/20 to-indigo-500/5 text-blue-400 border-blue-500/20',
        'emerald' => 'from-emerald-500/20 to-teal-500/5 text-emerald-400 border-emerald-500/20',
        'rose' => 'from-rose-500/20 to-pink-500/5 text-rose-400 border-rose-500/20',
        'amber' => 'from-amber-500/20 to-orange-500/5 text-amber-400 border-amber-500/20',
        'violet' => 'from-violet-500/20 to-purple-500/5 text-violet-400 border-violet-500/20',
    ];
    $currentColor = $colors[$color] ?? $colors['blue'];
?>

<div <?php echo e($attributes->merge(['class' => 'cc-stat group relative overflow-hidden rounded-2xl border border-white/5 bg-slate-900/40 p-6 backdrop-blur-xl transition-all duration-300 hover:scale-[1.02] hover:border-white/10'])); ?>>
    <div class="flex items-start justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-slate-500 transition-colors group-hover:text-slate-400">
                <?php echo e($label); ?>

            </p>
            <h4 class="mt-2 text-3xl font-black tracking-tight text-white">
                <?php echo e($value); ?>

            </h4>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trend): ?>
            <div class="mt-2 flex items-center space-x-1 <?php echo e($trendUp ? 'text-emerald-400' : 'text-rose-400'); ?>">
                <i class="fas <?php echo e($trendUp ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down'); ?> text-[10px]"></i>
                <span class="text-[10px] font-bold"><?php echo e($trend); ?></span>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br <?php echo e($currentColor); ?> shadow-lg shadow-black/20 ring-1">
            <i class="fas <?php echo e($icon); ?> text-xl"></i>
        </div>
    </div>
    
    <!-- Micro-Chart placeholder effect -->
    <div class="mt-4 h-1 w-full overflow-hidden rounded-full bg-white/5">
        <div class="h-full bg-gradient-to-r <?php echo e($currentColor); ?> opacity-50" style="width: 70%"></div>
    </div>
</div>
<?php /**PATH C:\laragon\www\opeshis\resources\views\components\cc-stat.blade.php ENDPATH**/ ?>
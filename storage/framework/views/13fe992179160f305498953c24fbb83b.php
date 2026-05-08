<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php $__env->startSection('title', 'PRIVACY - Opeshis OS'); ?>

<div class="py-24 glass-panel">
    <div class="max-w-4xl mx-auto px-8">
        <h1 class="text-5xl font-black text-white mb-12 uppercase tracking-tighter">PRIVACY</h1>
        <div class="prose prose-slate max-w-none font-medium text-slate-300 leading-relaxed space-y-8">
            <p class="text-xl">Opeshis OS is committed to the highest standards of institutional integrity. This PRIVACY page outlines our framework for universal healthcare delivery.</p>
            <section>
                <h2 class="text-2xl font-black text-white uppercase mb-4 tracking-tight">Institutional Framework</h2>
                <p>As a decentralized health operating system, we prioritize data sovereignty and clinical excellence. All operations are governed by the Opeshis Institutional Protocol.</p>
            </section>
            <div class="bg-white/5 p-12 rounded-[2.5rem] border border-white/10">
                <p class="italic">This is a standardized institutional document. For specific inquiries, contact the Opeshis OS Governance Board.</p>
            </div>
        </div>
    </div>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5f9e428c85f73cee41ce4c693f314c57)): ?>
<?php $attributes = $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57; ?>
<?php unset($__attributesOriginal5f9e428c85f73cee41ce4c693f314c57); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f9e428c85f73cee41ce4c693f314c57)): ?>
<?php $component = $__componentOriginal5f9e428c85f73cee41ce4c693f314c57; ?>
<?php unset($__componentOriginal5f9e428c85f73cee41ce4c693f314c57); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\opeshis\resources\views\public\privacy.blade.php ENDPATH**/ ?>
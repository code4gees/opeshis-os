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


<?php $__env->startSection('title', 'Informed Consent Hub — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Bioethics & Consent Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Medical Consent</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Informed Consent · Bioethics Compliance · Digital Signature Matrix</p>
        </div>
        <div class="flex gap-4">
            <button class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Authorize Consent Protocol
            </button>
        </div>
    </header>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            Consent protocol synchronized successfully.
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Live Consent Matrix -->
        <div class="lg:col-span-8 glass-panel rounded-[3rem] border border-white/10 shadow-xl overflow-hidden bg-white/[0.02] p-20 text-center flex flex-col items-center justify-center">
            <div class="w-24 h-24 bg-white/5 rounded-[2.5rem] flex items-center justify-center mb-10 border border-white/10 shadow-inner group hover:bg-indigo-500/20 hover:border-indigo-500/30 transition-all duration-700">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-slate-500 group-hover:text-indigo-400 transition-colors"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-4 italic">Bioethics Matrix Active</h3>
            <p class="text-slate-500 text-[11px] max-w-sm mx-auto font-black uppercase tracking-[0.2em] leading-relaxed italic">The institutional informed consent and bioethics module is operational. Real-time digital signatures and authorization telemetry will populate the matrix as protocols are executed.</p>
        </div>

        <!-- Ethics Telemetry Sidebar -->
        <div class="lg:col-span-4 space-y-8">
            <div class="glass-panel rounded-[3rem] p-10 border border-white/10 shadow-xl bg-slate-900 relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-10 italic">Bioethics Integrity Pulse</h3>
                    <div class="flex items-end gap-3 mb-10">
                        <span class="text-6xl font-black text-white italic tracking-tighter leading-none">100</span>
                        <span class="text-xl font-black text-indigo-500 opacity-60 mb-1 uppercase">%</span>
                    </div>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center">
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">Compliance Vector:</span>
                            <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Optimized</span>
                        </div>
                        <div class="w-full bg-white/5 h-2 rounded-full overflow-hidden shadow-inner">
                            <div class="bg-gradient-to-r from-indigo-600 to-indigo-400 h-full w-full shadow-[0_0_10px_rgba(99,102,241,0.5)]"></div>
                        </div>
                    </div>
                </div>
                <!-- Decorative background -->
                <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl"></div>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\consent.blade.php ENDPATH**/ ?>
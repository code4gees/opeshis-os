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


<?php $__env->startSection('title', 'Narcotics Audit Intelligence — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: Narcotics Report Command -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Narcotics Audit</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Controlled Substance Surveillance · Regulatory Compliance Matrix · Audit Ledger Hub</p>
 </div>
 <div class="flex gap-4">
 <button class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Generate Regulatory Export
 </button>
 </div>
 </header>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[12px] font-semibold font-medium mb-8 animate-pulse ">
 Narcotics audit protocol synchronized successfully.
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <!-- Audit Workspace Matrix -->
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden bg-card p-24 text-center relative">
 <div class="relative z-10">
 <div class="w-24 h-24 bg-[#2a2e38] rounded-[2rem] flex items-center justify-center mx-auto mb-8 border border-subtle ">
 <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-sage"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
 </div>
 <h3 class="text-2xl font-semibold text-white uppercase mb-4 tracking-tighter ">Narcotics Audit Matrix: Online</h3>
 <p class="text-slate-500 text-sm max-w-lg mx-auto font-semibold font-medium leading-relaxed">
 The Narcotics Audit Intelligence Hub is fully synchronized with the institutional regulatory core. Real-time consumption telemetry and specialized compliance logs will populate as clinical sessions are authorized.
 </p>
 <div class="mt-12 flex justify-center gap-6">
 <div class="px-6 py-3 bg-[#2a2e38] border border-subtle rounded-2xl">
 <p class="text-[12px] font-semibold text-sage font-medium mb-1 ">Compliance Status</p>
 <p class="text-xs font-semibold text-white uppercase ">NOMINAL_SYNC</p>
 </div>
 <div class="px-6 py-3 bg-[#2a2e38] border border-subtle rounded-2xl">
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-1 ">Regulatory ID</p>
 <p class="text-xs font-semibold text-white uppercase ">NARCO_AUDIT_V2</p>
 </div>
 </div>
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-sage/5 rounded-full blur-3xl"></div>
 <div class="absolute -left-20 -top-20 w-64 h-64 bg-sage/5 rounded-full blur-3xl"></div>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\narcotics_report.blade.php ENDPATH**/ ?>
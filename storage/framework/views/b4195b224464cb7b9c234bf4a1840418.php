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


<?php $__env->startSection('title', 'Institutional Payment Matrix — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: Fiscal Payment Command -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Payment Command</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Revenue Stream · Transaction Surveillance · Fiscal Settlement Hub</p>
 </div>
 <div class="flex gap-4">
 <button class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Authorize Bulk Settlement
 </button>
 </div>
 </header>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[12px] font-semibold font-medium mb-8 animate-pulse ">
 Fiscal payment protocol synchronized successfully.
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
 <!-- Live Payment Matrix -->
 <div class="lg:col-span-8 bg-card rounded-[3rem] border border-subtle overflow-hidden bg-card p-20 text-center flex flex-col items-center justify-center">
 <div class="w-24 h-24 bg-[#2a2e38] rounded-[2.5rem] flex items-center justify-center mb-10 border border-subtle group hover:bg-sage/20 hover:border-indigo-500/30 transition-all duration-700">
 <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-slate-500 group-hover:text-sage transition-colors"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
 </div>
 <h3 class="text-2xl font-semibold text-white uppercase tracking-tighter mb-4 ">Payment Stream Active</h3>
 <p class="text-slate-500 text-[12px] max-w-sm mx-auto font-semibold font-medium leading-relaxed ">The institutional payment and revenue surveillance module is operational. Real-time transaction telemetry will populate the matrix as settlements occur.</p>
 </div>

 <!-- Revenue Telemetry Sidebar -->
 <div class="lg:col-span-4 space-y-8">
 <div class="bg-card rounded-[3rem] p-10 border border-subtle bg-card relative overflow-hidden">
 <div class="relative z-10">
 <h3 class="text-[12px] font-semibold text-sage font-medium mb-10 ">Fiscal Revenue Pulse</h3>
 <div class="flex items-end gap-3 mb-10">
 <span class="text-6xl font-semibold text-white tracking-tighter leading-none">100</span>
 <span class="text-xl font-semibold text-sage opacity-60 mb-1 uppercase">%</span>
 </div>
 <div class="space-y-6">
 <div class="flex justify-between items-center">
 <span class="text-[12px] font-semibold text-slate-500 font-medium ">Collection Velocity:</span>
 <span class="text-[12px] font-semibold text-emerald-500 font-medium">Optimized</span>
 </div>
 <div class="w-full bg-[#2a2e38] h-2 rounded-full overflow-hidden ">
 <div class="bg-gradient-to-r from-indigo-600 to-indigo-400 h-full w-full shadow-[0_0_10px_rgba(99,102,241,0.5)]"></div>
 </div>
 </div>
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-sage/5 rounded-full blur-3xl"></div>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\billing\payments.blade.php ENDPATH**/ ?>
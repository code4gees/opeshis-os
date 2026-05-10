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


<?php $__env->startSection('title', 'Institutional Performance - Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in">
 <!-- Header: Performance & Compliance Command -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Performance & Talent</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Review Cycles, Staff Assessments & Merit Matrices</p>
 </div>
 <div class="flex gap-4">
 <div class="flex items-center gap-6 px-8 py-3 bg-card rounded-2xl border border-subtle">
 <div class="text-center">
 <p class="text-[8px] font-semibold text-emerald-500 font-medium mb-1">Active Cycles</p>
 <p class="text-xl font-semibold text-emerald-500 leading-none"><?php echo e($stats->active); ?></p>
 </div>
 <div class="w-px h-8 bg-white/10"></div>
 <div class="text-center">
 <p class="text-[8px] font-semibold text-sage font-medium mb-1">Total Cycles</p>
 <p class="text-xl font-semibold text-sage leading-none"><?php echo e($stats->total); ?></p>
 </div>
 </div>
 <button onclick="document.getElementById('cycleModal').classList.remove('hidden')" class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Initialize Review Cycle
 </button>
 </div>
 </header>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-xs font-semibold font-medium mb-8 animate-pulse">
 <?php echo e(session('success')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
 <!-- Performance Cycles -->
 <div class="lg:col-span-5 space-y-8">
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Review Frameworks</h3>
 </div>
 <div class="divide-y divide-white/5">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cycles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cycle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="px-10 py-6 group hover:bg-[#2a2e38] transition-all">
 <div class="flex justify-between items-start mb-2">
 <h4 class="text-sm font-semibold text-white uppercase"><?php echo e($cycle->name); ?></h4>
 <span class="px-2 py-0.5 <?php echo e($cycle->status === 'active' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-[#2a2e38] text-slate-500 border-subtle'); ?> rounded text-[8px] font-semibold uppercase border tracking-wider">
 <?php echo e($cycle->status); ?>

 </span>
 </div>
 <p class="text-[12px] font-bold text-slate-500 font-medium">
 Timeline: <?php echo e(\Carbon\Carbon::parse($cycle->start_date)->format('M Y')); ?> — <?php echo e(\Carbon\Carbon::parse($cycle->end_date)->format('M Y')); ?>

 </p>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cycles->isEmpty()): ?>
 <div class="px-10 py-20 text-center text-slate-600 text-[12px] font-semibold font-medium">No performance cycles initialized.</div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>
 </div>

 <!-- Recent Reviews Feed -->
 <div class="lg:col-span-7 space-y-8">
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Live Review Matrix</h3>
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 rounded-lg text-[8px] font-semibold font-medium border border-subtle">Compliance: 88%</span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Staff Member</th>
 <th class="px-6 py-6 text-center">Merit Rating</th>
 <th class="px-6 py-6">Review Status</th>
 <th class="px-10 py-6 text-right">Strategic Action</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-[#2a2e38] transition-all group">
 <td class="px-10 py-6">
 <div class="font-semibold text-white text-sm uppercase group-hover:text-sage transition-colors"><?php echo e($r->staff_name); ?></div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-0.5"><?php echo e($r->role); ?></div>
 </td>
 <td class="px-6 py-6 text-center">
 <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-sage/10 text-sage rounded-lg border border-indigo-500/20">
 <span class="text-xs font-semibold"><?php echo e($r->overall_rating); ?></span>
 <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor" class="text-sage"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
 </div>
 </td>
 <td class="px-6 py-6">
 <span class="text-[12px] font-semibold <?php echo e($r->status === 'signed' ? 'text-emerald-500' : 'text-amber-500'); ?> font-medium">
 <?php echo e(str_replace('_',' ', $r->status)); ?>

 </span>
 </td>
 <td class="px-10 py-6 text-right">
 <button class="px-4 py-2 bg-[#2a2e38] text-slate-300 rounded-lg text-[12px] font-semibold font-medium hover:bg-white/10 transition">View Dossier</button>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($reviews->isEmpty()): ?>
 <tr>
 <td colspan="4" class="px-10 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6M23 11h-6"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No performance reviews recorded in the active cycle.</p>
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
 </div>
 </div>
</div>

<!-- Modal: New Cycle -->
<div id="cycleModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-8 uppercase tracking-tight">Initialize Review Framework</h3>
 <form method="POST" action="<?php echo e(url('/admin/performance/cycle')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2 tracking-wider">Cycle Nomenclature</label>
 <input name="name" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all" placeholder="e.g. FY2026 Q1 Appraisal">
 </div>
 <div class="grid grid-cols-2 gap-6">
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2 tracking-wider">Start Matrix Date</label>
 <input name="start_date" type="date" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2 tracking-wider">End Matrix Date</label>
 <input name="end_date" type="date" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
 </div>
 </div>
 <div class="flex gap-4 mt-8">
 <button type="button" onclick="document.getElementById('cycleModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium">Cancel</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-[12px] font-semibold font-medium /20">Authorize Cycle</button>
 </div>
 </form>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\admin\performance.blade.php ENDPATH**/ ?>
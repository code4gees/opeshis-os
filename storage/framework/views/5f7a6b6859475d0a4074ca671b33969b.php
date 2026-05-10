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


<?php $__env->startSection('title', 'Pediatrics & NICU - Opeshis OS'); ?>


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">

 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-card border border-subtle rounded-xl p-6 ">
 <div>
 <h1 class="text-2xl font-bold text-white tracking-tight">Pediatrics & NICU</h1>
 <p class="text-sm text-slate-400 mt-1">Specialized care and monitoring for neonates and pediatric patients.</p>
 </div>
 <div class="mt-4 md:mt-0 flex items-center gap-4">
 <div class="flex items-center gap-6 px-6 py-2.5 bg-card/40 rounded-lg border border-subtle">
 <div class="text-center">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-1">Active Census</p>
 <p class="text-lg font-bold text-white leading-none"><?php echo e($registry->count()); ?></p>
 </div>
 <div class="w-px h-8 bg-slate-700"></div>
 <div class="text-center">
 <p class="text-[12px] font-bold text-emerald-500 font-medium mb-1">Unit Status</p>
 <p class="text-lg font-bold text-emerald-500 leading-none">Optimal</p>
 </div>
 </div>
 <button onclick="document.getElementById('enrollModal').classList.remove('hidden')" class="px-5 py-2.5 bg-sage hover:bg-sage text-white text-sm font-bold rounded-lg transition-all /20">
 Admit Patient
 </button>
 </div>
 </header>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-sm font-medium">
 <?php echo e(session('success')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 <!-- NICU Capacity -->
 <div class="lg:col-span-1 bg-[#2a2e38] p-8 rounded-xl border border-subtle relative overflow-hidden flex flex-col justify-center">
 <div class="flex justify-between items-start mb-6">
 <div>
 <p class="text-[12px] font-bold text-sage font-medium mb-2">NICU Bed Occupancy</p>
 <h3 class="text-3xl font-bold text-white tracking-tight">
 <?php echo e($nicuStatus['occupied']); ?> <span class="text-lg text-slate-500">/ <?php echo e($nicuStatus['total_beds']); ?></span>
 </h3>
 </div>
 <div class="w-10 h-10 bg-sage/10 rounded-lg flex items-center justify-center text-sage border border-blue-500/20">
 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
 </div>
 </div>
 <?php $nicuRate = ($nicuStatus['occupied'] / $nicuStatus['total_beds']) * 100; ?>
 <div class="w-full bg-card h-2 rounded-full overflow-hidden mb-4">
 <div class="bg-sage h-full rounded-full" style="width: <?php echo e($nicuRate); ?>%"></div>
 </div>
 <p class="text-[12px] font-bold text-slate-500 font-medium">Current Load: <?php echo e(round($nicuRate)); ?>%</p>
 </div>

 <!-- Performance KPIs -->
 <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle flex flex-col justify-center">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-2">Neonatal Mortality</p>
 <h3 class="text-2xl font-bold text-white tracking-tight">0.08%</h3>
 <p class="text-[12px] font-bold text-emerald-500 font-medium mt-2">Status: Excellent</p>
 </div>
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle flex flex-col justify-center">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-2">Growth Compliance</p>
 <h3 class="text-2xl font-bold text-sage tracking-tight">98.5%</h3>
 <p class="text-[12px] font-bold text-sage/60 font-medium mt-2">Active Monitoring</p>
 </div>
 <div class="bg-[#2a2e38] p-6 rounded-xl border border-subtle flex flex-col justify-center">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-2">Unit Stability</p>
 <div class="flex items-center gap-2">
 <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_6px_rgba(16,185,129,0.5)]"></div>
 <span class="text-lg font-bold text-white uppercase tracking-tight">Stable</span>
 </div>
 </div>
 </div>

 <!-- Patient Registry -->
 <div class="lg:col-span-3 bg-[#2a2e38] rounded-xl border border-subtle overflow-hidden">
 <div class="px-8 py-5 border-b border-subtle bg-card/40">
 <h3 class="text-sm font-bold text-slate-200">Institutional Pediatric Patient Registry</h3>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left text-sm">
 <thead>
 <tr class="text-slate-500 border-b border-subtle">
 <th class="px-8 py-5 font-semibold uppercase text-[12px] tracking-wider">Patient Details</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px] tracking-wider text-center">Unit Location</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px] tracking-wider text-center">Birth Weight</th>
 <th class="px-6 py-5 font-semibold uppercase text-[12px] tracking-wider text-center">Growth Progress</th>
 <th class="px-8 py-5 text-right uppercase text-[12px] tracking-wider">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-700/40">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $registry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-slate-700/30 transition-colors">
 <td class="px-8 py-6">
 <div class="flex items-center gap-4">
 <div class="w-10 h-10 bg-sage/10 rounded-lg flex items-center justify-center font-bold text-sage text-xs border border-blue-500/20">
 <?php echo e(substr($r->full_name, 0, 1)); ?>

 </div>
 <div>
 <div class="font-bold text-white uppercase text-xs"><?php echo e($r->full_name); ?></div>
 <div class="text-[12px] text-slate-500 font-bold font-medium mt-0.5"><?php echo e($r->medical_id); ?> • <?php echo e($r->gender); ?></div>
 </div>
 </div>
 </td>
 <td class="px-6 py-6 text-center">
 <span class="px-2 py-0.5 bg-card border border-slate-700 text-slate-400 rounded text-[12px] font-bold font-medium">
 <?php echo e($r->unit); ?>

 </span>
 </td>
 <td class="px-6 py-6 text-center">
 <div class="text-xs font-bold text-slate-200"><?php echo e($r->birth_weight ?? '—'); ?></div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-1">KG</div>
 </td>
 <td class="px-6 py-6 text-center">
 <div class="flex items-center justify-center gap-2">
 <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
 <span class="text-[12px] font-bold text-slate-300 font-medium">Normal</span>
 </div>
 </td>
 <td class="px-8 py-6 text-right">
 <button class="px-3 py-1.5 bg-sage/10 text-sage border border-blue-500/20 rounded text-[12px] font-bold uppercase hover:bg-sage hover:text-white transition-all">
 View Growth Chart
 </button>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="5" class="px-8 py-20 text-center text-slate-500 text-sm">No pediatric patients currently registered.</td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
 </div>
</div>

<!-- Modal: New Admission -->
<div id="enrollModal" class="fixed inset-0 bg-card/80 z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-[#2a2e38] w-full max-w-xl rounded-xl p-8 border border-subtle">
 <h3 class="text-xl font-bold text-white mb-8 uppercase flex items-center gap-3">
 <div class="w-2 h-2 bg-sage rounded-full animate-pulse"></div>
 Pediatric Unit Admission
 </h3>
 <form method="POST" action="<?php echo e(route('paeds.enroll')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Patient Medical ID</label>
 <input type="text" name="patient_id" required placeholder="Enter Patient ID..." class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-6">
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Target Unit</label>
 <select name="unit" class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 <option>General Pediatrics</option>
 <option>NICU</option>
 <option>Pediatric Surgery</option>
 <option>OPD Pediatrics</option>
 </select>
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Birth Weight (KG)</label>
 <input type="number" name="birth_weight" step="0.01" placeholder="0.00" class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 </div>
 <div class="flex gap-4 mt-8 pt-6 border-t border-subtle">
 <button type="button" onclick="document.getElementById('enrollModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-3 bg-sage hover:bg-sage text-white rounded-lg text-sm font-bold transition-all /20">Admit Patient</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\paeds\index.blade.php ENDPATH**/ ?>
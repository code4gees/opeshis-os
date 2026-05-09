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

<?php $__env->startSection('title', 'CSSD Ops — Opeshis OS'); ?>

<div class="space-y-8 animate-fade-in">

 
 <div class="flex justify-between items-start border-b border-subtle pb-8">
 <div>
 <h2 class="text-2xl font-semibold uppercase text-white tracking-tight">CSSD & Sterile Logistics</h2>
 <p class="text-[12px] font-bold text-slate-400 font-medium mt-1">Sterilization Load Tracking · Biological Indicators · Sterile Storage</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('loadModal').classList.remove('hidden')" class="px-6 py-3 bg-sage text-white rounded-xl font-bold text-xs hover:bg-indigo-700 transition-all">
 + Start Sterilization Load
 </button>
 </div>
 </div>

 
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
 ['Today\'s Loads', $loadStats->total ?? 0, 'indigo'],
 ['Passed Cycles', $loadStats->passed ?? 0, 'emerald'],
 ['Failed / Quarantined', $loadStats->failed ?? 0, 'rose'],
 ['Expiring Sterile Stock', $expiringCount, 'amber']
 ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $val, $color]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="bg-card rounded-3xl border border-subtle shadow-lg px-8 py-6">
 <p class="text-[12px] font-semibold text-slate-400 font-medium mb-2"><?php echo e($label); ?></p>
 <p class="text-3xl font-semibold text-<?php echo e($color); ?>-600"><?php echo e($val); ?></p>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>

 
 <div class="bg-card rounded-[2.5rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-6 border-b border-subtle bg-slate-50/30">
 <h3 class="text-xs font-semibold text-white font-medium">Active Sterilization Cycles</h3>
 </div>
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-4">Load Number</th>
 <th class="py-4">Sterilizer / Modality</th>
 <th class="py-4">Method</th>
 <th class="py-4">Status</th>
 <th class="py-4">Expiry Date</th>
 <th class="py-4 text-right px-10">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-50">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $todayLoads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-slate-50/60 transition group">
 <td class="px-10 py-5">
 <p class="text-sm font-semibold text-white"><?php echo e($l->load_number); ?></p>
 <p class="text-[12px] text-slate-400 font-bold font-medium"><?php echo e(date('H:i', strtotime($l->created_at))); ?> HRS</p>
 </td>
 <td class="py-5">
 <p class="text-xs font-semibold text-slate-700 uppercase"><?php echo e($l->sterilizer_name); ?></p>
 </td>
 <td class="py-5">
 <span class="px-2 py-1 bg-white/10 rounded-lg text-[12px] font-semibold text-slate-500 uppercase"><?php echo e($l->sterilization_method); ?></span>
 </td>
 <td class="py-5">
 <span class="px-2 py-1 rounded-full text-[12px] font-semibold font-medium
 <?php echo e($l->load_status === 'passed' ? 'bg-emerald-100 text-emerald-700' : ($l->load_status === 'in_progress' ? 'bg-indigo-100 text-indigo-700 animate-pulse' : 'bg-rose-100 text-rose-700')); ?>">
 <?php echo e(str_replace('_',' ',$l->load_status)); ?>

 </span>
 </td>
 <td class="py-5 text-xs font-bold text-slate-400"><?php echo e($l->expiry_date ?: 'TBD'); ?></td>
 <td class="px-10 py-5 text-right">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($l->load_status === 'in_progress'): ?>
 <button class="text-[12px] font-semibold text-sage hover:underline uppercase">Verify Load</button>
 <?php else: ?>
 <button class="text-[12px] font-semibold text-slate-300 uppercase cursor-not-allowed">Archived</button>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr><td colspan="6" class="p-20 text-center text-slate-300 text-sm">No sterilization loads recorded today.</td></tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>

</div>


<div id="loadModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[2.5rem] p-12 ">
 <h3 class="text-xl font-semibold text-white mb-8 uppercase">Initiate Sterilization Cycle</h3>
 <form method="POST" action="<?php echo e(url('/clinical/cssd/start')); ?>" class="space-y-5">
 <?php echo csrf_field(); ?>
 <div><label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Select Sterilizer</label>
 <select name="sterilizer_id" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-5 py-4 text-sm font-bold outline-none">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sterilizers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <option value="<?php echo e($s->id); ?>"><?php echo e($s->sterilizer_name); ?></option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </select>
 </div>
 <div><label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Sterilization Method</label>
 <select name="method" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-5 py-4 text-sm font-bold outline-none">
 <option value="Steam Autoclave (134°C)">Steam Autoclave (134°C)</option>
 <option value="Hydrogen Peroxide Plasma">Hydrogen Peroxide Plasma</option>
 <option value="Ethylene Oxide (ETO)">Ethylene Oxide (ETO)</option>
 <option value="Dry Heat">Dry Heat</option>
 </select>
 </div>
 <div class="flex gap-4 mt-8">
 <button type="button" onclick="document.getElementById('loadModal').classList.add('hidden')" class="flex-1 py-4 bg-white/10 text-slate-400 rounded-2xl text-xs font-semibold uppercase">Cancel</button>
 <button type="submit" class="flex-1 py-4 bg-sage text-white rounded-2xl text-xs font-semibold uppercase ">Start Cycle</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\cssd.blade.php ENDPATH**/ ?>
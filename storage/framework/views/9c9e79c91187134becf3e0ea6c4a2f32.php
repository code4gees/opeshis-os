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


<?php $__env->startSection('title', 'Asset Register & Maintenance Telemetry - Opeshis OS'); ?>


<div class="space-y-6 animate-fade-in">
 <div class="flex justify-between items-center mb-8 border-b border-subtle pb-8">
 <div>
 <h2 class="text-2xl font-semibold uppercase text-white tracking-tight">Institutional Asset Register</h2>
 <p class="text-[12px] font-bold text-slate-400 font-medium mt-1">Lifecycle Tracking & Service Alerts</p>
 </div>
 <div class="flex items-center gap-8">
 <div class="text-right">
 <label class="text-[12px] font-semibold text-rose-500 font-medium block mb-1">Service Required</label>
 <span class="text-2xl font-semibold text-rose-600"><?php echo e($maintenanceAlerts); ?> Assets</span>
 </div>
 </div>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold mb-6"><?php echo e(session('success')); ?></div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <div class="bg-card rounded-[2.5rem] shadow-lg border border-subtle overflow-hidden">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Asset / ID</th>
 <th>Category</th>
 <th>Purchase Date</th>
 <th>Last Service</th>
 <th>Next Service</th>
 <th class="text-right px-10">Status</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-50">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <?php
 $isDue = !empty($a->next_maintenance_date) && strtotime($a->next_maintenance_date) <= strtotime('+14 days');
 ?>
 <tr class="hover:bg-slate-50/50 transition">
 <td class="px-10 py-6">
 <div class="text-sm font-semibold text-white"><?php echo e($a->name); ?></div>
 <div class="text-[12px] text-slate-400 font-mono uppercase mt-1">S/N: <?php echo e($a->serial_number); ?></div>
 </td>
 <td class="text-[12px] font-semibold text-sage uppercase"><?php echo e($a->category); ?></td>
 <td class="text-[12px] font-mono text-slate-400"><?php echo e($a->purchase_date ?: '—'); ?></td>
 <td class="text-[12px] font-mono text-slate-400"><?php echo e($a->last_maintenance_date ?: '—'); ?></td>
 <td class="text-[12px] font-semibold <?php echo e($isDue ? 'text-rose-500 animate-pulse' : 'text-white'); ?>">
 <?php echo e($a->next_maintenance_date ?: '—'); ?>

 </td>
 <td class="px-10 py-6 text-right">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isDue): ?>
 <form method="POST" action="<?php echo e(route('assets.maintenance')); ?>">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="asset_id" value="<?php echo e($a->id); ?>">
 <button type="submit" class="px-4 py-2 bg-rose-500 text-white rounded-xl text-[12px] font-semibold uppercase hover:bg-rose-600 transition /20">Acknowledge Service</button>
 </form>
 <?php else: ?>
 <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[12px] font-semibold uppercase"><?php echo e($a->status); ?></span>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </tbody>
 </table>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\assets\index.blade.php ENDPATH**/ ?>
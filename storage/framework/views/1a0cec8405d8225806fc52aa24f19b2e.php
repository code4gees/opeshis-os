<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Clinical Engine — EMR | Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Clinical Engine — EMR | Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-[1400px] mx-auto pb-10">


 <div class="flex items-center justify-between mb-6">
 <div>
 <h1 class="text-xl font-semibold text-white">Clinical Engine</h1>
 <p class="text-[12px] text-slate-400 mt-0.5">Select a patient from the active queue to begin a consultation</p>
 </div>
 <a href="<?php echo e(route('clinical.opd.index')); ?>" class="flex items-center gap-2 px-4 py-2 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 <i class="fas fa-plus text-[12px]"></i>
 Register Walk-In
 </a>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('info')): ?>
 <div class="mb-4 px-4 py-3 bg-[#2a2e38] border border-subtle rounded-lg text-[12px] text-slate-300 flex items-center gap-2">
 <i class="fas fa-info-circle text-sage text-[12px]"></i>
 <?php echo e(session('info')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


 <div class="bg-card rounded-xl border border-subtle">
 <div class="px-6 py-4 border-b border-subtle flex items-center justify-between">
 <h2 class="text-[14px] font-medium text-white flex items-center gap-2">
 <i class="fas fa-users text-sage text-[12px]"></i>
 Active Patient Queue
 </h2>
 <span class="px-2.5 py-1 rounded-md bg-sage/10 text-sage text-[12px] font-medium">
 <?php echo e($queue->count()); ?> patients
 </span>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($queue->isEmpty()): ?>
 <div class="px-6 py-16 flex flex-col items-center justify-center text-center">
 <div class="w-16 h-16 rounded-full bg-[#2a2e38] flex items-center justify-center mb-4">
 <i class="fas fa-user-check text-slate-500 text-xl"></i>
 </div>
 <p class="text-[13px] font-medium text-slate-300">No patients in queue</p>
 <p class="text-[12px] text-slate-500 mt-1">Register a walk-in patient or check back later</p>
 <a href="<?php echo e(route('clinical.opd.index')); ?>" class="mt-4 px-4 py-2 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 Register Patient
 </a>
 </div>
 <?php else: ?>
 <table class="w-full text-left">
 <thead class="border-b border-subtle">
 <tr>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Patient</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Medical ID</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Status</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Wait Time</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Complaint</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400"></th>
 </tr>
 </thead>
 <tbody class="divide-y divide-subtle">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $queue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="<?php echo e($loop->even ? 'bg-[#1a1d24]/30' : 'bg-transparent'); ?> hover:bg-[#2a2e38] transition-colors">
 <td class="px-6 py-3.5">
 <div class="flex items-center gap-3">
 <div class="w-8 h-8 rounded-full bg-sage/10 border border-sage/20 flex items-center justify-center text-sage text-[12px] font-bold">
 <?php echo e(strtoupper(substr($item->patient->full_name ?? 'P', 0, 1))); ?>

 </div>
 <span class="text-[12px] font-medium text-slate-200"><?php echo e($item->patient->full_name ?? 'Unknown Patient'); ?></span>
 </div>
 </td>
 <td class="px-6 py-3.5 text-[12px] text-sage font-mono"><?php echo e($item->patient->medical_id ?? 'N/A'); ?></td>
 <td class="px-6 py-3.5">
 <span class="px-2.5 py-1 rounded-md text-[12px] font-medium
 <?php echo e(($item->status ?? '') === 'urgent' ? 'bg-alert/10 text-alert border border-alert/20' : 'bg-[#313642] text-slate-300'); ?>">
 <?php echo e(ucfirst($item->status ?? 'Waiting')); ?>

 </span>
 </td>
 <td class="px-6 py-3.5 text-[12px] text-slate-300">
 <?php echo e(\Carbon\Carbon::parse($item->created_at)->diffForHumans()); ?>

 </td>
 <td class="px-6 py-3.5 text-[12px] text-slate-400 max-w-[200px] truncate">
 <?php echo e($item->chief_complaint ?? '—'); ?>

 </td>
 <td class="px-6 py-3.5 text-right">
 <a href="<?php echo e(route('emr.main', $item->id)); ?>"
 class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sage text-[#16191f] rounded-md text-[12px] font-semibold hover:opacity-90 transition-opacity">
 <i class="fas fa-stethoscope text-[12px]"></i>
 Begin Consultation
 </a>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </tbody>
 </table>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>


 <div class="grid grid-cols-3 gap-4 mt-6">
 <div class="bg-card rounded-xl border border-subtle p-4">
 <p class="text-[12px] text-slate-400 mb-1">Patients in Queue</p>
 <p class="text-2xl font-bold text-white"><?php echo e($queue->count()); ?></p>
 </div>
 <div class="bg-card rounded-xl border border-subtle p-4">
 <p class="text-[12px] text-slate-400 mb-1">Urgent Cases</p>
 <p class="text-2xl font-bold text-alert"><?php echo e($queue->where('status', 'urgent')->count()); ?></p>
 </div>
 <div class="bg-card rounded-xl border border-subtle p-4">
 <p class="text-[12px] text-slate-400 mb-1">Avg. Wait Time</p>
 <p class="text-2xl font-bold text-white">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($queue->count() > 0): ?>
 <?php echo e(round($queue->avg(fn($q) => \Carbon\Carbon::parse($q->created_at)->diffInMinutes()))); ?> min
 <?php else: ?>
 —
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </p>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\emr-landing.blade.php ENDPATH**/ ?>
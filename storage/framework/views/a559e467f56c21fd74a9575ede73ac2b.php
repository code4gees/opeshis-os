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
 <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Clinical Engine</h1>
 <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Patient Matrix</p>
 </div>
 <a href="<?php echo e(route('clinical.opd.index')); ?>" class="cc-button-primary flex items-center gap-2">
 <i class="fas fa-plus text-[10px]"></i>
 Register Walk-In
 </a>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('info')): ?>
 <div class="mb-4 px-4 py-3 bg-[#2a2e38] border border-subtle rounded-lg text-[12px] text-slate-300 flex items-center gap-2">
 <i class="fas fa-info-circle text-sage text-[12px]"></i>
 <?php echo e(session('info')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


 <div class="cc-card overflow-hidden">
 <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
 <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
 <i class="fas fa-users text-sage text-[14px]"></i>
 Active Patient Queue
 </h2>
 <span class="px-3 py-1 rounded-full bg-sage/10 text-sage text-[11px] font-bold uppercase tracking-wider">
 <?php echo e($queue->count()); ?> Live Sessions
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
 <thead class="border-b border-white/[0.04] bg-white/[0.01]">
 <tr>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Patient</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Medical ID</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Status</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Wait Time</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest">Complaint</th>
 <th class="px-8 py-4 text-[10px] font-bold text-white/20 uppercase tracking-widest"></th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/[0.04]">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $queue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-white/[0.02] transition-colors group">
 <td class="px-8 py-4">
 <div class="flex items-center gap-4">
 <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center text-sage text-[13px] font-bold group-hover:scale-110 transition-transform">
 <?php echo e(strtoupper(substr($item->patient->full_name ?? 'P', 0, 1))); ?>

 </div>
 <span class="text-[12px] font-bold text-white tracking-tight"><?php echo e($item->patient->full_name ?? 'Unknown Patient'); ?></span>
 </div>
 </td>
 <td class="px-8 py-4 text-[11px] text-sage/60 font-mono tracking-wider"><?php echo e($item->patient->medical_id ?? 'N/A'); ?></td>
 <td class="px-8 py-4">
 <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
 <?php echo e(($item->status ?? '') === 'urgent' ? 'bg-alert/10 text-alert' : 'bg-white/5 text-white/40'); ?>">
 <?php echo e($item->status ?? 'Waiting'); ?>

 </span>
 </td>
 <td class="px-8 py-4 text-[11px] text-white/20 font-medium tracking-tight">
 <?php echo e(\Carbon\Carbon::parse($item->created_at)->diffForHumans(null, true)); ?>

 </td>
 <td class="px-8 py-4 text-[11px] text-white/30 max-w-[200px] truncate">
 <?php echo e($item->chief_complaint ?? '—'); ?>

 </td>
 <td class="px-8 py-4 text-right">
 <a href="<?php echo e(route('emr.main', $item->id)); ?>"
 class="cc-button-primary !py-2 !px-5 inline-flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
 <i class="fas fa-stethoscope text-[10px]"></i>
 Consult
 </a>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </tbody>
 </table>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>


 <div class="grid grid-cols-3 gap-6 mt-10">
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['label' => 'Queue Traffic','value' => $queue->count(),'icon' => 'fa-users-line']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Queue Traffic','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($queue->count()),'icon' => 'fa-users-line']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $attributes = $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $component = $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['label' => 'Urgent Triage','value' => $queue->where('status', 'urgent')->count(),'icon' => 'fa-triangle-exclamation','trend' => 'Priority 1','trendUp' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Urgent Triage','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($queue->where('status', 'urgent')->count()),'icon' => 'fa-triangle-exclamation','trend' => 'Priority 1','trendUp' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $attributes = $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $component = $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['label' => 'Avg Latency','value' => ($queue->count() > 0 ? round($queue->avg(fn($q) => \Carbon\Carbon::parse($q->created_at)->diffInMinutes())) . ' min' : '—'),'icon' => 'fa-clock']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Avg Latency','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($queue->count() > 0 ? round($queue->avg(fn($q) => \Carbon\Carbon::parse($q->created_at)->diffInMinutes())) . ' min' : '—')),'icon' => 'fa-clock']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $attributes = $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $component = $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views/emr-landing.blade.php ENDPATH**/ ?>
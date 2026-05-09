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


<?php $__env->startSection('title', 'Visual Bed Map & Ward Management - Opeshis OS'); ?>


<div class="space-y-6 animate-fade-in">
 <div class="flex justify-between items-center mb-8 border-b border-subtle pb-8">
 <div>
 <h2 class="text-2xl font-semibold uppercase text-white tracking-tight">Institutional Ward Map</h2>
 <p class="text-[12px] font-bold text-slate-400 font-medium mt-1">Real-time Bed Occupancy & Telemetry</p>
 </div>
 <div class="flex gap-4">
 <select onchange="window.location.href='?ward_id=' + this.value" class="bg-card border border-white/20 rounded-xl px-6 py-3 text-xs font-semibold font-medium outline-none">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <option value="<?php echo e($ward->id); ?>" <?php echo e($selectedWardId == $ward->id ? 'selected' : ''); ?>><?php echo e($ward->name); ?> (<?php echo e($ward->category); ?>)</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </select>
 </div>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-sm font-bold mb-6"><?php echo e(session('success')); ?></div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedWardId): ?>
 <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $beds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <?php $isOccupied = $bed->status === 'occupied'; ?>
 <div class="relative group">
 <div class="bg-card rounded-[2rem] p-8 border-2 <?php echo e($isOccupied ? 'border-rose-500/30 bg-rose-50/10' : 'border-subtle hover:border-indigo-100'); ?> transition-all flex flex-col items-center text-center shadow-lg">
 <div class="w-12 h-12 rounded-2xl <?php echo e($isOccupied ? 'bg-rose-500 /20' : 'bg-white/10 /20'); ?> flex items-center justify-center mb-4 ">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
 <path d="M2 20v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8M4 10V5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5M2 17h20M6 17v3M18 17v3" />
 </svg>
 </div>
 <h4 class="text-lg font-semibold text-white tracking-tight"><?php echo e($bed->bed_number); ?></h4>
 <p class="text-[12px] font-semibold font-medium <?php echo e($isOccupied ? 'text-rose-500' : 'text-slate-400'); ?> mt-1">
 <?php echo e($isOccupied ? 'Occupied' : 'Available'); ?>

 </p>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isOccupied): ?>
 <div class="mt-4 pt-4 border-t border-rose-50 w-full">
 <div class="text-[12px] font-semibold text-white uppercase truncate"><?php echo e($bed->full_name); ?></div>
 <div class="text-[12px] text-slate-400 font-bold uppercase mt-1"><?php echo e($bed->medical_id); ?></div>
 <div class="text-[8px] text-slate-300 font-mono mt-2 ">Adm: <?php echo e(\Carbon\Carbon::parse($bed->admitted_at)->format('d M H:i')); ?></div>
 <form method="POST" action="<?php echo e(route('admissions.action')); ?>" class="mt-4">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="action" value="discharge">
 <input type="hidden" name="bed_id" value="<?php echo e($bed->id); ?>">
 <button type="submit" class="text-[12px] font-semibold text-rose-500 uppercase hover:text-rose-700 transition">Discharge &rarr;</button>
 </form>
 </div>
 <?php else: ?>
 <button onclick="openAdmitModal('<?php echo e($bed->id); ?>', '<?php echo e($bed->bed_number); ?>')" class="mt-6 text-[12px] font-semibold text-sage uppercase hover:text-indigo-800 transition">Admit Patient</button>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 <?php else: ?>
 <div class="p-20 text-center bg-card rounded-[3rem] border border-subtle shadow-lg">
 <p class="text-slate-300 ">No wards defined in system registry.</p>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<!-- Admit Modal -->
<div id="admitModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-md rounded-[2.5rem] p-12 ">
 <h3 id="admitTitle" class="text-2xl font-semibold text-white mb-8 uppercase">Inpatient Admission</h3>
 <form method="POST" action="<?php echo e(route('admissions.action')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="action" value="admit">
 <input type="hidden" name="bed_id" id="modalBedId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-2">Patient Search (Medical ID/Name)</label>
 <input type="text" name="patient_id" placeholder="Start typing..." required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold outline-none">
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('admitModal').classList.add('hidden')" class="flex-1 py-5 bg-white/10 text-slate-400 rounded-2xl text-xs font-semibold font-medium hover:bg-slate-200 transition">Cancel</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-xs font-semibold font-medium /20 hover:bg-indigo-700 transition">Confirm Admission</button>
 </div>
 </form>
 </div>
</div>

<script>
 function openAdmitModal(id, num) {
 document.getElementById('modalBedId').value = id;
 document.getElementById('admitTitle').textContent = 'Admit to Bed ' + num;
 document.getElementById('admitModal').classList.remove('hidden');
 }
</script>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\admissions\bed_map.blade.php ENDPATH**/ ?>
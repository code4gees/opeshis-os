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


<?php $__env->startSection('title', 'HIV/ART Program — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: HIV/ART Intelligence Command -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">HIV/ART Program</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">UNAIDS 95-95-95 Surveillance · Longitudinal Regimen Tracking · Virological Failures</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('enrollModal').classList.remove('hidden')" class="px-8 py-4 bg-sage text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
 Authorize New Enrollment
 </button>
 </div>
 </header>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[12px] font-semibold font-medium mb-8 animate-pulse ">
 HIV program protocol synchronized successfully.
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <!-- UNAIDS 95-95-95 Indicators -->
 <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
 ['1st 95: Enrolled / Estimated', number_format($metrics['first_95'], 1) . '%', 'indigo', 'Diagnosed PLHIV'],
 ['2nd 95: On ART / Enrolled', number_format($metrics['second_95'], 1) . '%', 'amber', 'Active Treatment'],
 ['3rd 95: Suppressed / On ART', number_format($metrics['third_95'], 1) . '%', 'emerald', 'Virological Suppression']
 ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $val, $color, $sub]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="bg-card rounded-[2.5rem] border border-subtle p-10 relative overflow-hidden group bg-card">
 <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
 <div class="w-20 h-20 rounded-full border-8 border-<?php echo e($color === 'indigo' ? 'indigo' : ($color === 'amber' ? 'amber' : 'emerald')); ?>-500"></div>
 </div>
 <p class="text-[12px] font-semibold text-slate-500 font-medium mb-4 "><?php echo e($label); ?></p>
 <p class="text-5xl font-semibold text-<?php echo e($color === 'indigo' ? 'indigo-400' : ($color === 'amber' ? 'amber-500' : 'emerald-500')); ?> tracking-tighter leading-none"><?php echo e($val); ?></p>
 <p class="text-[12px] font-semibold text-slate-600 mt-6 font-medium ">Target Matrix: 95% <?php echo e($sub); ?></p>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>

 <!-- Active Program Registry Matrix -->
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden bg-card">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex items-center justify-between">
 <h3 class="text-xs font-semibold text-white font-medium ">ART Program Longitudinal Registry</h3>
 <div class="flex gap-4">
 <span class="px-4 py-1.5 bg-[#2a2e38] border border-subtle text-slate-500 rounded-xl text-[12px] font-semibold uppercase "><?php echo e($metrics['counts']['on_art']); ?> ACTIVE_ON_ART</span>
 </div>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Patient Identity</th>
 <th class="py-6">Unique ART Number</th>
 <th class="py-6">Active Therapeutic Regimen</th>
 <th class="py-6">WHO Clinical Stage</th>
 <th class="py-6">Viral Load Signal</th>
 <th class="px-10 py-6 text-right">Operational Action</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-[#2a2e38] transition-all group">
 <td class="px-10 py-6">
 <div class="font-semibold text-white text-base uppercase group-hover:text-sage transition-colors"><?php echo e($e->full_name); ?></div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-1 ">AGE: <?php echo e($e->age); ?> · <?php echo e(strtoupper($e->gender)); ?></div>
 </td>
 <td class="py-6 font-mono text-[12px] font-semibold text-sage tracking-wider"><?php echo e($e->art_number); ?></td>
 <td class="py-6">
 <span class="px-3 py-1 bg-[#2a2e38] border border-subtle rounded-lg text-[12px] font-semibold text-slate-400 uppercase "><?php echo e($e->current_regimen ?: 'TREATMENT_PENDING'); ?></span>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($e->regimen_line): ?>
 <div class="text-[8px] font-semibold text-slate-600 mt-2 font-medium "><?php echo e($e->regimen_line); ?> LINE_PROTOCOL</div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 <td class="py-6 text-[12px] font-semibold text-slate-500 uppercase ">Stage <?php echo e($e->who_stage); ?></td>
 <td class="py-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($e->last_vl !== null): ?>
 <div class="text-sm font-semibold <?php echo e($e->last_vl >= 1000 ? 'text-rose-500 animate-pulse' : 'text-emerald-500'); ?> tracking-tighter">
 <?php echo e(number_format($e->last_vl)); ?> COPIES/ML
 </div>
 <div class="text-[8px] font-semibold text-slate-600 uppercase mt-1 "><?php echo e(date('d M Y', strtotime($e->last_vl_date))); ?></div>
 <?php else: ?>
 <span class="text-slate-700 text-[12px] font-semibold uppercase ">SIGNAL_MISSING</span>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 <td class="px-10 py-6 text-right">
 <div class="flex justify-end gap-4 opacity-0 group-hover:opacity-100 transition-all">
 <button onclick="openVisitModal('<?php echo e($e->id); ?>')" class="px-4 py-1.5 bg-sage/10 text-sage border border-indigo-500/20 rounded-lg text-[8px] font-semibold font-medium hover:bg-sage hover:text-white transition-all">Visit</button>
 <button onclick="openRegimenModal('<?php echo e($e->id); ?>', '<?php echo e($e->current_regimen); ?>')" class="px-4 py-1.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-lg text-[8px] font-semibold font-medium hover:bg-amber-600 hover:text-white transition-all">Regimen</button>
 </div>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="6" class="px-10 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No active HIV enrollments identified in the program registry.</p>
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
</div>

<!-- Modal: Enrollment Protocol -->
<div id="enrollModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-10 uppercase tracking-tight">Authorize Program Enrollment</h3>
 <form method="POST" action="<?php echo e(url('/clinical/hiv/enroll')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Patient Identity (Medical ID)</label>
 <input name="patient_id" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase" placeholder="e.g. PID-000000">
 </div>
 <div class="grid grid-cols-2 gap-8">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Unique ART Matrix Number</label>
 <input name="art_number" required placeholder="ART-XXX-XXXX" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Enrollment WHO Stage</label>
 <select name="who_stage" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 <option value="1">STAGE_1_PROTOCOL</option>
 <option value="2">STAGE_2_PROTOCOL</option>
 <option value="3">STAGE_3_PROTOCOL</option>
 <option value="4">STAGE_4_PROTOCOL</option>
 </select>
 </div>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('enrollModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Discard Enrollment</button>
 <button type="submit" class="flex-1 py-5 bg-sage text-white rounded-2xl text-[12px] font-semibold font-medium /20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Authorize Enrollment</button>
 </div>
 </form>
 </div>
</div>

<!-- Modal: Regimen Transition Protocol -->
<div id="regimenModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-2 uppercase tracking-tight">Regimen Transition Matrix</h3>
 <p class="text-[12px] text-amber-500 font-semibold font-medium mb-10 ">⚠ Terminating current regimen node and authorizing new therapeutic line</p>
 <form method="POST" action="<?php echo e(url('/clinical/hiv/regimen-change')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="enrollment_id" id="regimenEnrollmentId">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Active Treatment Matrix</label>
 <input id="currentRegimenText" disabled class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-sm font-semibold text-slate-600 outline-none uppercase ">
 </div>
 <div class="grid grid-cols-2 gap-8">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">New Therapeutic Code</label>
 <input name="regimen_code" required placeholder="e.g. TLD_PROTOCOL" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Therapeutic Line Matrix</label>
 <select name="regimen_line" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 <option value="1st">1ST_LINE_OPTIMIZATION</option>
 <option value="2nd">2ND_LINE_FAILURE_RECOVERY</option>
 <option value="3rd">3RD_LINE_SALVAGE_PROTOCOL</option>
 </select>
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Transition Rationale Vector</label>
 <select name="reason" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 <option value="Routine Switch">ROUTINE_OPTIMIZATION_SWITCH</option>
 <option value="Treatment Failure">VIROLOGICAL_TREATMENT_FAILURE</option>
 <option value="Adverse Reaction">ADVERSE_DRUG_REACTION_NODE</option>
 <option value="Stock Out">PHARMACEUTICAL_STOCK_OUT</option>
 </select>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('regimenModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Discard Transition</button>
 <button type="submit" class="flex-1 py-5 bg-amber-600 text-white rounded-2xl text-[12px] font-semibold font-medium /20 hover:bg-amber-700 transition-all border border-amber-500/50">Authorize Treatment Update</button>
 </div>
 </form>
 </div>
</div>

<script>
 function openRegimenModal(id, current) {
 document.getElementById('regimenEnrollmentId').value = id;
 document.getElementById('currentRegimenText').value = current || 'NO_ACTIVE_REGIMEN';
 document.getElementById('regimenModal').classList.remove('hidden');
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\hiv.blade.php ENDPATH**/ ?>
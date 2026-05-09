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


<?php $__env->startSection('title', 'Dietary Command — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in">
 <!-- Header: Dietary Command Hub -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Dietary Command</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Nutrition Surveillance · Meal Logistics · Inpatient Regimen Matrix</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('planModal').classList.remove('hidden')" class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-emerald-700 transition-all border border-emerald-500/50">
 Authorize Meal Plan
 </button>
 </div>
 </header>

 <!-- Dietary Surveillance Matrix -->
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Live Delivery Surveillance Board</h3>
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 rounded-lg text-[8px] font-semibold font-medium border border-subtle ">Daily Sync: <?php echo e(now()->format('d M Y')); ?></span>
 </div>
 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="bg-[#2a2e38] text-[12px] font-semibold text-slate-400 font-medium">
 <tr>
 <th class="px-10 py-6">Patient Protocol</th>
 <th class="px-6 py-6">Regimen Matrix</th>
 <th class="px-6 py-6">Clinical Restrictions</th>
 <th class="px-6 py-6 text-center">Breakfast</th>
 <th class="px-6 py-6 text-center">Lunch Matrix</th>
 <th class="px-6 py-6 text-center">Dinner Matrix</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activePlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-[#2a2e38] transition-all group">
 <td class="px-10 py-6">
 <div class="font-semibold text-white text-sm uppercase group-hover:text-emerald-400 transition-colors"><?php echo e($p->full_name); ?></div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-0.5"><?php echo e($p->medical_id); ?></div>
 </td>
 <td class="px-6 py-6">
 <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded-lg text-[8px] font-semibold font-medium"><?php echo e($p->meal_type); ?></span>
 </td>
 <td class="px-6 py-6">
 <div class="text-[12px] text-slate-400 max-w-xs truncate group-hover:whitespace-normal group-hover:overflow-visible transition-all">"<?php echo e($p->restrictions ?: 'No documented clinical restrictions'); ?>"</div>
 </td>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['Breakfast', 'Lunch', 'Dinner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <?php 
 $delivery = $p->deliveries->where('meal_name', $meal)->first();
 $status = $delivery->meal_status ?? 'pending';
 ?>
 <td class="px-6 py-6 text-center">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'delivered'): ?>
 <div class="w-10 h-10 bg-emerald-500/10 text-emerald-500 rounded-xl flex items-center justify-center mx-auto border border-emerald-500/20 /5">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
 </div>
 <?php elseif($status === 'npo'): ?>
 <div class="w-10 h-10 bg-rose-500/10 text-rose-500 rounded-xl flex items-center justify-center mx-auto border border-rose-500/20 /5">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
 </div>
 <?php else: ?>
 <button onclick="logMealDelivery('<?php echo e($p->id); ?>', '<?php echo e($meal); ?>')" class="w-10 h-10 bg-[#2a2e38] text-slate-500 rounded-xl flex items-center justify-center mx-auto hover:bg-sage/20 hover:text-sage transition-all border border-subtle hover:border-indigo-500/30">
 <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/></svg>
 </button>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activePlans->isEmpty()): ?>
 <tr>
 <td colspan="6" class="px-10 py-24 text-center">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No active inpatient meal plans identified in the matrix.</p>
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>
</div>

<!-- Modal: Dietary Plan Authorization -->
<div id="planModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-8 uppercase tracking-tight">Regimen Assignment Protocol</h3>
 <form method="POST" action="<?php echo e(route('dietary.plan.store')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Institutional Admission ID</label>
 <input type="text" name="admission_id" required placeholder="ADM-XXXX-XXXX" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>
 <div class="grid grid-cols-2 gap-8">
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Regimen Matrix Category</label>
 <select name="meal_type" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-indigo-500/50 transition-all">
 <option>General / Standard</option>
 <option>Soft / Liquid</option>
 <option>Diabetic Matrix</option>
 <option>Renal Matrix</option>
 <option>Low Sodium</option>
 <option>Pediatric Protocol</option>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Clinical Restrictions</label>
 <input type="text" name="restrictions" placeholder="e.g. PEANUT_ALLERGY" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 font-medium mb-3">Strategic Special Instructions</label>
 <textarea name="instructions" class="w-full h-24 bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar resize-none" placeholder="Provide strategic nutritional findings..."></textarea>
 </div>
 <div class="flex gap-4 mt-8">
 <button type="button" onclick="document.getElementById('planModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-5 bg-emerald-600 text-white rounded-2xl text-[12px] font-semibold font-medium /20 hover:bg-emerald-700 transition-all border border-emerald-500/50">Establish Plan</button>
 </div>
 </form>
 </div>
</div>

<!-- Log Delivery Form (Hidden) -->
<form id="deliveryForm" method="POST" action="<?php echo e(route('dietary.delivery.log')); ?>" class="hidden">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="plan_id" id="form_plan_id">
 <input type="hidden" name="meal_name" id="form_meal_name">
 <input type="hidden" name="status" id="form_status">
</form>

<script>
 function logMealDelivery(planId, mealName) {
 if(confirm("AUTHORIZATION REQUIRED: Confirm delivery of " + mealName.toUpperCase() + "? (Cancel for NPO)")) {
 document.getElementById('form_status').value = 'delivered';
 } else {
 if(confirm("PROTOCOL WARNING: Mark as NPO (Nothing by Mouth)?")) {
 document.getElementById('form_status').value = 'npo';
 } else {
 return;
 }
 }
 document.getElementById('form_plan_id').value = planId;
 document.getElementById('form_meal_name').value = mealName;
 document.getElementById('deliveryForm').submit();
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\dietary\index.blade.php ENDPATH**/ ?>
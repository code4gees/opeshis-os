<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Ward Command | Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Ward Command | Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-[1600px] mx-auto pb-10">


 <div class="flex items-center justify-between mb-6">
 <div>
 <h1 class="text-xl font-semibold text-white">Ward Command</h1>
 <p class="text-[12px] text-slate-400 mt-0.5">Bed Management · Inpatient Admissions · Nursing Census</p>
 </div>
 <div class="flex items-center gap-4">

 <div class="flex items-center gap-6 px-5 py-3 bg-card rounded-xl border border-subtle">
 <div class="text-center">
 <p class="text-[12px] text-slate-500 mb-0.5">Occupancy Rate</p>
 <p class="text-lg font-bold text-sage leading-none"><?php echo e($occupancyRate); ?>%</p>
 </div>
 <div class="w-px h-8 bg-white/10"></div>
 <div class="text-center">
 <p class="text-[12px] text-slate-500 mb-0.5">Total Admitted</p>
 <p class="text-lg font-bold text-white leading-none"><?php echo e($admissions->count()); ?></p>
 </div>
 </div>

 <button onclick="document.getElementById('admitModal').classList.remove('hidden')"
 class="flex items-center gap-2 px-4 py-2.5 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 <i class="fas fa-plus text-[12px]"></i>
 Authorize Admission
 </button>
 </div>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="mb-5 px-4 py-3 bg-sage/10 border border-sage/20 text-sage rounded-lg text-[12px] flex items-center gap-2">
 <i class="fas fa-check-circle text-[12px]"></i> Ward protocol synchronized successfully.
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


 <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <?php
 $total = $w->beds->count();
 $occupied = $w->beds->where('status', 'occupied')->count();
 $available = $total - $occupied;
 $rate = $total > 0 ? round(($occupied / $total) * 100) : 0;
 ?>
 <div class="bg-card rounded-xl border border-subtle p-5 group hover:border-sage/30 transition-colors relative overflow-hidden">

 <div class="flex items-center justify-between mb-4">
 <div class="w-9 h-9 rounded-lg bg-[#16191f] border border-subtle flex items-center justify-center text-sage group-hover:text-sage transition-colors">
 <i class="fas fa-door-open text-[13px]"></i>
 </div>
 <span class="px-2 py-0.5 rounded text-[12px] font-medium text-slate-400 bg-[#2a2e38] border border-subtle">
 <?php echo e($w->type ?: 'General'); ?>

 </span>
 </div>

 <h4 class="text-[13px] font-semibold text-white mb-3 truncate"><?php echo e($w->name); ?></h4>


 <div class="w-full h-1.5 bg-[#16191f] rounded-full overflow-hidden mb-3">
 <div class="h-full rounded-full transition-all duration-700
 <?php echo e($rate >= 90 ? 'bg-alert' : ($rate >= 70 ? 'bg-yellow-500' : 'bg-sage')); ?>"
 style="width: <?php echo e($rate); ?>%"></div>
 </div>

 <div class="flex justify-between items-center">
 <span class="text-[12px] text-slate-400">
 <span class="text-white font-semibold"><?php echo e($available); ?></span> / <?php echo e($total); ?> beds free
 </span>
 <span class="text-[12px] font-semibold <?php echo e($rate >= 90 ? 'text-alert' : ($rate >= 70 ? 'text-yellow-400' : 'text-sage')); ?>">
 <?php echo e($rate); ?>%
 </span>
 </div>


 <div class="absolute -right-8 -bottom-8 w-24 h-24 bg-sage/5 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <div class="col-span-4 bg-card rounded-xl border border-subtle p-8 text-center text-slate-500 text-[12px]">
 No wards configured.
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>


 <div class="bg-card rounded-xl border border-subtle overflow-hidden">
 <div class="px-6 py-4 border-b border-subtle flex items-center justify-between">
 <h2 class="text-[14px] font-medium text-white flex items-center gap-2">
 <i class="fas fa-hospital-user text-sage text-[12px]"></i>
 Inpatient Census
 </h2>
 <span class="px-2.5 py-1 rounded-md bg-sage/10 text-sage text-[12px] font-medium border border-sage/20">
 <?php echo e($admissions->count()); ?> active
 </span>
 </div>

 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="border-b border-subtle bg-[#1a1d24]/50">
 <tr>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Patient</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Ward / Bed</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Diagnosis</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Admitted</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Status</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400 text-right">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-subtle">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="<?php echo e($loop->even ? 'bg-[#1a1d24]/30' : 'bg-transparent'); ?> hover:bg-[#2a2e38] transition-colors group">

 <td class="px-6 py-3.5">
 <div class="flex items-center gap-3">
 <div class="w-8 h-8 rounded-full bg-sage/10 border border-sage/20 flex items-center justify-center text-sage text-[12px] font-bold shrink-0">
 <?php echo e(strtoupper(substr($a->patient->full_name ?? 'P', 0, 1))); ?>

 </div>
 <div>
 <div class="text-[12px] font-medium text-slate-200 group-hover:text-white transition-colors">
 <?php echo e($a->patient->full_name ?? 'Unknown'); ?>

 </div>
 <div class="text-[12px] text-slate-500 font-mono">
 <?php echo e($a->patient->medical_id ?? '—'); ?>

 </div>
 </div>
 </div>
 </td>

 <td class="px-6 py-3.5">
 <div class="text-[12px] font-semibold text-white">
 <?php echo e($a->bed->ward->name ?? 'Unknown Ward'); ?>

 </div>
 <div class="text-[12px] text-slate-500">
 Bed <?php echo e($a->bed->bed_number ?? '—'); ?>

 </div>
 </td>

 <td class="px-6 py-3.5">
 <div class="text-[12px] text-slate-300 max-w-[220px] truncate">
 <?php echo e($a->diagnosis_at_admission ?? '—'); ?>

 </div>
 </td>

 <td class="px-6 py-3.5 text-[12px] text-slate-400">
 <?php echo e(\Carbon\Carbon::parse($a->admission_date ?? $a->created_at)->diffForHumans()); ?>

 </td>

 <td class="px-6 py-3.5">
 <span class="px-2.5 py-1 rounded-md text-[12px] font-medium
 <?php echo e(($a->status ?? '') === 'admitted' ? 'bg-sage/10 text-sage border border-sage/20'
 : (($a->status ?? '') === 'critical' ? 'bg-alert/10 text-alert border border-alert/20'
 : 'bg-[#313642] text-slate-300')); ?>">
 <?php echo e(ucfirst($a->status ?? 'admitted')); ?>

 </span>
 </td>

 <td class="px-6 py-3.5 text-right">
 <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
 <button class="px-3 py-1.5 bg-[#2a2e38] border border-subtle text-slate-300 rounded-md text-[12px] font-medium hover:text-white transition-colors">
 <i class="fas fa-heartbeat text-[12px] mr-1"></i> Vitals
 </button>
 <button onclick="openDischargeModal('<?php echo e($a->id); ?>')"
 class="px-3 py-1.5 bg-alert/10 border border-alert/20 text-alert rounded-md text-[12px] font-medium hover:bg-alert hover:text-white transition-colors">
 <i class="fas fa-door-open text-[12px] mr-1"></i> Discharge
 </button>
 </div>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="6" class="px-6 py-16 text-center">
 <div class="w-14 h-14 rounded-full bg-[#2a2e38] flex items-center justify-center mx-auto mb-3">
 <i class="fas fa-hospital-user text-slate-600 text-lg"></i>
 </div>
 <p class="text-[13px] font-medium text-slate-400">No active inpatient admissions</p>
 <p class="text-[12px] text-slate-600 mt-1">Authorize a new admission to get started</p>
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>

</div>


<div id="admitModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-card w-full max-w-lg rounded-2xl border border-subtle shadow-2xl">
 <div class="px-6 py-5 border-b border-subtle flex items-center justify-between">
 <h3 class="text-[15px] font-semibold text-white">Authorize Inpatient Admission</h3>
 <button onclick="document.getElementById('admitModal').classList.add('hidden')"
 class="w-8 h-8 rounded-lg bg-[#2a2e38] flex items-center justify-center text-slate-400 hover:text-white transition-colors">
 <i class="fas fa-times text-[12px]"></i>
 </button>
 </div>
 <form method="POST" action="<?php echo e(route('admissions.admit')); ?>" class="p-6 space-y-4">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Patient ID</label>
 <input name="patient_id" required
 class="w-full bg-[#16191f] border border-subtle rounded-lg px-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors placeholder-slate-600"
 placeholder="Enter patient UUID or Medical ID">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Ward</label>
 <select name="ward_id" id="wardSelect" onchange="updateBeds()"
 class="w-full bg-[#16191f] border border-subtle rounded-lg px-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors">
 <option value="">Select Ward</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <?php
 $av = $w->beds->where('status','available')->count();
 ?>
 <option value="<?php echo e($w->id); ?>" class="bg-[#16191f]"><?php echo e($w->name); ?> (<?php echo e($av); ?> avail)</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Bed</label>
 <select name="bed_id" id="bedSelect" required
 class="w-full bg-[#16191f] border border-subtle rounded-lg px-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors">
 <option value="">Select Bed</option>
 </select>
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Admitting Diagnosis</label>
 <textarea name="diagnosis" required rows="3"
 class="w-full bg-[#16191f] border border-subtle rounded-lg px-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors resize-none placeholder-slate-600"
 placeholder="Primary diagnosis at admission..."></textarea>
 </div>
 <div class="flex gap-3 pt-2">
 <button type="button" onclick="document.getElementById('admitModal').classList.add('hidden')"
 class="flex-1 py-2.5 bg-[#2a2e38] border border-subtle text-slate-300 rounded-lg text-[12px] font-medium hover:text-white transition-colors">
 Cancel
 </button>
 <button type="submit"
 class="flex-1 py-2.5 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 Authorize Admission
 </button>
 </div>
 </form>
 </div>
</div>


<div id="dischargeModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-card w-full max-w-md rounded-2xl border border-subtle shadow-2xl">
 <div class="px-6 py-5 border-b border-subtle flex items-center justify-between">
 <h3 class="text-[15px] font-semibold text-white">Discharge Patient</h3>
 <button onclick="document.getElementById('dischargeModal').classList.add('hidden')"
 class="w-8 h-8 rounded-lg bg-[#2a2e38] flex items-center justify-center text-slate-400 hover:text-white transition-colors">
 <i class="fas fa-times text-[12px]"></i>
 </button>
 </div>
 <form id="dischargeForm" method="POST" class="p-6 space-y-4">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Discharge Summary</label>
 <textarea name="summary" rows="4"
 class="w-full bg-[#16191f] border border-subtle rounded-lg px-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors resize-none placeholder-slate-600"
 placeholder="Discharge notes and follow-up instructions..."></textarea>
 </div>
 <div class="flex gap-3 pt-2">
 <button type="button" onclick="document.getElementById('dischargeModal').classList.add('hidden')"
 class="flex-1 py-2.5 bg-[#2a2e38] border border-subtle text-slate-300 rounded-lg text-[12px] font-medium hover:text-white transition-colors">
 Cancel
 </button>
 <button type="submit"
 class="flex-1 py-2.5 bg-alert text-white rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 Confirm Discharge
 </button>
 </div>
 </form>
 </div>
</div>

<script>
 function updateBeds() {
 const wardId = document.getElementById('wardSelect').value;
 const bedSelect = document.getElementById('bedSelect');
 bedSelect.innerHTML = '<option value="">Loading...</option>';

 if (!wardId) {
 bedSelect.innerHTML = '<option value="">Select Bed</option>';
 return;
 }

 fetch(`<?php echo e(route('admissions.beds.available')); ?>?ward_id=${wardId}`)
 .then(res => res.json())
 .then(data => {
 bedSelect.innerHTML = '<option value="">Select Bed</option>';
 data.forEach(bed => {
 bedSelect.innerHTML += `<option value="${bed.id}" class="bg-[#16191f]">Bed ${bed.bed_number}</option>`;
 });
 })
 .catch(() => {
 bedSelect.innerHTML = '<option value="">Failed to load beds</option>';
 });
 }

 function openDischargeModal(admissionId) {
 const form = document.getElementById('dischargeForm');
   form.action = `<?php echo e(route('admissions.discharge', ':id')); ?>`.replace(':id', admissionId);
 document.getElementById('dischargeModal').classList.remove('hidden');
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\ward.blade.php ENDPATH**/ ?>
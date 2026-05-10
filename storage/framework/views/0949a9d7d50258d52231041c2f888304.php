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


    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tighter uppercase">Ward Command</h1>
            <p class="text-[11px] font-bold text-white/20 uppercase tracking-[0.2em] mt-1">Institutional Bed Management & Inpatient Census</p>
        </div>
        <div class="flex items-center gap-6">

            <div class="flex items-center gap-8 px-6 py-4 cc-card bg-white/[0.02]">
                <div class="text-center">
                    <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-1">Occupancy</p>
                    <p class="text-xl font-bold text-sage tracking-tighter leading-none"><?php echo e($occupancyRate); ?>%</p>
                </div>
                <div class="w-px h-8 bg-white/[0.04]"></div>
                <div class="text-center">
                    <p class="text-[10px] font-bold text-white/20 uppercase tracking-widest mb-1">Census</p>
                    <p class="text-xl font-bold text-white tracking-tighter leading-none"><?php echo e($admissions->count()); ?></p>
                </div>
            </div>

            <button onclick="document.getElementById('admitModal').classList.remove('hidden')"
                class="cc-button-primary flex items-center gap-2">
                <i class="fas fa-plus text-[10px]"></i>
                Authorize Admission
            </button>
        </div>
    </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="mb-5 px-4 py-3 bg-sage/10 border border-sage/20 text-sage rounded-lg text-[12px] flex items-center gap-2">
 <i class="fas fa-check-circle text-[12px]"></i> Ward protocol synchronized successfully.
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <?php
            $total = $w->beds->count();
            $occupied = $w->beds->where('status', 'occupied')->count();
            $available = $total - $occupied;
            $rate = $total > 0 ? round(($occupied / $total) * 100) : 0;
        ?>
        <div class="cc-card p-6 group relative overflow-hidden transition-all duration-500 hover:border-sage/30">

            <div class="flex items-center justify-between mb-6">
                <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center text-sage group-hover:scale-110 transition-transform">
                    <i class="fas fa-door-open text-[14px]"></i>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-bold text-white/40 bg-white/5 uppercase tracking-wider">
                    <?php echo e($w->type ?: 'General'); ?>

                </span>
            </div>

            <h4 class="text-[13px] font-bold text-white mb-4 truncate tracking-tight uppercase"><?php echo e($w->name); ?></h4>


            <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden mb-4">
                <div class="h-full rounded-full transition-all duration-1000
                    <?php echo e($rate >= 90 ? 'bg-alert' : ($rate >= 70 ? 'bg-amber-500' : 'bg-sage shadow-[0_0_10px_rgba(130,192,154,0.3)]')); ?>"
                    style="width: <?php echo e($rate); ?>%"></div>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-[11px] font-bold text-white/20 uppercase tracking-widest">
                    <span class="text-white"><?php echo e($available); ?></span> / <?php echo e($total); ?> Free
                </span>
                <span class="text-[11px] font-bold <?php echo e($rate >= 90 ? 'text-alert' : ($rate >= 70 ? 'text-amber-400' : 'text-sage')); ?>">
                    <?php echo e($rate); ?>%
                </span>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <div class="col-span-4 cc-card p-12 text-center">
            <p class="text-[12px] font-bold text-white/20 uppercase tracking-[0.2em]">Institutional Wards Not Configured</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>


    <div class="cc-card overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
                <i class="fas fa-hospital-user text-sage text-[14px]"></i>
                Inpatient Census Matrix
            </h2>
            <span class="px-3 py-1 rounded-full bg-sage/10 text-sage text-[10px] font-bold uppercase tracking-wider">
                <?php echo e($admissions->count()); ?> Synchronized
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="border-b border-white/[0.04] bg-white/[0.01]">
                    <tr class="text-white/20">
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest">Patient Identity</th>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest">Inpatient Allocation</th>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest">Primary Diagnosis</th>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest">Admission Depth</th>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest">Protocol Status</th>
                        <th class="px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-right">Forensic Actions</th>
                    </tr>
                </thead>
 <tbody class="divide-y divide-white/[0.04]">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-white/[0.02] transition-colors group">

 <td class="px-8 py-5">
 <div class="flex items-center gap-4">
 <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/5 flex items-center justify-center text-sage text-[13px] font-bold group-hover:scale-110 transition-transform">
 <?php echo e(strtoupper(substr($a->patient->full_name ?? 'P', 0, 1))); ?>

 </div>
 <div>
 <div class="text-[12px] font-bold text-white tracking-tight group-hover:text-sage transition-colors">
 <?php echo e($a->patient->full_name ?? 'Unknown Entity'); ?>

 </div>
 <div class="text-[11px] text-white/20 font-mono tracking-wider">
 <?php echo e($a->patient->medical_id ?? 'IDENTITY_UNDEFINED'); ?>

 </div>
 </div>
 </div>
 </td>

 <td class="px-8 py-5">
 <div class="text-[11px] font-bold text-white tracking-tight uppercase">
 <?php echo e($a->bed->ward->name ?? 'Allocation Unknown'); ?>

 </div>
 <div class="text-[10px] text-white/20 font-bold uppercase tracking-widest mt-1">
 BED ID: <?php echo e($a->bed->bed_number ?? '—'); ?>

 </div>
 </td>

 <td class="px-8 py-5">
 <div class="text-[11px] text-white/40 max-w-[220px] truncate italic">
 "<?php echo e($a->diagnosis_at_admission ?? 'Observation'); ?>"
 </div>
 </td>

 <td class="px-8 py-5 text-[11px] font-bold text-white/20 uppercase tracking-tighter">
 <?php echo e(\Carbon\Carbon::parse($a->admission_date ?? $a->created_at)->diffForHumans()); ?>

 </td>

 <td class="px-8 py-5">
 <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider
 <?php echo e(($a->status ?? '') === 'admitted' ? 'bg-sage/10 text-sage'
 : (($a->status ?? '') === 'critical' ? 'bg-alert/10 text-alert'
 : 'bg-white/5 text-white/40')); ?>">
 <?php echo e($a->status ?? 'admitted'); ?>

 </span>
 </td>

 <td class="px-8 py-5 text-right">
 <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
 <button class="cc-button-primary !py-2 !px-4 !bg-white/5 !text-white/40 border border-white/5 hover:!text-white">
 <i class="fas fa-heartbeat text-[10px]"></i> Vitals
 </button>
 <button onclick="openDischargeModal('<?php echo e($a->id); ?>')"
 class="cc-button-primary !py-2 !px-4 !bg-alert/10 !text-alert border border-alert/10 hover:!bg-alert hover:!text-white">
 <i class="fas fa-door-open text-[10px]"></i> Discharge
 </button>
 </div>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="6" class="px-8 py-24 text-center">
 <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4">
 <i class="fas fa-hospital-user text-white/20 text-xl"></i>
 </div>
 <p class="text-[12px] font-bold text-white/20 uppercase tracking-[0.2em]">Census Inventory Empty</p>
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 </div>

</div>



<div id="admitModal" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] hidden flex items-center justify-center p-6">
    <div class="cc-card w-full max-lg shadow-2xl overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]">Institutional Admission Authorization</h3>
            <button onclick="document.getElementById('admitModal').classList.add('hidden')"
                class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                <i class="fas fa-times text-[10px]"></i>
            </button>
        </div>
        <form method="POST" action="<?php echo e(route('admissions.admit')); ?>" class="p-8 space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Patient Forensic Identity</label>
                <div class="relative">
                    <i class="fas fa-id-badge absolute left-4 top-1/2 -translate-y-1/2 text-white/10 text-[12px]"></i>
                    <input name="patient_id" required
                        class="cc-input w-full pl-12"
                        placeholder="Enter Patient UUID or Medical ID">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Ward Allocation</label>
                    <div class="relative">
                        <i class="fas fa-hospital absolute left-4 top-1/2 -translate-y-1/2 text-white/10 text-[12px]"></i>
                        <select name="ward_id" id="wardSelect" onchange="updateBeds()"
                            class="cc-input w-full pl-12 appearance-none">
                            <option value="" class="bg-[#1a1d24]">Select Ward</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($w->id); ?>" class="bg-[#1a1d24]"><?php echo e($w->name); ?> (<?php echo e($w->beds->where('status','available')->count()); ?> avail)</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Bed Designation</label>
                    <div class="relative">
                        <i class="fas fa-bed absolute left-4 top-1/2 -translate-y-1/2 text-white/10 text-[12px]"></i>
                        <select name="bed_id" id="bedSelect" required
                            class="cc-input w-full pl-12 appearance-none">
                            <option value="" class="bg-[#1a1d24]">Select Bed</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Primary Admitting Diagnosis</label>
                <textarea name="diagnosis" required rows="3"
                    class="cc-input w-full resize-none h-24"
                    placeholder="Document primary clinical findings..."></textarea>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="button" onclick="document.getElementById('admitModal').classList.add('hidden')"
                    class="flex-1 py-3 bg-white/5 border border-white/5 text-white/30 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:text-white transition-all">
                    Abort
                </button>
                <button type="submit" class="cc-button-primary flex-1">
                    Authorize Admission
                </button>
            </div>
        </form>
    </div>
</div>


<div id="dischargeModal" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] hidden flex items-center justify-center p-6">
    <div class="cc-card w-full max-w-md shadow-2xl overflow-hidden">
        <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em]">Discharge Protocol</h3>
            <button onclick="document.getElementById('dischargeModal').classList.add('hidden')"
                class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center text-white/20 hover:text-white transition-colors">
                <i class="fas fa-times text-[10px]"></i>
            </button>
        </div>
        <form id="dischargeForm" method="POST" class="p-8 space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3">Final Clinical Summary</label>
                <textarea name="summary" rows="4" required
                    class="cc-input w-full resize-none h-32"
                    placeholder="Document discharge summary and follow-up..."></textarea>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="document.getElementById('dischargeModal').classList.add('hidden')"
                    class="flex-1 py-3 bg-white/5 border border-white/5 text-white/30 rounded-xl text-[11px] font-bold uppercase tracking-widest hover:text-white transition-all">
                    Discard
                </button>
                <button type="submit"
                    class="flex-1 cc-button-primary !bg-alert !text-white hover:brightness-110">
                    Finalize Discharge
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
<?php /**PATH C:\laragon\www\opeshis\resources\views/clinical/ward.blade.php ENDPATH**/ ?>
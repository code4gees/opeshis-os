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


<?php $__env->startSection('title', 'Nursing Strategic Command — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Unified Nursing Station -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Nursing Station</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Inpatient Monitoring Hub · Clinical Rounding · NEWS2 Risk Surveillance</p>
        </div>
        <div class="flex gap-4">
            <span class="px-6 py-3 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-xl text-[10px] font-black uppercase tracking-widest italic shadow-lg shadow-indigo-500/5">
                Live Census: <?php echo e($admissions->count()); ?> Patients
            </span>
        </div>
    </header>

    <!-- Inpatient Strategic Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $admissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="glass-panel rounded-[3rem] p-10 border border-white/10 shadow-xl hover:border-indigo-500/30 transition-all group bg-white/[0.02] relative overflow-hidden">
                <div class="flex justify-between items-start mb-8 relative z-10">
                    <div class="w-16 h-16 rounded-[2rem] bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-500 font-black text-2xl group-hover:bg-indigo-500 group-hover:text-white transition-all duration-500 shadow-lg">
                        <?php echo e(substr($a->full_name, 0, 1)); ?>

                    </div>
                    <div class="text-right">
                        <span class="px-3 py-1 bg-white/5 text-slate-500 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic"><?php echo e($a->ward_name); ?></span>
                        <div class="text-[11px] font-black text-indigo-400 mt-2 uppercase tracking-tighter">Bed: <?php echo e($a->bed_number); ?></div>
                    </div>
                </div>

                <div class="mb-10 relative z-10">
                    <h4 class="text-xl font-black text-white uppercase tracking-tighter group-hover:text-indigo-400 transition-colors"><?php echo e($a->full_name); ?></h4>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mt-1 italic"><?php echo e($a->medical_id); ?> · <?php echo e(strtoupper($a->gender)); ?></p>
                </div>

                <!-- Strategic Vitals Snapshot Matrix -->
                <div class="grid grid-cols-2 gap-4 mb-8 relative z-10">
                    <div class="bg-white/5 rounded-3xl p-5 border border-white/5 text-center group-hover:border-white/10 transition-all">
                        <label class="text-[8px] font-black text-slate-600 uppercase block mb-2 tracking-widest">TEMP_CORE</label>
                        <div class="text-sm font-black italic <?php echo e(($a->last_vitals->temp ?? 0) > 37.5 ? 'text-rose-500' : 'text-white'); ?>"><?php echo e($a->last_vitals->temp ?? '--'); ?>°C</div>
                    </div>
                    <div class="bg-white/5 rounded-3xl p-5 border border-white/5 text-center group-hover:border-white/10 transition-all">
                        <label class="text-[8px] font-black text-slate-600 uppercase block mb-2 tracking-widest">BP_SYS_DIA</label>
                        <div class="text-sm font-black text-white italic"><?php echo e($a->last_vitals->bp_sys ?? '--'); ?>/<?php echo e($a->last_vitals->bp_dia ?? '--'); ?></div>
                    </div>
                    <div class="bg-white/5 rounded-3xl p-5 border border-white/5 text-center group-hover:border-white/10 transition-all">
                        <label class="text-[8px] font-black text-slate-600 uppercase block mb-2 tracking-widest">SPO2_OXY</label>
                        <div class="text-sm font-black text-emerald-500 italic"><?php echo e($a->last_vitals->spo2 ?? '--'); ?>%</div>
                    </div>
                    <div class="bg-white/5 rounded-3xl p-5 border border-white/5 text-center group-hover:border-white/10 transition-all">
                        <label class="text-[8px] font-black text-slate-600 uppercase block mb-2 tracking-widest">RESP_RATE</label>
                        <div class="text-sm font-black text-white italic"><?php echo e($a->last_vitals->respiratory_rate ?? '--'); ?></div>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($a->last_vitals->news2_score)): ?>
                    <?php 
                        $riskColor = match($a->last_vitals->risk_level) {
                            'HIGH' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 shadow-rose-500/5',
                            'MEDIUM' => 'bg-amber-500/10 text-amber-500 border-amber-500/20 shadow-amber-500/5',
                            default => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20 shadow-emerald-500/5'
                        };
                    ?>
                    <div class="mb-10 p-6 <?php echo e($riskColor); ?> rounded-[2rem] border flex justify-between items-center shadow-lg relative z-10">
                        <div class="flex flex-col">
                            <span class="text-[8px] font-black uppercase tracking-[0.2em] mb-1 italic">NEWS2 Clinical Risk</span>
                            <span class="text-xs font-black uppercase"><?php echo e($a->last_vitals->risk_level); ?> PROTOCOL</span>
                        </div>
                        <span class="text-2xl font-black italic tracking-tighter"><?php echo e($a->last_vitals->news2_score); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="flex gap-4 relative z-10">
                    <button onclick="openRoundModal('<?php echo e($a->id); ?>', '<?php echo e(addslashes($a->full_name)); ?>')" class="flex-1 py-4 bg-indigo-600 text-white rounded-2xl text-[9px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Authorize Round</button>
                    <a href="<?php echo e(route('patients.show', $a->patient_id)); ?>" class="flex-1 py-4 bg-white/5 text-slate-400 border border-white/10 rounded-2xl text-[9px] font-black uppercase tracking-widest text-center hover:bg-white/10 transition-all italic">Longitudinal Profile</a>
                </div>

                <!-- Decorative background -->
                <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all"></div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($admissions->isEmpty()): ?>
            <div class="col-span-full py-32 text-center glass-panel rounded-[3rem] border-2 border-dashed border-white/5 bg-white/[0.02]">
                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                </div>
                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active inpatient census identified in the matrix.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<!-- Modal: Nursing Round Execution -->
<div id="roundModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-2xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 id="modalPatient" class="text-2xl font-black text-white mb-10 uppercase tracking-tight">Execute Clinical Rounding</h3>
        <form method="POST" action="<?php echo e(route('nursing.save')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="admission_id" id="modalAdmissionId">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Temp (°C)</label>
                    <input type="number" step="0.1" name="temp" placeholder="e.g. 36.8" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
                </div>
                <div>
                    <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Pulse (BPM)</label>
                    <input type="number" name="pulse" placeholder="e.g. 72" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
                </div>
                <div>
                    <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Resp Rate</label>
                    <input type="number" name="respiratory_rate" placeholder="e.g. 16" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
                </div>
                <div>
                    <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">SPO2 (%)</label>
                    <input type="number" name="spo2" placeholder="e.g. 98" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div class="col-span-1">
                    <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Blood Pressure (SYS/DIA)</label>
                    <div class="flex items-center gap-3">
                        <input type="number" name="bp_sys" placeholder="SYS" class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
                        <span class="text-slate-600 font-black">/</span>
                        <input type="number" name="bp_dia" placeholder="DIA" class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
                    </div>
                </div>
                <div class="col-span-1">
                    <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Supplemental Oxygen</label>
                    <select name="supplemental_oxygen" class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                        <option value="0">NO_SUPPLEMENTAL_O2</option>
                        <option value="1">OXYGEN_PROTOCOL_ACTIVE</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[9px] font-black text-slate-500 uppercase tracking-widest mb-3">Clinical Rounding Findings & Observations</label>
                <textarea name="notes" placeholder="Describe patient status, longitudinal trends, and interventions..." class="w-full h-32 bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none no-scrollbar resize-none focus:border-indigo-500/50 transition-all"></textarea>
            </div>
            <div class="flex gap-4 mt-8">
                <button type="button" onclick="document.getElementById('roundModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Cancel Assessment</button>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Commit Assessment</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRoundModal(id, patient) {
        document.getElementById('modalAdmissionId').value = id;
        document.getElementById('modalPatient').innerText = 'ASSESSMENT PROTOCOL: ' + patient.toUpperCase();
        document.getElementById('roundModal').classList.remove('hidden');
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\nursing\index.blade.php ENDPATH**/ ?>
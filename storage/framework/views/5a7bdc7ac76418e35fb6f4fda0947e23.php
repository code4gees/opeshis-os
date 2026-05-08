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


<?php $__env->startSection('title', 'Institutional Reporting & DHIS2 — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in">
    <!-- Header: Reporting Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Reporting Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional HMIS Aggregation · DHIS2 National Data Link · Strategic Analytics</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('generateModal').classList.remove('hidden')" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Generate Period Report
            </button>
        </div>
    </header>

    <!-- DHIS2 Integration Status -->
    <div class="glass-panel rounded-[2.5rem] border border-white/10 p-10 flex items-center justify-between shadow-xl bg-gradient-to-br from-indigo-500/5 to-transparent relative overflow-hidden">
        <div class="flex items-center gap-10 relative z-10">
            <div class="w-20 h-20 bg-indigo-500/10 rounded-[2rem] border border-indigo-500/20 flex items-center justify-center relative shadow-lg">
                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="text-indigo-400"><path d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/></svg>
                <div class="absolute -top-2 -right-2 w-5 h-5 bg-emerald-500 rounded-full border-4 border-slate-900 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
            </div>
            <div>
                <h3 class="text-sm font-black text-white uppercase tracking-widest">DHIS2 National Instance</h3>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mt-2 italic"><?php echo e($config->instance_url ?? 'UNCONFIGURED_INSTANCE_LINK'); ?></p>
            </div>
        </div>
        <div class="text-right relative z-10">
            <div class="flex items-center justify-end gap-2 mb-2">
                <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Linked & Operational</p>
            </div>
            <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Last Payload Sync: <?php echo e(date('M d, H:i')); ?></p>
        </div>
        <!-- Decorative background -->
        <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Reporting Registry Matrix -->
    <div class="glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
        <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
            <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Institutional Reporting Ledger</h3>
            <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10">Registry Sync: Active</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-10 py-6">Reporting Period Protocol</th>
                        <th class="px-6 py-6">Form Matrix (MoH)</th>
                        <th class="px-6 py-6">Authorized By</th>
                        <th class="px-6 py-6 text-center">Transmission Status</th>
                        <th class="px-10 py-6 text-right">Strategic Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="hover:bg-white/5 transition-all group">
                        <td class="px-10 py-6">
                            <div class="font-black text-white text-sm uppercase group-hover:text-indigo-400 transition-colors"><?php echo e($r->report_period); ?></div>
                            <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5"><?php echo e(date('M d, Y · H:i', strtotime($r->created_at))); ?></div>
                        </td>
                        <td class="px-6 py-6">
                            <span class="px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 rounded-lg text-[9px] font-black text-indigo-400 uppercase tracking-widest"><?php echo e($r->report_type); ?></span>
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-[10px] font-black text-white uppercase tracking-widest"><?php echo e($r->generator); ?></div>
                            <div class="text-[8px] font-bold text-slate-500 uppercase tracking-widest mt-1">Authorizing Officer</div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            <?php $isTransmitted = $r->status === 'TRANSMITTED'; ?>
                            <span class="px-3 py-1 rounded-lg border text-[8px] font-black uppercase tracking-widest
                                <?php echo e($isTransmitted ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20 animate-pulse'); ?>">
                                <?php echo e($r->status); ?>

                            </span>
                        </td>
                        <td class="px-10 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <button onclick="viewPayload('<?php echo e($r->id); ?>')" class="px-4 py-2 bg-white/5 text-slate-400 border border-white/10 rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">View Payload</button>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r->status === 'DRAFT'): ?>
                                    <form method="POST" action="<?php echo e(url('/reporting/export')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="report_id" value="<?php echo e($r->id); ?>">
                                        <button class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-[9px] font-black uppercase tracking-widest shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all border border-emerald-500/50">Transmit to MoH</button>
                                    </form>
                                <?php else: ?>
                                    <span class="px-4 py-2 bg-white/5 text-slate-600 border border-white/10 rounded-lg text-[9px] font-black uppercase tracking-widest italic">Archived Matrix</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="5" class="px-10 py-24 text-center">
                            <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                            </div>
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No institutional periodic reports identified in the registry.</p>
                        </td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Generate Period Report -->
<div id="generateModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-8 uppercase tracking-tight">Generate Institutional Analytics</h3>
        <form method="POST" action="<?php echo e(url('/reporting/generate')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Strategic Reporting Period</label>
                <input name="period" type="month" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Report Framework Matrix (MoH Standard)</label>
                <select name="type" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                    <option value="HMIS-105">HMIS 105: Strategic Outpatient Surveillance</option>
                    <option value="HMIS-108">HMIS 108: Institutional Inpatient Census</option>
                    <option value="IDSR-WEEKLY">IDSR Weekly Epidemiological Surveillance</option>
                    <option value="ART-QUARTERLY">ART Quarterly Institutional Performance</option>
                </select>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('generateModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20">Aggregate & Generate Report</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\reporting\index.blade.php ENDPATH**/ ?>
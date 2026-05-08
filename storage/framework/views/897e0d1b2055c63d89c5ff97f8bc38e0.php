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


<?php $__env->startSection('title', 'CSSD Strategic Command — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in">
    <!-- Header: CSSD Command Hub -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">CSSD Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Sterile Services · Infection Control Surveillance · Asset Validation</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('loadModal').classList.remove('hidden')" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Initiate Sterilization Cycle
            </button>
        </div>
    </header>

    <!-- CSSD Telemetry KPIs -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-indigo-500/5 to-transparent flex flex-col justify-center">
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4">Cycles Processed (Today)</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter"><?php echo e($loadStats->total ?? 0); ?></h3>
        </div>
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-emerald-500/5 to-transparent flex flex-col justify-center">
            <p class="text-[9px] font-black text-emerald-500 uppercase tracking-widest mb-4">Validation: PASSED</p>
            <h3 class="text-4xl font-black text-emerald-500 italic tracking-tighter"><?php echo e($loadStats->passed ?? 0); ?></h3>
        </div>
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-rose-500/5 to-transparent flex flex-col justify-center">
            <p class="text-[9px] font-black text-rose-500 uppercase tracking-widest mb-4">Quarantined / Failed</p>
            <h3 class="text-4xl font-black text-rose-500 italic tracking-tighter"><?php echo e($loadStats->failed ?? 0); ?></h3>
        </div>
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-amber-500/5 to-transparent flex flex-col justify-center relative overflow-hidden">
            <p class="text-[9px] font-black text-amber-500 uppercase tracking-widest mb-4 italic">Expiring Protocol (14D)</p>
            <h3 class="text-4xl font-black text-white italic tracking-tighter"><?php echo e($expiringCount); ?></h3>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expiringCount > 0): ?>
                <div class="absolute top-8 right-8 w-2 h-2 bg-rose-500 rounded-full animate-ping"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Active Sterilization Matrix -->
        <div class="lg:col-span-8 glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
            <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
                <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Live Sterilization Ledger</h3>
                <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic">Chain Sync: Operational</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-10 py-6">Load Protocol Matrix</th>
                            <th class="px-6 py-6">Sterilizer Unit ID</th>
                            <th class="px-6 py-6">Methodology</th>
                            <th class="px-6 py-6 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $todayLoads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr class="hover:bg-white/5 transition-all group">
                            <td class="px-10 py-6">
                                <div class="font-black text-indigo-400 text-sm uppercase group-hover:text-indigo-300 transition-colors"><?php echo e($l->load_number); ?></div>
                                <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-0.5 italic">EXPIRY_SYNC: <?php echo e(\Carbon\Carbon::parse($l->expiry_date)->format('d M Y')); ?></div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-[10px] font-black text-white uppercase tracking-widest italic"><?php echo e($l->sterilizer_name); ?></div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest"><?php echo e($l->sterilization_method); ?></div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <?php
                                    $statusCls = [
                                        'passed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                        'in_progress' => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/20 animate-pulse shadow-lg shadow-indigo-500/10',
                                        'failed' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                    ];
                                    $cls = $statusCls[$l->load_status] ?? 'bg-white/5 text-slate-400 border-white/10';
                                ?>
                                <span class="px-3 py-1 rounded-lg border <?php echo e($cls); ?> text-[8px] font-black uppercase tracking-widest">
                                    <?php echo e(str_replace('_', ' ', $l->load_status)); ?>

                                </span>
                            </td>
                        </tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayLoads->isEmpty()): ?>
                        <tr>
                            <td colspan="4" class="px-10 py-24 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active sterilization cycles identified in the current window.</p>
                            </td>
                        </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sterilizer Fleet Status -->
        <div class="lg:col-span-4 space-y-8">
            <div class="glass-panel rounded-[3rem] p-10 border border-white/10 shadow-xl relative overflow-hidden bg-white/[0.02]">
                <h3 class="text-xs font-black text-white uppercase tracking-widest mb-10 border-b border-white/5 pb-4 italic">Fleet Validation Status</h3>
                <div class="space-y-4 relative z-10">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sterilizers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php $overdue = (\Carbon\Carbon::parse($st->next_validation_due)->isPast()); ?>
                        <div class="p-6 rounded-3xl border <?php echo e($overdue ? 'border-rose-500/30 bg-rose-500/5 shadow-lg shadow-rose-500/5' : 'border-white/5 bg-white/5'); ?> transition-all group hover:border-indigo-500/30">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-[11px] font-black text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors"><?php echo e($st->sterilizer_name); ?></h3>
                                    <p class="text-[8px] font-black text-slate-500 uppercase mt-1 tracking-widest"><?php echo e($st->sterilizer_type); ?></p>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($overdue): ?>
                                    <span class="px-2 py-1 bg-rose-600 text-white rounded text-[7px] font-black uppercase tracking-widest animate-pulse">Overdue</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 bg-emerald-500 text-white rounded text-[7px] font-black uppercase tracking-widest">Validated</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="flex justify-between items-center text-[8px] font-black uppercase tracking-[0.2em] text-slate-500">
                                <span class="italic">Next Validation:</span>
                                <span class="<?php echo e($overdue ? 'text-rose-500' : 'text-white'); ?>"><?php echo e(\Carbon\Carbon::parse($st->next_validation_due)->format('d M Y')); ?></span>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <!-- Decorative background -->
                <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Initiate Sterilization -->
<div id="loadModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-8 uppercase tracking-tight">Initiate Sterilization Protocol</h3>
        <form method="POST" action="<?php echo e(route('cssd.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Unit Fleet Selection</label>
                <select name="sterilizer_id" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sterilizers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($st->id); ?>"><?php echo e($st->sterilizer_name); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Sterilization Methodology</label>
                <select name="method" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                    <option>Steam Autoclave (134°C / 4 min)</option>
                    <option>Plasma (Hydrogen Peroxide)</option>
                    <option>EO Gas (Ethylene Oxide)</option>
                    <option>Dry Heat (160°C / 2 hrs)</option>
                </select>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('loadModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Cancel</button>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Start Cycle</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\cssd\index.blade.php ENDPATH**/ ?>
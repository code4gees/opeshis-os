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


<?php $__env->startSection('title', 'Financial Reconciliation — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Fiscal Integrity Command -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Fiscal Reconciliation</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Interoperability · Third-Party Fiscal Sync · Audit Integrity Matrix</p>
        </div>
        <div class="flex gap-6">
            <div class="flex items-center gap-8 px-10 py-4 glass-panel rounded-[2rem] border border-white/10 bg-white/[0.02]">
                <div class="text-center">
                    <p class="text-[9px] font-black text-emerald-500 uppercase tracking-[0.2em] mb-2 italic">Synced (24h)</p>
                    <p class="text-3xl font-black text-white italic tracking-tighter leading-none"><?php echo e($history->where('status', 'success')->count()); ?></p>
                </div>
                <div class="w-px h-10 bg-white/10 shadow-sm"></div>
                <div class="text-center">
                    <p class="text-[9px] font-black text-indigo-500 uppercase tracking-[0.2em] mb-2 italic">Total Logs</p>
                    <p class="text-3xl font-black text-white italic tracking-tighter leading-none"><?php echo e($history->count()); ?></p>
                </div>
            </div>
            <button onclick="document.getElementById('syncModal').classList.remove('hidden')" class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all border border-emerald-500/50">
                Initiate Fiscal Sync
            </button>
        </div>
    </header>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse italic">
            Fiscal synchronization protocol successfully authorized.
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Reconciliation Matrix -->
    <div class="glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden bg-white/[0.02]">
        <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
            <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Institutional Interoperability Audit Matrix</h3>
            <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic">Gateway: Operational</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-10 py-6">Transaction Identity / Protocol</th>
                        <th class="px-6 py-6 text-center">Fiscal Amount Matrix</th>
                        <th class="px-6 py-6">Integration Channel Vector</th>
                        <th class="px-6 py-6">Sync Outcome Status</th>
                        <th class="px-10 py-6 text-right">Audit Temporal Matrix</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="hover:bg-white/5 transition-all group">
                        <td class="px-10 py-6">
                            <div class="font-black text-white text-base uppercase group-hover:text-emerald-400 transition-colors"><?php echo e($h->reference_id); ?></div>
                            <div class="text-[9px] font-bold text-slate-500 uppercase tracking-[0.2em] mt-1 italic">Type: <?php echo e(strtoupper($h->transaction_type)); ?></div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            <div class="text-sm font-black text-white italic tracking-tighter"><?php echo e($settings['currency_symbol'] ?? 'FCFA'); ?> <?php echo e(number_format($h->amount, 2)); ?></div>
                        </td>
                        <td class="px-6 py-6">
                            <span class="px-4 py-1.5 bg-white/5 text-slate-400 border border-white/10 rounded-xl text-[8px] font-black uppercase tracking-widest italic group-hover:border-indigo-500/30 transition-all">
                                <?php echo e(strtoupper($h->channel)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-6">
                            <?php
                                $statusCls = match($h->status) {
                                    'success' => 'text-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.3)]',
                                    'failed' => 'text-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.3)] animate-pulse',
                                    default => 'text-slate-500'
                                };
                            ?>
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full <?php echo e($h->status === 'success' ? 'bg-emerald-500' : 'bg-rose-500'); ?> <?php echo e($statusCls); ?>"></span>
                                <span class="text-[9px] font-black <?php echo e($statusCls); ?> uppercase tracking-widest">
                                    <?php echo e(strtoupper($h->status)); ?>

                                </span>
                            </div>
                        </td>
                        <td class="px-10 py-6 text-right text-[10px] font-black text-slate-500 uppercase tracking-widest italic">
                            <?php echo e(\Carbon\Carbon::parse($h->created_at)->format('d M · H:i:s')); ?>

                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($history->isEmpty()): ?>
                        <tr>
                            <td colspan="5" class="px-10 py-24 text-center">
                                <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active fiscal reconciliation logs identified in the matrix.</p>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Fiscal Synchronization Protocol -->
<div id="syncModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tight">Initiate Third-Party Fiscal Sync</h3>
        <form method="POST" action="<?php echo e(url('/ops/finance/sync')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Integration Channel Vector</label>
                <select name="channel" class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-black text-white outline-none focus:border-emerald-500/50 transition-all">
                    <option value="mpesa">MOBILE_MONEY_GATEWAY</option>
                    <option value="bank_interop">INSTITUTIONAL_BANK_API</option>
                    <option value="nhif">NATIONAL_INSURANCE_PORTAL_UHC</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Date Range Temporal Matrix</label>
                <div class="grid grid-cols-2 gap-8">
                    <input name="start" type="date" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-bold text-white outline-none focus:border-emerald-500/50 transition-all">
                    <input name="end" type="date" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-8 py-5 text-sm font-bold text-white outline-none focus:border-emerald-500/50 transition-all">
                </div>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('syncModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Discard Sync</button>
                <button type="submit" class="flex-1 py-5 bg-emerald-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-emerald-600/20 hover:bg-emerald-700 transition-all border border-emerald-500/50">Authorize Fiscal Sync</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\ops\reconciliation.blade.php ENDPATH**/ ?>
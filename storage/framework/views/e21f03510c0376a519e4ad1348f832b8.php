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


<?php $__env->startSection('title', 'Institutional Messaging Engine — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
    <!-- Header: Messaging Command Hub -->
    <header class="flex justify-between items-center mb-10 pb-8 border-b border-white/10">
        <div>
            <h1 class="text-3xl font-black text-white tracking-tight uppercase">Messaging Command</h1>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Institutional Notification Engine · Real-time Alert Relay · Transmission Surveillance</p>
        </div>
        <div class="flex gap-4">
            <button onclick="document.getElementById('composeModal').classList.remove('hidden')" class="px-8 py-4 bg-indigo-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">
                Authorize Message Dispatch
            </button>
        </div>
    </header>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-[10px] font-black uppercase tracking-widest mb-8 animate-pulse">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Transmission Telemetry Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-indigo-500/5 to-transparent flex flex-col justify-center">
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-4 italic">Active Queue Status</p>
            <div class="flex items-end gap-3">
                <h2 class="text-5xl font-black text-white italic tracking-tighter"><?php echo e($stats->pending ?? 0); ?></h2>
                <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest mb-2 italic">Pending Payload</span>
            </div>
        </div>
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-emerald-500/5 to-transparent flex flex-col justify-center">
            <p class="text-[9px] font-black text-emerald-500 uppercase tracking-widest mb-4 italic">Success Spectrum (24h)</p>
            <div class="flex items-end gap-3">
                <h2 class="text-5xl font-black text-emerald-500 italic tracking-tighter"><?php echo e($stats->sent_today ?? 0); ?></h2>
                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest mb-2 italic">Transmitted</span>
            </div>
        </div>
        <div class="glass-panel rounded-[2.5rem] p-10 border border-white/10 shadow-xl bg-gradient-to-br from-rose-500/5 to-transparent flex flex-col justify-center relative overflow-hidden">
            <p class="text-[9px] font-black text-rose-500 uppercase tracking-widest mb-4 italic">Transmission Failures (24h)</p>
            <div class="flex items-end gap-3">
                <h2 class="text-5xl font-black text-rose-500 italic tracking-tighter"><?php echo e($stats->failed_today ?? 0); ?></h2>
                <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest mb-2 italic">Error State</span>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($stats->failed_today ?? 0) > 0): ?>
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-rose-500/5 rounded-full blur-2xl"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <!-- Live Transmission Matrix -->
    <div class="glass-panel rounded-[3rem] border border-white/10 shadow-[0_8px_30px_rgb(0,0,0,0.12)] overflow-hidden">
        <div class="px-10 py-8 border-b border-white/5 bg-white/5 flex justify-between items-center">
            <h3 class="text-xs font-black text-white uppercase tracking-widest italic">Real-time Transmission Stream</h3>
            <span class="px-3 py-1 bg-white/5 text-slate-400 rounded-lg text-[8px] font-black uppercase tracking-widest border border-white/10 italic">Hub Sync: Operational</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-10 py-6">Temporal Matrix</th>
                        <th class="px-6 py-6">Recipient Identity</th>
                        <th class="px-6 py-6">Channel Vector</th>
                        <th class="px-6 py-6">Message Intelligence</th>
                        <th class="px-10 py-6 text-right">Payload Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="hover:bg-white/5 transition-all group">
                        <td class="px-10 py-6 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <?php echo e(\Carbon\Carbon::parse($m->created_at)->format('H:i:s')); ?>

                        </td>
                        <td class="px-6 py-6">
                            <div class="font-black text-white text-sm uppercase group-hover:text-indigo-400 transition-colors"><?php echo e($m->recipient_name ?: 'ANONYMOUS_RECIPIENT'); ?></div>
                            <div class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-1 italic"><?php echo e($m->recipient_phone); ?></div>
                        </td>
                        <td class="px-6 py-6">
                            <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-lg text-[8px] font-black uppercase tracking-widest"><?php echo e($m->channel); ?></span>
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-[11px] text-slate-400 max-w-sm truncate italic group-hover:whitespace-normal transition-all leading-relaxed uppercase tracking-tight">"<?php echo e($m->resolved_message); ?>"</div>
                            <div class="text-[7px] font-black text-slate-600 uppercase mt-2 tracking-widest">RELAY_SOURCE: <?php echo e($m->provider ?? 'INSTITUTIONAL_CORE'); ?></div>
                        </td>
                        <td class="px-10 py-6 text-right">
                            <?php
                                $statusCls = match($m->status) {
                                    'sent' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
                                    'delivered' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    'failed' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 animate-pulse',
                                    default => 'bg-white/5 text-slate-500 border-white/10'
                                };
                            ?>
                            <span class="px-4 py-1.5 rounded-xl text-[8px] font-black uppercase tracking-widest border <?php echo e($statusCls); ?> shadow-lg shadow-white/5">
                                <?php echo e($m->status); ?>

                            </span>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recent->isEmpty()): ?>
                    <tr>
                        <td colspan="5" class="px-10 py-24 text-center">
                            <div class="w-16 h-16 bg-white/5 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
                            </div>
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] italic">No active message transmissions identified in the live stream.</p>
                        </td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Compose Dispatch -->
<div id="composeModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-8">
    <div class="glass-panel w-full max-w-xl rounded-[3rem] p-12 shadow-2xl border border-white/10">
        <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tight">Institutional Payload Dispatch</h3>
        <form method="POST" action="<?php echo e(route('messaging.store')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Transmission Relay Provider</label>
                <select name="provider_id" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($p->id); ?>"><?php echo e($p->display_name); ?> (<?php echo e(strtoupper($p->slug)); ?>)</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Recipient Destination (MSISDN)</label>
                <input type="text" name="recipient" required placeholder="e.g. +237 600 000 000" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-black text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 italic">Message Intelligence Payload</label>
                <textarea name="message" required placeholder="Provide the strategic notification content..." class="w-full h-32 bg-white/5 border border-white/10 rounded-3xl px-6 py-5 text-sm font-bold text-white outline-none no-scrollbar resize-none focus:border-indigo-500/50 transition-all"></textarea>
            </div>
            <div class="flex gap-4 mt-10">
                <button type="button" onclick="document.getElementById('composeModal').classList.add('hidden')" class="flex-1 py-5 bg-white/5 border border-white/10 text-slate-400 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-white/10 transition-all">Discard Dispatch</button>
                <button type="submit" class="flex-1 py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-700 transition-all border border-indigo-500/50">Authorize Transmission</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\messaging\index.blade.php ENDPATH**/ ?>
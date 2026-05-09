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


<?php $__env->startSection('title', 'Clinical Risk & Safety — Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in pb-20">
 <!-- Header: Quality & Safety Command -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Safety Command</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Incident Surveillance · Quality Assurance · Clinical Risk Management</p>
 </div>
 <div class="flex gap-4">
 <button onclick="document.getElementById('reportModal').classList.remove('hidden')" class="px-8 py-4 bg-rose-600 text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-rose-700 transition-all border border-rose-500/50">
 Authorize Incident Report
 </button>
 </div>
 </header>

 <div class="grid grid-cols-1 xl:grid-cols-12 gap-10">
 <!-- Live Incident Surveillance Matrix -->
 <div class="xl:col-span-8 space-y-8">
 <div class="flex items-center justify-between mb-4">
 <h3 class="text-xs font-semibold text-white font-medium ">Live Incident Surveillance Feed</h3>
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 rounded-lg text-[8px] font-semibold font-medium border border-subtle ">Ledger Sync: <?php echo e($incidents->count()); ?> Entries</span>
 </div>
 
 <div class="space-y-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $incidents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="bg-card rounded-[3rem] border border-subtle p-10 hover:border-rose-500/30 transition-all relative group bg-card">
 <div class="flex justify-between items-start mb-8">
 <div class="flex flex-col gap-4">
 <?php
 $sevCls = match($i->severity_level) {
 'CATASTROPHIC' => 'bg-rose-500/10 text-rose-500 border-rose-500/20 /10 animate-pulse',
 'HIGH' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
 default => 'bg-sage/10 text-sage border-indigo-500/20'
 };
 ?>
 <span class="px-4 py-1.5 rounded-xl text-[8px] font-semibold font-medium border <?php echo e($sevCls); ?> w-max">
 <?php echo e($i->severity_level); ?> SEVERITY
 </span>
 <h3 class="text-2xl font-semibold text-white uppercase tracking-tighter group-hover:text-rose-400 transition-colors"><?php echo e($i->incident_type); ?></h3>
 <p class="text-[12px] font-semibold text-slate-500 font-medium "><?php echo e($i->location ?? 'UNSPECIFIED_INSTITUTIONAL_LOCATION'); ?> · <?php echo e(\Carbon\Carbon::parse($i->incident_date)->format('M j, Y · H:i')); ?></p>
 </div>
 <div class="text-right">
 <span class="block text-[8px] font-semibold text-slate-600 font-medium mb-2 ">Tracking Vector</span>
 <span class="px-3 py-1 bg-[#2a2e38] text-sage rounded-lg text-[12px] font-semibold font-medium border border-subtle"><?php echo e($i->status); ?></span>
 </div>
 </div>
 
 <div class="p-8 bg-[#2a2e38] rounded-[2.5rem] border border-subtle mb-10">
 <p class="text-slate-300 text-[13px] font-bold leading-relaxed uppercase tracking-tight">"<?php echo e($i->description); ?>"</p>
 </div>
 
 <div class="flex justify-between items-center pt-8 border-t border-subtle">
 <div class="text-[12px] font-semibold text-slate-500 font-medium ">
 Source Protocol: <span class="text-white ml-1"><?php echo e($i->is_anonymous ? 'ANONYMOUS_ENTITY_REPORT' : ($i->reporter_name ?? 'SYSTEM_AUTOMATED_FLAG')); ?></span>
 </div>
 <button class="px-6 py-2.5 bg-[#2a2e38] text-sage border border-subtle rounded-xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Execute Investigation &rarr;</button>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($incidents->isEmpty()): ?>
 <div class="py-24 text-center bg-card rounded-[3rem] border-2 border-dashed border-subtle bg-card">
 <div class="w-16 h-16 bg-[#2a2e38] rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-600">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 8.2c0 7.3 8 11.8 8 11.8z"/></svg>
 </div>
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">Institutional safety ledger is currently clear of active flags.</p>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>

 <!-- CAPA Strategic Sidebar -->
 <div class="xl:col-span-4 space-y-8">
 <h3 class="text-xs font-semibold text-white font-medium mb-6">Strategic Corrective Actions (CAPA)</h3>
 <div class="space-y-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $capas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="bg-card rounded-[3rem] p-10 border border-subtle relative overflow-hidden bg-card group hover:border-indigo-500/30 transition-all">
 <div class="flex justify-between items-start mb-8 relative z-10">
 <span class="text-[12px] font-semibold text-rose-500 font-medium "><?php echo e($c->incident_type); ?></span>
 <span class="px-2 py-1 bg-white/10 text-white rounded text-[7px] font-semibold font-medium border border-subtle"><?php echo e($c->status); ?></span>
 </div>
 <div class="p-6 bg-[#2a2e38] rounded-[2rem] border border-subtle mb-8 relative z-10">
 <p class="text-[12px] font-bold text-slate-300 leading-relaxed uppercase tracking-tight "><?php echo e($c->corrective_action); ?></p>
 </div>
 <div class="flex justify-between items-center text-[8px] font-semibold font-medium text-slate-500 relative z-10">
 <span>Authorized: <?php echo e($c->assigned_name ?? 'PENDING_ASSIGNMENT'); ?></span>
 <span class="text-white">Deadline: <?php echo e(\Carbon\Carbon::parse($c->deadline)->format('d M Y')); ?></span>
 </div>
 <!-- Decorative background -->
 <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-sage/5 rounded-full blur-3xl"></div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($capas->isEmpty()): ?>
 <div class="p-16 bg-card rounded-[3rem] text-center border border-subtle bg-card">
 <p class="text-[12px] font-semibold text-slate-600 font-medium ">No pending corrective actions identified.</p>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>
 </div>
</div>

<!-- Modal: Incident Authorization -->
<div id="reportModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-2xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-10 uppercase tracking-tight">Institutional Safety Disclosure</h3>
 <form method="POST" action="<?php echo e(route('quality.report')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Incident Classification</label>
 <select name="incident_type" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-rose-500/50 transition-all">
 <option>Medication Protocol Variance</option>
 <option>Patient Stability Event (Fall)</option>
 <option>Surgical Discrepancy Matrix</option>
 <option>Strategic Equipment Malfunction</option>
 <option>Potential Sentinel Event (Near Miss)</option>
 <option>Institutional Workplace Hazard</option>
 </select>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Assessed Severity Protocol</label>
 <select name="severity_level" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-rose-500/50 transition-all">
 <option value="LOW">LOW_PRIORITY (Monitor)</option>
 <option value="MEDIUM">MEDIUM_RISK (Corrective)</option>
 <option value="HIGH">HIGH_RISK (Critical Harm)</option>
 <option value="CATASTROPHIC">CATASTROPHIC_FAILURE</option>
 </select>
 </div>
 <div class="col-span-1 md:col-span-2">
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Factual Clinical Disclosure</label>
 <textarea name="description" placeholder="Provide a strategic account of the safety event..." class="w-full h-32 bg-[#2a2e38] border border-subtle rounded-3xl px-6 py-5 text-sm font-bold text-white outline-none no-scrollbar resize-none focus:border-rose-500/50 transition-all"></textarea>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-3 ">Institutional Location Matrix</label>
 <input type="text" name="location" placeholder="e.g. WARD_A_BAY_04" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-semibold text-white outline-none focus:border-rose-500/50 transition-all uppercase">
 </div>
 <div class="flex items-center gap-4">
 <input type="checkbox" name="is_anonymous" value="true" class="w-6 h-6 rounded-xl border-subtle bg-[#2a2e38] text-rose-600 focus:ring-rose-500 transition-all">
 <label class="text-[12px] font-semibold text-slate-300 font-medium ">Anonymize Source Protocol</label>
 </div>
 </div>
 <div class="flex gap-4 mt-10">
 <button type="button" onclick="document.getElementById('reportModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium hover:bg-white/10 transition-all">Discard Disclosure</button>
 <button type="submit" class="flex-1 py-5 bg-rose-600 text-white rounded-2xl text-[12px] font-semibold font-medium /20 hover:bg-rose-700 transition-all border border-rose-500/50">Transmit Safety Report</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\quality\index.blade.php ENDPATH**/ ?>
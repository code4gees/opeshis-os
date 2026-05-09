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


<?php $__env->startSection('title', 'Telemedicine Hub - Opeshis OS'); ?>


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
 
 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-card border border-subtle rounded-xl p-6 ">
 <div>
 <h1 class="text-2xl font-bold text-white tracking-tight">Telemedicine Hub</h1>
 <p class="text-sm text-slate-400 mt-1">Virtual patient consultations and remote healthcare monitoring services.</p>
 </div>
 <div class="mt-4 md:mt-0">
 <button onclick="document.getElementById('scheduleModal').classList.remove('hidden')" class="px-5 py-2.5 bg-sage hover:bg-sage text-white text-sm font-bold rounded-lg transition-all /20">
 Schedule Video Call
 </button>
 </div>
 </header>

 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 <!-- Active Consultations List -->
 <div class="lg:col-span-2 space-y-6">
 <div class="flex items-center justify-between mb-2 px-2">
 <h3 class="text-sm font-bold text-slate-200">Scheduled Consultations</h3>
 <span class="px-2 py-0.5 bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 rounded text-[12px] font-bold font-medium">
 <?php echo e($consultations->count()); ?> Sessions Today
 </span>
 </div>

 <div class="space-y-4">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $consultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="bg-[#2a2e38] rounded-xl border border-subtle p-6 hover:border-blue-500/40 transition-all group relative overflow-hidden">
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
 <div class="flex items-center gap-6">
 <div class="w-16 h-16 rounded-lg bg-sage/10 text-sage flex items-center justify-center border border-blue-500/20 group-hover:bg-sage group-hover:text-white transition-all duration-300">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
 </div>
 <div>
 <h3 class="text-lg font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors"><?php echo e($c->full_name); ?></h3>
 <p class="text-[12px] font-bold text-slate-500 font-medium mt-1"><?php echo e($c->medical_id); ?> • Scheduled: <?php echo e(\Carbon\Carbon::parse($c->scheduled_at)->format('H:i')); ?></p>
 </div>
 </div>
 <div class="flex flex-col md:items-end gap-3 w-full md:w-auto">
 <span class="px-3 py-1 bg-sage/10 text-sage border border-blue-500/20 rounded-lg text-[12px] font-bold font-medium text-center"><?php echo e($c->status); ?></span>
 <a href="<?php echo e($c->meeting_link); ?>" target="_blank" class="px-6 py-2 bg-sage hover:bg-sage text-white rounded-lg text-[12px] font-bold font-medium transition-all /10 text-center">
 Join Video Call
 </a>
 </div>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <div class="bg-[#2a2e38] rounded-xl border border-subtle p-16 text-center ">
 <svg class="mx-auto h-12 w-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
 <p class="mt-4 text-sm text-slate-500 font-medium">No active virtual consultations.</p>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>

 <!-- System Stats Sidebar -->
 <div class="lg:col-span-1 space-y-6">
 <div class="bg-[#2a2e38] rounded-xl p-8 border border-subtle relative overflow-hidden">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-8">Connection Quality</p>
 <div class="flex items-end gap-2 mb-8">
 <span class="text-5xl font-bold text-white tracking-tight">99.9</span>
 <span class="text-xl font-bold text-sage mb-1">%</span>
 </div>
 <div class="space-y-4">
 <div class="flex justify-between items-center">
 <span class="text-[12px] font-bold text-slate-500 font-medium">Network Latency:</span>
 <div class="flex items-center gap-2">
 <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
 <span class="text-[12px] font-bold text-emerald-500 font-medium">12ms (Excellent)</span>
 </div>
 </div>
 <div class="w-full bg-card h-1.5 rounded-full overflow-hidden border border-slate-700/50">
 <div class="bg-sage h-full w-[99.9%]"></div>
 </div>
 </div>
 <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-sage/5 rounded-full blur-2xl"></div>
 </div>

 <div class="bg-[#2a2e38] p-8 rounded-xl border border-subtle ">
 <p class="text-[12px] font-bold text-slate-500 font-medium mb-4">Unit Availability</p>
 <div class="flex items-center gap-3">
 <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></div>
 <span class="text-sm font-bold text-white uppercase tracking-tight">Tele-Station 01 Active</span>
 </div>
 </div>
 </div>
 </div>
</div>

<!-- Modal: Schedule Call -->
<div id="scheduleModal" class="fixed inset-0 bg-card/80 z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-[#2a2e38] w-full max-w-xl rounded-xl p-8 border border-subtle">
 <h3 class="text-xl font-bold text-white mb-8 uppercase flex items-center gap-3">
 <div class="w-2 h-2 bg-sage rounded-full animate-pulse"></div>
 Schedule Telemedicine Call
 </h3>
 <form method="POST" action="<?php echo e(route('telemedicine.schedule')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Patient Medical ID</label>
 <input type="text" name="patient_id" required placeholder="Enter Patient ID..." class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Scheduled Date & Time</label>
 <input type="datetime-local" name="scheduled_at" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 <div class="flex gap-4 mt-8 pt-6 border-t border-subtle">
 <button type="button" onclick="document.getElementById('scheduleModal').classList.add('hidden')" class="flex-1 py-3 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-bold transition-all">Cancel</button>
 <button type="submit" class="flex-1 py-3 bg-sage hover:bg-sage text-white rounded-lg text-sm font-bold transition-all /20">Confirm Schedule</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\telemedicine\index.blade.php ENDPATH**/ ?>
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


<?php $__env->startSection('title', 'Staff Training & Compliance - Opeshis OS'); ?>


<div class="space-y-8 animate-fade-in">
 <!-- Header: Institutional Excellence -->
 <header class="flex justify-between items-center mb-10 pb-8 border-b border-subtle">
 <div>
 <h1 class="text-3xl font-semibold text-white tracking-tight uppercase">Training & Development</h1>
 <p class="text-[12px] font-semibold text-slate-400 font-medium mt-1">Institutional Courses, Sessions & Compliance Matrices</p>
 </div>
 <div class="flex gap-4">
 <div class="flex items-center gap-6 px-8 py-3 bg-card rounded-2xl border border-subtle">
 <div class="text-center">
 <p class="text-[8px] font-semibold text-emerald-500 font-medium mb-1">Active Courses</p>
 <p class="text-xl font-semibold text-emerald-500 leading-none"><?php echo e($courses->count()); ?></p>
 </div>
 <div class="w-px h-8 bg-white/10"></div>
 <div class="text-center">
 <p class="text-[8px] font-semibold text-sage font-medium mb-1">Scheduled Sessions</p>
 <p class="text-xl font-semibold text-sage leading-none"><?php echo e($sessions->count()); ?></p>
 </div>
 </div>
 <button onclick="document.getElementById('courseModal').classList.remove('hidden')" class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-semibold text-[12px] font-medium /20 hover:bg-emerald-700 transition-all border border-emerald-500/50">
 Initialize Course
 </button>
 </div>
 </header>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-xs font-semibold font-medium mb-8 animate-pulse">
 <?php echo e(session('success')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
 <!-- Courses Matrix -->
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Educational Catalog</h3>
 <span class="text-[8px] font-semibold text-slate-500 font-medium">Institutional Core</span>
 </div>
 <div class="divide-y divide-white/5">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="px-10 py-6 flex justify-between items-center group hover:bg-[#2a2e38] transition-all">
 <div class="flex items-center gap-4">
 <div class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-500 border border-emerald-500/20">
 <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
 </div>
 <div>
 <div class="text-sm font-semibold text-white uppercase group-hover:text-emerald-400 transition-colors"><?php echo e($c->title); ?></div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-0.5">Target: <?php echo e($c->target_role); ?></div>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->mandatory): ?>
 <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 text-[8px] font-semibold rounded-lg font-medium">Mandatory</span>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($courses->isEmpty()): ?>
 <div class="px-10 py-20 text-center text-slate-600 text-[12px] font-semibold font-medium">No active courses in the catalog.</div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>

 <!-- Sessions Timeline -->
 <div class="bg-card rounded-[3rem] border border-subtle shadow-lg overflow-hidden">
 <div class="px-10 py-8 border-b border-subtle bg-[#2a2e38] flex justify-between items-center">
 <h3 class="text-xs font-semibold text-white font-medium ">Upcoming Sessions</h3>
 <span class="text-[8px] font-semibold text-slate-500 font-medium">Live Timeline</span>
 </div>
 <div class="divide-y divide-white/5">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="px-10 py-6 flex items-center gap-6 group hover:bg-[#2a2e38] transition-all">
 <div class="text-center min-w-[60px]">
 <p class="text-lg font-semibold text-white leading-none"><?php echo e(\Carbon\Carbon::parse($s->session_date)->format('d')); ?></p>
 <p class="text-[8px] font-semibold text-sage font-medium mt-1"><?php echo e(\Carbon\Carbon::parse($s->session_date)->format('M')); ?></p>
 </div>
 <div class="w-px h-10 bg-white/10"></div>
 <div>
 <div class="text-sm font-semibold text-white uppercase"><?php echo e($s->course_title); ?></div>
 <div class="text-[12px] font-bold text-slate-500 font-medium mt-0.5"><?php echo e($s->venue); ?> · <?php echo e(\Carbon\Carbon::parse($s->session_date)->format('H:i')); ?></div>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sessions->isEmpty()): ?>
 <div class="px-10 py-20 text-center text-slate-600 text-[12px] font-semibold font-medium">No training sessions scheduled.</div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 </div>
 </div>
</div>

<!-- Modal: Create Course -->
<div id="courseModal" class="fixed inset-0 bg-card z-[100] hidden flex items-center justify-center p-8">
 <div class="bg-card w-full max-w-xl rounded-[3rem] p-12 border border-subtle">
 <h3 class="text-2xl font-semibold text-white mb-8 uppercase tracking-tight">Institutional Course Creation</h3>
 <form method="POST" action="<?php echo e(url('/admin/training/course')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2 tracking-wider">Course Title</label>
 <input name="title" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-emerald-500/50 transition-all">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2 tracking-wider">Target Staff Role</label>
 <input name="target_role" required class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-emerald-500/50 transition-all" placeholder="e.g. Clinical Staff, Admin, All">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-400 uppercase mb-2 tracking-wider">Compliance Status</label>
 <select name="mandatory" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none">
 <option value="yes">Mandatory Compliance</option>
 <option value="no">Optional Development</option>
 </select>
 </div>
 <div class="flex gap-4 mt-8">
 <button type="button" onclick="document.getElementById('courseModal').classList.add('hidden')" class="flex-1 py-5 bg-[#2a2e38] border border-subtle text-slate-400 rounded-2xl text-[12px] font-semibold font-medium">Cancel</button>
 <button type="submit" class="flex-1 py-5 bg-emerald-600 text-white rounded-2xl text-[12px] font-semibold font-medium /20">Authorize Course</button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\admin\training.blade.php ENDPATH**/ ?>
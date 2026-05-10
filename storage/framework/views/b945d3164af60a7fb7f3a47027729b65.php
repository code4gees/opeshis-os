<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Patient Registry | Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Patient Registry | Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-[1600px] mx-auto pb-10">


 <div class="flex items-center justify-between mb-6">
 <div>
 <h1 class="text-xl font-semibold text-white">Patient Registry</h1>
 <p class="text-[12px] text-slate-400 mt-0.5">Master Patient Index · Institutional Archive</p>
 </div>
 <button onclick="document.getElementById('enrollModal').classList.remove('hidden')"
 class="flex items-center gap-2 px-4 py-2.5 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 <i class="fas fa-user-plus text-[12px]"></i>
 Register New Patient
 </button>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="mb-5 px-4 py-3 bg-sage/10 border border-sage/20 text-sage rounded-lg text-[12px] flex items-center gap-2">
 <i class="fas fa-check-circle text-[12px]"></i> <?php echo e(session('success')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


 <div class="bg-card rounded-xl border border-subtle p-5 mb-6">
 <form method="GET" class="flex items-end gap-4">
 <div class="flex-1">
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Search Archive</label>
 <div class="relative">
 <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-[12px]"></i>
 <input type="text" name="q" value="<?php echo e($search); ?>"
 class="w-full bg-[#16191f] border border-subtle rounded-lg pl-10 pr-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors placeholder-slate-600"
 placeholder="Enter Patient Name, Medical ID, or Phone Number...">
 </div>
 </div>
 <button type="submit"
 class="px-5 py-2.5 bg-[#2a2e38] border border-subtle text-slate-300 rounded-lg text-[12px] font-medium hover:text-white transition-colors flex items-center gap-2">
 <i class="fas fa-filter text-[12px]"></i> Search
 </button>
 </form>
 </div>


 <div class="bg-card rounded-xl border border-subtle overflow-hidden">
 <div class="px-6 py-4 border-b border-subtle flex items-center justify-between">
 <h2 class="text-[14px] font-medium text-white flex items-center gap-2">
 <i class="fas fa-database text-sage text-[12px]"></i>
 Master Patient Index
 </h2>
 <span class="px-2.5 py-1 rounded-md bg-sage/10 text-sage text-[12px] font-medium border border-sage/20">
 <?php echo e($patients->total()); ?> records
 </span>
 </div>

 <div class="overflow-x-auto">
 <table class="w-full text-left">
 <thead class="border-b border-subtle bg-[#1a1d24]/50">
 <tr>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Patient Identity</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Contact Channel</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Gender</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400">Registered</th>
 <th class="px-6 py-3 text-[12px] font-medium text-slate-400 text-right">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-subtle">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="<?php echo e($loop->even ? 'bg-[#1a1d24]/30' : 'bg-transparent'); ?> hover:bg-[#2a2e38] transition-colors group">

 <td class="px-6 py-3.5">
 <div class="flex items-center gap-3">
 <div class="w-8 h-8 rounded-full bg-sage/10 border border-sage/20 flex items-center justify-center text-sage text-[12px] font-bold shrink-0">
 <?php echo e(strtoupper(substr($p->full_name ?? 'P', 0, 1))); ?>

 </div>
 <div>
 <div class="text-[12px] font-medium text-slate-200 group-hover:text-white transition-colors">
 <?php echo e($p->full_name); ?>

 </div>
 <div class="text-[12px] text-slate-500 font-mono">
 <?php echo e($p->medical_id); ?>

 </div>
 </div>
 </div>
 </td>

 <td class="px-6 py-3.5">
 <div class="text-[12px] text-slate-300">
 <?php echo e($p->phone ?: 'Unspecified'); ?>

 </div>
 <div class="text-[12px] text-slate-500">
 <?php echo e($p->email ?: 'No Email'); ?>

 </div>
 </td>

 <td class="px-6 py-3.5">
 <span class="px-2.5 py-1 rounded-md text-[12px] font-medium
 <?php echo e(strtolower($p->gender) === 'male' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/20'
 : (strtolower($p->gender) === 'female' ? 'bg-pink-500/10 text-pink-400 border border-pink-500/20'
 : 'bg-[#313642] text-slate-300 border border-subtle')); ?>">
 <?php echo e(ucfirst($p->gender)); ?>

 </span>
 </td>

 <td class="px-6 py-3.5">
 <div class="text-[12px] text-slate-400">
 <?php echo e($p->created_at->format('M d, Y')); ?>

 </div>
 </td>

 <td class="px-6 py-3.5 text-right">
 <a href="<?php echo e(route('patients.show', $p->id)); ?>"
 class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#2a2e38] border border-subtle text-sage rounded-md text-[12px] font-medium hover:bg-sage hover:text-[#16191f] hover:border-sage transition-all opacity-0 group-hover:opacity-100">
 <i class="fas fa-id-card text-[12px]"></i> Profile
 </a>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="5" class="px-6 py-16 text-center">
 <div class="w-14 h-14 rounded-full bg-[#2a2e38] flex items-center justify-center mx-auto mb-3">
 <i class="fas fa-search text-slate-600 text-lg"></i>
 </div>
 <p class="text-[13px] font-medium text-slate-400">No patients found</p>
 <p class="text-[12px] text-slate-600 mt-1">Adjust search criteria or register a new patient</p>
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($patients->hasPages()): ?>
 <div class="px-6 py-4 border-t border-subtle bg-[#1a1d24]/50">
 <?php echo e($patients->links()); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
</div>


<div id="enrollModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-6">
 <div class="bg-card w-full max-w-lg rounded-2xl border border-subtle shadow-2xl">
 <div class="px-6 py-5 border-b border-subtle flex items-center justify-between">
 <h3 class="text-[15px] font-semibold text-white">Register Patient</h3>
 <button onclick="document.getElementById('enrollModal').classList.add('hidden')"
 class="w-8 h-8 rounded-lg bg-[#2a2e38] flex items-center justify-center text-slate-400 hover:text-white transition-colors">
 <i class="fas fa-times text-[12px]"></i>
 </button>
 </div>
 <form method="POST" action="<?php echo e(route('patients.register')); ?>" class="p-6 space-y-4">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Full Legal Name</label>
 <div class="relative">
 <i class="fas fa-id-badge absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-[12px]"></i>
 <input name="full_name" required
 class="w-full bg-[#16191f] border border-subtle rounded-lg pl-10 pr-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors placeholder-slate-600"
 placeholder="Surname, First Name">
 </div>
 </div>

 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Biological Gender</label>
 <div class="relative">
 <i class="fas fa-venus-mars absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-[12px]"></i>
 <select name="gender" required
 class="w-full bg-[#16191f] border border-subtle rounded-lg pl-10 pr-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors">
 <option value="Male">Male</option>
 <option value="Female">Female</option>
 <option value="Other">Other</option>
 </select>
 </div>
 </div>

 <div>
 <label class="block text-[12px] font-medium text-slate-400 mb-1.5">Primary Contact</label>
 <div class="relative">
 <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-[12px]"></i>
 <input name="phone"
 class="w-full bg-[#16191f] border border-subtle rounded-lg pl-10 pr-4 py-2.5 text-[13px] text-white outline-none focus:border-sage/50 transition-colors placeholder-slate-600"
 placeholder="+237 ...">
 </div>
 </div>
 </div>

 <div class="flex gap-3 pt-2">
 <button type="button" onclick="document.getElementById('enrollModal').classList.add('hidden')"
 class="flex-1 py-2.5 bg-[#2a2e38] border border-subtle text-slate-300 rounded-lg text-[12px] font-medium hover:text-white transition-colors">
 Discard
 </button>
 <button type="submit"
 class="flex-1 py-2.5 bg-sage text-[#16191f] rounded-lg text-[12px] font-semibold hover:opacity-90 transition-opacity">
 Authorize Registration
 </button>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\patients\index.blade.php ENDPATH**/ ?>
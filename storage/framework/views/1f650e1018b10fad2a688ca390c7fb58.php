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


<?php $__env->startSection('title', 'Institutional Identity Verification - Opeshis OS'); ?>


<div class="min-h-[80vh] flex items-center justify-center p-8">
 <div class="bg-[#2a2e38] border border-subtle w-full max-w-md rounded-[2.5rem] p-12 relative overflow-hidden">
 <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-emerald-500 to-indigo-500"></div>

 <div class="mb-10 text-center">
 <h2 class="text-3xl font-semibold text-white uppercase tracking-tight mb-2">Verification</h2>
 <p class="text-xs font-bold text-slate-400 font-medium">Institutional Access Protocol</p>
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
 <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-500 rounded-2xl text-[12px] font-semibold font-medium text-center">
 <?php echo e(session('error')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <p class="text-[12px] text-slate-400 font-bold font-medium mb-8 text-center leading-relaxed">
 A secure authorization code has been dispatched to your institutional terminal. Enter it below to proceed.
 </p>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('last_otp_debug')): ?>
 <div class="mb-8 p-4 bg-sage/10 border border-indigo-500/20 text-sage rounded-2xl text-[12px] font-semibold font-medium text-center">
 DEBUG_HINT: <?php echo e(session('last_otp_debug')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <form method="POST" action="<?php echo e(url('/login/otp')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <input type="text" name="otp" placeholder="••••••" required maxlength="6"
 class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-8 py-5 text-2xl font-semibold text-center text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all tracking-[0.5em]">
 </div>

 <button type="submit" class="w-full py-5 bg-sage text-white rounded-2xl text-xs font-semibold font-medium /30 hover:bg-indigo-700 transition-all hover:scale-[1.02] active:scale-[0.98]">
 Authorize Session
 </button>
 </form>

 <div class="mt-10 text-center border-t border-subtle pt-8">
 <a href="<?php echo e(route('login')); ?>" class="text-[12px] font-semibold text-slate-500 font-medium hover:text-white transition">Return to Personnel Portal</a>
 </div>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\auth\otp.blade.php ENDPATH**/ ?>
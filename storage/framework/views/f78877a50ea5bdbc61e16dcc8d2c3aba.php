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


<?php $__env->startSection('title', 'System Settings - Opeshis OS'); ?>


<div class="max-w-7xl mx-auto space-y-8 animate-fade-in pb-20">
 
 <!-- Header -->
 <header class="flex flex-col md:flex-row justify-between items-start md:items-center bg-card border border-subtle rounded-xl p-6 ">
 <div>
 <h1 class="text-2xl font-bold text-white tracking-tight">System Settings</h1>
 <p class="text-sm text-slate-400 mt-1">Configure hospital identity, localization, and system-wide preferences.</p>
 </div>
 <div class="mt-4 md:mt-0 flex items-center gap-3">
 <span class="text-[12px] font-bold text-sage font-medium">System Version: 2.1.0-Elite</span>
 <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
 </div>
 </header>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-sm font-medium">
 System configuration updated successfully.
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <form method="POST" action="<?php echo e(route('settings.update')); ?>" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 <?php echo csrf_field(); ?>
 <div class="lg:col-span-2 space-y-8">
 
 <!-- Hospital Identity -->
 <div class="bg-[#2a2e38] rounded-xl p-8 border border-subtle ">
 <h3 class="text-sm font-bold text-slate-200 font-medium mb-8 border-b border-subtle pb-4">
 Hospital Information
 </h3>
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 <div class="md:col-span-2">
 <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Hospital Name</label>
 <input type="text" name="settings[hospital_name]" value="<?php echo e($settings['hospital_name'] ?? 'Opeshis General Hospital'); ?>" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Primary Email</label>
 <input type="email" name="settings[hospital_email]" value="<?php echo e($settings['hospital_email'] ?? 'contact@opeshis.com'); ?>" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Phone Number</label>
 <input type="text" name="settings[hospital_phone]" value="<?php echo e($settings['hospital_phone'] ?? '+237 000 000 000'); ?>" required class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 </div>
 </div>

 <!-- Localization -->
 <div class="bg-[#2a2e38] rounded-xl p-8 border border-subtle ">
 <h3 class="text-sm font-bold text-slate-200 font-medium mb-8 border-b border-subtle pb-4">
 Localization & Regional Settings
 </h3>
 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-2">System Currency</label>
 <select name="settings[currency_symbol]" class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 <option value="FCFA" <?php echo e(($settings['currency_symbol'] ?? '') === 'FCFA' ? 'selected' : ''); ?>>FCFA (XAF)</option>
 <option value="USD" <?php echo e(($settings['currency_symbol'] ?? '') === 'USD' ? 'selected' : ''); ?>>US Dollar (USD)</option>
 <option value="EUR" <?php echo e(($settings['currency_symbol'] ?? '') === 'EUR' ? 'selected' : ''); ?>>Euro (EUR)</option>
 </select>
 </div>
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Operational Mode</label>
 <select name="settings[multi_branch_mode]" class="w-full bg-card border border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 <option value="OFF" <?php echo e(($settings['multi_branch_mode'] ?? 'OFF') === 'OFF' ? 'selected' : ''); ?>>Single Facility</option>
 <option value="ON" <?php echo e(($settings['multi_branch_mode'] ?? 'OFF') === 'ON' ? 'selected' : ''); ?>>Multi-Branch (Enterprise)</option>
 </select>
 </div>
 </div>
 </div>
 </div>

 <!-- Branding Sidebar -->
 <div class="lg:col-span-1 space-y-8">
 <div class="bg-[#2a2e38] rounded-xl p-6 border border-subtle ">
 <h3 class="text-sm font-bold text-slate-200 font-medium mb-6">Hospital Branding</h3>
 <div class="space-y-6">
 <div>
 <label class="block text-xs font-bold text-slate-500 uppercase mb-3">Official Logo</label>
 <div class="w-full aspect-square bg-card rounded-lg border border-slate-700 border-dashed flex items-center justify-center overflow-hidden mb-4 p-4">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($settings['hospital_logo'])): ?>
 <img src="<?php echo e($settings['hospital_logo']); ?>" class="max-h-full max-w-full object-contain">
 <?php else: ?>
 <div class="text-center">
 <svg class="w-10 h-10 text-slate-700 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
 <span class="text-[12px] font-bold text-slate-600 uppercase">No Logo Uploaded</span>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>
 <input type="file" name="hospital_logo" class="w-full text-[12px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-[12px] file:font-bold file:bg-slate-700 file:text-slate-300 hover:file:bg-slate-600">
 </div>
 </div>
 </div>

 <button type="submit" class="w-full py-4 bg-sage hover:bg-sage text-white rounded-lg text-sm font-bold /20 transition-all border border-blue-500/50">
 Save System Settings
 </button>
 </div>
 </form>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\settings.blade.php ENDPATH**/ ?>
<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Central Inventory - Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Central Inventory - Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php $__env->startSection('title', 'Central Inventory | Operations'); ?>

<div class="max-w-7xl mx-auto space-y-6">

 <!-- Page Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-subtle pb-8">
 <div>
 <div class="flex items-center gap-2 text-[12px] font-semibold font-medium text-slate-500 mb-2">
 <i class="fas fa-boxes text-emerald-500/50"></i>
 <span>Operations</span>
 <span class="text-white/10">/</span>
 <span class="text-slate-300">Central Inventory</span>
 </div>
 <h1 class="text-4xl font-semibold text-white tracking-tighter uppercase">
 Inventory <span class="text-emerald-500">Control</span>
 </h1>
 </div>
 <div class="mt-6 md:mt-0">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['icon' => 'fa-plus-circle','onclick' => 'document.getElementById(\'inventoryModal\').classList.remove(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fa-plus-circle','onclick' => 'document.getElementById(\'inventoryModal\').classList.remove(\'hidden\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Record Stock
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2d350f6afc4d732ce961fba75ba7e203)): ?>
<?php $attributes = $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203; ?>
<?php unset($__attributesOriginal2d350f6afc4d732ce961fba75ba7e203); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2d350f6afc4d732ce961fba75ba7e203)): ?>
<?php $component = $__componentOriginal2d350f6afc4d732ce961fba75ba7e203; ?>
<?php unset($__componentOriginal2d350f6afc4d732ce961fba75ba7e203); ?>
<?php endif; ?>
 </div>
 </div>

 <!-- Error/Success Banners -->
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl text-sm font-bold flex items-center gap-3">
 <i class="fas fa-check-circle"></i>
 <?php echo e(session('success')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
 <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-4 rounded-xl text-sm font-bold flex items-center gap-3">
 <i class="fas fa-exclamation-triangle"></i>
 <?php echo e(session('error')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Stock Overview','icon' => 'fa-clipboard-list']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Stock Overview','icon' => 'fa-clipboard-list']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <div class="overflow-x-auto">
 <table class="w-full text-left border-collapse">
 <thead>
 <tr class="border-b border-subtle text-[12px] font-medium text-slate-500">
 <th class="p-3 font-bold">Item Name</th>
 <th class="p-3 font-bold">Category</th>
 <th class="p-3 font-bold">Location</th>
 <th class="p-3 font-bold text-center">Stock Level</th>
 <th class="p-3 font-bold">Actions</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-white/5">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="hover:bg-card transition-colors">
 <td class="p-3 text-sm text-slate-200 font-bold"><?php echo e($item->item_name); ?></td>
 <td class="p-3 text-xs text-slate-400"><?php echo e($item->category); ?></td>
 <td class="p-3 text-xs text-slate-400"><?php echo e($item->location); ?></td>
 <td class="p-3 text-center">
 <span class="px-2 py-1 rounded-md text-[12px] font-semibold font-medium <?php echo e($item->stock_level < 10 ? 'bg-rose-500/20 text-rose-400' : 'bg-emerald-500/20 text-emerald-400'); ?>">
 <?php echo e($item->stock_level); ?> Units
 </span>
 </td>
 <td class="p-3">
 <button class="text-xs text-sage hover:text-blue-300 font-bold font-medium" onclick="openActionModal(<?php echo e($item->id); ?>, '<?php echo e($item->item_name); ?>', <?php echo e($item->stock_level); ?>)">
 Update
 </button>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="5" class="p-8 text-center text-slate-500 text-xs font-bold font-medium">
 No Inventory Items Recorded
 </td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </tbody>
 </table>
 </div>
 <div class="mt-4">
 <?php echo e($items->links()); ?>

 </div>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4da797a88693fb589dd89646de275649)): ?>
<?php $attributes = $__attributesOriginal4da797a88693fb589dd89646de275649; ?>
<?php unset($__attributesOriginal4da797a88693fb589dd89646de275649); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4da797a88693fb589dd89646de275649)): ?>
<?php $component = $__componentOriginal4da797a88693fb589dd89646de275649; ?>
<?php unset($__componentOriginal4da797a88693fb589dd89646de275649); ?>
<?php endif; ?>
</div>

<!-- Quick Action Modal -->
<div id="actionModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 ">
 <div class="bg-card border border-subtle rounded-2xl w-full max-w-md p-6">
 <h3 class="text-xl font-semibold text-white mb-4 uppercase tracking-tight">Stock Update</h3>
 <p class="text-xs text-slate-400 mb-6 font-medium">Item: <span id="modalItemName" class="text-sage font-bold"></span></p>
 
 <form method="POST" action="<?php echo e(route('inventory.action')); ?>" class="space-y-4">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="item_id" id="modalItemId">
 
 <div>
 <label class="block text-[12px] font-semibold font-medium text-slate-500 mb-2">Action</label>
 <select name="action_type" class="w-full bg-[#2a2e38] border border-slate-700 rounded-xl p-3 text-sm text-white">
 <option value="restock">Restock (+)</option>
 <option value="dispatch">Dispatch (-)</option>
 </select>
 </div>
 
 <div>
 <label class="block text-[12px] font-semibold font-medium text-slate-500 mb-2">Quantity</label>
 <input type="number" name="quantity" min="1" required class="w-full bg-[#2a2e38] border border-slate-700 rounded-xl p-3 text-sm text-white" placeholder="Enter amount">
 </div>

 <div>
 <label class="block text-[12px] font-semibold font-medium text-slate-500 mb-2">Reason / Reference</label>
 <input type="text" name="reason" class="w-full bg-[#2a2e38] border border-slate-700 rounded-xl p-3 text-sm text-white" placeholder="Optional reference note">
 </div>

 <div class="flex gap-3 mt-6">
 <button type="button" onclick="document.getElementById('actionModal').classList.add('hidden')" class="flex-1 py-3 bg-[#2a2e38] hover:bg-slate-700 rounded-xl text-xs font-bold text-white font-medium transition-colors">
 Cancel
 </button>
 <button type="submit" class="flex-1 py-3 bg-sage hover:bg-sage rounded-xl text-xs font-bold text-white font-medium transition-colors">
 Confirm
 </button>
 </div>
 </form>
 </div>
</div>

<script>
 function openActionModal(id, name, currentStock) {
 document.getElementById('modalItemId').value = id;
 document.getElementById('modalItemName').innerText = name + ' (Current: ' + currentStock + ')';
 document.getElementById('actionModal').classList.remove('hidden');
 }
</script>

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
<?php /**PATH C:\laragon\www\opeshis\resources\views\operations\inventory.blade.php ENDPATH**/ ?>
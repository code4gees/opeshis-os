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


<?php $__env->startSection('title', 'Pediatrics Command - Opeshis OS'); ?>


<div class="space-y-8 pb-20">

 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-white uppercase tracking-tighter">Pediatric Clinical Hub</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Inpatient Pediatric Census & Monitoring</p>
 </div>
 <div class="flex gap-3">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['icon' => 'fa-plus-circle','onclick' => 'document.getElementById(\'admitModal\').classList.remove(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fa-plus-circle','onclick' => 'document.getElementById(\'admitModal\').classList.remove(\'hidden\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Authorize Intake
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

 <!-- Ward KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Ward Occupancy','value' => ''.e($stats['active']).'','icon' => 'fa-bed','trend' => 'Active Census','color' => 'indigo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Ward Occupancy','value' => ''.e($stats['active']).'','icon' => 'fa-bed','trend' => 'Active Census','color' => 'indigo']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $attributes = $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $component = $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Pending Orders','value' => ''.e($stats['pending_orders']).'','icon' => 'fa-clipboard-check','trend' => 'Needs Attention','color' => 'amber']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pending Orders','value' => ''.e($stats['pending_orders']).'','icon' => 'fa-clipboard-check','trend' => 'Needs Attention','color' => 'amber']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $attributes = $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $component = $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Stability Index','value' => '98.5%','icon' => 'fa-heart-pulse','trend' => 'Protocol Standard','color' => 'emerald']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Stability Index','value' => '98.5%','icon' => 'fa-heart-pulse','trend' => 'Protocol Standard','color' => 'emerald']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $attributes = $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $component = $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Unit Protocol','value' => 'Level II','icon' => 'fa-shield-halved','trend' => 'Active Monitoring','color' => 'slate']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Unit Protocol','value' => 'Level II','icon' => 'fa-shield-halved','trend' => 'Active Monitoring','color' => 'slate']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $attributes = $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43)): ?>
<?php $component = $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43; ?>
<?php unset($__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43); ?>
<?php endif; ?>
 </div>

 <!-- Census Matrix -->
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Inpatient Pediatric Census','icon' => 'fa-users-viewfinder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Inpatient Pediatric Census','icon' => 'fa-users-viewfinder']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

  <?php $__env->slot('action', null, []); ?>
 <span class="px-2 py-0.5 bg-sage/10 text-sage border border-indigo-500/20 rounded text-[12px] font-semibold font-medium">Active Monitoring</span>
  <?php $__env->endSlot(); ?>

 <?php if (isset($component)) { $__componentOriginal11958e14de982b4883e7282860cbd101 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal11958e14de982b4883e7282860cbd101 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-table','data' => ['headers' => ['Patient Identity', 'Age / Growth', 'Ward / Bed', 'Vital Stability', 'Operations']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Patient Identity', 'Age / Growth', 'Ward / Bed', 'Vital Stability', 'Operations'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $census; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="group hover:bg-card transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-sage/10 flex items-center justify-center border border-indigo-500/20 text-sage font-bold text-xs">
 <?php echo e(substr($c->patient->full_name, 0, 1)); ?>

 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors"><?php echo e($c->patient->full_name); ?></div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium"><?php echo e($c->patient->medical_id); ?></div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <div class="text-xs font-semibold text-slate-300 uppercase">
 <?php echo e($c->age_days < 365 ? $c->age_days." Days" : floor($c->age_days/365)." Years"); ?>

 </div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">Weight: <?php echo e($c->weight_kg); ?> kg</div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-center">
 <span class="px-3 py-1 bg-[#2a2e38] text-slate-400 border border-subtle rounded-lg text-[12px] font-semibold font-medium">
 <?php echo e($c->ward); ?> · Bed <?php echo e($c->bed_number); ?>

 </span>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <?php $spo2 = optional($c->latest_vitals)->spo2; ?>
 <div class="flex items-center gap-3">
 <span class="text-xs font-semibold <?php echo e($spo2 && $spo2 < 92 ? 'text-rose-500' : ($spo2 ? 'text-emerald-500' : 'text-slate-600')); ?>">
 <?php echo e($spo2 ? $spo2.'%' : '—'); ?>

 </span>
 <div class="w-12 h-1 bg-[#2a2e38] rounded-full overflow-hidden">
 <div class="h-full <?php echo e($spo2 && $spo2 < 92 ? 'bg-rose-500' : 'bg-emerald-500'); ?>" style="width: <?php echo e($spo2 ?: 0); ?>%"></div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <div class="flex justify-end gap-2">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-chart-line','onclick' => 'openVitals(\''.e($c->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-chart-line','onclick' => 'openVitals(\''.e($c->id).'\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Vitals
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
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-ruler-vertical','onclick' => 'openGrowth(\''.e($c->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-ruler-vertical','onclick' => 'openGrowth(\''.e($c->id).'\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Growth
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
 <form method="POST" action="<?php echo e(route('clinical.paeds.discharge', $c->id)); ?>" class="inline-block">
 <?php echo csrf_field(); ?>
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-door-open','color' => 'emerald']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-door-open','color' => 'emerald']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Discharge
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
 </form>
 </div>
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active paediatric admissions in the census.</td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal11958e14de982b4883e7282860cbd101)): ?>
<?php $attributes = $__attributesOriginal11958e14de982b4883e7282860cbd101; ?>
<?php unset($__attributesOriginal11958e14de982b4883e7282860cbd101); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal11958e14de982b4883e7282860cbd101)): ?>
<?php $component = $__componentOriginal11958e14de982b4883e7282860cbd101; ?>
<?php unset($__componentOriginal11958e14de982b4883e7282860cbd101); ?>
<?php endif; ?>
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

<!-- Modal: Intake Authorization -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'admitModal','title' => 'Intake Authorization','icon' => 'fa-hospital-user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'admitModal','title' => 'Intake Authorization','icon' => 'fa-hospital-user']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('clinical.paeds.admit')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div class="space-y-4">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Patient UUID</label>
 <input name="patient_id" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Current Weight (KG)</label>
 <input name="weight" type="number" step="0.1" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Ward Allocation</label>
 <input name="ward" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Bed Designation</label>
 <input name="bed_number" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Admitting Clinical Diagnosis</label>
 <textarea name="diagnosis" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none h-24 no-scrollbar"></textarea>
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Authorize Pediatric Intake <?php echo $__env->renderComponent(); ?>
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
 </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb33f26299501d7f3f1f86db35937b93)): ?>
<?php $attributes = $__attributesOriginaldb33f26299501d7f3f1f86db35937b93; ?>
<?php unset($__attributesOriginaldb33f26299501d7f3f1f86db35937b93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb33f26299501d7f3f1f86db35937b93)): ?>
<?php $component = $__componentOriginaldb33f26299501d7f3f1f86db35937b93; ?>
<?php unset($__componentOriginaldb33f26299501d7f3f1f86db35937b93); ?>
<?php endif; ?>

<!-- Modal: Vitals Logging -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'vitalsModal','title' => 'Clinical Vitals Matrix','icon' => 'fa-chart-line']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'vitalsModal','title' => 'Clinical Vitals Matrix','icon' => 'fa-chart-line']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('clinical.paeds.vitals')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="admission_id" id="vitalsId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Temp (°C)</label>
 <input name="temperature" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Heart Rate (BPM)</label>
 <input name="heart_rate" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Resp Rate</label>
 <input name="resp_rate" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">SpO₂ (%)</label>
 <input name="spo2" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600">
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Record Vitals <?php echo $__env->renderComponent(); ?>
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
 </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb33f26299501d7f3f1f86db35937b93)): ?>
<?php $attributes = $__attributesOriginaldb33f26299501d7f3f1f86db35937b93; ?>
<?php unset($__attributesOriginaldb33f26299501d7f3f1f86db35937b93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb33f26299501d7f3f1f86db35937b93)): ?>
<?php $component = $__componentOriginaldb33f26299501d7f3f1f86db35937b93; ?>
<?php unset($__componentOriginaldb33f26299501d7f3f1f86db35937b93); ?>
<?php endif; ?>

<!-- Modal: Growth Monitoring -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'growthModal','title' => 'Growth Telemetry','icon' => 'fa-ruler-vertical']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'growthModal','title' => 'Growth Telemetry','icon' => 'fa-ruler-vertical']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('clinical.paeds.growth')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="admission_id" id="growthId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Weight (KG)</label>
 <input name="weight" step="0.01" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Height (CM)</label>
 <input name="height" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Head Circ (CM)</label>
 <input name="hc" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">MUAC (CM)</label>
 <input name="muac" step="0.1" type="number" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-amber-600">
 </div>
 </div>
 <div class="flex gap-3 pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Save Growth Data <?php echo $__env->renderComponent(); ?>
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
 </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb33f26299501d7f3f1f86db35937b93)): ?>
<?php $attributes = $__attributesOriginaldb33f26299501d7f3f1f86db35937b93; ?>
<?php unset($__attributesOriginaldb33f26299501d7f3f1f86db35937b93); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb33f26299501d7f3f1f86db35937b93)): ?>
<?php $component = $__componentOriginaldb33f26299501d7f3f1f86db35937b93; ?>
<?php unset($__componentOriginaldb33f26299501d7f3f1f86db35937b93); ?>
<?php endif; ?>

<script>
function openVitals(id){ document.getElementById('vitalsId').value=id; document.getElementById('vitalsModal').classList.remove('hidden'); }
function openGrowth(id){ document.getElementById('growthId').value=id; document.getElementById('growthModal').classList.remove('hidden'); }
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\paeds.blade.php ENDPATH**/ ?>
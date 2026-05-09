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


<?php $__env->startSection('title', 'Maternal Health Command - Opeshis OS'); ?>


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-white uppercase tracking-tighter">Maternal & Obstetrics</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Reproductive Health Command</p>
 </div>
 <div class="flex gap-3">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['icon' => 'fa-plus','onclick' => 'document.getElementById(\'ancModal\').classList.remove(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fa-plus','onclick' => 'document.getElementById(\'ancModal\').classList.remove(\'hidden\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 ANC Enrollment
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','icon' => 'fa-baby','onclick' => 'document.getElementById(\'birthModal\').classList.remove(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','icon' => 'fa-baby','onclick' => 'document.getElementById(\'birthModal\').classList.remove(\'hidden\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Record Delivery
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

 <!-- Specialty KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Active ANC Tracking','value' => ''.e($ancPatients->count()).'','icon' => 'fa-person-pregnant','trend' => 'Prenatal Queue','color' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Active ANC Tracking','value' => ''.e($ancPatients->count()).'','icon' => 'fa-person-pregnant','trend' => 'Prenatal Queue','color' => 'blue']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Recent Births','value' => ''.e($recentBirths->count()).'','icon' => 'fa-baby-carriage','trend' => 'Last 30 Days','color' => 'emerald']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Recent Births','value' => ''.e($recentBirths->count()).'','icon' => 'fa-baby-carriage','trend' => 'Last 30 Days','color' => 'emerald']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Ward Admissions','value' => ''.e($activeAdmissions->count()).'','icon' => 'fa-bed-pulse','trend' => 'Postnatal/Obstetric','color' => 'rose']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Ward Admissions','value' => ''.e($activeAdmissions->count()).'','icon' => 'fa-bed-pulse','trend' => 'Postnatal/Obstetric','color' => 'rose']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Safety Protocol','value' => '99.9%','icon' => 'fa-shield-heart','trend' => 'Institutional Standard','color' => 'amber']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Safety Protocol','value' => '99.9%','icon' => 'fa-shield-heart','trend' => 'Institutional Standard','color' => 'amber']); ?>
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

 <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 <!-- Main Column: ANC Registry -->
 <div class="lg:col-span-2 space-y-8">
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Antenatal Care Waitlist','icon' => 'fa-clipboard-list']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Antenatal Care Waitlist','icon' => 'fa-clipboard-list']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

  <?php $__env->slot('action', null, []); ?> 
 <span class="px-2 py-0.5 bg-sage/10 text-sage border border-blue-500/20 rounded text-[12px] font-semibold font-medium">Active Monitoring</span>
  <?php $__env->endSlot(); ?>

 <?php if (isset($component)) { $__componentOriginal11958e14de982b4883e7282860cbd101 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal11958e14de982b4883e7282860cbd101 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-table','data' => ['headers' => ['Patient Identity', 'Gestation Status', 'EDD Prediction', 'Operations']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Patient Identity', 'Gestation Status', 'EDD Prediction', 'Operations'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $ancPatients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="group hover:bg-card transition-colors">
 <td class="whitespace-nowrap px-5 py-4">
 <div class="flex items-center">
 <div class="h-9 w-9 flex-shrink-0 rounded-full bg-sage/10 flex items-center justify-center border border-blue-500/20 text-sage font-bold text-xs">
 <?php echo e(substr($anc->patient->full_name, 0, 1)); ?>

 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors"><?php echo e($anc->patient->full_name); ?></div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium"><?php echo e($anc->patient->medical_id); ?></div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <div class="text-xs font-semibold text-slate-300 uppercase tracking-tight">G<?php echo e($anc->gravida); ?> • P<?php echo e($anc->parity); ?></div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">LMP: <?php echo e(\Carbon\Carbon::parse($anc->lmp_date)->format('d M, Y')); ?></div>
 </td>
 <td class="whitespace-nowrap px-5 py-4">
 <?php $isPast = \Carbon\Carbon::parse($anc->edd_date)->isPast(); ?>
 <div class="text-xs font-semibold <?php echo e($isPast ? 'text-rose-500' : 'text-sage'); ?> uppercase">
 <?php echo e(\Carbon\Carbon::parse($anc->edd_date)->format('d M, Y')); ?>

 </div>
 <div class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">
 <?php echo e($isPast ? 'Overdue' : \Carbon\Carbon::parse($anc->edd_date)->diffForHumans()); ?>

 </div>
 </td>
 <td class="whitespace-nowrap px-5 py-4 text-right">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-file-medical','href' => ''.e(route('emr', $anc->patient_id)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-file-medical','href' => ''.e(route('emr', $anc->patient_id)).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Open Chart
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
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="4" class="px-6 py-12 text-center text-slate-600 text-sm">No active ANC tracking records found.</td>
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

 <!-- Right Column: Recent Deliveries & Admissions -->
 <div class="space-y-8">
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Institutional Birth Registry','icon' => 'fa-baby']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Institutional Birth Registry','icon' => 'fa-baby']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <div class="space-y-4">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentBirths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="p-4 rounded-xl bg-card border border-subtle hover:border-blue-500/30 transition-all group">
 <div class="flex justify-between items-start">
 <div class="flex gap-3">
 <div class="w-10 h-10 rounded-lg <?php echo e($birth->gender === 'Female' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-sage/10 text-sage border-blue-500/20'); ?> flex items-center justify-center font-bold text-sm border">
 <?php echo e(substr($birth->gender, 0, 1)); ?>

 </div>
 <div>
 <h4 class="text-xs font-semibold text-slate-200 uppercase tracking-tight group-hover:text-sage transition-colors"><?php echo e($birth->baby_name ?: 'Neonatal Subject'); ?></h4>
 <p class="text-[12px] font-bold text-slate-500 uppercase mt-0.5">Mother: <?php echo e($birth->mother->full_name); ?></p>
 </div>
 </div>
 <span class="text-[12px] font-semibold text-slate-600 uppercase"><?php echo e(\Carbon\Carbon::parse($birth->birth_datetime)->diffForHumans(null, true)); ?></span>
 </div>
 <div class="mt-4 flex items-center justify-between pt-3 border-t border-subtle">
 <span class="text-[12px] font-semibold text-sage font-medium"><?php echo e($birth->weight_kg); ?> KG</span>
 <span class="text-[12px] font-bold text-slate-500 uppercase "><?php echo e($birth->delivery_type); ?></span>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <div class="py-12 text-center">
 <p class="text-xs font-bold text-slate-600 font-medium">Registry Vacuum</p>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
 </div>
</div>

<!-- Modal: ANC Registration -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'ancModal','title' => 'ANC Enrollment','icon' => 'fa-person-pregnant']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'ancModal','title' => 'ANC Enrollment','icon' => 'fa-person-pregnant']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('maternal.anc.register')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div class="space-y-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Mother's Medical Identity</label>
 <input type="text" name="patient_id" required placeholder="Search Patient UUID..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">LMP Date</label>
 <input type="date" name="lmp_date" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all">
 </div>
 <div class="grid grid-cols-2 gap-3">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Gravida</label>
 <input type="number" name="gravida" value="1" min="1" class="w-full bg-card/50 border border-subtle rounded-xl px-3 py-3 text-sm font-bold text-slate-200 outline-none">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Parity</label>
 <input type="number" name="parity" value="0" min="0" class="w-full bg-card/50 border border-subtle rounded-xl px-3 py-3 text-sm font-bold text-slate-200 outline-none">
 </div>
 </div>
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
Initialize ANC Profile <?php echo $__env->renderComponent(); ?>
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

<!-- Modal: Birth Record -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'birthModal','title' => 'Neonatal Registry','icon' => 'fa-baby']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'birthModal','title' => 'Neonatal Registry','icon' => 'fa-baby']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('maternal.birth.record')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div class="space-y-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Mother's Medical Identity</label>
 <input type="text" name="mother_id" required placeholder="Mother's UUID..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600 transition-all uppercase">
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Neonatal Name</label>
 <input type="text" name="baby_name" placeholder="Baby of..." class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Gender</label>
 <select name="gender" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 <option value="Male">Male</option>
 <option value="Female">Female</option>
 <option value="Indeterminate">Indeterminate</option>
 </select>
 </div>
 </div>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Time of Delivery</label>
 <input type="datetime-local" name="birth_datetime" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Weight (KG)</label>
 <input type="number" step="0.01" name="weight" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-blue-600">
 </div>
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
Finalize Birth Record <?php echo $__env->renderComponent(); ?>
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
>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal)): ?>
<?php $attributes = $__attributesOriginal; ?>
<?php unset($__attributesOriginal); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal)): ?>
<?php $component = $__componentOriginal; ?>
<?php unset($__componentOriginal); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\opeshis\resources\views\maternal\index.blade.php ENDPATH**/ ?>
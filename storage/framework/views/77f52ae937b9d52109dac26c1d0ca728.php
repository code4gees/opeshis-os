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


<?php $__env->startSection('title', 'Epidemiological Surveillance — Opeshis OS'); ?>


<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-slate-200 uppercase tracking-tighter">Surveillance Command</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional IDSR Surveillance · Outbreak Intelligence · Contact Tracing Matrix</p>
 </div>
 <div class="flex gap-3">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['icon' => 'fa-file-medical','color' => 'rose','variant' => 'ghost','onclick' => 'document.getElementById(\'reportModal\').classList.remove(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fa-file-medical','color' => 'rose','variant' => 'ghost','onclick' => 'document.getElementById(\'reportModal\').classList.remove(\'hidden\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Report IDSR Protocol
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
 <div class="flex gap-2">
 <form action="<?php echo e(url('/clinical/surveillance/weekly')); ?>" method="POST"><?php echo csrf_field(); ?><?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','size' => 'sm','color' => 'slate','variant' => 'ghost','icon' => 'fa-calendar-week']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','size' => 'sm','color' => 'slate','variant' => 'ghost','icon' => 'fa-calendar-week']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Weekly Report <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2d350f6afc4d732ce961fba75ba7e203)): ?>
<?php $attributes = $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203; ?>
<?php unset($__attributesOriginal2d350f6afc4d732ce961fba75ba7e203); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2d350f6afc4d732ce961fba75ba7e203)): ?>
<?php $component = $__componentOriginal2d350f6afc4d732ce961fba75ba7e203; ?>
<?php unset($__componentOriginal2d350f6afc4d732ce961fba75ba7e203); ?>
<?php endif; ?></form>
 <form action="<?php echo e(url('/clinical/surveillance/moh')); ?>" method="POST"><?php echo csrf_field(); ?><?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','size' => 'sm','color' => 'slate','variant' => 'ghost','icon' => 'fa-paper-plane']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','size' => 'sm','color' => 'slate','variant' => 'ghost','icon' => 'fa-paper-plane']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Dispatch MOH <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2d350f6afc4d732ce961fba75ba7e203)): ?>
<?php $attributes = $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203; ?>
<?php unset($__attributesOriginal2d350f6afc4d732ce961fba75ba7e203); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2d350f6afc4d732ce961fba75ba7e203)): ?>
<?php $component = $__componentOriginal2d350f6afc4d732ce961fba75ba7e203; ?>
<?php unset($__componentOriginal2d350f6afc4d732ce961fba75ba7e203); ?>
<?php endif; ?></form>
 </div>
 </div>
 </div>

 <!-- Surveillance Intelligence KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Active Alerts','value' => ''.e(count($alerts)).'','icon' => 'fa-bell-exclamation','trend' => 'Institutional Log','color' => 'rose']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Active Alerts','value' => ''.e(count($alerts)).'','icon' => 'fa-bell-exclamation','trend' => 'Institutional Log','color' => 'rose']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Investigations','value' => ''.e(count($cases)).'','icon' => 'fa-microscope','trend' => 'Active Matrix','color' => 'indigo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Investigations','value' => ''.e(count($cases)).'','icon' => 'fa-microscope','trend' => 'Active Matrix','color' => 'indigo']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Weekly Yield','value' => ''.e($cases->where('created_at', '>=', now()->startOfWeek())->count()).'','icon' => 'fa-chart-line','trend' => 'Surveillance Pulse','color' => 'emerald']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Weekly Yield','value' => ''.e($cases->where('created_at', '>=', now()->startOfWeek())->count()).'','icon' => 'fa-chart-line','trend' => 'Surveillance Pulse','color' => 'emerald']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Registry Pulse','value' => 'Synced','icon' => 'fa-network-wired','trend' => 'Institutional Log','color' => 'slate']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Registry Pulse','value' => 'Synced','icon' => 'fa-network-wired','trend' => 'Institutional Log','color' => 'slate']); ?>
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

 <!-- Outbreak Alert Hub -->
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="bg-card/40 border border-rose-500/20 rounded-[2rem] p-8 relative overflow-hidden group /10">
 <div class="absolute top-0 right-0 p-6 opacity-5 group-hover:opacity-10 transition-opacity">
 <i class="fas fa-biohazard text-6xl text-rose-500"></i>
 </div>
 <div class="flex items-center gap-2 mb-4">
 <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
 <p class="text-[12px] font-semibold text-rose-500 font-medium "><?php echo e($a->alert_level); ?> ALERT_PROTOCOL</p>
 </div>
 <h3 class="text-xl font-semibold text-white mb-4 uppercase tracking-tighter ">Outbreak Detected: <?php echo e($a->disease->disease_name); ?></h3>
 <p class="text-[12px] text-slate-400 leading-relaxed mb-8 uppercase tracking-tight">"<?php echo e($a->description); ?>"</p>
 <form method="POST" action="<?php echo e(url('/clinical/surveillance/resolve-alert/'.$a->id)); ?>">
 <?php echo csrf_field(); ?>
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'rose','variant' => 'ghost','class' => 'w-full font-medium text-[12px]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'rose','variant' => 'ghost','class' => 'w-full font-medium text-[12px]']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Mark Protocol Resolved <?php echo $__env->renderComponent(); ?>
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
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <div class="col-span-full bg-emerald-500/5 border border-emerald-500/20 rounded-[2rem] p-10 flex items-center gap-8">
 <div class="w-16 h-16 bg-emerald-500/10 text-emerald-500 rounded-2xl flex items-center justify-center border border-emerald-500/20">
 <i class="fas fa-check-shield text-2xl"></i>
 </div>
 <div>
 <h4 class="text-lg font-semibold text-white uppercase tracking-tighter ">Institutional State: Equilibrium</h4>
 <p class="text-[12px] font-semibold text-emerald-500 font-medium mt-2 ">No active disease outbreaks or threshold alerts detected in the surveillance matrix.</p>
 </div>
 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </div>

 <!-- IDSR Investigative Matrix -->
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Institutional IDSR Investigative Matrix','icon' => 'fa-database']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Institutional IDSR Investigative Matrix','icon' => 'fa-database']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <?php if (isset($component)) { $__componentOriginal11958e14de982b4883e7282860cbd101 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal11958e14de982b4883e7282860cbd101 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-table','data' => ['headers' => ['Patient Principal Profile', 'Infectious Classification', 'Outcome Matrix', 'Tracing Yield', 'Strategic Action']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Patient Principal Profile', 'Infectious Classification', 'Outcome Matrix', 'Tracing Yield', 'Strategic Action'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="group hover:bg-rose-500/[0.02] transition-colors border-b border-slate-800/50 last:border-0">
 <td class="px-5 py-6">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors "><?php echo e($c->patient->full_name ?? 'SYSTEM_GEN_PROTOCOL'); ?></div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium mt-1"><?php echo e($c->patient->medical_id ?? 'NODE_UNKNOWN'); ?></div>
 </td>
 <td class="px-5 py-6">
 <span class="px-3 py-1 bg-rose-500/10 text-rose-500 border border-rose-500/20 rounded-lg text-[8px] font-semibold font-medium /5 animate-pulse">
 <?php echo e(strtoupper($c->disease_code)); ?>

 </span>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1"><?php echo e($c->disease->disease_name); ?></div>
 </td>
 <td class="px-5 py-6">
 <div class="text-[12px] font-semibold text-slate-300 uppercase tracking-wider"><?php echo e(str_replace('_',' ', $c->outcome)); ?></div>
 <div class="text-[8px] font-bold text-slate-600 font-medium mt-1">Institutional Log</div>
 </td>
 <td class="px-5 py-6 text-center">
 <div class="flex flex-col items-center">
 <span class="text-lg font-semibold text-white leading-none"><?php echo e($c->contacts_count); ?></span>
 <span class="text-[8px] font-semibold text-slate-600 uppercase mt-1 ">Verified Trace</span>
 </div>
 </td>
 <td class="px-5 py-6 text-right">
 <div class="flex justify-end gap-2">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-users-viewfinder','color' => 'indigo','onclick' => 'openTraceModal(\''.e($c->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-users-viewfinder','color' => 'indigo','onclick' => 'openTraceModal(\''.e($c->id).'\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Trace <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-file-signature','color' => 'emerald','onclick' => 'openOutcomeModal(\''.e($c->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-file-signature','color' => 'emerald','onclick' => 'openOutcomeModal(\''.e($c->id).'\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Outcome <?php echo $__env->renderComponent(); ?>
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
 </td>
 </tr>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 <tr>
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">No active IDSR investigations identified in the surveillance feed.</td>
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

<!-- Modal: IDSR Reporting Protocol -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'reportModal','title' => 'Authorize IDSR Reporting Protocol','icon' => 'fa-file-medical']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'reportModal','title' => 'Authorize IDSR Reporting Protocol','icon' => 'fa-file-medical']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(url('/clinical/surveillance/report')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Institutional Patient Identity</label>
 <input name="patient_id" required placeholder="OP-XXXX-XXXX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">IDSR Disease Classification Selection</label>
 <select name="disease_code" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $diseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <option value="<?php echo e($d->disease_code); ?>"><?php echo e(strtoupper($d->disease_name)); ?> (<?php echo e(strtoupper($d->disease_code)); ?>)</option>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </select>
 </div>
 <div class="pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'rose','class' => 'w-full font-medium']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'rose','class' => 'w-full font-medium']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Authorize Transmission <?php echo $__env->renderComponent(); ?>
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

<!-- Modal: Contact Tracing -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'traceModal','title' => 'Commit Institutional Contact Tracing Intelligence','icon' => 'fa-users-viewfinder']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'traceModal','title' => 'Commit Institutional Contact Tracing Intelligence','icon' => 'fa-users-viewfinder']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(url('/clinical/surveillance/add-contact')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="case_id" id="traceCaseId">
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Contact Full Identity</label>
 <input name="name" required placeholder="CONTACT_FULL_NAME" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Anatomical Relationship Matrix</label>
 <input name="relationship" required placeholder="RELATIONSHIP_NODE" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Communication Node (Phone)</label>
 <input name="phone" required placeholder="PHONE_SIGNAL" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-indigo-600 uppercase">
 </div>
 <div class="pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'indigo','class' => 'w-full font-medium']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'indigo','class' => 'w-full font-medium']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Commit Tracing Intelligence <?php echo $__env->renderComponent(); ?>
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

<!-- Modal: Update Outcome -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'outcomeModal','title' => 'Commit Case Outcome Intelligence','icon' => 'fa-file-signature']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'outcomeModal','title' => 'Commit Case Outcome Intelligence','icon' => 'fa-file-signature']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" id="outcomeForm" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2 ">Final Investigative Outcome</label>
 <select name="outcome" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-emerald-600">
 <option value="under_investigation">UNDER_INVESTIGATION</option>
 <option value="confirmed">CONFIRMED_CASE</option>
 <option value="discarded">DISCARDED_CASE</option>
 <option value="recovered">RECOVERED_PATIENT</option>
 <option value="deceased">DECEASED_PATIENT</option>
 </select>
 </div>
 <div class="pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'emerald','class' => 'w-full font-medium']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'emerald','class' => 'w-full font-medium']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Commit Outcome Intelligence <?php echo $__env->renderComponent(); ?>
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
function openTraceModal(id) {
 document.getElementById('traceCaseId').value = id;
 document.getElementById('traceModal').classList.remove('hidden');
}
function openOutcomeModal(id) {
 document.getElementById('outcomeForm').action = `<?php echo e(url('/clinical/surveillance/update-outcome')); ?>/${id}`;
 document.getElementById('outcomeModal').classList.remove('hidden');
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\surveillance.blade.php ENDPATH**/ ?>
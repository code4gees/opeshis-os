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


<?php $__env->startSection('title', 'ICU Command - Opeshis OS'); ?>

<div class="space-y-8 pb-20">
 
 <!-- Institutional Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
 <div>
 <h1 class="text-2xl font-semibold text-rose-500 uppercase tracking-tighter">Critical Care Command</h1>
 <p class="text-xs font-bold text-slate-500 font-medium mt-1">Institutional Intensive Care Surveillance · SOFA Strategic Scoring</p>
 </div>
 <div class="flex gap-3">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['icon' => 'fa-plus-circle','color' => 'rose','onclick' => 'document.getElementById(\'admitModal\').classList.remove(\'hidden\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'fa-plus-circle','color' => 'rose','onclick' => 'document.getElementById(\'admitModal\').classList.remove(\'hidden\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Authorize Admission
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

 <!-- Critical Care KPIs -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
 <?php if (isset($component)) { $__componentOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6daf6fe1df9fcd4f85c4bb30e85ca43 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Active Census','value' => ''.e($census->count()).'','icon' => 'fa-bed-pulse','trend' => 'Active Cases','color' => 'rose']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Active Census','value' => ''.e($census->count()).'','icon' => 'fa-bed-pulse','trend' => 'Active Cases','color' => 'rose']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'High Risk','value' => ''.e($census->filter(fn($c) => ($c->latestSofa->total_score ?? 0) >= 10)->count()).'','icon' => 'fa-triangle-exclamation','trend' => 'SOFA ≥ 10','color' => 'amber']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'High Risk','value' => ''.e($census->filter(fn($c) => ($c->latestSofa->total_score ?? 0) >= 10)->count()).'','icon' => 'fa-triangle-exclamation','trend' => 'SOFA ≥ 10','color' => 'amber']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Avg SOFA','value' => ''.e(number_format($census->avg(fn($c) => $c->latestSofa->total_score ?? 0), 1)).'','icon' => 'fa-chart-line','trend' => 'Unit Index','color' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Avg SOFA','value' => ''.e(number_format($census->avg(fn($c) => $c->latestSofa->total_score ?? 0), 1)).'','icon' => 'fa-chart-line','trend' => 'Unit Index','color' => 'blue']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-stat','data' => ['title' => 'Surveillance','value' => 'Active','icon' => 'fa-eye','trend' => 'Real-time','color' => 'emerald']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Surveillance','value' => 'Active','icon' => 'fa-eye','trend' => 'Real-time','color' => 'emerald']); ?>
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

 <!-- ICU Census Matrix -->
 <?php if (isset($component)) { $__componentOriginal20f354184d3b88d04bf151863b9992fb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal20f354184d3b88d04bf151863b9992fb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.clinical-card','data' => ['title' => 'Live Critical Care Census','icon' => 'fa-hospital-user','badge' => 'Live Surveillance']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('clinical-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Live Critical Care Census','icon' => 'fa-hospital-user','badge' => 'Live Surveillance']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <?php if (isset($component)) { $__componentOriginalc8463834ba515134d5c98b88e1a9dc03 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-table','data' => ['headers' => ['Patient Identity', 'Bed / Unit', 'Hemodynamics', 'SOFA Index', 'Strategic Actions']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Patient Identity', 'Bed / Unit', 'Hemodynamics', 'SOFA Index', 'Strategic Actions'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $census; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <tr class="group hover:bg-rose-500/[0.02] transition-colors">
 <td class="whitespace-nowrap px-6 py-4">
 <div class="flex items-center">
 <div class="h-10 w-10 flex-shrink-0 rounded-xl bg-rose-500/10 flex items-center justify-center border border-rose-500/20 text-rose-500 font-bold text-xs">
 <?php echo e(substr($c->patient->full_name, 0, 1)); ?>

 </div>
 <div class="ml-4">
 <div class="text-sm font-bold text-slate-200 uppercase tracking-tight group-hover:text-rose-400 transition-colors"><?php echo e($c->patient->full_name); ?></div>
 <div class="text-[12px] font-semibold text-slate-500 font-medium"><?php echo e($c->patient->medical_id); ?></div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-6 py-4 text-center">
 <span class="px-2 py-1 bg-card/40 border border-subtle rounded text-[12px] font-semibold text-rose-400 font-medium">
 <?php echo e($c->bed_number); ?>

 </span>
 <div class="text-[8px] font-semibold text-slate-600 uppercase mt-1"><?php echo e($c->source_unit ?? 'ORIGIN_NA'); ?></div>
 </td>
 <td class="whitespace-nowrap px-6 py-4">
 <?php $v = $c->latestVital; ?>
 <div class="flex gap-4">
 <div class="text-center">
 <div class="text-[12px] font-semibold text-slate-200"><?php echo e($v ? $v->bp_systolic.'/'.$v->bp_diastolic : '—'); ?></div>
 <div class="text-[8px] font-bold text-slate-600 font-medium">BP</div>
 </div>
 <div class="text-center">
 <div class="text-[12px] font-semibold <?php echo e(($v->spo2 ?? 100) < 90 ? 'text-rose-500 animate-pulse' : 'text-emerald-500'); ?>">
 <?php echo e($v ? $v->spo2.'%' : '—'); ?>

 </div>
 <div class="text-[8px] font-bold text-slate-600 font-medium">SpO₂</div>
 </div>
 </div>
 </td>
 <td class="whitespace-nowrap px-6 py-4 text-center">
 <?php $sofa = $c->latestSofa->total_score ?? null; ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sofa !== null): ?>
 <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $sofa >= 10 ? 'critical' : ($sofa >= 6 ? 'pending' : 'completed')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sofa >= 10 ? 'critical' : ($sofa >= 6 ? 'pending' : 'completed'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
 <div class="text-[12px] font-semibold text-slate-400 mt-1 font-medium">Score: <?php echo e($sofa); ?></div>
 <?php else: ?>
 <span class="text-[12px] font-semibold text-slate-600 font-medium ">PENDING</span>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 </td>
 <td class="whitespace-nowrap px-6 py-4 text-right">
 <div class="flex justify-end gap-2">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-heart-pulse','color' => 'rose','onclick' => 'openVitalsModal(\''.e($c->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-heart-pulse','color' => 'rose','onclick' => 'openVitalsModal(\''.e($c->id).'\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Vitals <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-chart-simple','color' => 'amber','onclick' => 'openSOFAModal(\''.e($c->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-chart-simple','color' => 'amber','onclick' => 'openSOFAModal(\''.e($c->id).'\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
SOFA <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'ghost','size' => 'sm','icon' => 'fa-door-open','color' => 'emerald','onclick' => 'openDischargeModal(\''.e($c->id).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'ghost','size' => 'sm','icon' => 'fa-door-open','color' => 'emerald','onclick' => 'openDischargeModal(\''.e($c->id).'\')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Discharge <?php echo $__env->renderComponent(); ?>
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
 <td colspan="5" class="px-6 py-12 text-center text-slate-600 text-sm">Critical care census is currently baseline (empty).</td>
 </tr>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $attributes = $__attributesOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__attributesOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03)): ?>
<?php $component = $__componentOriginalc8463834ba515134d5c98b88e1a9dc03; ?>
<?php unset($__componentOriginalc8463834ba515134d5c98b88e1a9dc03); ?>
<?php endif; ?>
  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal20f354184d3b88d04bf151863b9992fb)): ?>
<?php $attributes = $__attributesOriginal20f354184d3b88d04bf151863b9992fb; ?>
<?php unset($__attributesOriginal20f354184d3b88d04bf151863b9992fb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal20f354184d3b88d04bf151863b9992fb)): ?>
<?php $component = $__componentOriginal20f354184d3b88d04bf151863b9992fb; ?>
<?php unset($__componentOriginal20f354184d3b88d04bf151863b9992fb); ?>
<?php endif; ?>
</div>

<!-- Modal: ICU Admission -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'admitModal','title' => 'Critical Intake Authorization','icon' => 'fa-hospital-user']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'admitModal','title' => 'Critical Intake Authorization','icon' => 'fa-hospital-user']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('specialty.critical.icu.admit')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div class="grid grid-cols-2 gap-4">
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Institutional Patient ID</label>
 <input name="patient_id" required placeholder="UUID / Medical ID" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Bed Allocation</label>
 <input name="bed_number" required placeholder="ICU-XX" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all uppercase">
 </div>
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Primary Critical Diagnosis</label>
 <input name="diagnosis" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none focus:ring-2 focus:ring-rose-600 transition-all">
 </div>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Referral Origin</label>
 <input name="source" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none uppercase" placeholder="e.g. EMERGENCY, THEATRE">
 </div>
 <div class="pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'rose','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'rose','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Authorize Critical Care Admission <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'vitalsModal','title' => 'Hemodynamic Surveillance Log','icon' => 'fa-heart-pulse']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'vitalsModal','title' => 'Hemodynamic Surveillance Log','icon' => 'fa-heart-pulse']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('specialty.critical.icu.vitals')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="admission_id" id="vitalsAdmissionId">
 <div class="grid grid-cols-3 gap-4">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['bp_systolic'=>'Sys BP','bp_diastolic'=>'Dia BP','heart_rate'=>'HR','spo2'=>'SpO2','temperature'=>'Temp','gcs'=>'GCS']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2"><?php echo e($label); ?></label>
 <input name="<?php echo e($name); ?>" type="number" step="0.1" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-200 outline-none">
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 <div class="pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'rose','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'rose','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Commit Hemodynamic Data <?php echo $__env->renderComponent(); ?>
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

<!-- Modal: SOFA Scoring -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'sofaModal','title' => 'SOFA Strategic Indexing','icon' => 'fa-chart-simple']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'sofaModal','title' => 'SOFA Strategic Indexing','icon' => 'fa-chart-simple']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" action="<?php echo e(route('specialty.critical.icu.sofa')); ?>" class="space-y-6">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="admission_id" id="sofaAdmissionId">
 <div class="grid grid-cols-2 gap-4">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['respiratory'=>'Respiratory','coagulation'=>'Coagulation','liver'=>'Liver','cardiovascular'=>'Cardiovascular','cns'=>'CNS (GCS)','renal'=>'Renal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2"><?php echo e($label); ?></label>
 <select name="<?php echo e($name); ?>" class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-2.5 text-xs font-semibold text-slate-200 outline-none">
 <option value="0">0 (Normal)</option>
 <option value="1">1</option><option value="2">2</option>
 <option value="3">3</option><option value="4">4 (Failure)</option>
 </select>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 <div class="pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'amber','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'amber','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Authorize SOFA Log <?php echo $__env->renderComponent(); ?>
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

<!-- Modal: Discharge -->
<?php if (isset($component)) { $__componentOriginaldb33f26299501d7f3f1f86db35937b93 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb33f26299501d7f3f1f86db35937b93 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-modal','data' => ['id' => 'dischargeModal','title' => 'Discharge Protocol','icon' => 'fa-door-open']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'dischargeModal','title' => 'Discharge Protocol','icon' => 'fa-door-open']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <form method="POST" id="dischargeForm" class="space-y-6">
 <?php echo csrf_field(); ?>
 <div>
 <label class="block text-[12px] font-semibold text-slate-500 font-medium mb-2">Discharge Destination</label>
 <select name="destination" required class="w-full bg-card/50 border border-subtle rounded-xl px-4 py-3 text-sm font-bold text-slate-200 outline-none">
 <option value="General Ward">General Ward</option>
 <option value="HDU">High Dependency Unit (HDU)</option>
 <option value="Other Facility">Transfer to Other Facility</option>
 <option value="Home">Discharge Home</option>
 <option value="Morgue">Morgue (Expired)</option>
 </select>
 </div>
 <div class="pt-4">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'submit','color' => 'emerald','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','color' => 'emerald','class' => 'w-full']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Finalize Discharge Protocol <?php echo $__env->renderComponent(); ?>
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
function openVitalsModal(id) {
 document.getElementById('vitalsAdmissionId').value = id;
 document.getElementById('vitalsModal').classList.remove('hidden');
}
function openSOFAModal(id) {
 document.getElementById('sofaAdmissionId').value = id;
 document.getElementById('sofaModal').classList.remove('hidden');
}
function openDischargeModal(id) {
  let url = "<?php echo e(route('specialty.critical.icu.discharge', ':id')); ?>";
  document.getElementById('dischargeForm').action = url.replace(':id', id);
  document.getElementById('dischargeModal').classList.remove('hidden');
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\clinical\icu.blade.php ENDPATH**/ ?>
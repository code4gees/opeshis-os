<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Dashboard | Hospital Intelligence']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard | Hospital Intelligence']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-[1600px] mx-auto pb-10">

  <!-- TOP ROW METRICS: Operational KPIs -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
    <?php if (isset($component)) { $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-vital-trend','data' => ['label' => 'Admissions Today','value' => '48','unit' => '+5%','trend' => 'up','history' => [20, 35, 25, 45, 48]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-vital-trend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Admissions Today','value' => '48','unit' => '+5%','trend' => 'up','history' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([20, 35, 25, 45, 48])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $attributes = $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $component = $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-vital-trend','data' => ['label' => 'Self-Service Vitals','value' => ''.e($stats['kiosk_vitals_today']).'','unit' => 'Kiosk Hub','trend' => 'stable','history' => [10, 15, 12, 18, $stats['kiosk_vitals_today']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-vital-trend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Self-Service Vitals','value' => ''.e($stats['kiosk_vitals_today']).'','unit' => 'Kiosk Hub','trend' => 'stable','history' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([10, 15, 12, 18, $stats['kiosk_vitals_today']])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $attributes = $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $component = $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-vital-trend','data' => ['label' => 'Bed Occupancy','value' => '86%','unit' => 'Optimal','trend' => 'up','history' => [70, 75, 80, 82, 86]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-vital-trend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Bed Occupancy','value' => '86%','unit' => 'Optimal','trend' => 'up','history' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([70, 75, 80, 82, 86])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $attributes = $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $component = $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-vital-trend','data' => ['label' => 'Critical Alerts','value' => '3','unit' => 'Immediate','trend' => 'up','status' => 'critical','history' => [0, 1, 0, 2, 3]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-vital-trend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Critical Alerts','value' => '3','unit' => 'Immediate','trend' => 'up','status' => 'critical','history' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([0, 1, 0, 2, 3])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $attributes = $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $component = $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_billing')): ?>
      <?php if (isset($component)) { $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-vital-trend','data' => ['label' => 'Revenue Today','value' => '$'.e(number_format($stats['revenue_today'])).'','unit' => 'XAF','trend' => 'up','status' => 'normal','history' => [5000, 7000, 6000, 8000, $stats['revenue_today']]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-vital-trend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Revenue Today','value' => '$'.e(number_format($stats['revenue_today'])).'','unit' => 'XAF','trend' => 'up','status' => 'normal','history' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([5000, 7000, 6000, 8000, $stats['revenue_today']])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $attributes = $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $component = $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
    <?php else: ?>
      <?php if (isset($component)) { $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-vital-trend','data' => ['label' => 'Staff on Duty','value' => '112','unit' => 'Synchronized','trend' => 'stable','history' => [110, 112, 112, 111, 112]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-vital-trend'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Staff on Duty','value' => '112','unit' => 'Synchronized','trend' => 'stable','history' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([110, 112, 112, 111, 112])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $attributes = $__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__attributesOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e)): ?>
<?php $component = $__componentOriginaldf47de39c930c33ce6267c6a1744ab3e; ?>
<?php unset($__componentOriginaldf47de39c930c33ce6267c6a1744ab3e); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
  </div>

  <!-- MAIN TWO COLUMNS: Responsive Grid Architecture -->
  <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
      <!-- LEFT COLUMN: Patient Queue Survaillance -->
      <div class="xl:col-span-5 xl:h-[820px] min-h-[500px] flex flex-col">
        <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'flex-1 flex flex-col p-0 overflow-hidden','title' => 'Institutional Live Queue','icon' => 'users']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex-1 flex flex-col p-0 overflow-hidden','title' => 'Institutional Live Queue','icon' => 'users']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

           <?php $__env->slot('action', null, []); ?>
            <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['size' => 'sm','variant' => 'secondary','icon' => 'arrow-right','onclick' => 'window.location.href=\''.e(route('patients.index')).'\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm','variant' => 'secondary','icon' => 'arrow-right','onclick' => 'window.location.href=\''.e(route('patients.index')).'\'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                Master Index
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
           <?php $__env->endSlot(); ?>

          <div class="flex-1 overflow-y-auto custom-scrollbar">
            <?php if (isset($component)) { $__componentOriginal11958e14de982b4883e7282860cbd101 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal11958e14de982b4883e7282860cbd101 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-table','data' => ['headers' => ['Patient Identity', 'Protocol Status', 'Latency', 'Assigned Node'],'compact' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Patient Identity', 'Protocol Status', 'Latency', 'Assigned Node']),'compact' => true]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $active_queue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr onclick="window.location.href='<?php echo e(route('emr.main', $q->id)); ?>'" class="group cursor-pointer hover:bg-white/[0.01] transition-colors border-b border-white/[0.02] last:border-0">
                  <td class="px-4 py-4">
                    <div class="text-[12px] font-bold text-slate-200 group-hover:text-cobalt transition-colors"><?php echo e($q->patient->full_name); ?></div>
                    <div class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-0.5"><?php echo e($q->patient->medical_id); ?></div>
                  </td>
                  <td class="px-4 py-4">
                    <span class="px-2 py-1 rounded-lg bg-white/5 border border-white/10 text-slate-400 text-[9px] font-bold uppercase tracking-widest">
                      <?php echo e($q->status); ?>

                    </span>
                  </td>
                  <td class="px-4 py-4">
                    <div class="text-[11px] font-bold text-slate-500 uppercase tracking-tighter"><?php echo e($q->created_at->diffForHumans(null, true)); ?></div>
                  </td>
                  <td class="px-4 py-4">
                    <div class="text-[11px] font-bold text-cobalt/60 uppercase tracking-widest"><?php echo e($q->doctor->name ?? 'UNASSIGNED'); ?></div>
                  </td>
                </tr>
              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                  <td colspan="4" class="px-8 py-20 text-center">
                    <div class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center mx-auto mb-4 border border-white/5">
                      <i class="fas fa-inbox text-white/10 text-lg"></i>
                    </div>
                    <p class="text-[11px] font-bold text-white/20 uppercase tracking-widest">Queue Status: Empty</p>
                  </td>
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
    <?php else: ?>
      <div class="xl:col-span-5 xl:h-[820px] min-h-[500px]">
        <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'h-full flex flex-col items-center justify-center text-center p-12 bg-alert/[0.02] border-alert/10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-full flex flex-col items-center justify-center text-center p-12 bg-alert/[0.02] border-alert/10']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

          <div class="w-16 h-16 rounded-2xl bg-alert/10 flex items-center justify-center mb-6">
            <i class="fas fa-shield-slash text-alert text-2xl"></i>
          </div>
          <h3 class="text-white font-bold uppercase tracking-[0.2em] mb-3">Restricted Node</h3>
          <p class="text-white/20 text-[11px] uppercase tracking-widest leading-relaxed">Required: module_clinical authorization<br>Access denied by governance protocol.</p>
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
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- RIGHT COLUMN: Intelligence Matrix -->
    <div class="xl:col-span-7 flex flex-col gap-8 xl:h-[820px]">
      <!-- Clinical Velocity Visualizer -->
      <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'h-[340px] flex flex-col p-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-[340px] flex flex-col p-8']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div class="flex justify-between items-center mb-8">
          <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
            <i class="fas fa-chart-line text-sage text-[14px]"></i>
            Clinical Inflow Intelligence
          </h2>
          <div class="flex gap-2">
            <span class="flex items-center gap-2 text-[9px] font-bold text-white/20 uppercase tracking-widest">
              <div class="w-1.5 h-1.5 rounded-full bg-sage shadow-[0_0_8px_rgba(130,192,154,0.4)]"></div> Primary Inflow
            </span>
          </div>
        </div>
        <div class="flex-1 relative">
          <canvas id="mainChart"></canvas>
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

      <!-- Departmental Resource Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 h-[240px]">
        <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'p-8 flex flex-col justify-between']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'p-8 flex flex-col justify-between']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

          <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em]">Departmental Saturation</h3>
          <div class="flex items-end justify-between h-24 mt-4 gap-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [40,70,100,40,50,90,40,80,30]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
              <div class="flex-1 bg-white/5 rounded-t-lg relative group">
                <div class="absolute bottom-0 left-0 right-0 bg-sage/20 group-hover:bg-sage/40 transition-all rounded-t-lg" style="height: <?php echo e($h); ?>%"></div>
              </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
          </div>
          <div class="flex justify-between mt-4 text-[9px] font-bold text-white/10 uppercase tracking-widest font-mono">
            <span>A&E</span><span>ICU</span><span>OPD</span><span>LAB</span><span>RAD</span>
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

        <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'p-8 flex flex-col justify-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'p-8 flex flex-col justify-center']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

          <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] mb-6 text-center">Inpatient Census Matrix</h3>
          <div class="flex justify-around items-end h-24 gap-4 px-6">
            <div class="w-full bg-white/5 rounded-t-xl relative overflow-hidden h-full">
              <div class="absolute bottom-0 left-0 right-0 bg-sage/40 h-[60%]"></div>
            </div>
            <div class="w-full bg-white/5 rounded-t-xl relative overflow-hidden h-full">
              <div class="absolute bottom-0 left-0 right-0 bg-sage/20 h-[85%]"></div>
            </div>
            <div class="w-full bg-white/5 rounded-t-xl relative overflow-hidden h-full">
              <div class="absolute bottom-0 left-0 right-0 bg-sage/10 h-[30%]"></div>
            </div>
          </div>
          <div class="flex justify-around mt-4 text-[9px] font-bold text-white/10 uppercase tracking-widest font-mono">
            <span>GEN</span><span>MAT</span><span>PED</span>
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

      <!-- Ward Status Surveillance -->
      <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'flex-1 flex flex-col p-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex-1 flex flex-col p-8']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <div class="flex justify-between items-center mb-8">
          <h3 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
            <i class="fas fa-bed-pulse text-sage text-[14px]"></i>
            Ward Status Surveillance
          </h3>
          <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
            <a href="<?php echo e(route('wards')); ?>" class="text-[10px] font-bold text-sage uppercase tracking-widest hover:text-white transition-colors">Full Census Protocol</a>
          <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['Ground Floor / A-Wing', 'First Floor / B-Wing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
              <div class="bg-white/[0.01] border border-white/[0.04] rounded-2xl p-6 relative flex flex-col">
                <div class="flex items-center gap-3 mb-6">
                  <div class="w-2 h-2 rounded-full bg-sage shadow-[0_0_8px_rgba(130,192,154,0.4)]"></div>
                  <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest"><?php echo e($floor); ?></span>
                </div>
                <div class="grid grid-cols-2 gap-4 flex-1">
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i=0; $i<4; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="bg-white/[0.02] border border-white/[0.04] rounded-xl flex items-center justify-center gap-3 group hover:border-sage/20 transition-all">
                      <i class="fas fa-bed text-white/10 group-hover:text-sage transition-colors"></i>
                      <div class="w-2 h-2 rounded-full <?php echo e($i % 3 == 0 ? 'bg-alert shadow-[0_0_8px_rgba(217,119,108,0.4)]' : 'bg-sage/40'); ?>"></div>
                    </div>
                  <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
              </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
          </div>
        <?php else: ?>
          <div class="flex-1 flex flex-col items-center justify-center text-center">
            <i class="fas fa-lock text-white/5 text-4xl mb-4"></i>
            <p class="text-[10px] font-bold text-white/10 uppercase tracking-[0.25em]">Census Encryption Protocol: Active</p>
          </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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


<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 document.addEventListener("DOMContentLoaded", function() {
 Chart.defaults.color = '#64748b';
 Chart.defaults.font.family = 'Inter, sans-serif';

 const ctx = document.getElementById('mainChart');
 if(ctx) {
 new Chart(ctx, {
 type: 'line',
 data: {
 labels: ['12h','14h','16h','18h','20h','22h','00h','02h'],
 datasets: [
 {
 label: 'Patient',
 data: [10, 40, 20, 80, 40, 60, 30, 70],
 borderColor: '#82c09a', // Sage
 borderWidth: 2,
 tension: 0.4,
 pointRadius: 0,
 fill: true,
 backgroundColor: (context) => {
 const chartCtx = context.chart.ctx;
 const gradient = chartCtx.createLinearGradient(0, 0, 0, 200);
 gradient.addColorStop(0, 'rgba(130, 192, 154, 0.4)');
 gradient.addColorStop(1, 'rgba(130, 192, 154, 0)');
 return gradient;
 }
 },
 {
 label: 'Series',
 data: [30, 20, 40, 30, 50, 40, 20, 50],
 borderColor: '#4c566a', // Slate
 borderWidth: 2,
 tension: 0.4,
 pointRadius: 0,
 fill: true,
 backgroundColor: (context) => {
 const chartCtx = context.chart.ctx;
 const gradient = chartCtx.createLinearGradient(0, 0, 0, 200);
 gradient.addColorStop(0, 'rgba(76, 86, 106, 0.2)');
 gradient.addColorStop(1, 'rgba(76, 86, 106, 0)');
 return gradient;
 }
 }
 ]
 },
 options: {
 responsive: true, maintainAspectRatio: false,
 plugins: { legend: { display: false }, tooltip: { enabled: false } },
 scales: {
 y: { min: 0, max: 100, border: {display: false}, grid: { color: 'rgba(255,255,255,0.06)' }, ticks: { font: {size: 9} } },
 x: { border: {display: true, color: 'rgba(255,255,255,0.06)'}, grid: { display: false }, ticks: { font: {size: 9} } }
 }
 }
 });
 }
 });
</script>

  <!-- CLINICAL QUICK-LAUNCH MATRIX: Premium Operational Grid -->
  <div class="mt-12 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_emergency')): ?>
      <a href="<?php echo e(route('clinical.emergency.index')); ?>" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-rose/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-rose/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="truck" class="text-rose w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-rose transition-colors">Emergency</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-rose group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
      <a href="<?php echo e(route('specialty.critical.icu.index')); ?>" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-cobalt/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-cobalt/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="activity" class="text-cobalt w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-cobalt transition-colors">ICU Command</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-cobalt group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_pharmacy')): ?>
      <a href="<?php echo e(route('operations.diagnostics.pharmacy.index')); ?>" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-sage/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-sage/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="pill" class="text-sage w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-sage transition-colors">Pharmacy</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-sage group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_lab')): ?>
      <a href="<?php echo e(route('operations.diagnostics.lab.index')); ?>" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-amber-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="flask-conical" class="text-amber-500 w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-amber-500 transition-colors">Laboratory</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-amber-500 group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
      <a href="<?php echo e(route('specialty.clinics.dental.index')); ?>" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-white/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-white/5 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="smile" class="text-slate-400 w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-slate-100 transition-colors">Dental Clinic</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-white/40 group-hover:w-full transition-all duration-500"></div>
      </a>
      <a href="<?php echo e(route('specialty.clinics.eye.index')); ?>" class="group relative overflow-hidden bg-surface-elevated border border-white/5 p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-surface-overlay hover:border-indigo-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i data-lucide="eye" class="text-indigo-500 w-6 h-6"></i>
        </div>
        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.25em] group-hover:text-indigo-400 transition-colors">Eye Clinic</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-indigo-500 group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php /**PATH /app/resources/views/dashboard.blade.php ENDPATH**/ ?>
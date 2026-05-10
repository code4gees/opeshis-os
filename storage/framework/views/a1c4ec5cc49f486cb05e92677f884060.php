<?php if (isset($component)) { $__componentOriginal5f9e428c85f73cee41ce4c693f314c57 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5f9e428c85f73cee41ce4c693f314c57 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-shell','data' => ['title' => 'Dashboard | Hospital']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard | Hospital']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


<div class="max-w-[1600px] mx-auto pb-10">

  <!-- TOP ROW METRICS: Responsive Institutional Pulse -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
    <!-- Admissions Matrix -->
    <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

      <div class="p-6 h-full flex flex-col justify-between">
        <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em]">Admissions Today</h3>
        <div class="flex items-baseline gap-2 mt-2 relative z-10">
          <span class="text-4xl font-extrabold text-white tracking-tighter">48</span>
          <span class="text-[11px] text-sage font-bold tracking-tight bg-sage/10 px-2 py-0.5 rounded-lg border border-sage/20">+5%</span>
        </div>
        <!-- Micro-Trend Visualizer -->
        <div class="absolute bottom-0 left-0 right-0 h-16 opacity-30 pointer-events-none group-hover:opacity-60 transition-opacity">
          <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,20 Q10,10 20,20 T40,20 T60,10 T80,25 T100,5 L100,30 L0,30 Z" fill="rgba(130,192,154,0.2)"></path>
            <path d="M0,20 Q10,10 20,20 T40,20 T60,10 T80,25 T100,5" fill="none" stroke="#82c09a" stroke-width="2"></path>
          </svg>
        </div>
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

    <!-- Kiosk Intelligence -->
    <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

      <div class="p-6 h-full flex flex-col justify-between">
        <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em]">Self-Service Vitals</h3>
        <div class="flex items-baseline gap-2 mt-2 relative z-10">
          <span class="text-4xl font-extrabold text-white tracking-tighter"><?php echo e($stats['kiosk_vitals_today']); ?></span>
          <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Kiosk Hub</span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 opacity-30 pointer-events-none group-hover:opacity-60 transition-opacity">
          <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,25 Q10,15 20,25 T40,15 T60,5 T80,15 T100,20 L100,30 L0,30 Z" fill="rgba(130,192,154,0.2)"></path>
            <path d="M0,25 Q10,15 20,25 T40,15 T60,5 T80,15 T100,20" fill="none" stroke="#82c09a" stroke-width="2"></path>
          </svg>
        </div>
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

    <!-- Occupancy Surveillance -->
    <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

      <div class="p-6 h-full flex flex-col justify-between">
        <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em]">Bed Occupancy</h3>
        <div class="flex items-baseline gap-2 mt-2 relative z-10">
          <span class="text-4xl font-extrabold text-white tracking-tighter">86%</span>
          <div class="flex items-center gap-1">
            <div class="w-2 h-2 rounded-full bg-sage animate-pulse shadow-[0_0_8px_rgba(130,192,154,0.5)]"></div>
            <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Optimal</span>
          </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 opacity-30 pointer-events-none group-hover:opacity-60 transition-opacity">
          <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,25 Q15,25 25,20 T50,20 T75,10 T100,20 L100,30 L0,30 Z" fill="rgba(130,192,154,0.2)"></path>
            <path d="M0,25 Q15,25 25,20 T50,20 T75,10 T100,20" fill="none" stroke="#82c09a" stroke-width="2"></path>
          </svg>
        </div>
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

    <!-- Critical Alerts Matrix -->
    <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'relative overflow-hidden group border-alert/20 bg-alert/[0.02] hover:bg-alert/[0.05] transition-all duration-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative overflow-hidden group border-alert/20 bg-alert/[0.02] hover:bg-alert/[0.05] transition-all duration-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

      <div class="p-6 h-full flex flex-col justify-between">
        <div class="flex justify-between items-start relative z-10">
          <h3 class="text-[10px] font-bold text-alert/40 uppercase tracking-[0.25em]">Critical Alerts</h3>
          <i class="fas fa-triangle-exclamation text-alert text-[14px] animate-pulse"></i>
        </div>
        <div class="flex items-baseline gap-2 mt-2 relative z-10">
          <span class="text-4xl font-extrabold text-alert tracking-tighter">3</span>
          <span class="text-[10px] font-bold text-alert/40 uppercase tracking-widest">Immediate</span>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 opacity-30 pointer-events-none group-hover:opacity-60 transition-opacity">
          <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,25 L30,25 L35,10 L45,28 L50,25 L100,25" fill="none" stroke="#d9776c" stroke-width="2"></path>
          </svg>
        </div>
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

    <!-- Revenue / Workforce Intelligence -->
    <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative overflow-hidden group hover:bg-white/[0.03] transition-all duration-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

      <div class="p-6 h-full flex flex-col justify-between">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_billing')): ?>
          <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em]">Revenue Today</h3>
          <div class="flex items-baseline gap-2 mt-2 relative z-10">
            <span class="text-4xl font-extrabold text-white tracking-tighter">$<?php echo e(number_format($stats['revenue_today'])); ?></span>
            <span class="text-[10px] font-bold text-sage/40 uppercase tracking-widest font-mono">XAF</span>
          </div>
        <?php else: ?>
          <h3 class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em]">Staff on Duty</h3>
          <div class="flex items-baseline gap-2 mt-2 relative z-10">
            <span class="text-4xl font-extrabold text-white tracking-tighter">112</span>
            <span class="text-[10px] font-bold text-white/20 uppercase tracking-widest">Synchronized</span>
          </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="absolute bottom-0 left-0 right-0 h-16 opacity-30 pointer-events-none group-hover:opacity-60 transition-opacity">
          <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="w-full h-full">
            <path d="M0,20 Q10,15 20,20 T40,10 T60,20 T80,15 T100,20 L100,30 L0,30 Z" fill="rgba(130,192,154,0.2)"></path>
            <path d="M0,20 Q10,15 20,20 T40,10 T60,20 T80,15 T100,20" fill="none" stroke="#82c09a" stroke-width="2"></path>
          </svg>
        </div>
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

  <!-- MAIN TWO COLUMNS: Responsive Grid Architecture -->
  <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
      <!-- LEFT COLUMN: Patient Queue Survaillance -->
      <div class="xl:col-span-5 xl:h-[820px] min-h-[500px] flex flex-col">
        <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['class' => 'flex-1 flex flex-col overflow-hidden']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex-1 flex flex-col overflow-hidden']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

          <div class="px-8 py-6 border-b border-white/[0.04] flex items-center justify-between bg-white/[0.02]">
            <h2 class="text-[12px] font-bold text-white/40 uppercase tracking-[0.2em] flex items-center gap-3">
              <i class="fas fa-users-viewfinder text-sage text-[14px]"></i>
              Institutional Live Queue
            </h2>
            <a href="<?php echo e(route('patients.index')); ?>" class="cc-button-primary !py-1.5 !px-4 text-[10px]">
              Master Index
            </a>
          </div>

          <div class="flex-1 overflow-y-auto custom-scrollbar">
            <?php if (isset($component)) { $__componentOriginal11958e14de982b4883e7282860cbd101 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal11958e14de982b4883e7282860cbd101 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-table','data' => ['headers' => ['Patient Identity', 'Protocol Status', 'Latency', 'Assigned Node']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['headers' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Patient Identity', 'Protocol Status', 'Latency', 'Assigned Node'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

              <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $active_queue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr onclick="window.location.href='<?php echo e(route('emr.main', $q->id)); ?>'" class="group cursor-pointer hover:bg-white/[0.01] transition-colors border-b border-white/[0.02] last:border-0">
                  <td class="px-8 py-5">
                    <div class="text-[12px] font-bold text-white uppercase tracking-tight group-hover:text-sage transition-colors"><?php echo e($q->patient->full_name); ?></div>
                    <div class="text-[10px] font-bold text-white/20 uppercase tracking-widest mt-1"><?php echo e($q->patient->medical_id); ?></div>
                  </td>
                  <td class="px-8 py-5">
                    <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/10 text-white/40 text-[9px] font-bold uppercase tracking-widest">
                      <?php echo e($q->status); ?>

                    </span>
                  </td>
                  <td class="px-8 py-5">
                    <div class="text-[11px] font-bold text-white/20 uppercase tracking-tighter"><?php echo e($q->created_at->diffForHumans(null, true)); ?></div>
                  </td>
                  <td class="px-8 py-5">
                    <div class="text-[11px] font-bold text-sage/60 uppercase tracking-widest"><?php echo e($q->doctor->name ?? 'UNASSIGNED'); ?></div>
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
      <a href="<?php echo e(route('clinical.emergency.index')); ?>" class="group relative overflow-hidden bg-white/[0.01] border border-white/[0.04] p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-white/[0.03] hover:border-rose-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-rose-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i class="fas fa-truck-medical text-rose-500 text-xl"></i>
        </div>
        <span class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] group-hover:text-rose-400 transition-colors">Emergency</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-rose-500 group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
      <a href="<?php echo e(route('specialty.critical.icu.index')); ?>" class="group relative overflow-hidden bg-white/[0.01] border border-white/[0.04] p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-white/[0.03] hover:border-blue-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i class="fas fa-heart-pulse text-blue-500 text-xl"></i>
        </div>
        <span class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] group-hover:text-blue-400 transition-colors">ICU Command</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-blue-500 group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_pharmacy')): ?>
      <a href="<?php echo e(route('operations.diagnostics.pharmacy.index')); ?>" class="group relative overflow-hidden bg-white/[0.01] border border-white/[0.04] p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-white/[0.03] hover:border-sage/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-sage/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i class="fas fa-pills text-sage text-xl"></i>
        </div>
        <span class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] group-hover:text-sage transition-colors">Pharmacy</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-sage group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_lab')): ?>
      <a href="<?php echo e(route('operations.diagnostics.lab.index')); ?>" class="group relative overflow-hidden bg-white/[0.01] border border-white/[0.04] p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-white/[0.03] hover:border-amber-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i class="fas fa-flask text-amber-500 text-xl"></i>
        </div>
        <span class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] group-hover:text-amber-400 transition-colors">Laboratory</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-amber-500 group-hover:w-full transition-all duration-500"></div>
      </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasPermission('module_clinical')): ?>
      <a href="<?php echo e(route('specialty.clinics.dental.index')); ?>" class="group relative overflow-hidden bg-white/[0.01] border border-white/[0.04] p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-white/[0.03] hover:border-white/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-white/5 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i class="fas fa-tooth text-white/40 text-xl"></i>
        </div>
        <span class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] group-hover:text-white transition-colors">Dental Clinic</span>
        <div class="absolute -bottom-1 w-0 h-1 bg-white/40 group-hover:w-full transition-all duration-500"></div>
      </a>
      <a href="<?php echo e(route('specialty.clinics.eye.index')); ?>" class="group relative overflow-hidden bg-white/[0.01] border border-white/[0.04] p-8 rounded-[2rem] flex flex-col items-center justify-center gap-4 transition-all duration-500 hover:bg-white/[0.03] hover:border-indigo-500/20 hover:-translate-y-2">
        <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
          <i class="fas fa-eye text-indigo-500 text-xl"></i>
        </div>
        <span class="text-[10px] font-bold text-white/20 uppercase tracking-[0.25em] group-hover:text-indigo-400 transition-colors">Eye Clinic</span>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views/dashboard.blade.php ENDPATH**/ ?>
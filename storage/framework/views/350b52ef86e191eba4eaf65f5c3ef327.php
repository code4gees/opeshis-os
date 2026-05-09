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


<?php $__env->startSection('title', 'Patient Consultation - Opeshis OS'); ?>


<div class="max-w-7xl mx-auto space-y-6 pb-20">
 
 <!-- Institutional Clinical Header -->
 <div class="flex flex-col md:flex-row justify-between items-start md:items-end border-b border-subtle pb-8">
 <div class="flex items-center gap-6">
 <div class="h-20 w-20 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center border border-subtle text-3xl font-semibold text-white /20">
 <?php echo e(substr($encounter->full_name, 0, 1)); ?>

 </div>
 <div>
 <div class="flex items-center gap-2 text-[12px] font-semibold font-medium text-slate-500 mb-2">
 <i class="fas fa-stethoscope text-sage/50"></i>
 <span>Clinical Command</span>
 <span class="text-white/10">/</span>
 <span class="text-slate-300">Live Consultation</span>
 </div>
 <h1 class="text-4xl font-semibold text-white tracking-tighter uppercase">
 <?php echo e($encounter->full_name); ?>

 </h1>
 <div class="flex items-center gap-4 mt-2 text-[12px] font-bold font-medium">
 <span class="text-sage"><?php echo e($encounter->medical_id); ?></span>
 <span class="text-slate-600">|</span>
 <span class="text-slate-300"><?php echo e($encounter->gender); ?></span>
 <span class="text-slate-600">|</span>
 <span class="text-slate-300"><?php echo e(\Carbon\Carbon::parse($encounter->date_of_birth)->age); ?> Years Old</span>
 </div>
 </div>
 </div>
 <div class="mt-6 md:mt-0 flex gap-3">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['variant' => 'secondary','icon' => 'fa-history','href' => ''.e(route('clinical.dossier', $encounter->patient_id)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','icon' => 'fa-history','href' => ''.e(route('clinical.dossier', $encounter->patient_id)).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Full Dossier
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
 <form action="<?php echo e(route('emr.close')); ?>" method="POST" id="closeForm">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="encounter_id" value="<?php echo e($encounterId); ?>">
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'button','icon' => 'fa-check-double','onclick' => 'finalizeSession()','class' => 'bg-emerald-600 hover:bg-emerald-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','icon' => 'fa-check-double','onclick' => 'finalizeSession()','class' => 'bg-emerald-600 hover:bg-emerald-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Finalize Session
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
 </div>

 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
 <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-[12px] font-semibold font-medium animate-pulse">
 <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

 </div>
 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
 
 <!-- Main Documentation Engine (3 Columns) -->
 <div class="lg:col-span-3 space-y-6">
 
 <div class="cc-card rounded-2xl border border-subtle bg-card/50 overflow-hidden ">
 <!-- SOAP Navigation Architecture -->
 <div class="flex border-b border-subtle bg-card">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['subjective' => 'Subjective', 'objective' => 'Objective', 'assessment' => 'Assessment', 'plan' => 'Plan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <button onclick="setSoapTab('<?php echo e($id); ?>')" id="btn-<?php echo e($id); ?>" class="tab-btn <?php echo e($id === 'subjective' ? 'active' : ''); ?> px-8 py-5 text-[12px] font-semibold font-medium transition-all border-b-2 border-transparent">
 <?php echo e($label); ?>

 </button>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 
 <!-- Documentation Panels -->
 <div class="p-8 min-h-[500px]">
 <div id="soap-subjective" class="soap-panel">
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-history text-sage/50"></i>
 <span>Clinical History & Complaints</span>
 </div>
 <textarea id="subjective" oninput="syncInputs()" class="w-full h-96 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Document patient complaints and clinical history..."><?php echo e($consult->subjective ?? ''); ?></textarea>
 </div>
 
 <div id="soap-objective" class="soap-panel hidden">
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-microscope text-sage/50"></i>
 <span>Physical Examination Findings</span>
 </div>
 <textarea id="objective" oninput="syncInputs()" class="w-full h-96 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Document physical examination findings..."><?php echo e($consult->objective ?? ''); ?></textarea>
 </div>

 <div id="soap-assessment" class="soap-panel hidden space-y-8">
 <div>
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-diagnoses text-sage/50"></i>
 <span>Clinical Impression & Diagnosis</span>
 </div>
 <textarea id="assessment" oninput="syncInputs()" class="w-full h-48 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Document working diagnosis..."><?php echo e($consult->assessment ?? ''); ?></textarea>
 </div>
 
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'ICD-11 Diagnostic Encoding','icon' => 'fa-barcode']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'ICD-11 Diagnostic Encoding','icon' => 'fa-barcode']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <div class="flex gap-4 mb-6">
 <div class="flex-1">
 <?php if (isset($component)) { $__componentOriginalc42b184c8aa3d30580c8722aa3451660 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc42b184c8aa3d30580c8722aa3451660 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-input','data' => ['name' => 'icdSearch','placeholder' => 'Search codes (e.g. Malaria, COVID)...','icon' => 'fa-search']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'icdSearch','placeholder' => 'Search codes (e.g. Malaria, COVID)...','icon' => 'fa-search']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc42b184c8aa3d30580c8722aa3451660)): ?>
<?php $attributes = $__attributesOriginalc42b184c8aa3d30580c8722aa3451660; ?>
<?php unset($__attributesOriginalc42b184c8aa3d30580c8722aa3451660); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc42b184c8aa3d30580c8722aa3451660)): ?>
<?php $component = $__componentOriginalc42b184c8aa3d30580c8722aa3451660; ?>
<?php unset($__componentOriginalc42b184c8aa3d30580c8722aa3451660); ?>
<?php endif; ?>
 </div>
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'button','variant' => 'secondary','onclick' => 'addICD()','icon' => 'fa-plus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','variant' => 'secondary','onclick' => 'addICD()','icon' => 'fa-plus']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Encode
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
 <div id="icdList" class="flex flex-wrap gap-2">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-sage/10 text-sage border border-blue-500/20 rounded-xl text-[12px] font-semibold uppercase tracking-tight">
 <?php echo e($code); ?> 
 <button class="hover:text-white transition-colors">✕</button>
 </span>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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

 <div id="soap-plan" class="soap-panel hidden space-y-8">
 <div>
 <div class="flex items-center gap-2 text-[12px] font-semibold text-slate-500 font-medium mb-4">
 <i class="fas fa-clipboard-list text-sage/50"></i>
 <span>Management Protocol & Follow-up</span>
 </div>
 <textarea id="plan" oninput="syncInputs()" class="w-full h-48 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-6 text-sm font-medium text-slate-200 placeholder-slate-700 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all resize-none " placeholder="Outline treatment plan and follow-up instructions..."><?php echo e($consult->plan ?? ''); ?></textarea>
 </div>
 
 <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Institutional Pharmacy Order','icon' => 'fa-pills']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Institutional Pharmacy Order','icon' => 'fa-pills']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <div id="prescList" class="space-y-3 mb-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="p-4 bg-card rounded-xl border border-subtle flex justify-between items-center group hover:border-blue-500/30 transition-all">
 <div>
 <div class="text-[12px] text-slate-200 font-semibold uppercase tracking-tight"><?php echo e($p['drug']); ?></div>
 <div class="text-[12px] text-slate-500 font-bold uppercase mt-1"><?php echo e($p['dose']); ?></div>
 </div>
 <button class="text-slate-600 hover:text-rose-500 transition-colors">✕</button>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['type' => 'button','variant' => 'ghost','class' => 'w-full border-dashed border-subtle','onclick' => 'addPresc()','icon' => 'fa-plus']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','variant' => 'ghost','class' => 'w-full border-dashed border-subtle','onclick' => 'addPresc()','icon' => 'fa-plus']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Add Medication
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Diagnostic Investigations','icon' => 'fa-microscope']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Diagnostic Investigations','icon' => 'fa-microscope']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <textarea id="procedure_notes" class="w-full h-32 bg-[#1a1d24]/50 border border-subtle rounded-2xl p-4 text-xs font-bold text-slate-400 placeholder-slate-800 outline-none focus:border-emerald-500/50 focus:ring-4 focus:ring-emerald-500/10 transition-all resize-none " placeholder="Request labs or radiology scans..."><?php echo e($consult->procedure_notes ?? ''); ?></textarea>
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
 
 <!-- Forensic Command Strip -->
 <div class="p-6 bg-card border-t border-subtle flex justify-between items-center">
 <div class="text-[12px] font-semibold text-slate-500 font-medium flex items-center gap-2">
 <i class="fas fa-shield-check text-sage/50"></i>
 <span>End-to-End Encryption Active</span>
 </div>
 <?php if (isset($component)) { $__componentOriginal2d350f6afc4d732ce961fba75ba7e203 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2d350f6afc4d732ce961fba75ba7e203 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-button','data' => ['onclick' => 'submitSave()','icon' => 'fa-cloud-upload']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['onclick' => 'submitSave()','icon' => 'fa-cloud-upload']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 Synchronize Documentation
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
 </div>

 <!-- Clinical Intelligence Panel (1 Column) -->
 <div class="lg:col-span-1 space-y-6">
 
 <!-- Dynamic Vitals Pulse -->
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Institutional Vitals','icon' => 'fa-heart-pulse']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Institutional Vitals','icon' => 'fa-heart-pulse']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <div class="grid grid-cols-2 gap-4">
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">BP Gauge</label>
 <div class="text-lg font-semibold text-white">120/80</div>
 <div class="text-[8px] font-bold text-emerald-500 mt-1 uppercase">Normal Range</div>
 </div>
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">Thermal</label>
 <div class="text-lg font-semibold text-emerald-500">36.8°C</div>
 <div class="text-[8px] font-bold text-slate-500 mt-1 uppercase">Febrile Negative</div>
 </div>
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">O2 Saturation</label>
 <div class="text-lg font-semibold text-sage">98%</div>
 <div class="text-[8px] font-bold text-sage/50 mt-1 uppercase">Ambient Air</div>
 </div>
 <div class="p-4 bg-card rounded-2xl border border-subtle group hover:border-blue-500/20 transition-all">
 <label class="text-[12px] font-semibold text-slate-500 font-medium block mb-2">Mass Index</label>
 <div class="text-lg font-semibold text-white">72.5 kg</div>
 <div class="text-[8px] font-bold text-slate-500 mt-1 uppercase">Target: 70kg</div>
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

 <!-- Forensic Alert Center -->
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Clinical Risks','icon' => 'fa-triangle-exclamation','class' => 'border-rose-500/20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Clinical Risks','icon' => 'fa-triangle-exclamation','class' => 'border-rose-500/20']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <div class="p-4 bg-rose-500/5 rounded-2xl border border-rose-500/10 text-xs font-bold text-rose-200">
 <i class="fas fa-hand-dots mr-2"></i>
 <?php echo e($encounter->allergies ?: 'No Allergies Documented'); ?>

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

 <!-- Longitudinal Timeline -->
 <?php if (isset($component)) { $__componentOriginal4da797a88693fb589dd89646de275649 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4da797a88693fb589dd89646de275649 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cc-card','data' => ['title' => 'Patient Timeline','icon' => 'fa-timeline']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cc-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Patient Timeline','icon' => 'fa-timeline']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

 <div class="space-y-6 relative">
 <div class="absolute left-2.5 top-2 bottom-2 w-px bg-[#2a2e38]"></div>
 
 <div class="pl-8 relative">
 <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-sage/10 border border-blue-500 flex items-center justify-center z-10 shadow-[0_0_15px_rgba(59,130,246,0.3)]">
 <div class="w-1.5 h-1.5 rounded-full bg-sage"></div>
 </div>
 <span class="text-[12px] font-semibold text-sage font-medium block">Active</span>
 <h4 class="text-xs font-semibold text-white uppercase mt-1">EMR Documentation</h4>
 <p class="text-[12px] font-medium text-slate-500 mt-1">Started <?php echo e(\Carbon\Carbon::parse($encounter->created_at)->format('H:i')); ?></p>
 </div>
 
 <div class="pl-8 relative">
 <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-[#2a2e38] border border-slate-700 flex items-center justify-center z-10">
 <div class="w-1.5 h-1.5 rounded-full bg-slate-600"></div>
 </div>
 <span class="text-[12px] font-semibold text-slate-600 font-medium block">Genesis</span>
 <h4 class="text-xs font-semibold text-slate-500 uppercase mt-1">Record Initialized</h4>
 <p class="text-[12px] font-medium text-slate-700 mt-1 ">New institutional entry.</p>
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
 </div>
</div>

<!-- Hidden Persistence Gateway -->
<form action="<?php echo e(route('emr.save')); ?>" method="POST" id="saveForm" class="hidden">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="encounter_id" value="<?php echo e($encounterId); ?>">
 <input type="hidden" name="subjective" id="hidden_subjective">
 <input type="hidden" name="objective" id="hidden_objective">
 <input type="hidden" name="assessment" id="hidden_assessment">
 <input type="hidden" name="plan" id="hidden_plan">
</form>

<style>
 .tab-btn { color: rgba(148, 163, 184, 0.6); }
 .tab-btn.active { color: #3b82f6; border-color: #3b82f6; background-color: rgba(59, 130, 246, 0.05); text-shadow: 0 0 15px rgba(59, 130, 246, 0.4); }
 .tab-btn:hover:not(.active) { color: #cbd5e1; background-color: rgba(255, 255, 255, 0.02); }
 .soap-panel.hidden { display: none; }
</style>

<script>
 function setSoapTab(name) {
 document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
 document.getElementById('btn-' + name).classList.add('active');
 
 document.querySelectorAll('.soap-panel').forEach(p => p.classList.add('hidden'));
 document.getElementById('soap-' + name).classList.remove('hidden');
 }

 function syncInputs() {
 document.getElementById('hidden_subjective').value = document.getElementById('subjective').value;
 document.getElementById('hidden_objective').value = document.getElementById('objective').value;
 document.getElementById('hidden_assessment').value = document.getElementById('assessment').value;
 document.getElementById('hidden_plan').value = document.getElementById('plan').value;
 }

 function submitSave() {
 syncInputs();
 document.getElementById('saveForm').submit();
 }

 function finalizeSession() {
 if(confirm("Institutional Protocol: Finalize this clinical session? The forensic record will be synchronized and locked.")) {
 document.getElementById('closeForm').submit();
 }
 }

 // Initialize synchronization
 syncInputs();
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\emr.blade.php ENDPATH**/ ?>
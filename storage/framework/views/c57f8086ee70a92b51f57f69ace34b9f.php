<?php if (isset($component)) { $__componentOriginalbc817d30aff94645282678110822d638 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc817d30aff94645282678110822d638 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.public-shell','data' => ['title' => 'Opeshis OS']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('public-shell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Opeshis OS']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>




<div class="pt-32 pb-20 border-b border-subtle relative overflow-hidden">
 <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-transparent"></div>
 <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
 <h1 class="text-4xl md:text-6xl font-semibold text-white mb-6 uppercase tracking-tighter fade-up">Platform Ecosystem</h1>
 <p class="text-xl text-white/40 max-w-3xl mx-auto font-light leading-relaxed fade-up">
 Opeshis OS is a modular healthcare operating system. 22 specialized modules working in absolute real-time synchronization to power your entire institution.
 </p>
 </div>
</div>

<section class="py-24 bg-[#050505]">
 <div class="max-w-7xl mx-auto px-6 lg:px-8">
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

 <!-- EMR Card -->
 <div class="feature-card rounded-[3rem] p-10 group fade-up">
 <div class="w-14 h-14 bg-sage/10 text-sage rounded-2xl flex items-center justify-center mb-8 group-hover:bg-sage group-hover:text-white transition-colors">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
 </div>
 <h3 class="text-2xl font-semibold text-white mb-4 tracking-tight uppercase">Clinical & EMR</h3>
 <p class="text-white/40 text-sm leading-relaxed mb-8 font-light">Standardized SOAP consultations, ICD-11 coding, and immutable record management.</p>
 <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center text-sage font-semibold text-[12px] font-medium group-hover:text-white transition-all">
 Access Module &rarr;
 </a>
 </div>

 <!-- Lab Card -->
 <div class="feature-card rounded-[3rem] p-10 group fade-up" style="transition-delay: 100ms">
 <div class="w-14 h-14 bg-emerald-600/10 text-emerald-500 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
 </div>
 <h3 class="text-2xl font-semibold text-white mb-4 tracking-tight uppercase">Laboratory Ops</h3>
 <p class="text-white/40 text-sm leading-relaxed mb-8 font-light">Automated result validation, reference standards, and watermarked clinical reports.</p>
 <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center text-emerald-500 font-semibold text-[12px] font-medium group-hover:text-white transition-all">
 Access Module &rarr;
 </a>
 </div>

 <!-- Pharmacy Card -->
 <div class="feature-card rounded-[3rem] p-10 group fade-up" style="transition-delay: 200ms">
 <div class="w-14 h-14 bg-purple-600/10 text-purple-500 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-purple-600 group-hover:text-white transition-colors">
 <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
 </div>
 <h3 class="text-2xl font-semibold text-white mb-4 tracking-tight uppercase">Pharmacy & POS</h3>
 <p class="text-white/40 text-sm leading-relaxed mb-8 font-light">Real-time inventory management, drug interaction checking, and dispensing workflows.</p>
 <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center text-purple-500 font-semibold text-[12px] font-medium group-hover:text-white transition-all">
 Access Module &rarr;
 </a>
 </div>

 <!-- More features... (simplified for now) -->
 </div>
 </div>
</section>

<!-- Governance Focus -->
<section class="py-32 bg-sage/5 relative overflow-hidden">
 <div class="max-w-7xl mx-auto px-6 lg:px-8">
 <div class="text-center mb-20">
 <h2 class="text-[12px] font-semibold text-sage uppercase tracking-[0.3em] mb-4">Institutional Integrity</h2>
 <h3 class="text-4xl md:text-6xl font-semibold text-white mb-6 uppercase tracking-tighter">Governance Protocol</h3>
 <p class="text-xl text-white/40 max-w-3xl mx-auto font-light leading-relaxed">
 Mission-critical control plane synchronizing granular functional authority with clinical duty segregation.
 </p>
 </div>

 <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
 <div class="fade-up">
 <div class="text-5xl font-semibold text-white/10 mb-4 ">34+</div>
 <h4 class="text-xl font-semibold text-white mb-4 uppercase tracking-tight">Clinical Roles</h4>
 <p class="text-white/40 text-sm leading-relaxed font-light">Pre-configured roles for Surgeons, Neonatologists, and CHW Supervisors.</p>
 </div>
 <div class="fade-up" style="transition-delay: 100ms">
 <div class="text-5xl font-semibold text-white/10 mb-4 ">217+</div>
 <h4 class="text-xl font-semibold text-white mb-4 uppercase tracking-tight">Authorities</h4>
 <p class="text-white/40 text-sm leading-relaxed font-light">Granular precision gating for voiding bills, ordering investigations, and verifying results.</p>
 </div>
 <div class="fade-up" style="transition-delay: 200ms">
 <div class="text-5xl font-semibold text-white/10 mb-4 ">SoD</div>
 <h4 class="text-xl font-semibold text-white mb-4 uppercase tracking-tight">Duty Segregation</h4>
 <p class="text-white/40 text-sm leading-relaxed font-light">Hard-gate logic preventing conflicting authorities from being assigned to a single role.</p>
 </div>
 </div>
 </div>
</section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc817d30aff94645282678110822d638)): ?>
<?php $attributes = $__attributesOriginalbc817d30aff94645282678110822d638; ?>
<?php unset($__attributesOriginalbc817d30aff94645282678110822d638); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc817d30aff94645282678110822d638)): ?>
<?php $component = $__componentOriginalbc817d30aff94645282678110822d638; ?>
<?php unset($__componentOriginalbc817d30aff94645282678110822d638); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\opeshis\resources\views\public\features.blade.php ENDPATH**/ ?>
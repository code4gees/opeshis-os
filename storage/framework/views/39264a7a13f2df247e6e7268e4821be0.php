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
 <h1 class="text-5xl md:text-8xl font-semibold text-white tracking-tighter mb-8 uppercase fade-up">
 Architecting <span class="text-sage">Clinical Sovereignty</span>
 </h1>
 <p class="text-xl md:text-2xl text-white/40 max-w-4xl mx-auto font-light leading-relaxed fade-up">
 Headquartered in Douala, Cameroon, Opeshis OS is engineering the institutional backbone of healthcare for the Global South.
 </p>
 </div>
</div>

<section class="py-24 bg-[#050505]">
 <div class="max-w-7xl mx-auto px-6 lg:px-8">

 <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start mb-40">
 <div class="fade-up">
 <h2 class="text-[12px] font-semibold text-sage uppercase tracking-[0.3em] mb-8">The Opeshis Genesis</h2>
 <h3 class="text-4xl md:text-6xl font-semibold text-white mb-10 tracking-tighter leading-tight uppercase">Beyond Simple Software. <span class="text-sage">Operating System Level.</span></h3>
 <div class="text-white/40 space-y-6 font-light text-lg">
 <p>
 Opeshis OS was born out of a critical observation in the field: traditional healthcare software is built for high-bandwidth, stable-power environments. When deployed in regional institutions, these systems fail during internet outages and fragment clinical data across silos.
 </p>
 <p>
 We didn't just build an application; we built an **Institutional Operating System**. By prioritizing Local-First architecture and Edge Computing, we ensure that clinical care never stops, regardless of the external environment.
 </p>
 </div>
 </div>

 <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
 <div class="feature-card p-10 rounded-[3rem] fade-up">
 <h4 class="text-4xl font-semibold text-sage mb-4 tracking-tighter">22</h4>
 <p class="text-[12px] font-semibold font-medium text-white/30 mb-2">Pillar Modules</p>
 <p class="text-sm text-white/40 leading-relaxed font-light">A unified ecosystem covering every clinical and operational touchpoint.</p>
 </div>
 <div class="feature-card p-10 rounded-[3rem] fade-up" style="transition-delay: 100ms">
 <h4 class="text-4xl font-semibold text-emerald-500 mb-4 tracking-tighter">100%</h4>
 <p class="text-[12px] font-semibold font-medium text-white/30 mb-2">Offline Uptime</p>
 <p class="text-sm text-white/40 leading-relaxed font-light">Zero reliance on the cloud for critical life-saving consultations.</p>
 </div>
 <div class="feature-card p-10 rounded-[3rem] fade-up" style="transition-delay: 200ms">
 <h4 class="text-4xl font-semibold text-sage mb-4 tracking-tighter">AES</h4>
 <p class="text-[12px] font-semibold font-medium text-white/30 mb-2">Data Sovereignty</p>
 <p class="text-sm text-white/40 leading-relaxed font-light">Extreme encryption ensuring hospital records remain locally secure.</p>
 </div>
 <div class="feature-card p-10 rounded-[3rem] fade-up" style="transition-delay: 300ms">
 <h4 class="text-4xl font-semibold text-rose-500 mb-4 tracking-tighter">CDSS</h4>
 <p class="text-[12px] font-semibold font-medium text-white/30 mb-2">Clinical Intel</p>
 <p class="text-sm text-white/40 leading-relaxed font-light">Built-in safeguards for diagnostic accuracy in regional clinics.</p>
 </div>
 </div>
 </div>

 <div class="bg-sage/5 border border-subtle rounded-[4rem] p-20 text-white relative overflow-hidden fade-up">
 <div class="relative z-10">
 <div class="max-w-3xl mb-16">
 <h2 class="text-[12px] font-semibold text-sage uppercase tracking-[0.3em] mb-8">Our Standards</h2>
 <h3 class="text-4xl md:text-5xl font-semibold mb-10 tracking-tighter uppercase">Engineering for Institutional Longevity</h3>
 <p class="text-xl text-white/40 font-light leading-relaxed">
 We don't just deploy and leave. Opeshis OS provides a lifetime commitment to the clinical integrity of your institution.
 </p>
 </div>

 <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
 <div>
 <h4 class="font-semibold text-[12px] font-medium mb-4 text-sage">Clinical Integrity</h4>
 <p class="text-sm text-white/40 leading-relaxed font-light">Standardizing every consultation with ICD-11, SNOMED CT, and automated SOAP workflows.</p>
 </div>
 <div>
 <h4 class="font-semibold text-[12px] font-medium mb-4 text-sage">Financial Security</h4>
 <p class="text-sm text-white/40 leading-relaxed font-light">Zero-leakage architectures that bridge the gap between clinical care and fiscal reality.</p>
 </div>
 <div>
 <h4 class="font-semibold text-[12px] font-medium mb-4 text-sage">National Impact</h4>
 <p class="text-sm text-white/40 leading-relaxed font-light">Direct integration with DHIS2 and regional health directories for national reporting.</p>
 </div>
 </div>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\public\about.blade.php ENDPATH**/ ?>
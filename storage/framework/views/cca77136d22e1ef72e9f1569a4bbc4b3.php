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
 <h1 class="text-5xl md:text-7xl font-semibold text-white tracking-tighter mb-6 uppercase fade-up">
 Institutional <span class="text-sage">Insights</span>
 </h1>
 <p class="text-xl text-white/40 max-w-2xl mx-auto font-light leading-relaxed fade-up">
 Analyzing the intersection of clinical excellence, infrastructure engineering, and medical policy across the African continent.
 </p>
 </div>
</div>

<div class="py-24 max-w-7xl mx-auto px-6 lg:px-8">
 <div class="flex flex-col lg:flex-row gap-16">
 
 <!-- Sidebar -->
 <aside class="w-full lg:w-1/4 shrink-0">
 <div class="sticky top-32 space-y-10">
 <div>
 <h3 class="text-[12px] font-semibold uppercase tracking-[0.3em] text-white/30 mb-8">Filter by Category</h3>
 <div class="flex flex-wrap lg:flex-col gap-3">
 <button onclick="filterBlog('all')" class="px-6 py-3 rounded-2xl text-[12px] font-semibold font-medium transition-all bg-sage text-white /20">All Insights</button>
 <button onclick="filterBlog('Infrastructure')" class="px-6 py-3 rounded-2xl text-[12px] font-semibold font-medium transition-all bg-[#2a2e38] text-white/40 hover:bg-white/10 hover:text-white">Infrastructure</button>
 <button onclick="filterBlog('Clinical')" class="px-6 py-3 rounded-2xl text-[12px] font-semibold font-medium transition-all bg-[#2a2e38] text-white/40 hover:bg-white/10 hover:text-white">Clinical Support</button>
 <button onclick="filterBlog('Operations')" class="px-6 py-3 rounded-2xl text-[12px] font-semibold font-medium transition-all bg-[#2a2e38] text-white/40 hover:bg-white/10 hover:text-white">Operations</button>
 </div>
 </div>

 <div class="p-10 bg-sage/5 rounded-[2.5rem] border border-subtle">
 <h4 class="text-xl font-semibold text-white mb-4 uppercase tracking-tighter">Institutional Ledger</h4>
 <p class="text-sm text-white/40 mb-8 font-light">Join 2,000+ medical directors receiving our weekly technical updates.</p>
 <input type="email" placeholder="work@institution.org" class="w-full bg-[#2a2e38] border border-subtle rounded-2xl px-6 py-4 text-xs text-white mb-4 focus:border-indigo-500 outline-none">
 <button class="w-full bg-sage text-white py-4 rounded-2xl text-[12px] font-semibold font-medium hover:bg-sage transition /20">Subscribe</button>
 </div>
 </div>
 </aside>
 
 <!-- Grid -->
 <div class="w-full lg:w-3/4">
 <div id="blog-grid" class="grid grid-cols-1 md:grid-cols-2 gap-12">
 
 <article class="group fade-up blog-card" data-category="Infrastructure">
 <div class="aspect-video bg-[#2a2e38] rounded-[2.5rem] mb-8 overflow-hidden relative border border-subtle">
 <div class="absolute inset-0 bg-sage/10 group-hover:bg-transparent transition-all"></div>
 <div class="absolute bottom-6 left-6 text-white font-semibold uppercase text-[12px] tracking-wider bg-sage px-4 py-1.5 rounded-full">Infrastructure</div>
 </div>
 <h2 class="text-2xl font-semibold text-white mb-4 group-hover:text-sage transition tracking-tight uppercase">
 The Crisis of HIS in Africa: A Systemic Analysis
 </h2>
 <p class="text-white/40 text-sm leading-relaxed mb-8 font-light">
 Why 80% of legacy HMS deployments fail in Sub-Saharan Africa, and how localized engineering solves the infrastructure gap.
 </p>
 <a href="<?php echo e(route('public.blog.post', 'crisis-of-his-africa')); ?>" class="text-[12px] font-semibold font-medium text-sage hover:text-white transition-all flex items-center gap-2">
 Read Deep Dive &rarr;
 </a>
 </article>

 <article class="group fade-up blog-card" data-category="Clinical">
 <div class="aspect-video bg-[#2a2e38] rounded-[2.5rem] mb-8 overflow-hidden relative border border-subtle">
 <div class="absolute inset-0 bg-emerald-600/10 group-hover:bg-transparent transition-all"></div>
 <div class="absolute bottom-6 left-6 text-white font-semibold uppercase text-[12px] tracking-wider bg-emerald-600 px-4 py-1.5 rounded-full">Clinical Support</div>
 </div>
 <h2 class="text-2xl font-semibold text-white mb-4 group-hover:text-emerald-400 transition tracking-tight uppercase">
 Reducing Diagnostic Error: The Role of CDSS
 </h2>
 <p class="text-white/40 text-sm leading-relaxed mb-8 font-light">
 How Clinical Decision Support Systems bridge the specialist gap in regional medical centers across Cameroon.
 </p>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\public\blog.blade.php ENDPATH**/ ?>
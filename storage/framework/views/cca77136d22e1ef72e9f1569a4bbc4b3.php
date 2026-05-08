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


<?php $__env->startSection('title', 'Institutional Insights — Opeshis OS Blog'); ?>


<div class="pt-32 pb-20 border-b border-white/5 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter mb-6 uppercase fade-up">
            Institutional <span class="text-indigo-500">Insights</span>
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
                    <h3 class="text-[11px] font-black uppercase tracking-[0.3em] text-white/30 mb-8">Filter by Category</h3>
                    <div class="flex flex-wrap lg:flex-col gap-3">
                        <button onclick="filterBlog('all')" class="px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all bg-indigo-600 text-white shadow-xl shadow-indigo-600/20">All Insights</button>
                        <button onclick="filterBlog('Infrastructure')" class="px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all bg-white/5 text-white/40 hover:bg-white/10 hover:text-white">Infrastructure</button>
                        <button onclick="filterBlog('Clinical')" class="px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all bg-white/5 text-white/40 hover:bg-white/10 hover:text-white">Clinical Support</button>
                        <button onclick="filterBlog('Operations')" class="px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all bg-white/5 text-white/40 hover:bg-white/10 hover:text-white">Operations</button>
                    </div>
                </div>

                <div class="p-10 bg-indigo-600/5 rounded-[2.5rem] border border-white/5">
                    <h4 class="text-xl font-black text-white mb-4 uppercase tracking-tighter">Institutional Ledger</h4>
                    <p class="text-sm text-white/40 mb-8 font-light">Join 2,000+ medical directors receiving our weekly technical updates.</p>
                    <input type="email" placeholder="work@institution.org" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-xs text-white mb-4 focus:border-indigo-500 outline-none">
                    <button class="w-full bg-indigo-600 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-500 transition shadow-xl shadow-indigo-600/20">Subscribe</button>
                </div>
            </div>
        </aside>
        
        <!-- Grid -->
        <div class="w-full lg:w-3/4">
            <div id="blog-grid" class="grid grid-cols-1 md:grid-cols-2 gap-12">
                
                <article class="group fade-up blog-card" data-category="Infrastructure">
                    <div class="aspect-video bg-white/5 rounded-[2.5rem] mb-8 overflow-hidden relative border border-white/5">
                        <div class="absolute inset-0 bg-indigo-600/10 group-hover:bg-transparent transition-all"></div>
                        <div class="absolute bottom-6 left-6 text-white font-black uppercase text-[9px] tracking-widest bg-indigo-600 px-4 py-1.5 rounded-full">Infrastructure</div>
                    </div>
                    <h2 class="text-2xl font-black text-white mb-4 group-hover:text-indigo-400 transition tracking-tight uppercase">
                        The Crisis of HIS in Africa: A Systemic Analysis
                    </h2>
                    <p class="text-white/40 text-sm leading-relaxed mb-8 font-light">
                        Why 80% of legacy HMS deployments fail in Sub-Saharan Africa, and how localized engineering solves the infrastructure gap.
                    </p>
                    <a href="#" class="text-[10px] font-black uppercase tracking-widest text-indigo-500 hover:text-white transition-all flex items-center gap-2">
                        Read Deep Dive &rarr;
                    </a>
                </article>

                <article class="group fade-up blog-card" data-category="Clinical">
                    <div class="aspect-video bg-white/5 rounded-[2.5rem] mb-8 overflow-hidden relative border border-white/5">
                        <div class="absolute inset-0 bg-emerald-600/10 group-hover:bg-transparent transition-all"></div>
                        <div class="absolute bottom-6 left-6 text-white font-black uppercase text-[9px] tracking-widest bg-emerald-600 px-4 py-1.5 rounded-full">Clinical Support</div>
                    </div>
                    <h2 class="text-2xl font-black text-white mb-4 group-hover:text-emerald-400 transition tracking-tight uppercase">
                        Reducing Diagnostic Error: The Role of CDSS
                    </h2>
                    <p class="text-white/40 text-sm leading-relaxed mb-8 font-light">
                        How Clinical Decision Support Systems bridge the specialist gap in regional medical centers across Cameroon.
                    </p>
                    <a href="#" class="text-[10px] font-black uppercase tracking-widest text-emerald-500 hover:text-white transition-all flex items-center gap-2">
                        Read Deep Dive &rarr;
                    </a>
                </article>

            </div>
        </div>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\public\blog.blade.php ENDPATH**/ ?>
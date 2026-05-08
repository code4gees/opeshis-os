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


<?php $__env->startSection('title', 'Frequently Asked Questions — Opeshis OS Intelligence'); ?>


<div class="pt-32 pb-20 border-b border-white/5 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-transparent"></div>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-7xl font-black text-white tracking-tighter mb-6 uppercase fade-up">Institutional <span class="text-indigo-500">Intelligence</span> FAQ</h1>
        <p class="text-xl text-white/40 max-w-3xl mx-auto font-light leading-relaxed">
            Technical and operational answers for the Opeshis OS 22-Pillar Ecosystem.
        </p>
    </div>
</div>

<section class="py-24 bg-[#050505]">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
        
        <div class="space-y-16">
            
            <!-- Clinical Section -->
            <div class="fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-600/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h2 class="text-[11px] font-black text-indigo-500 uppercase tracking-[0.3em]">Clinical & Consultations</h2>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <details class="group feature-card rounded-3xl p-8 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex items-center justify-between cursor-pointer"><h3 class="text-lg font-black text-white tracking-tight uppercase">General Clinics: How does Opeshis handle outpatient traffic?</h3><span class="text-indigo-500 transition-transform group-open:rotate-180"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></span></summary>
                        <p class="mt-4 text-white/40 text-sm leading-relaxed font-light">The Clinics module manages the entire outpatient journey from self-check-in to consultation, ensuring zero-bottleneck workflows even in high-volume urban medical centers.</p>
                    </details>
                    <details class="group feature-card rounded-3xl p-8 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex items-center justify-between cursor-pointer"><h3 class="text-lg font-black text-white tracking-tight uppercase">EMR: Are consultations permanent and immutable?</h3><span class="text-indigo-500 transition-transform group-open:rotate-180"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></span></summary>
                        <p class="mt-4 text-white/40 text-sm leading-relaxed font-light">Yes. Once a consultation is locked by the physician, it becomes a permanent legal record. Any subsequent amendments are tracked as separate, versioned addendums.</p>
                    </details>
                    <details class="group feature-card rounded-3xl p-8 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex items-center justify-between cursor-pointer"><h3 class="text-lg font-black text-white tracking-tight uppercase">Triage: Can nurses capture vitals on mobile devices?</h3><span class="text-indigo-500 transition-transform group-open:rotate-180"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></span></summary>
                        <p class="mt-4 text-white/40 text-sm leading-relaxed font-light">Absolutely. The Triage module is fully responsive, allowing nurses to capture vitals at the bedside via tablets or smartphones, instantly syncing with the doctor's dashboard.</p>
                    </details>
                </div>
            </div>

            <!-- Category 2: Diagnostics & Supply -->
            <div class="fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h2 class="text-[11px] font-black text-emerald-500 uppercase tracking-[0.3em]">Diagnostics & Supply</h2>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <details class="group feature-card rounded-3xl p-8 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex items-center justify-between cursor-pointer"><h3 class="text-lg font-black text-white tracking-tight uppercase">Lab: Can we integrate with automated analyzers?</h3><span class="text-emerald-500 transition-transform group-open:rotate-180"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></span></summary>
                        <p class="mt-4 text-white/40 text-sm leading-relaxed font-light">Yes. The Laboratory module supports HL7 and LIS protocols to ingest results directly from automated hematology and biochemistry analyzers.</p>
                    </details>
                    <details class="group feature-card rounded-3xl p-8 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex items-center justify-between cursor-pointer"><h3 class="text-lg font-black text-white tracking-tight uppercase">Pharmacy: How is inventory expiry tracked?</h3><span class="text-emerald-500 transition-transform group-open:rotate-180"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg></span></summary>
                        <p class="mt-4 text-white/40 text-sm leading-relaxed font-light">The Pharmacy module features real-time FEFO (First-Expiry, First-Out) tracking with automated alerts for medications nearing their expiration date.</p>
                    </details>
                </div>
            </div>

        </div>
        
        <div class="mt-32 p-16 bg-indigo-600/5 border border-white/5 rounded-[4rem] text-white text-center fade-up relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="text-3xl md:text-5xl font-black mb-8 tracking-tighter uppercase">Still have questions?</h3>
                <p class="text-xl text-white/40 mb-12 max-w-2xl mx-auto font-light">Our technical implementation team is ready to provide a full institutional audit of your facility.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="/contact" class="px-12 py-6 bg-indigo-600 rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-indigo-500 transition shadow-2xl shadow-indigo-600/30">Request Live Demo</a>
                    <a href="/features" class="px-12 py-6 bg-white/5 border border-white/10 rounded-2xl font-black uppercase text-[11px] tracking-widest hover:bg-white/10 transition">Technical Briefing</a>
                </div>
            </div>
        </div>
    </div>
</section>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\public\faq.blade.php ENDPATH**/ ?>
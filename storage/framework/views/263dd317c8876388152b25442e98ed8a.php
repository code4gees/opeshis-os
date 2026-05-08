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


<?php $__env->startSection('title', 'Self-Service Triage Kiosk - Opeshis OS'); ?>


<div class="min-h-screen flex flex-col items-center justify-center p-8 bg-slate-950 bg-[radial-gradient(circle_at_center,rgba(79,70,229,0.1)_0%,transparent_70%)]">
    <div class="w-full max-w-4xl glass-panel rounded-[4rem] p-20 shadow-2xl overflow-hidden relative border border-white/10">
        <div class="absolute top-0 left-0 w-full h-4 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
        
        <div class="mb-20 text-center">
            <h1 class="text-6xl font-black text-white uppercase tracking-tighter mb-4 italic">Institutional Kiosk</h1>
            <p class="text-xs font-black text-indigo-500 uppercase tracking-[0.4em]">Rapid Vital Integration Matrix</p>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-16 p-10 bg-emerald-500/10 border-2 border-emerald-500/20 text-emerald-400 rounded-[3rem] text-2xl font-black text-center animate-bounce shadow-2xl shadow-emerald-500/20">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(url('/kiosk/triage')); ?>" class="grid grid-cols-2 gap-12">
            <?php echo csrf_field(); ?>
            <div class="col-span-2 relative group">
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-6 text-center">Scan Institutional Medical ID</label>
                <input type="text" name="patient_id" placeholder="OP-XXXX-XXXX" required autofocus
                    class="w-full bg-white/5 border-4 border-white/10 rounded-[2.5rem] px-12 py-10 text-4xl font-black text-center text-white outline-none focus:border-indigo-500 focus:ring-8 focus:ring-indigo-500/10 transition-all uppercase placeholder-slate-800">
                <div class="absolute inset-0 rounded-[2.5rem] border-2 border-indigo-500/0 group-focus-within:border-indigo-500/20 pointer-events-none transition-all"></div>
            </div>

            <div class="space-y-6">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Systolic BP (mmHg)</label>
                <input type="number" name="bp_systolic" required 
                    class="w-full bg-white/5 border-2 border-white/10 rounded-3xl px-8 py-8 text-3xl font-black text-center text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>

            <div class="space-y-6">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Diastolic BP (mmHg)</label>
                <input type="number" name="bp_diastolic" required 
                    class="w-full bg-white/5 border-2 border-white/10 rounded-3xl px-8 py-8 text-3xl font-black text-center text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>

            <div class="space-y-6">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Temperature (°C)</label>
                <input type="number" step="0.1" name="temperature" required 
                    class="w-full bg-white/5 border-2 border-white/10 rounded-3xl px-8 py-8 text-3xl font-black text-center text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>

            <div class="space-y-6">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Pulse Rate (BPM)</label>
                <input type="number" name="pulse" required 
                    class="w-full bg-white/5 border-2 border-white/10 rounded-3xl px-8 py-8 text-3xl font-black text-center text-white outline-none focus:border-indigo-500/50 transition-all">
            </div>

            <div class="col-span-2 mt-16">
                <button type="submit" class="group relative w-full py-12 bg-indigo-600 text-white rounded-[3rem] text-3xl font-black uppercase tracking-[0.2em] shadow-2xl shadow-indigo-600/40 hover:bg-indigo-500 transition-all hover:scale-[1.02] active:scale-[0.98] border border-indigo-400/30 overflow-hidden">
                    <span class="relative z-10 flex items-center justify-center gap-4">
                        Initialize Case Flow
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="animate-bounce-x"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </button>
            </div>
        </form>

        <div class="mt-24 text-center">
            <p class="text-[9px] font-black text-slate-600 uppercase tracking-[0.5em] italic">Confidential Institutional Perimeter · Secured Core</p>
        </div>
    </div>
</div>

<style>
    @keyframes bounce-x {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(5px); }
    }
    .animate-bounce-x { animation: bounce-x 1s infinite; }
</style>
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
<?php /**PATH C:\laragon\www\opeshis\resources\views\kiosk\triage.blade.php ENDPATH**/ ?>
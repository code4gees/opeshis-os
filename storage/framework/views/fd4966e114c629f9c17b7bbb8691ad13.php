<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutional Login - Opeshis OS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #050505; color: #fff; overflow: hidden; }
        .hero-gradient { background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.1), transparent 50%), radial-gradient(circle at bottom left, rgba(16, 185, 129, 0.05), transparent 50%); }
        .login-card { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); backdrop-filter: blur(40px); }
        .bg-blob {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.08) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            z-index: 0;
            filter: blur(80px);
            animation: float 20s infinite alternate;
        }
        @keyframes float { 0% { transform: translate(-10%, -10%) scale(1); } 100% { transform: translate(10%, 10%) scale(1.1); } }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6 overflow-hidden">
    <div class="bg-blob" style="top: -200px; left: -200px;"></div>
    <div class="bg-blob" style="bottom: -200px; right: -200px; background: radial-gradient(circle, rgba(236, 72, 153, 0.05) 0%, rgba(0,0,0,0) 70%);"></div>

    <div class="w-full max-w-md p-10 login-card rounded-[3rem] shadow-2xl relative z-10">
        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl shadow-indigo-600/20">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h1 class="text-2xl font-black text-white tracking-tighter uppercase">Opeshis OS</h1>
            <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] mt-2">Institutional Access</p>
        </div>

        <form id="loginForm" action="<?php echo e(route('login.post')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-center">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div>
                <label class="block text-[9px] font-black text-white/30 uppercase tracking-widest mb-3">Institutional Email</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required placeholder="name@opesware.com" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500 transition">
            </div>

            <div>
                <label class="block text-[9px] font-black text-white/30 uppercase tracking-widest mb-3">Security Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-sm font-bold text-white outline-none focus:border-indigo-500 transition">
            </div>

            <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-indigo-600/30 hover:bg-indigo-500 transition-all hover:-translate-y-0.5">
                Authenticate →
            </button>
        </form>

        <div class="mt-10 pt-10 border-t border-white/5">
            <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.3em] mb-4 text-center">Quick Access Prototypes</p>
            <div class="relative">
                <select onchange="if(this.value) quickLogin(this.value);" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-[11px] font-black text-white/60 outline-none hover:bg-white/10 transition-all cursor-pointer appearance-none focus:border-indigo-500/50">
                    <option value="" disabled selected>Select Demo Role...</option>
                    <optgroup label="Institutional Staff" class="bg-[#0A192F] text-white/80">
                        <option value="admin@opesware.com">Administrator</option>
                        <option value="doctor@opesware.com">Medical Doctor</option>
                        <option value="nurse@opesware.com">Registered Nurse</option>
                        <option value="lab@opesware.com">Laboratory Tech</option>
                        <option value="pharmacy@opesware.com">Pharmacist</option>
                        <option value="cfo@opesware.com">CFO / Billing</option>
                        <option value="store@opesware.com">Warehouse / Logistics</option>
                        <option value="radiology@opesware.com">Radiologist</option>
                    </optgroup>
                </select>
                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none opacity-40 text-white">
                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 1l4 4 4-4"/></svg>
                </div>
            </div>
        </div>

        <p class="mt-12 text-[9px] text-white/10 text-center font-mono uppercase tracking-widest">&copy; 2026 Opesware Innovation &middot; Cameroon</p>
    </div>

    <script>
        function quickLogin(email) {
            const form = document.getElementById('loginForm');
            form.email.value = email;
            form.password.value = 'password';
            form.submit();
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\opeshis\resources\views\auth\login.blade.php ENDPATH**/ ?>
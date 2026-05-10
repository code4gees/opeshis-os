<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="Opeshis OS — Institutional Healthcare Operating System. Secure access portal.">
 <title>Institutional Login — Opeshis OS</title>

    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background: #1a1d24;
            color: #cbd5e1;
            overflow: hidden;
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }

        .left-panel {
            display: none;
            width: 55%;
            position: relative;
            overflow: hidden;
            background: #0b0f19;
            border-right: 1px solid rgba(255,255,255,0.04);
        }
        @media (min-width: 1024px) { .left-panel { display: flex; flex-direction: column; justify-content: space-between; padding: 5rem; } }

        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 2px 2px, rgba(255,255,255,0.02) 1px, transparent 0);
            background-size: 40px 40px;
        }

        .left-content { position: relative; z-index: 10; }

        .brand-icon {
            width: 56px; height: 56px;
            background: #131824;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
        }
        .brand-icon-inner {
            width: 20px; height: 20px;
            background: #82c09a;
            border-radius: 6px;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.4rem 1rem;
            background: rgba(130,192,154,0.1);
            border: 1px solid rgba(130,192,154,0.2);
            border-radius: 8px;
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;
            color: #82c09a;
            margin-bottom: 2.5rem;
        }

        .hero-title {
            font-size: clamp(3.5rem, 5vw, 5.5rem);
            font-weight: 800;
            line-height: 0.95;
            letter-spacing: -0.05em;
            color: #fff;
            margin-bottom: 2rem;
            text-transform: uppercase;
        }
        .hero-title span { color: #82c09a; }

        .hero-desc {
            font-size: 1.125rem; font-weight: 300; line-height: 1.6;
            color: rgba(255,255,255,0.4);
            max-width: 32rem;
            margin-bottom: 4rem;
        }

        .stat-num { font-size: 1.75rem; font-weight: 700; color: #fff; letter-spacing: -0.02em; }
        .stat-label { font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.15em; color: #64748b; margin-top: 6px; }

        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #1a1d24;
            position: relative;
        }

        .cc-login-card {
            width: 100%;
            max-width: 420px;
            background: #22262f;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 2rem;
            padding: 3.5rem;
            box-shadow: 0 50px 100px -20px rgba(0,0,0,0.5);
            z-index: 10;
        }

        .login-header h2 { font-size: 2rem; font-weight: 800; letter-spacing: -0.03em; color: #fff; margin-bottom: 0.5rem; }
        .login-header p { font-size: 0.9375rem; color: rgba(255,255,255,0.3); font-weight: 300; }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: #82c09a;
            border: none; border-radius: 12px;
            color: #1a1d24;
            font-size: 0.8125rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.1em;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            margin-top: 1.5rem;
        }
        .submit-btn:hover { transform: translateY(-2px); filter: brightness(1.1); box-shadow: 0 10px 20px -5px rgba(130,192,154,0.4); }
        .submit-btn:active { transform: translateY(0); }

        .demo-select {
            width: 100%;
            background: #1a1d24;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 0.875rem 1rem;
            font-size: 0.875rem; color: rgba(255,255,255,0.4);
            font-family: 'Outfit', sans-serif;
            outline: none; cursor: pointer;
            appearance: none;
            transition: all 0.2s;
        }
        .demo-select:focus { border-color: rgba(130,192,154,0.4); color: #fff; }

        .security-strip {
            display: flex; align-items: center; justify-content: center; gap: 1.5rem;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.04);
        }
        .security-text { font-size: 0.65rem; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 0.5rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .security-dot { width: 5px; height: 5px; background: #82c09a; border-radius: 50%; box-shadow: 0 0 10px #82c09a; }
    </style>

</head>
<body>

<div class="left-panel">
    <div class="grid-bg"></div>

    <div class="left-content">
        <div class="flex items-center gap-4">
            <div class="brand-icon"><div class="brand-icon-inner"></div></div>
            <div>
                <div class="text-white font-bold text-lg tracking-tight">Opeshis OS</div>
                <div class="text-[10px] font-bold text-white/30 uppercase tracking-[0.2em]">Institutional Core</div>
            </div>
        </div>
    </div>

    <div class="left-content mb-20">
        <div class="hero-badge">Sentinel Matrix v2.2</div>
        <h1 class="hero-title">
            Clinical<br>
            Sovereignty.<br>
            <span>Without Limits.</span>
        </h1>
        <p class="hero-desc">
            The institutional operating system for high-density medical environments.
            Engineered for clinical intelligence and zero-leakage operations.
        </p>

        <div class="flex gap-16">
            <div>
                <div class="stat-num text-sage">22</div>
                <div class="stat-label">Pillar Modules</div>
            </div>
            <div>
                <div class="stat-num">100%</div>
                <div class="stat-label">Offline Uptime</div>
            </div>
            <div>
                <div class="stat-num">FIPS</div>
                <div class="stat-label">Secure Core</div>
            </div>
        </div>
    </div>

    <div class="left-content flex items-center justify-between border-t border-white/[0.04] pt-10">
        <div class="flex gap-10">
            <a href="<?php echo e(route('public.about')); ?>" class="text-[11px] font-bold text-white/20 uppercase tracking-widest hover:text-sage transition-all">Institutional About</a>
            <a href="<?php echo e(route('public.features')); ?>" class="text-[11px] font-bold text-white/20 uppercase tracking-widest hover:text-sage transition-all">Feature Intelligence</a>
        </div>
        <span class="text-[11px] font-bold text-white/10 uppercase tracking-widest">© 2026 Opesware</span>
    </div>
</div>


<div class="right-panel">
    <div class="cc-login-card">

        <div class="login-header mb-10">
            <h2>Sign In</h2>
            <p>Access the Opeshis OS Core Matrix</p>
        </div>

        <form id="loginForm" action="<?php echo e(route('login.post')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group mb-6">
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3" for="email">Institutional Email</label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required
                    class="cc-input w-full" placeholder="name@institution.com">
            </div>

            <div class="form-group mb-6">
                <label class="block text-[10px] font-bold text-white/20 uppercase tracking-widest mb-3" for="password">Security Protocol</label>
                <input id="password" type="password" name="password" required
                    class="cc-input w-full" placeholder="••••••••">
            </div>

            <button type="submit" class="submit-btn">Authorize Access</button>
        </form>

        <div class="divider flex items-center gap-4 my-10">
            <div class="h-[1px] flex-1 bg-white/[0.04]"></div>
            <span class="text-[10px] font-bold text-white/10 uppercase tracking-widest">Demo Override</span>
            <div class="h-[1px] flex-1 bg-white/[0.04]"></div>
        </div>

        <select class="demo-select" onchange="if(this.value) quickLogin(this.value);">
            <option value="" disabled selected>Select Simulation Role...</option>
            <option value="bamenda.admin@clinicore.com">Institutional Administrator</option>
            <option value="chiefmedicalofficer@clinicore.test">Clinical Director (MD)</option>
            <option value="chiefmatron@clinicore.test">Head of Nursing</option>
        </select>

        <div class="security-strip">
            <span class="security-text"><div class="security-dot"></div> Session Active</span>
            <span class="security-text">FIPS 140-2 Validated</span>
        </div>

    </div>
</div>


<script>
 function quickLogin(email) {
 const form = document.getElementById('loginForm');
 form.email.value = email;
 form.password.value = 'password';
 form.submit();
 }
 document.getElementById('email').focus();
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\opeshis\resources\views/auth/login.blade.php ENDPATH**/ ?>
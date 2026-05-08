<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Opeshis OS — Institutional Healthcare Operating System. Secure access portal.">
    <title>Institutional Login — Opeshis OS</title>

    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --indigo: #6366f1;
            --indigo-dark: #4f46e5;
            --indigo-glow: rgba(99,102,241,0.25);
            --emerald: #10b981;
            --slate-950: #020617;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-700: #334155;
            --slate-500: #64748b;
            --slate-400: #94a3b8;
            --slate-300: #cbd5e1;
        }

        html, body { height: 100%; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--slate-950);
            color: #fff;
            overflow: hidden;
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }

        /* ─── LEFT PANEL ─── */
        .left-panel {
            display: none;
            width: 55%;
            position: relative;
            overflow: hidden;
            background: #070d1a;
        }
        @media (min-width: 1024px) { .left-panel { display: flex; flex-direction: column; justify-content: space-between; padding: 3rem; } }

        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(99,102,241,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.06) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: drift 18s ease-in-out infinite alternate;
        }
        .orb-1 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(99,102,241,0.18), transparent 70%); top: -100px; left: -100px; animation-delay: 0s; }
        .orb-2 { width: 400px; height: 400px; background: radial-gradient(circle, rgba(16,185,129,0.12), transparent 70%); bottom: -80px; right: -80px; animation-delay: -8s; }
        .orb-3 { width: 300px; height: 300px; background: radial-gradient(circle, rgba(236,72,153,0.08), transparent 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); animation-delay: -4s; }
        @keyframes drift { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(30px, 20px) scale(1.08); } }
        .orb-3 { animation: drift2 22s ease-in-out infinite alternate; }
        @keyframes drift2 { 0% { transform: translate(-50%, -50%) scale(1); } 100% { transform: translate(calc(-50% + 20px), calc(-50% - 20px)) scale(1.1); } }

        .left-content { position: relative; z-index: 10; }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .brand-icon {
            width: 44px; height: 44px;
            background: var(--indigo);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 30px rgba(99,102,241,0.5);
        }
        .brand-name { font-size: 1.1rem; font-weight: 900; letter-spacing: -0.03em; text-transform: uppercase; color: #fff; }
        .brand-sub { font-size: 0.55rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.3); margin-top: 1px; }

        .hero-block { margin-top: auto; padding-top: 4rem; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.4rem 0.9rem;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 999px;
            font-size: 0.6rem; font-weight: 800; letter-spacing: 0.18em; text-transform: uppercase;
            color: #a5b4fc;
            margin-bottom: 1.75rem;
        }
        .hero-badge-dot { width: 6px; height: 6px; background: var(--indigo); border-radius: 50%; box-shadow: 0 0 8px var(--indigo); animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }

        .hero-title {
            font-size: clamp(2.8rem, 4.5vw, 4rem);
            font-weight: 900;
            line-height: 0.95;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 1.5rem;
        }
        .hero-title em { font-style: normal; color: transparent; background: linear-gradient(135deg, #a5b4fc, #6366f1 50%, #818cf8); -webkit-background-clip: text; background-clip: text; }

        .hero-desc {
            font-size: 0.9rem; font-weight: 400; line-height: 1.7;
            color: rgba(255,255,255,0.4);
            max-width: 30rem;
            margin-bottom: 2.5rem;
        }

        .stat-row { display: flex; gap: 2rem; flex-wrap: wrap; }
        .stat-item { }
        .stat-num { font-size: 1.6rem; font-weight: 900; color: #fff; letter-spacing: -0.04em; }
        .stat-label { font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: rgba(255,255,255,0.3); margin-top: 2px; }

        .left-footer {
            position: relative; z-index: 10;
            display: flex; gap: 1.5rem;
        }
        .left-footer-link { font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.25); text-decoration: none; transition: color 0.2s; }
        .left-footer-link:hover { color: rgba(255,255,255,0.6); }

        /* ─── RIGHT PANEL ─── */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--slate-950);
            position: relative;
            overflow: hidden;
        }
        .right-panel::before {
            content: '';
            position: absolute;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,102,241,0.06), transparent 65%);
            border-radius: 50%;
        }

        .login-box {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 10;
        }

        /* Mobile brand */
        .mobile-brand {
            display: flex; flex-direction: column; align-items: center;
            margin-bottom: 2.5rem;
        }
        @media (min-width: 1024px) { .mobile-brand { display: none; } }
        .mobile-brand-icon {
            width: 48px; height: 48px;
            background: var(--indigo);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 30px rgba(99,102,241,0.4);
            margin-bottom: 0.75rem;
        }
        .mobile-brand-name { font-size: 1rem; font-weight: 900; letter-spacing: -0.03em; text-transform: uppercase; }
        .mobile-brand-sub { font-size: 0.55rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.3); margin-top: 2px; }

        .login-header { margin-bottom: 2rem; }
        .login-header h2 { font-size: 1.5rem; font-weight: 900; letter-spacing: -0.03em; text-transform: uppercase; color: #fff; }
        .login-header p { font-size: 0.72rem; color: rgba(255,255,255,0.35); margin-top: 0.4rem; font-weight: 500; letter-spacing: 0.04em; }

        .error-box {
            background: rgba(244,63,94,0.08);
            border: 1px solid rgba(244,63,94,0.25);
            border-radius: 12px;
            padding: 0.875rem 1rem;
            margin-bottom: 1.25rem;
            display: flex; align-items: flex-start; gap: 0.6rem;
        }
        .error-icon { flex-shrink: 0; width: 14px; height: 14px; margin-top: 1px; color: #f43f5e; }
        .error-text { font-size: 0.72rem; font-weight: 700; color: #fb7185; letter-spacing: 0.04em; text-transform: uppercase; line-height: 1.4; }

        .form-group { margin-bottom: 1rem; }
        .form-label {
            display: block;
            font-size: 0.6rem; font-weight: 800; letter-spacing: 0.15em;
            text-transform: uppercase; color: rgba(255,255,255,0.35);
            margin-bottom: 0.5rem;
        }
        .form-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 0.875rem 1rem;
            font-size: 0.875rem; font-weight: 500; color: #fff;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .form-input::placeholder { color: rgba(255,255,255,0.2); font-weight: 400; }
        .form-input:focus {
            border-color: rgba(99,102,241,0.6);
            background: rgba(99,102,241,0.05);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        .password-wrap { position: relative; }
        .toggle-pw {
            position: absolute; right: 1rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center;
            transition: color 0.2s; padding: 0;
        }
        .toggle-pw:hover { color: rgba(255,255,255,0.7); }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: var(--indigo);
            border: none; border-radius: 14px;
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 0.72rem; font-weight: 800; letter-spacing: 0.18em; text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 24px rgba(99,102,241,0.3);
            margin-top: 0.75rem;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            position: relative; overflow: hidden;
        }
        .submit-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);
            opacity: 0; transition: opacity 0.2s;
        }
        .submit-btn:hover { background: #4f46e5; transform: translateY(-1px); box-shadow: 0 8px 32px rgba(99,102,241,0.4); }
        .submit-btn:hover::after { opacity: 1; }
        .submit-btn:active { transform: translateY(0); }
        .btn-arrow { transition: transform 0.2s; }
        .submit-btn:hover .btn-arrow { transform: translateX(3px); }

        .divider {
            display: flex; align-items: center; gap: 0.75rem;
            margin: 1.5rem 0 1.25rem;
        }
        .divider-line { flex: 1; height: 1px; background: rgba(255,255,255,0.06); }
        .divider-text { font-size: 0.6rem; font-weight: 700; color: rgba(255,255,255,0.2); letter-spacing: 0.12em; text-transform: uppercase; }

        .demo-select {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 0.875rem 2.5rem 0.875rem 1rem;
            font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.5);
            font-family: 'Inter', sans-serif;
            outline: none;
            cursor: pointer;
            appearance: none;
            transition: border-color 0.2s;
        }
        .demo-select:hover { border-color: rgba(99,102,241,0.3); }
        .demo-select:focus { border-color: rgba(99,102,241,0.5); box-shadow: 0 0 0 3px rgba(99,102,241,0.08); }
        .demo-wrap { position: relative; }
        .demo-chevron { position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.25); pointer-events: none; }

        .security-strip {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            margin-top: 2rem;
        }
        .security-dot { width: 5px; height: 5px; background: #10b981; border-radius: 50%; box-shadow: 0 0 6px #10b981; animation: pulse 2s infinite; }
        .security-text { font-size: 0.6rem; font-weight: 700; color: rgba(255,255,255,0.2); letter-spacing: 0.1em; text-transform: uppercase; }
        .security-sep { font-size: 0.6rem; color: rgba(255,255,255,0.1); }
    </style>
</head>
<body>

<!-- ═══════════════ LEFT PANEL ═══════════════ -->
<div class="left-panel">
    <div class="grid-bg"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Brand -->
    <div class="left-content">
        <div class="brand-logo">
            <div class="brand-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                    <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <div class="brand-name">Opeshis OS</div>
                <div class="brand-sub">Healthcare Intelligence Core</div>
            </div>
        </div>
    </div>

    <!-- Hero -->
    <div class="left-content hero-block">
        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Sentinel v2.2 · Institutional Suite
        </div>
        <h1 class="hero-title">
            Clinical<br>
            Intelligence.<br>
            <em>Without Limits.</em>
        </h1>
        <p class="hero-desc">
            The world's first offline-first, multi-branch hospital operating system. 
            Engineered for high-density clinical environments where data sovereignty is non-negotiable.
        </p>
        <div class="stat-row">
            <div class="stat-item">
                <div class="stat-num">40+</div>
                <div class="stat-label">Clinical Modules</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">99.9%</div>
                <div class="stat-label">Uptime SLA</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">HIPAA</div>
                <div class="stat-label">Compliant</div>
            </div>
        </div>
    </div>

    <!-- Footer links -->
    <div class="left-footer left-content">
        <a href="/about" class="left-footer-link">About</a>
        <a href="/features" class="left-footer-link">Features</a>
        <a href="/contact" class="left-footer-link">Contact</a>
        <a href="/faq" class="left-footer-link">FAQ</a>
        <span class="left-footer-link" style="margin-left: auto;">© 2026 Opesware Innovation</span>
    </div>
</div>

<!-- ═══════════════ RIGHT PANEL ═══════════════ -->
<div class="right-panel">
    <div class="login-box">

        <!-- Mobile brand -->
        <div class="mobile-brand">
            <div class="mobile-brand-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                    <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="mobile-brand-name">Opeshis OS</div>
            <div class="mobile-brand-sub">Healthcare Intelligence Core</div>
        </div>

        <div class="login-header">
            <h2>Secure Access</h2>
            <p>Enter your institutional credentials to access the command center</p>
        </div>

        @if($errors->any())
        <div class="error-box">
            <svg class="error-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <div class="error-text">{{ $errors->first() }}</div>
        </div>
        @endif

        @if(session('info'))
        <div class="error-box" style="background: rgba(99,102,241,0.08); border-color: rgba(99,102,241,0.3);">
            <svg class="error-icon" style="color: #818cf8;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
            <div class="error-text" style="color: #a5b4fc;">{{ session('info') }}</div>
        </div>
        @endif

        <form id="loginForm" action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Institutional Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="name@institution.com"
                    class="form-input"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Security Password</label>
                <div class="password-wrap">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••••••"
                        class="form-input"
                        style="padding-right: 3rem;"
                    >
                    <button type="button" class="toggle-pw" onclick="togglePassword()" id="eyeBtn" aria-label="Toggle password visibility">
                        <svg id="eyeOpen" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="eyeClosed" width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <span>Authenticate</span>
                <svg class="btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"/>
                    <polyline points="12 5 19 12 12 19"/>
                </svg>
            </button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">Quick Demo Access</span>
            <div class="divider-line"></div>
        </div>

        <div class="demo-wrap">
            <select class="demo-select" onchange="if(this.value) quickLogin(this.value);" aria-label="Select demo role">
                <option value="" disabled selected>Select a demo role...</option>
                <optgroup label="Clinical Staff">
                    <option value="doctor@opesware.com">Medical Doctor</option>
                    <option value="nurse@opesware.com">Registered Nurse</option>
                </optgroup>
                <optgroup label="Support Services">
                    <option value="lab@opesware.com">Laboratory Technician</option>
                    <option value="pharmacy@opesware.com">Pharmacist</option>
                    <option value="radiology@opesware.com">Radiologist</option>
                </optgroup>
                <optgroup label="Management">
                    <option value="admin@opesware.com">Administrator</option>
                    <option value="cfo@opesware.com">CFO / Billing Officer</option>
                    <option value="store@opesware.com">Warehouse Manager</option>
                </optgroup>
            </select>
            <svg class="demo-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </div>

        <div class="security-strip">
            <div class="security-dot"></div>
            <span class="security-text">AES-256 Encrypted</span>
            <span class="security-sep">·</span>
            <span class="security-text">MFA Enforced</span>
            <span class="security-sep">·</span>
            <span class="security-text">Zero-Trust Perimeter</span>
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
    function togglePassword() {
        const input = document.getElementById('password');
        const open = document.getElementById('eyeOpen');
        const closed = document.getElementById('eyeClosed');
        if (input.type === 'password') {
            input.type = 'text';
            open.style.display = 'none';
            closed.style.display = 'block';
        } else {
            input.type = 'password';
            open.style.display = 'block';
            closed.style.display = 'none';
        }
    }
    // Auto-focus email
    document.getElementById('email').focus();
</script>
</body>
</html>

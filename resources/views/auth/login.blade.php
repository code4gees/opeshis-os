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
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

 <style>
 *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

 body {
 font-family: 'Inter', sans-serif;
 background: #0b0f19;
 color: #cbd5e1;
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
 background: #06080c;
 border-right: 1px solid rgba(255,255,255,0.04);
 }
 @media (min-width: 1024px) { .left-panel { display: flex; flex-direction: column; justify-content: space-between; padding: 4rem; } }

 .grid-bg {
 position: absolute;
 inset: 0;
 background-image:
 linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
 linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
 background-size: 64px 64px;
 opacity: 0.5;
 }

 .left-content { position: relative; z-index: 10; }

 .brand-logo {
 display: flex;
 align-items: center;
 gap: 1rem;
 }
 .brand-icon {
 width: 48px; height: 48px;
 background: #131824;
 border: 1px solid rgba(255,255,255,0.04);
 border-radius: 12px;
 display: flex; align-items: center; justify-content: center;
 }
 .brand-icon-inner {
 width: 16px; height: 16px;
 background: #4ade80;
 border-radius: 4px;
 }
 .brand-name { font-size: 1.25rem; font-weight: 800; letter-spacing: -0.02em; color: #fff; }
 .brand-sub { font-size: 0.65rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; color: #64748b; margin-top: 2px; }

 .hero-block { margin-top: auto; margin-bottom: 2rem; }
 .hero-badge {
 display: inline-flex; align-items: center; gap: 0.5rem;
 padding: 0.35rem 0.75rem;
 background: rgba(74,222,128,0.1);
 border: 1px solid rgba(74,222,128,0.2);
 border-radius: 6px;
 font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;
 color: #4ade80;
 margin-bottom: 2rem;
 }

 .hero-title {
 font-size: clamp(3rem, 4.5vw, 4.5rem);
 font-weight: 900;
 line-height: 1;
 letter-spacing: -0.04em;
 color: #fff;
 margin-bottom: 1.5rem;
 }
 .hero-title span { color: #4ade80; }

 .hero-desc {
 font-size: 1rem; font-weight: 400; line-height: 1.6;
 color: #94a3b8;
 max-width: 32rem;
 margin-bottom: 3rem;
 }

 .stat-row { display: flex; gap: 3rem; flex-wrap: wrap; }
 .stat-num { font-size: 1.5rem; font-weight: 800; color: #fff; letter-spacing: -0.02em; }
 .stat-label { font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; margin-top: 4px; }

 .left-footer {
 position: relative; z-index: 10;
 display: flex; gap: 2rem;
 }
 .left-footer-link { font-size: 0.7rem; font-weight: 500; color: #64748b; text-decoration: none; transition: color 0.2s; }
 .left-footer-link:hover { color: #cbd5e1; }

 /* ─── RIGHT PANEL ─── */
 .right-panel {
 flex: 1;
 display: flex;
 flex-direction: column;
 align-items: center;
 justify-content: center;
 padding: 2rem;
 background: #0b0f19;
 position: relative;
 }

 .login-box {
 width: 100%;
 max-width: 400px;
 position: relative;
 z-index: 10;
 }

 .login-header { margin-bottom: 2.5rem; text-align: left; }
 .login-header h2 { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.02em; color: #fff; }
 .login-header p { font-size: 0.875rem; color: #94a3b8; margin-top: 0.5rem; }

 .form-group { margin-bottom: 1.25rem; }
 .form-label {
 display: block;
 font-size: 0.75rem; font-weight: 600;
 color: #94a3b8;
 margin-bottom: 0.5rem;
 }
 .form-input {
 width: 100%;
 background: #131824;
 border: 1px solid rgba(255,255,255,0.04);
 border-radius: 8px;
 padding: 0.75rem 1rem;
 font-size: 0.875rem; color: #fff;
 font-family: 'Inter', sans-serif;
 outline: none;
 transition: all 0.2s;
 }
 .form-input::placeholder { color: #475569; }
 .form-input:focus {
 border-color: rgba(74,222,128,0.4);
 box-shadow: 0 0 0 3px rgba(74,222,128,0.1);
 }

 .submit-btn {
 width: 100%;
 padding: 0.875rem;
 background: #4ade80;
 border: none; border-radius: 8px;
 color: #06080c;
 font-family: 'Inter', sans-serif;
 font-size: 0.875rem; font-weight: 700;
 cursor: pointer;
 transition: opacity 0.2s;
 margin-top: 1rem;
 }
 .submit-btn:hover { opacity: 0.9; }

 .divider {
 display: flex; align-items: center; gap: 1rem;
 margin: 2rem 0;
 }
 .divider-line { flex: 1; height: 1px; background: rgba(255,255,255,0.04); }
 .divider-text { font-size: 0.75rem; font-weight: 500; color: #64748b; }

 .demo-select {
 width: 100%;
 background: #131824;
 border: 1px solid rgba(255,255,255,0.04);
 border-radius: 8px;
 padding: 0.75rem 1rem;
 font-size: 0.875rem; color: #94a3b8;
 font-family: 'Inter', sans-serif;
 outline: none; cursor: pointer;
 appearance: none;
 }
 .demo-select:focus { border-color: rgba(74,222,128,0.4); }

 .security-strip {
 display: flex; align-items: center; justify-content: flex-start; gap: 1rem;
 margin-top: 2rem;
 padding-top: 2rem;
 border-top: 1px solid rgba(255,255,255,0.04);
 }
 .security-text { font-size: 0.7rem; font-weight: 500; color: #64748b; display: flex; align-items: center; gap: 0.4rem; }
 .security-dot { width: 6px; height: 6px; background: #4ade80; border-radius: 50%; }
 </style>
</head>
<body>

<div class="left-panel">
 <div class="grid-bg"></div>

 <div class="left-content">
 <div class="brand-logo">
 <div class="brand-icon"><div class="brand-icon-inner"></div></div>
 <div>
 <div class="brand-name">Opeshis OS</div>
 <div class="brand-sub">Healthcare Intelligence Core</div>
 </div>
 </div>
 </div>

 <div class="left-content hero-block">
 <div class="hero-badge">Sentinel v2.2</div>
 <h1 class="hero-title">
 Clinical<br>
 Intelligence.<br>
 <span>Without Limits.</span>
 </h1>
 <p class="hero-desc">
 The world's first offline-first, multi-branch hospital operating system. 
 Engineered for high-density clinical environments.
 </p>
 <div class="stat-row">
 <div>
 <div class="stat-num">40+</div>
 <div class="stat-label">Modules</div>
 </div>
 <div>
 <div class="stat-num">99.9%</div>
 <div class="stat-label">Uptime</div>
 </div>
 <div>
 <div class="stat-num">HIPAA</div>
 <div class="stat-label">Compliant</div>
 </div>
 </div>
 </div>

 <div class="left-footer left-content">
 <a href="{{ route('public.about') }}" class="left-footer-link">About</a>
 <a href="{{ route('public.features') }}" class="left-footer-link">Features</a>
 <span class="left-footer-link" style="margin-left: auto;">© 2026 Opesware Innovation</span>
 </div>
</div>

<div class="right-panel">
 <div class="login-box">

 <div class="login-header">
 <h2>Sign in to Opeshis</h2>
 <p>Enter your institutional credentials</p>
 </div>

 <form id="loginForm" action="{{ route('login.post') }}" method="POST">
 @csrf
 <div class="form-group">
 <label class="form-label" for="email">Email address</label>
 <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-input">
 </div>

 <div class="form-group">
 <label class="form-label" for="password">Password</label>
 <input id="password" type="password" name="password" required class="form-input">
 </div>

 <button type="submit" class="submit-btn">Sign in</button>
 </form>

 <div class="divider">
 <div class="divider-line"></div>
 <span class="divider-text">or use demo access</span>
 <div class="divider-line"></div>
 </div>

 <select class="demo-select" onchange="if(this.value) quickLogin(this.value);">
 <option value="" disabled selected>Select a demo role...</option>
 <option value="bamenda.admin@clinicore.com">Administrator (Full Access)</option>
 <option value="chiefmedicalofficer@clinicore.test">Medical Doctor (Clinical)</option>
 <option value="chiefmatron@clinicore.test">Registered Nurse</option>
 </select>

 <div class="security-strip">
 <span class="security-text"><div class="security-dot"></div> Secure Session</span>
 <span class="security-text">AES-256 Encrypted</span>
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

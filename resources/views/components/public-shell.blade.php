@props(['title' => 'Opeshis OS'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: #020617;
            color: #fff;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .pub-nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.1rem 5%;
            background: rgba(2,6,23,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .pub-nav-brand { display: flex; align-items: center; gap: .65rem; text-decoration: none; }
        .pub-nav-icon {
            width: 36px; height: 36px;
            background: #6366f1;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 20px rgba(99,102,241,.5);
            flex-shrink: 0;
        }
        .pub-nav-name { font-size: .9rem; font-weight: 900; letter-spacing: -.03em; text-transform: uppercase; color: #fff; }
        .pub-nav-links { display: flex; align-items: center; gap: 1.75rem; }
        .pub-nav-link { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.4); text-decoration: none; transition: color .2s; }
        .pub-nav-link:hover { color: #fff; }
        .pub-nav-link.active { color: #a5b4fc; }
        .pub-nav-cta {
            padding: .5rem 1.2rem;
            background: #6366f1;
            border-radius: 10px;
            font-size: .65rem; font-weight: 800; letter-spacing: .15em; text-transform: uppercase;
            color: #fff; text-decoration: none;
            transition: background .2s, transform .15s;
            box-shadow: 0 4px 20px rgba(99,102,241,.35);
        }
        .pub-nav-cta:hover { background: #4f46e5; transform: translateY(-1px); }

        /* Mobile nav toggle */
        .pub-nav-toggle {
            display: none;
            background: none; border: none;
            color: rgba(255,255,255,.6); cursor: pointer;
            padding: .25rem;
        }
        @media (max-width: 768px) {
            .pub-nav-toggle { display: flex; }
            .pub-nav-links { display: none; position: absolute; top: 100%; left: 0; right: 0; flex-direction: column; align-items: stretch; padding: 1rem 5%; background: rgba(2,6,23,.97); border-bottom: 1px solid rgba(255,255,255,.05); gap: .5rem; }
            .pub-nav-links.open { display: flex; }
            .pub-nav-link { padding: .6rem 0; border-bottom: 1px solid rgba(255,255,255,.04); }
            .pub-nav-cta { margin-top: .5rem; text-align: center; padding: .75rem; }
        }

        /* ── PAGE CONTENT WRAPPER ── */
        .pub-main { flex: 1; padding-top: 72px; }

        /* ── FOOTER ── */
        .pub-footer {
            border-top: 1px solid rgba(255,255,255,.05);
            padding: 2.5rem 5%;
            display: flex; flex-wrap: wrap; gap: 1.25rem;
            align-items: center; justify-content: space-between;
            background: rgba(15,23,42,.5);
        }
        .pub-footer-brand { display: flex; align-items: center; gap: .5rem; text-decoration: none; }
        .pub-footer-icon { width: 28px; height: 28px; background: #6366f1; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .pub-footer-name { font-size: .75rem; font-weight: 900; text-transform: uppercase; letter-spacing: -.02em; color: #fff; }
        .pub-footer-links { display: flex; gap: 1.5rem; flex-wrap: wrap; }
        .pub-footer-link { font-size: .6rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: rgba(255,255,255,.25); text-decoration: none; transition: color .2s; }
        .pub-footer-link:hover { color: rgba(255,255,255,.6); }
        .pub-footer-copy { font-size: .6rem; color: rgba(255,255,255,.18); letter-spacing: .06em; text-transform: uppercase; }

        /* ── SHARED CONTENT UTILITIES ── */
        .pub-container { max-width: 1100px; margin: 0 auto; padding: 0 5%; }
        .pub-section { padding: 5rem 5%; }
        .pub-page-hero {
            padding: 5rem 5% 4rem;
            text-align: center;
            background: radial-gradient(ellipse 80% 50% at 50% 0%, rgba(99,102,241,.1), transparent 70%);
            border-bottom: 1px solid rgba(255,255,255,.05);
            position: relative; overflow: hidden;
        }
        .pub-page-hero::before {
            content: '';
            position: absolute; inset: 0;
            background-image: linear-gradient(rgba(99,102,241,.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(99,102,241,.04) 1px, transparent 1px);
            background-size: 52px 52px;
        }
        .pub-page-hero-inner { position: relative; z-index: 10; }
        .pub-tag { display: inline-block; padding: .3rem .8rem; background: rgba(99,102,241,.08); border: 1px solid rgba(99,102,241,.2); border-radius: 6px; font-size: .6rem; font-weight: 800; letter-spacing: .18em; text-transform: uppercase; color: #818cf8; margin-bottom: 1.25rem; }
        .pub-page-title { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 900; letter-spacing: -.04em; text-transform: uppercase; line-height: .95; margin-bottom: 1rem; }
        .pub-page-desc { font-size: .95rem; font-weight: 300; color: rgba(255,255,255,.4); max-width: 560px; margin: 0 auto; line-height: 1.7; font-style: italic; }
    </style>
    @yield('styles')
</head>
<body>

<!-- PUBLIC NAVBAR -->
<nav class="pub-nav">
    <a href="{{ route('public.landing') }}" class="pub-nav-brand">
        <div class="pub-nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <span class="pub-nav-name">Opeshis OS</span>
    </a>

    <button class="pub-nav-toggle" onclick="document.querySelector('.pub-nav-links').classList.toggle('open')" aria-label="Menu">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>

    <div class="pub-nav-links">
        <a href="{{ route('public.features') }}" class="pub-nav-link {{ request()->routeIs('public.features') ? 'active' : '' }}">Features</a>
        <a href="{{ route('public.about') }}" class="pub-nav-link {{ request()->routeIs('public.about') ? 'active' : '' }}">About</a>
        <a href="{{ route('public.faq') }}" class="pub-nav-link {{ request()->routeIs('public.faq') ? 'active' : '' }}">FAQ</a>
        <a href="{{ route('public.blog') }}" class="pub-nav-link {{ request()->routeIs('public.blog') ? 'active' : '' }}">Blog</a>
        <a href="{{ route('public.contact') }}" class="pub-nav-link {{ request()->routeIs('public.contact') ? 'active' : '' }}">Contact</a>
        <a href="{{ route('login') }}" class="pub-nav-cta">Enter Portal →</a>
    </div>
</nav>

<!-- PAGE CONTENT -->
<main class="pub-main">
    {{ $slot }}
</main>

<!-- FOOTER -->
<footer class="pub-footer">
    <a href="/" class="pub-footer-brand">
        <div class="pub-footer-icon">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
        </div>
        <span class="pub-footer-name">Opeshis OS</span>
    </a>
    <div class="pub-footer-links">
        <a href="{{ route('public.about') }}" class="pub-footer-link">About</a>
        <a href="{{ route('public.features') }}" class="pub-footer-link">Features</a>
        <a href="{{ route('public.faq') }}" class="pub-footer-link">FAQ</a>
        <a href="{{ route('public.blog') }}" class="pub-footer-link">Blog</a>
        <a href="{{ route('public.contact') }}" class="pub-footer-link">Contact</a>
        <a href="{{ route('login') }}" class="pub-footer-link">Portal Login</a>
    </div>
    <div class="pub-footer-copy">© 2026 Opesware Innovation · Cameroon</div>
</footer>

@yield('scripts')
</body>
</html>

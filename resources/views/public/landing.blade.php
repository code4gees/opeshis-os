<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Opeshis OS — Institutional-grade hospital operating system for high-density clinical environments.">
    <title>Opeshis OS — Medical Intelligence Without Limits</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{--indigo:#6366f1;--indigo-dark:#4f46e5;--emerald:#10b981;--rose:#f43f5e;--s950:#020617;--s900:#0f172a;--s800:#1e293b;--s700:#334155;--s400:#94a3b8}
        html{scroll-behavior:smooth}
        body{font-family:'Inter',sans-serif;background:var(--s950);color:#fff;overflow-x:hidden}
        a{text-decoration:none;color:inherit}

        /* NAV */
        nav{position:fixed;top:0;left:0;right:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1.25rem 5%;border-bottom:1px solid rgba(255,255,255,0.05);background:rgba(2,6,23,0.8);backdrop-filter:blur(20px)}
        .nav-brand{display:flex;align-items:center;gap:.65rem}
        .nav-icon{width:36px;height:36px;background:var(--indigo);border-radius:10px;display:flex;align-items:center;justify-content:center;box-shadow:0 0 20px rgba(99,102,241,.5)}
        .nav-name{font-size:.95rem;font-weight:900;letter-spacing:-.03em;text-transform:uppercase}
        .nav-links{display:flex;align-items:center;gap:2rem}
        .nav-link{font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.45);transition:color .2s}
        .nav-link:hover{color:#fff}
        .nav-cta{padding:.55rem 1.25rem;background:var(--indigo);border-radius:10px;font-size:.65rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;transition:background .2s,transform .15s;box-shadow:0 4px 20px rgba(99,102,241,.35)}
        .nav-cta:hover{background:var(--indigo-dark);transform:translateY(-1px)}

        /* HERO */
        .hero{min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:8rem 5% 5rem;position:relative;overflow:hidden}
        .hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:60px 60px}
        .hero-grid::after{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 50% 0%,rgba(99,102,241,.12),transparent 70%)}
        .orb{position:absolute;border-radius:50%;filter:blur(100px);animation:orbFloat 20s ease-in-out infinite alternate}
        .orb-a{width:700px;height:700px;background:radial-gradient(circle,rgba(99,102,241,.15),transparent 70%);top:-200px;left:-200px}
        .orb-b{width:500px;height:500px;background:radial-gradient(circle,rgba(16,185,129,.1),transparent 70%);bottom:-150px;right:-150px;animation-delay:-10s}
        @keyframes orbFloat{0%{transform:translate(0,0) scale(1)}100%{transform:translate(25px,20px) scale(1.06)}}
        .hero-inner{position:relative;z-index:10;max-width:900px;margin:0 auto}
        .hero-badge{display:inline-flex;align-items:center;gap:.5rem;padding:.35rem 1rem;background:rgba(99,102,241,.1);border:1px solid rgba(99,102,241,.3);border-radius:999px;font-size:.6rem;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:#a5b4fc;margin-bottom:2rem}
        .hero-dot{width:6px;height:6px;background:var(--indigo);border-radius:50%;box-shadow:0 0 8px var(--indigo);animation:pulse 2s infinite}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}
        .hero-title{font-size:clamp(3rem,8vw,6.5rem);font-weight:900;line-height:.92;letter-spacing:-.05em;text-transform:uppercase;margin-bottom:1.75rem}
        .hero-title-grad{color:transparent;background:linear-gradient(135deg,#c7d2fe,#818cf8 40%,#6366f1 70%,#a5b4fc);-webkit-background-clip:text;background-clip:text}
        .hero-sub{font-size:1.1rem;font-weight:300;line-height:1.75;color:rgba(255,255,255,.45);max-width:600px;margin:0 auto 2.5rem;font-style:italic}
        .hero-btns{display:flex;flex-wrap:wrap;gap:1rem;justify-content:center}
        .btn-primary{padding:.9rem 2.25rem;background:var(--indigo);border-radius:14px;font-size:.72rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;box-shadow:0 6px 30px rgba(99,102,241,.4);transition:all .2s}
        .btn-primary:hover{background:var(--indigo-dark);transform:translateY(-2px);box-shadow:0 12px 40px rgba(99,102,241,.5)}
        .btn-ghost{padding:.9rem 2.25rem;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:14px;font-size:.72rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;transition:all .2s}
        .btn-ghost:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.2);transform:translateY(-2px)}

        /* STATS BAR */
        .stats-bar{padding:4rem 5%;border-top:1px solid rgba(255,255,255,.05);border-bottom:1px solid rgba(255,255,255,.05);background:rgba(15,23,42,.6)}
        .stats-inner{max-width:1100px;margin:0 auto;display:grid;grid-template-columns:repeat(2,1fr);gap:2rem}
        @media(min-width:640px){.stats-inner{grid-template-columns:repeat(4,1fr)}}
        .stat{text-align:center}
        .stat-num{font-size:2.5rem;font-weight:900;letter-spacing:-.05em;background:linear-gradient(135deg,#fff,rgba(255,255,255,.6));-webkit-background-clip:text;background-clip:text;color:transparent}
        .stat-lbl{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.15em;color:rgba(255,255,255,.3);margin-top:.35rem}

        /* MODULES */
        .section{padding:7rem 5%}
        .section-inner{max-width:1200px;margin:0 auto}
        .section-tag{display:inline-block;padding:.3rem .8rem;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.2);border-radius:6px;font-size:.6rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase;color:#818cf8;margin-bottom:1.25rem}
        .section-title{font-size:clamp(2rem,4vw,3.25rem);font-weight:900;letter-spacing:-.04em;text-transform:uppercase;line-height:.95;margin-bottom:1rem}
        .section-desc{font-size:.95rem;font-weight:300;color:rgba(255,255,255,.4);max-width:500px;line-height:1.7;font-style:italic;margin-bottom:3.5rem}

        .modules-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem}
        @media(min-width:768px){.modules-grid{grid-template-columns:repeat(3,1fr)}}
        @media(min-width:1200px){.modules-grid{grid-template-columns:repeat(4,1fr)}}
        .mod-card{padding:1.75rem;background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.06);border-radius:20px;transition:all .25s;cursor:default}
        .mod-card:hover{background:rgba(255,255,255,.04);border-color:rgba(99,102,241,.3);transform:translateY(-3px);box-shadow:0 12px 30px rgba(0,0,0,.4)}
        .mod-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;font-size:1.1rem}
        .mod-name{font-size:.72rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:#fff;margin-bottom:.35rem}
        .mod-desc{font-size:.65rem;font-weight:400;color:rgba(255,255,255,.35);line-height:1.5}

        /* FEATURE HIGHLIGHT */
        .highlight-grid{display:grid;gap:3rem}
        @media(min-width:768px){.highlight-grid{grid-template-columns:1fr 1fr;align-items:center}}
        .highlight-visual{background:rgba(255,255,255,.02);border:1px solid rgba(255,255,255,.06);border-radius:24px;padding:2.5rem;min-height:280px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden}
        .highlight-visual::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 30% 50%,rgba(99,102,241,.08),transparent 60%)}
        .highlight-points{display:flex;flex-direction:column;gap:1.25rem}
        .hpoint{display:flex;align-items:flex-start;gap:.875rem}
        .hpoint-dot{width:8px;height:8px;border-radius:50%;background:var(--indigo);box-shadow:0 0 10px var(--indigo);flex-shrink:0;margin-top:.3rem}
        .hpoint-title{font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:#fff;margin-bottom:.2rem}
        .hpoint-desc{font-size:.7rem;font-weight:400;color:rgba(255,255,255,.4);line-height:1.5}

        /* CTA */
        .cta-section{padding:8rem 5%;position:relative;overflow:hidden;text-align:center;border-top:1px solid rgba(255,255,255,.05)}
        .cta-section::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 60% at 50% 50%,rgba(99,102,241,.1),transparent 70%)}
        .cta-inner{max-width:700px;margin:0 auto;position:relative;z-index:10}
        .cta-title{font-size:clamp(2.5rem,5vw,4rem);font-weight:900;letter-spacing:-.05em;text-transform:uppercase;line-height:.95;margin-bottom:1.25rem}
        .cta-sub{font-size:1rem;font-weight:300;color:rgba(255,255,255,.4);font-style:italic;margin-bottom:2.75rem;line-height:1.7}

        /* FOOTER */
        footer{padding:2.5rem 5%;border-top:1px solid rgba(255,255,255,.05);display:flex;flex-wrap:wrap;gap:1rem;align-items:center;justify-content:space-between}
        .footer-brand{display:flex;align-items:center;gap:.5rem}
        .footer-icon{width:28px;height:28px;background:var(--indigo);border-radius:8px;display:flex;align-items:center;justify-content:center}
        .footer-name{font-size:.75rem;font-weight:900;text-transform:uppercase;letter-spacing:-.02em}
        .footer-links{display:flex;gap:1.5rem;flex-wrap:wrap}
        .footer-link{font-size:.6rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.25);transition:color .2s}
        .footer-link:hover{color:rgba(255,255,255,.6)}
        .footer-copy{font-size:.6rem;color:rgba(255,255,255,.2);letter-spacing:.06em;text-transform:uppercase}
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <div class="nav-brand">
        <div class="nav-icon">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <span class="nav-name">Opeshis OS</span>
    </div>
    <div class="nav-links">
        <a href="/features" class="nav-link">Features</a>
        <a href="/about" class="nav-link">About</a>
        <a href="/faq" class="nav-link">FAQ</a>
        <a href="/contact" class="nav-link">Contact</a>
        <a href="/login" class="nav-cta">Enter Portal →</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-grid"></div>
    <div class="orb orb-a"></div>
    <div class="orb orb-b"></div>
    <div class="hero-inner">
        <div class="hero-badge">
            <span class="hero-dot"></span>
            Sentinel v2.2 · Now Live · Multi-Branch Ready
        </div>
        <h1 class="hero-title">
            Medical<br>
            <span class="hero-title-grad">Intelligence.</span><br>
            Without Limits.
        </h1>
        <p class="hero-sub">The world's first offline-first, institutional-grade hospital operating system. Built for high-density clinical environments where data sovereignty is non-negotiable.</p>
        <div class="hero-btns">
            <a href="/login" class="btn-primary">Enter Institutional Portal →</a>
            <a href="/features" class="btn-ghost">View All Features</a>
        </div>
    </div>
</section>

<!-- STATS -->
<div class="stats-bar">
    <div class="stats-inner">
        <div class="stat">
            <div class="stat-num">40+</div>
            <div class="stat-lbl">Clinical Modules</div>
        </div>
        <div class="stat">
            <div class="stat-num">99.9%</div>
            <div class="stat-lbl">Uptime SLA</div>
        </div>
        <div class="stat">
            <div class="stat-num">HIPAA</div>
            <div class="stat-lbl">Compliant</div>
        </div>
        <div class="stat">
            <div class="stat-num">0ms</div>
            <div class="stat-lbl">Offline Latency</div>
        </div>
    </div>
</div>

<!-- MODULES -->
<section class="section" style="background:var(--s950);">
    <div class="section-inner">
        <div class="section-tag">Core Platform</div>
        <h2 class="section-title">Every Clinical<br>Department. One OS.</h2>
        <p class="section-desc">From the ICU to the pharmacy counter — Opeshis OS unifies every care touchpoint into a single, high-performance institutional nerve center.</p>

        <div class="modules-grid">
            @php
            $modules = [
                ['bg'=>'rgba(99,102,241,.15)','color'=>'#818cf8','icon'=>'🩺','name'=>'EMR & Consultations','desc'=>'SOAP engine with ICD-11 coding & clinical decision support'],
                ['bg'=>'rgba(16,185,129,.12)','color'=>'#6ee7b7','icon'=>'💊','name'=>'Pharmacy & Dispensary','desc'=>'Real-time dispensing, drug interactions & POS integration'],
                ['bg'=>'rgba(59,130,246,.12)','color'=>'#93c5fd','icon'=>'🔬','name'=>'Laboratory','desc'=>'Order management, result entry & critical flag alerts'],
                ['bg'=>'rgba(245,158,11,.12)','color'=>'#fcd34d','icon'=>'📡','name'=>'Radiology & Imaging','desc'=>'DICOM worklist, order tracking & reporting portal'],
                ['bg'=>'rgba(236,72,153,.12)','color'=>'#f9a8d4','icon'=>'🫀','name'=>'ICU & Critical Care','desc'=>'SOFA scoring, ventilator logs & 24hr vitals monitoring'],
                ['bg'=>'rgba(99,102,241,.12)','color'=>'#c4b5fd','icon'=>'🤱','name'=>'Obstetrics & Maternal','desc'=>'ANC tracking, partograph & delivery suite management'],
                ['bg'=>'rgba(16,185,129,.12)','color'=>'#6ee7b7','icon'=>'👶','name'=>'Paediatrics & NICU','desc'=>'Growth charts, immunisation registry & neonatal care'],
                ['bg'=>'rgba(239,68,68,.12)','color'=>'#fca5a5','icon'=>'🚑','name'=>'Emergency & Trauma','desc'=>'Rapid triage, resuscitation logs & mass casualty mode'],
                ['bg'=>'rgba(168,85,247,.12)','color'=>'#d8b4fe','icon'=>'🧠','name'=>'Psychiatry','desc'=>'Mental status exams, risk scoring & medication trails'],
                ['bg'=>'rgba(20,184,166,.12)','color'=>'#5eead4','icon'=>'🧬','name'=>'Oncology','desc'=>'Chemo cycles, protocol management & oncology nursing'],
                ['bg'=>'rgba(245,158,11,.12)','color'=>'#fcd34d','icon'=>'💰','name'=>'Billing & Finance','desc'=>'Insurance claims, NHIF integration & revenue analytics'],
                ['bg'=>'rgba(99,102,241,.12)','color'=>'#a5b4fc','icon'=>'📊','name'=>'BI & Reporting','desc'=>'Morbidity pulse, DHIS2 export & institutional KPIs'],
            ];
            @endphp
            @foreach($modules as $m)
            <div class="mod-card">
                <div class="mod-icon" style="background:{{$m['bg']}};">
                    <span>{{$m['icon']}}</span>
                </div>
                <div class="mod-name">{{$m['name']}}</div>
                <div class="mod-desc">{{$m['desc']}}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- HIGHLIGHT -->
<section class="section" style="background:rgba(15,23,42,.5);border-top:1px solid rgba(255,255,255,.05);">
    <div class="section-inner">
        <div class="highlight-grid">
            <div>
                <div class="section-tag">Architecture</div>
                <h2 class="section-title">Engineered for<br>Institutional Scale</h2>
                <p class="section-desc">Built on battle-tested Laravel, PostgreSQL, and a zero-trust security perimeter — Opeshis OS is designed for multi-branch, high-concurrency hospital environments.</p>
                <div class="highlight-points">
                    <div class="hpoint">
                        <div class="hpoint-dot"></div>
                        <div>
                            <div class="hpoint-title">Multi-Branch Tenant Isolation</div>
                            <div class="hpoint-desc">Every query is scoped to branch_id at the framework level — data leakage between facilities is architecturally impossible.</div>
                        </div>
                    </div>
                    <div class="hpoint">
                        <div class="hpoint-dot" style="background:var(--emerald);box-shadow:0 0 10px var(--emerald);"></div>
                        <div>
                            <div class="hpoint-title">Offline-First Protocol</div>
                            <div class="hpoint-desc">Full clinical workflows function without internet. Local-first sync ensures continuity in low-bandwidth environments.</div>
                        </div>
                    </div>
                    <div class="hpoint">
                        <div class="hpoint-dot" style="background:#f59e0b;box-shadow:0 0 10px #f59e0b;"></div>
                        <div>
                            <div class="hpoint-title">Institutional Forensic Audit</div>
                            <div class="hpoint-desc">Every state-changing action creates an immutable audit log — who did what, when, on which record, from which IP.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="highlight-visual">
                <div style="position:relative;z-index:10;text-align:center;">
                    <div style="font-size:4rem;font-weight:900;letter-spacing:-.06em;background:linear-gradient(135deg,#6366f1,#818cf8,#c7d2fe);-webkit-background-clip:text;background-clip:text;color:transparent;line-height:1;">Zero<br>Trust</div>
                    <div style="font-size:.65rem;font-weight:700;text-transform:uppercase;letter-spacing:.2em;color:rgba(255,255,255,.3);margin-top:.75rem;">Security Architecture</div>
                    <div style="display:flex;gap:.75rem;justify-content:center;margin-top:1.5rem;flex-wrap:wrap;">
                        @foreach(['AES-256','MFA','RBAC','PII Vault','HTTPS','Audit Log'] as $badge)
                        <span style="padding:.25rem .65rem;background:rgba(99,102,241,.12);border:1px solid rgba(99,102,241,.25);border-radius:6px;font-size:.55rem;font-weight:800;letter-spacing:.15em;text-transform:uppercase;color:#a5b4fc;">{{$badge}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-inner">
        <h2 class="cta-title">Ready for<br>Institutional<br>Excellence.</h2>
        <p class="cta-sub">Standardize your facility today with the most resilient hospital operating system built for Africa and beyond.</p>
        <div class="hero-btns">
            <a href="/login" class="btn-primary">Launch Institutional Portal →</a>
            <a href="/contact" class="btn-ghost">Contact Enterprise Team</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-brand">
        <div class="footer-icon">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                <path d="M2 17L12 22L22 17" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M2 12L12 17L22 12" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
            </svg>
        </div>
        <span class="footer-name">Opeshis OS</span>
    </div>
    <div class="footer-links">
        <a href="/about" class="footer-link">About</a>
        <a href="/features" class="footer-link">Features</a>
        <a href="/faq" class="footer-link">FAQ</a>
        <a href="/blog" class="footer-link">Blog</a>
        <a href="/contact" class="footer-link">Contact</a>
    </div>
    <div class="footer-copy">© 2026 Opesware Innovation · Cameroon</div>
</footer>

</body>
</html>

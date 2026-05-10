<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Opeshis OS — Institutional-grade hospital operating system. 40+ clinical modules. Zero-trust security. Offline-first.">
<title>Opeshis OS — Hospital Intelligence Platform</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<style>
body{font-family:'Inter',sans-serif;background:#020617;color:#f8fafc;overflow-x:hidden;}
.grid-bg{background-image:linear-gradient(rgba(99,102,241,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.06) 1px,transparent 1px);background-size:56px 56px;}
.glow-text{background:linear-gradient(135deg,#e0e7ff 0%,#a5b4fc 40%,#818cf8 70%,#c7d2fe 100%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;}
.glass{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);backdrop-filter:blur(12px);}
.mod-card{background:rgba(15,23,42,.8);border:1px solid rgba(255,255,255,.06);transition:all .25s cubic-bezier(.4,0,.2,1);}
.mod-card:hover{border-color:rgba(99,102,241,.4);transform:translateY(-4px);box-shadow:0 20px 40px rgba(0,0,0,.5),0 0 0 1px rgba(99,102,241,.15);}
.btn-primary{background:linear-gradient(135deg,#6366f1,#4f46e5);box-shadow:0 4px 24px rgba(99,102,241,.35);}
.btn-primary:hover{box-shadow:0 8px 40px rgba(99,102,241,.5);transform:translateY(-2px);}
.orb1{position:absolute;width:800px;height:800px;background:radial-gradient(circle,rgba(99,102,241,.12) 0%,transparent 65%);border-radius:50%;top:-300px;left:-200px;filter:blur(60px);animation:drift 20s ease-in-out infinite alternate;}
.orb2{position:absolute;width:600px;height:600px;background:radial-gradient(circle,rgba(16,185,129,.08) 0%,transparent 65%);border-radius:50%;bottom:-200px;right:-100px;filter:blur(60px);animation:drift 25s ease-in-out infinite alternate-reverse;}
@keyframes drift{0%{transform:translate(0,0)}100%{transform:translate(30px,20px)}}
.pulse-dot{animation:pdot 2s ease-in-out infinite;}
@keyframes pdot{0%,100%{opacity:1;box-shadow:0 0 0 0 rgba(16,185,129,.4)}50%{opacity:.7;box-shadow:0 0 0 6px rgba(16,185,129,0)}}
nav{position:fixed;top:0;left:0;right:0;z-index:100;border-bottom:1px solid rgba(255,255,255,.05);background:rgba(2,6,23,.85);backdrop-filter:blur(24px);}
</style>
</head>
<body>


<nav>
 <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
 <a href="/" class="flex items-center gap-3">
 <div class="w-9 h-9 bg-sage rounded-xl flex items-center justify-center /40">
 <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2L2 7l10 5 10-5-10-5Z" fill="white"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
 </div>
 <span class="font-semibold text-white tracking-tight text-sm uppercase">Opeshis OS</span>
 </a>
 <div class="hidden md:flex items-center gap-8">
 <a href="<?php echo e(route('public.features')); ?>" class="text-slate-400 hover:text-white text-xs font-semibold font-medium transition-colors">Features</a>
 <a href="<?php echo e(route('public.about')); ?>" class="text-slate-400 hover:text-white text-xs font-semibold font-medium transition-colors">About</a>
 <a href="<?php echo e(route('public.faq')); ?>" class="text-slate-400 hover:text-white text-xs font-semibold font-medium transition-colors">FAQ</a>
 <a href="<?php echo e(route('public.contact')); ?>" class="text-slate-400 hover:text-white text-xs font-semibold font-medium transition-colors">Contact</a>
 <a href="<?php echo e(route('login')); ?>" class="btn-primary px-5 py-2.5 rounded-xl text-xs font-bold font-medium text-white transition-all duration-200">Enter Portal</a>
 </div>
 </div>
</nav>


<section class="relative min-h-screen flex items-center justify-center overflow-hidden grid-bg">
 <div class="orb1"></div><div class="orb2"></div>
 <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#020617]"></div>
 <div class="relative z-10 max-w-5xl mx-auto px-6 text-center pt-24 pb-20">
 <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full border border-indigo-500/30 bg-sage/8 mb-8">
 <span class="w-2 h-2 bg-emerald-400 rounded-full pulse-dot"></span>
 <span class="text-xs font-bold text-indigo-300 font-medium">Sentinel v2.2 · Now Live</span>
 </div>
 <h1 class="text-[clamp(3.5rem,9vw,7rem)] font-semibold leading-[.9] tracking-[-0.05em] uppercase text-white mb-8">
 The Operating<br><span class="glow-text">System for</span><br>Modern Healthcare.
 </h1>
 <p class="text-lg md:text-xl text-slate-400 font-light leading-relaxed max-w-2xl mx-auto mb-12 ">
 40+ integrated clinical modules. Offline-first architecture. Zero-trust security perimeter. Built for institutions where every second is a clinical decision.
 </p>
 <div class="flex flex-wrap gap-4 justify-center">
 <a href="<?php echo e(route('login')); ?>" class="btn-primary px-8 py-4 rounded-2xl text-sm font-bold font-medium text-white transition-all duration-200 flex items-center gap-3">
 <span>Enter Institutional Portal</span>
 <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
 </a>
 <a href="<?php echo e(route('public.features')); ?>" class="px-8 py-4 rounded-2xl text-sm font-bold font-medium text-slate-300 border border-subtle hover:bg-[#2a2e38] hover:border-white/20 transition-all duration-200">
 View Platform Features
 </a>
 </div>
 </div>
</section>


<div class="border-y border-subtle bg-card/40">
 <div class="max-w-5xl mx-auto px-6 py-10 grid grid-cols-2 md:grid-cols-4 gap-8">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [['40+','Clinical Modules'],['99.9%','Uptime SLA'],['HIPAA','Compliant'],['AES-256','Encrypted at Rest']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$num,$lbl]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="text-center">
 <div class="text-3xl font-semibold tracking-tight text-white mb-1"><?php echo e($num); ?></div>
 <div class="text-[12px] font-bold font-medium text-slate-500"><?php echo e($lbl); ?></div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
</div>


<section class="py-28 px-6">
 <div class="max-w-7xl mx-auto">
 <div class="mb-16 max-w-2xl">
 <div class="inline-block px-3 py-1 rounded-md bg-sage/10 border border-indigo-500/20 text-sage text-[12px] font-semibold font-medium mb-5">Platform Modules</div>
 <h2 class="text-5xl font-semibold tracking-tight uppercase text-white leading-[.95] mb-4">Every Department.<br>One Platform.</h2>
 <p class="text-slate-500 font-light leading-relaxed">From the triage desk to the executive boardroom — Opeshis OS is the single source of clinical truth for your institution.</p>
 </div>
 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
 <?php
 $modules = [
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>','color'=>'indigo','name'=>'EMR & Consultations','desc'=>'SOAP documentation, ICD-11 coding, clinical decision support'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>','color'=>'emerald','name'=>'Pharmacy & Dispensary','desc'=>'Real-time dispensing, drug interactions, POS integration'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>','color'=>'blue','name'=>'Laboratory','desc'=>'Order management, result entry, critical flag alerts'],
 ['ic'=>'<circle cx="11" cy="11" r="8" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m21 21-4.35-4.35M11 8v6m-3-3h6"/>','color'=>'violet','name'=>'Radiology & Imaging','desc'=>'DICOM worklist, order tracking, reporting portal'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>','color'=>'rose','name'=>'ICU & Critical Care','desc'=>'SOFA scoring, ventilator logs, 24-hr vitals monitoring'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>','color'=>'pink','name'=>'Obstetrics & Maternal','desc'=>'ANC tracking, partograph, delivery suite management'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>','color'=>'teal','name'=>'Paediatrics & NICU','desc'=>'Growth charts, immunisation registry, neonatal care'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>','color'=>'amber','name'=>'Emergency & Trauma','desc'=>'Rapid triage, resuscitation logs, mass casualty mode'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>','color'=>'purple','name'=>'Psychiatry','desc'=>'MSE, risk assessment, medication trails'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>','color'=>'indigo','name'=>'Oncology','desc'=>'Chemo cycles, protocol management, oncology nursing'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/>','color'=>'emerald','name'=>'Billing & Finance','desc'=>'Insurance claims, NHIF integration, revenue analytics'],
 ['ic'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>','color'=>'sky','name'=>'BI & Reporting','desc'=>'Morbidity pulse, DHIS2 export, institutional KPIs'],
 ];
 $colorMap=['indigo'=>['bg'=>'bg-sage/10','text'=>'text-sage','border'=>'border-indigo-500/20'],'emerald'=>['bg'=>'bg-emerald-500/10','text'=>'text-emerald-400','border'=>'border-emerald-500/20'],'blue'=>['bg'=>'bg-sage/10','text'=>'text-sage','border'=>'border-blue-500/20'],'violet'=>['bg'=>'bg-violet-500/10','text'=>'text-violet-400','border'=>'border-violet-500/20'],'rose'=>['bg'=>'bg-rose-500/10','text'=>'text-rose-400','border'=>'border-rose-500/20'],'pink'=>['bg'=>'bg-pink-500/10','text'=>'text-pink-400','border'=>'border-pink-500/20'],'teal'=>['bg'=>'bg-teal-500/10','text'=>'text-teal-400','border'=>'border-teal-500/20'],'amber'=>['bg'=>'bg-amber-500/10','text'=>'text-amber-400','border'=>'border-amber-500/20'],'purple'=>['bg'=>'bg-purple-500/10','text'=>'text-purple-400','border'=>'border-purple-500/20'],'sky'=>['bg'=>'bg-sky-500/10','text'=>'text-sky-400','border'=>'border-sky-500/20']];
 ?>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <?php $c=$colorMap[$m['color']]??$colorMap['indigo']; ?>
 <div class="mod-card rounded-2xl p-6 group cursor-default">
 <div class="w-10 h-10 rounded-xl <?php echo e($c['bg']); ?> border <?php echo e($c['border']); ?> flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200">
 <svg class="w-5 h-5 <?php echo e($c['text']); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><?php echo $m['ic']; ?></svg>
 </div>
 <h3 class="text-sm font-bold text-white mb-1.5 tracking-tight"><?php echo e($m['name']); ?></h3>
 <p class="text-xs text-slate-500 leading-relaxed font-light"><?php echo e($m['desc']); ?></p>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 </div>
</section>


<section class="py-28 px-6 border-t border-subtle bg-card/30">
 <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center">
 <div>
 <div class="inline-block px-3 py-1 rounded-md bg-sage/10 border border-indigo-500/20 text-sage text-[12px] font-semibold font-medium mb-5">Architecture</div>
 <h2 class="text-5xl font-semibold tracking-tight uppercase text-white leading-[.95] mb-6">Engineered for<br>Institutional Scale.</h2>
 <p class="text-slate-500 font-light leading-relaxed mb-10">Built on battle-tested Laravel, PostgreSQL, and a zero-trust security perimeter. Designed to serve multi-branch hospital networks under heavy concurrent load.</p>
 <div class="space-y-6">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
 ['Multi-Branch Tenant Isolation','Every query is scoped to branch_id at framework level. Data leakage between facilities is architecturally impossible.','indigo'],
 ['Offline-First Clinical Protocol','Full clinical workflows function without internet connectivity. Local-first sync ensures care continuity in low-bandwidth environments.','emerald'],
 ['Immutable Forensic Audit Trail','Every state-changing action creates a tamper-proof log — who acted, on which record, from which IP, at what time.','amber'],
 ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$t,$d,$c]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="flex gap-4">
 <div class="w-2 h-2 rounded-full bg-<?php echo e($c); ?>-500 shadow-[0_0_8px_theme(colors.<?php echo e($c); ?>.500)] mt-1.5 flex-shrink-0"></div>
 <div>
 <div class="text-sm font-bold text-white mb-1 uppercase tracking-tight"><?php echo e($t); ?></div>
 <div class="text-sm text-slate-500 font-light leading-relaxed"><?php echo e($d); ?></div>
 </div>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 </div>
 <div class="glass rounded-3xl p-10 relative overflow-hidden">
 <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/5 to-transparent"></div>
 <div class="relative z-10">
 <div class="text-[12px] font-semibold font-medium text-slate-600 mb-6">Security Architecture</div>
 <div class="grid grid-cols-2 gap-3 mb-8">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['AES-256 Encryption','Zero-Trust Perimeter','Role-Based Access','PII Vault','MFA Enforcement','Audit Logging','HTTPS Enforced','Session Isolation']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <div class="flex items-center gap-2.5 p-3 rounded-xl bg-white/[.03] border border-white/[.06]">
 <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full flex-shrink-0"></div>
 <span class="text-xs font-semibold text-slate-400"><?php echo e($b); ?></span>
 </div>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 <div class="flex items-center justify-between pt-6 border-t border-subtle">
 <div class="text-center">
 <div class="text-2xl font-semibold text-white tracking-tight">HIPAA</div>
 <div class="text-[12px] font-bold font-medium text-slate-600 mt-1">Compliant</div>
 </div>
 <div class="w-px h-10 bg-[#2a2e38]"></div>
 <div class="text-center">
 <div class="text-2xl font-semibold text-white tracking-tight">DHIS2</div>
 <div class="text-[12px] font-bold font-medium text-slate-600 mt-1">Integration</div>
 </div>
 <div class="w-px h-10 bg-[#2a2e38]"></div>
 <div class="text-center">
 <div class="text-2xl font-semibold text-white tracking-tight">ISO</div>
 <div class="text-[12px] font-bold font-medium text-slate-600 mt-1">Standards</div>
 </div>
 </div>
 </div>
 </div>
 </div>
</section>


<section class="py-32 px-6 relative overflow-hidden">
 <div class="absolute inset-0 bg-gradient-to-b from-transparent via-indigo-950/20 to-transparent pointer-events-none"></div>
 <div class="max-w-3xl mx-auto text-center relative z-10">
 <h2 class="text-6xl font-semibold tracking-tight uppercase text-white leading-[.9] mb-6">Ready to<br><span class="glow-text">Modernize</span><br>Your Institution?</h2>
 <p class="text-slate-500 text-lg font-light leading-relaxed mb-10 ">Join the institutions already running on Africa's most sophisticated hospital operating system.</p>
 <div class="flex flex-wrap gap-4 justify-center">
 <a href="<?php echo e(route('login')); ?>" class="btn-primary px-10 py-4 rounded-2xl text-sm font-bold font-medium text-white transition-all duration-200 flex items-center gap-3">
 <span>Launch Institutional Portal</span>
 <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
 </a>
 <a href="<?php echo e(route('public.contact')); ?>" class="px-10 py-4 rounded-2xl text-sm font-bold font-medium text-slate-300 border border-subtle hover:bg-[#2a2e38] hover:border-white/20 transition-all duration-200">Contact Sales Team</a>
 </div>
 </div>
</section>


<footer class="border-t border-subtle bg-card/30 px-6 py-8">
 <div class="max-w-7xl mx-auto flex flex-wrap gap-6 items-center justify-between">
 <div class="flex items-center gap-3">
 <div class="w-8 h-8 bg-sage rounded-lg flex items-center justify-center">
 <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 2L2 7l10 5 10-5-10-5Z" fill="white"/><path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="white" stroke-width="2.5" stroke-linecap="round"/></svg>
 </div>
 <span class="text-sm font-semibold uppercase tracking-tight text-white">Opeshis OS</span>
 </div>
 <div class="flex gap-6 flex-wrap">
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['About'=>'public.about','Features'=>'public.features','FAQ'=>'public.faq','Blog'=>'public.blog','Contact'=>'public.contact','Portal Login'=>'login']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lbl=>$route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
 <a href="<?php echo e(route($route)); ?>" class="text-[12px] font-bold font-medium text-slate-600 hover:text-slate-300 transition-colors"><?php echo e($lbl); ?></a>
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
 </div>
 <div class="text-[12px] font-mono font-medium text-slate-700">© 2026 Opesware Innovation · Cameroon</div>
 </div>
</footer>

</body>
</html>
<?php /**PATH C:\laragon\www\opeshis\resources\views/public/landing.blade.php ENDPATH**/ ?>
@props(['title' => 'Opeshis OS'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plh7eecsDa4A4e/eq+4e7V8zn3iHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0b0f19; color: #cbd5e1; }
        .bg-obsidian { background-color: #06080c; }
        .bg-panel { background-color: #131824; }
        .border-subtle { border-color: rgba(255,255,255,0.04); }
        .text-sage { color: #4ade80; }
        .bg-sage { background-color: #4ade80; }
        
        .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #334155; }
    </style>
</head>
<body class="antialiased selection:bg-[#4ade80]/20 selection:text-[#4ade80] custom-scrollbar overflow-hidden flex h-screen">
    
    <!-- Sidebar -->
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Header -->
        <header class="h-16 border-b border-subtle flex items-center justify-between px-8 bg-[#0b0f19] z-40 sticky top-0">
            <div class="flex items-center gap-6 flex-1">
                <div class="relative w-full max-w-md group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-500 text-xs"></i>
                    </div>
                    <input type="text" placeholder="Search records, patients, or modules..." class="w-full bg-[#131824] border border-transparent rounded-lg py-2 pl-9 pr-4 text-xs text-slate-200 placeholder-slate-600 outline-none focus:border-[#4ade80]/30 focus:ring-2 focus:ring-[#4ade80]/10 transition-all">
                </div>
            </div>

            <div class="flex items-center gap-5">
                <button class="text-slate-500 hover:text-slate-300 transition-colors relative">
                    <i class="fas fa-bell"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 rounded-full bg-rose-500"></span>
                </button>
                <div class="h-6 w-px bg-white/5"></div>
                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-semibold text-slate-200 leading-none group-hover:text-white transition-colors">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-slate-500 mt-1">{{ Auth::user()->role ?? 'Clinical Lead' }}</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-[#1e293b] flex items-center justify-center font-semibold text-white text-xs border border-subtle group-hover:border-[#4ade80]/50 transition-colors">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 custom-scrollbar relative">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>

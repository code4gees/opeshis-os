@props(['title' => 'Opeshis OS'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-950 text-slate-300 antialiased selection:bg-indigo-500 selection:text-white">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Institutional Sidebar -->
        @include('partials.sidebar')

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Navigation Bar -->
            <header class="h-20 border-b border-white/5 flex items-center justify-between px-12 bg-slate-950/50 backdrop-blur-md z-40 sticky top-0">
                <div class="flex items-center gap-8 flex-1">
                    <div class="relative w-full max-w-xl group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-slate-500 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" placeholder="Institutional Registry Search..." class="w-full bg-white/5 border border-white/10 rounded-xl py-3 pl-12 pr-4 text-xs font-bold text-white placeholder-slate-500 outline-none focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2 px-4 py-2 bg-emerald-500/10 border border-emerald-500/20 rounded-xl">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">Sentinel Active</span>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-[10px] font-black text-white uppercase leading-none">{{ Auth::user()->name ?? 'System Admin' }}</p>
                            <p class="text-[8px] font-black text-blue-500 uppercase tracking-widest mt-1">{{ Auth::user()->role ?? 'Institutional Personnel' }}</p>
                        </div>
                        <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-700 rounded-xl flex items-center justify-center font-black text-white text-xs shadow-lg shadow-blue-600/20">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-12 no-scrollbar scroll-smooth">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>

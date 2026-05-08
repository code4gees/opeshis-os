@props(['title' => 'Opeshis OS'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #1a1d24; 
            color: #ffffff; 
        }
        .bg-sidebar { background-color: #16191f; }
        .bg-card { background-color: #22262f; }
        .bg-card-hover { background-color: #2a2e38; }
        .border-subtle { border-color: rgba(255,255,255,0.06); }
        .text-sage { color: #82c09a; }
        .bg-sage { background-color: #82c09a; }
        .text-alert { color: #d9776c; }
        
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #3b4252; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #4c566a; }

        /* Smooth chart fills */
        .chart-gradient {
            background: linear-gradient(180deg, rgba(130,192,154,0.2) 0%, rgba(130,192,154,0) 100%);
        }
    </style>
</head>
<body class="antialiased selection:bg-[#82c09a]/20 selection:text-[#82c09a] overflow-hidden flex h-screen">
    
    <!-- Sidebar -->
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0">
        <main class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            {{ $slot }}
        </main>
    </div>
    
    @livewireScripts
</body>
</html>

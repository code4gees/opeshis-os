@props(['title' => 'Opeshis OS', 'noSidebar' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased selection:bg-[#82c09a]/20 selection:text-[#82c09a] overflow-hidden flex h-screen bg-[#1a1d24] text-white font-outfit">
    
    <!-- Sidebar -->
    @if(!$noSidebar)
        @include('partials.sidebar')
    @endif

    <div class="flex-1 flex flex-col min-w-0">
        <main class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            {{ $slot }}
        </main>
    </div>
    
    @livewireScripts
</body>
</html>

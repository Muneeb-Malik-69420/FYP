<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoBite Supplier Portal')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">

    @livewireStyles
<style>
    .sidebar-locked {
        filter: grayscale(100%);
        opacity: 0.5;
        pointer-events: none;
        user-select: none;
    }
</style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Montserrat', 'sans-serif'] },
                    colors: {
                        'forest-dark': '#0f711c',
                        'forest-light': '#52c234',
                    }
                    // ... your keyframes
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 m-0 p-0 font-sans antialiased text-gray-900"x-data="{ sidebarOpen: true }" x-data="{ sidebarOpen: window.innerWidth > 1024 }">

    <div class="flex h-screen overflow-hidden">
        
        @auth
            @include('supplier.partials.sidebar')
        @endauth

        <div class="flex-1 flex flex-col overflow-hidden">
            @auth
                @include('supplier.partials.top-nav')
            @endauth

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
    @yield('scripts')
</body>
</html>